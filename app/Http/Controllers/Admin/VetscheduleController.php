<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vetschedule;
use App\Models\VetShifts;
use App\Models\HospitalAppointments;
use DB;
use DateTime;
use DateInterval;
use DatePeriod;

class VetScheduleController extends Controller
{
public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Vetschedule::whereDate('available_from', '>=', $request->start)
                       ->whereDate('available_to',   '<=', $request->end)
                       ->get(['id', 'available_from', 'available_to']);
            return response()->json($data);
    	}
    	return view('full-calender');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{dd($request->start);
    			$event = Vetschedule::create([
    				'title'		=>	$request->title,
    				'available_from'		=>	$request->start,
    				'available_to'		    =>	$request->end,
                    'vet_id'                =>'1',
    			]);
                $event->save();
    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Vetschedule::find($request->id)->update([
    				'title'		=>	$request->title,
    				'available_from'		=>	$request->start,
    				'available_to'		    =>	$request->end,
                    'vet_id'                =>1,
    			]);
                $event->save();
    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Vetschedule::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
	public function getVetSchedules(Request $request, $vet_id =NULL){
        $result = [];
		$params['start'] = date('Y-m-d',strtotime($request->get('start')));
		$params['end'] = date('Y-m-d',strtotime($request->get('end')));
		$params['vet_id'] = $vet_id;

        $schedules = Vetschedule::getVetSchedules($params);
    
        if($schedules){
            $i=0;
            foreach($schedules as $data){
                $date = $data->date;
                $result[$i]['title'] = '';
                $result[$i]['start'] = $date;
                $result[$i]['end'] = $date;
                $result[$i]['display'] = 'background';
				$result[$i]['className'] = 'scheduled';
                $i++;
            }
        }
		
        return response()->json($result);
    }

	public function saveVetSchedule(Request $request){
		$vet_id = $request->get('vet_id');
		$addDates = $request->get('addDates');
		$removeDates = $request->get('removeDates');

		$add = explode(',',$addDates);
		$remove = explode(',',$removeDates);
		
		$datesRemove = $datesNotRemoved = [];
		if(!empty($add[0])){
			foreach($add as $add_date){
				$schedule = Vetschedule::firstOrCreate(
					['vet_id' => $vet_id,'date' =>  "$add_date",'status' => 'published']
				);
			}
		}

		if(!empty($remove)){
			foreach($remove as $rem){
				$bookedCount = HospitalAppointments::where('vet_id',$vet_id)->where('date_appointment',"$rem")->count();
				if($bookedCount == 0){
					$datesRemove[] = $rem;
				}else{
					$datesNotRemoved [] = $rem;
				}
			}
			Vetschedule::where('vet_id',$vet_id)->whereIn('date',$datesRemove)->delete();
		}
		if(!empty($datesNotRemoved)){
			$count = count($datesNotRemoved);
			$dateWord = ($count == 1) ? 'date' : 'dates';
			$status = 'warning';
			$responseMsg = 'Booking already created. Unable to delete schedule for the '.$dateWord.' '.implode(', ',$datesNotRemoved);
		}else{
			$status = 'success';
			$responseMsg = 'Updated Successfully';
		}
		return json_encode(array('status' => $status,'msg' => $responseMsg));
	}

	public function getScheduledVets(Request $request, $vet_id =NULL){
        $result = [];
		$params['start'] = date('Y-m-d',strtotime($request->get('start')));
		$params['end'] = date('Y-m-d',strtotime($request->get('end')));
        $schedules = Vetschedule::getVetSchedulesByDates($params);
		
        if($schedules){
            $i=0;
            foreach($schedules as $data){
                $date = $data->date;
				$color = $this->getSlotAvailabiltyColor($date,$data->vet_ids,$data->vet_name);
				$response = json_decode($color);
				
                $result[$i]['title'] = implode(' <br> ',$response->vetNames);
                $result[$i]['start'] = $date;
                $result[$i]['end'] = $date;
                $result[$i]['display'] = 'background';
				$result[$i]['allDay'] = true;
				$result[$i]['className'] = ($response->count != 0) ? 'scheduled' : 'fully-booked';
                $i++;
            }
        }
	
        return response()->json($result);
    }

	public function getSlotAvailabiltyColor($date,$vet_ids,$vet_names){
		$vetIds = explode(',',$vet_ids);
		$vetNames = explode(',',$vet_names);
		$shifts = VetShifts::getVetShiftsByDate($vetIds,$date);
		$count = 0;
		$vets = [];
		if($vetIds){
			foreach($vetIds as $key=>$id){
				$bookedCount = $this->checkSlotBooked($id,$date);
				if($bookedCount != count($shifts[$id])){
					$count++;
					$vets[] = '<span class="not-booked">'.$vetNames[$key].'</span>';
				}else{
					$vets[] = '<span class="booked-red">'.$vetNames[$key].'</span>';
				}
			}
		}
		return json_encode(array('count' => $count, 'vetNames' => $vets));
	}
	public function checkSlotBooked($id,$date){
		$count = HospitalAppointments::select('id')
										->whereDate('date_appointment',$date)
										->where('vet_id',$id)
										->count();
		return $count;
	}

	public function ajaxGetYearSchedules(Request $request){
        $month = $request->month; 
        $year = $request->year; 

        $date = $year.'-'.$month.'-01';
        $newYear = date("Y",strtotime ( '+1 year' , strtotime ( $date ) ));
        $newMonth = date("m",strtotime ( '+1 month' , strtotime ( $date ) ));
        
        $startMonthWord = ($year == date('Y') && $month == date('m') ) ?  date("M",strtotime ($date)) : 'Jan';
        $endMonthWord = ($year == date('Y') && $month == date('m') ) ?  date("M",strtotime ($date)) : 'Dec';

        if(($year == date('Y') && $month == date('m') )){
            $start    = (new DateTime($year.'-'.$month.'-01'));
            $end      = (new DateTime($newYear.'-'.$newMonth.'-01'));
        }else{
            $start    = (new DateTime($year.'-01-01'));
            $end      = (new DateTime($year.'-12-31'));
            $newYear = $year;
        }
        
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);
        $result = [];
        $i = 0;
        foreach ($period as $dt) {
           
            $vetnames = '';
           
            $vets =  Vetschedule::select("date")
								->where('status', 'published')
								->whereYear('date',$dt->format("Y"))
                            	->whereMonth('date',$dt->format("m"))
								->where('vet_id',$request->vet_id)
								->get();
										        
            $result[$i]['vet'] = (isset($vets[0])) ? 1 : 0 ;
            $result[$i]['year'] = $dt->format("Y");
            $result[$i]['month'] = $dt->format("m");
            $result[$i]['name'] = $dt->format("M-Y");
            $i++; 
        }

        $viewData = view('admin.vet.year_schedule', compact('month','startMonthWord','endMonthWord','year','newYear','result'))->render();
        return $viewData;
    }
}	