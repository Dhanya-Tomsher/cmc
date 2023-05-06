<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vetschedule;
use App\Models\VetShifts;
use App\Models\HospitalAppointments;
use DB;

class VetScheduleController extends Controller
{
public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = VetSchedule::whereDate('available_from', '>=', $request->start)
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
    			$event = VetSchedule::create([
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
    			$event = VetSchedule::find($request->id)->update([
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
    			$event = VetSchedule::find($request->id)->delete();

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
		
		$add_datas = [];
		if(!empty($add[0])){
			foreach($add as $add_date){
				$schedule = Vetschedule::firstOrCreate(
					['vet_id' => $vet_id,'date' =>  "$add_date",'status' => 'published']
				);
			}
		}
		if(!empty($remove)){
			Vetschedule::where('vet_id',$vet_id)->whereIn('date',$remove)->delete();
		}
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
				$color = $this->getSlotAvailabiltyColor($date,$data->vet_ids);

                $result[$i]['title'] = str_replace(',',' <br> ',$data->vet_name);
                $result[$i]['start'] = $date;
                $result[$i]['end'] = $date;
                $result[$i]['display'] = 'background';
				$result[$i]['allDay'] = true;
				$result[$i]['className'] = ($color != 0) ? 'scheduled' : 'fully-booked';
                $i++;
            }
        }
		
        return response()->json($result);
    }

	public function getSlotAvailabiltyColor($date,$vet_ids){
		$vetIds = explode(',',$vet_ids);
		$shifts = VetShifts::getVetShiftsByDate($vetIds,$date);
		$count = 0;
		if($vetIds){
			foreach($vetIds as $id){
				$bookedCount = $this->checkSlotBooked($id,$date);
				if($bookedCount != count($shifts[$id])){
					$count++;
				}
			}
		}
		return $count;
	}
	public function checkSlotBooked($id,$date){
		$count = HospitalAppointments::select('id')
										->whereDate('date_appointment',$date)
										->where('vet_id',$id)
										->count();
		return $count;
	}
}	