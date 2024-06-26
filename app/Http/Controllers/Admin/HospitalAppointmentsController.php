<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caretaker;
use App\Models\Cat;
use App\Models\Vet;
use App\Models\Vetschedule;
use App\Models\Procedures;
use App\Models\VetShifts;
use App\Models\Country;
use App\Models\Invoices;
use App\Http\Requests\StoreHospitalAppointmentRequest;
use App\Http\Requests\StoreHospitalAppointmentsRequest;
use App\Http\Requests\UpdateHospitalAppointmentRequest;
use App\Http\Requests\UpdateHospitalAppointmentsRequest;
use Illuminate\Http\Request;
use App\Models\HospitalAppointments;
use DB;
use DateTime;
use Helper;
use DateInterval;
use DatePeriod;


class HospitalAppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $hosp  = HospitalAppointments::all();
        return view('admin.hosp.index')->with([
            'hosp' => $hosp,
        ]);
    }
    public function create()
    {
        return view('admin.hosp.create');
    }
    public function search()
    {
        return view('admin.hosp.create');
    }
    public function update(UpdateHospitalAppointmentRequest $request, HospitalAppointments $hosp)
    {
        $hosp->update($request->all());
        return back()->with('status', 'Hospital Appointment Upated!');
    }
    public function view(HospitalAppointments $hosp)
    {
        return view('admin.hosp.show')->with([
            'hosp' => $hosp,
        ]);
    }
    public function edit(HospitalAppointments $hosp)
    {
        return view('admin.hosp.edit')->with([
            'hosp' => $hosp
        ]);
    }
    public function store(StoreHospitalAppointmentRequest $request)
    {
        $hosp = HospitalAppointments::create([
            'cat_id' => $request->cat_id,
            'vet_id' => $request->vet_id,
            'date_appointment' => $request->date_appointment,
            'time_appointment' => $request->time_appointment,
            'caretaker_id' => $request->caretaker_id,
            'reason' => $request->reason,
            'vet_comment' => $request->vet_comment,
            'medicine' => $request->medicine,
            'caretaker_comment' => $request->caretaker_comment,
            'status' => $request->status,
        ]);
        return redirect()->route('hosp.index')->with('status', 'Hospital Appointment created!');
    }
    public function getAppointments(){
        $events = [];
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->orderBy('name','ASC')
                    ->get();

        $procedures = Procedures::select("id","name","price")
                    ->where('status', 1)
                    ->orderBy('name','ASC')
                    ->get();

        $timeslots = Helper::getTimeSlotHrMIn(30,env('SLOT_FROM_TIME'),env('SLOT_TO_TIME'));

        return view('admin.hospital.appointments')-> with([
            'vets' => $vets,
            'timeslots' => $timeslots,
            'procedures' => $procedures
        ]);
    }

    public function searchCaretaker(Request $request)
    {
        $caretakers = [];
            
        if($request->has('term')){
            $search = $request->term;
            $query = Caretaker::select("id","name","customer_id")
                            ->where('status', 'published')->where('is_blacklist',0);
            if($search){  
                $query->Where(function ($query) use ($search) {
                    $query->orWhere('name', 'LIKE', "%$search%")
                    ->orWhere('customer_id', 'LIKE', "$search%")
                    ->orWhere('phone_number', 'LIKE', "$search%")
                    ->orWhere('whatsapp_number', 'LIKE', "$search%")
                    ->orWhere('work_contact_number', 'LIKE', "$search%");
                });                    
            }
                            
            $caretakers = $query->orderBy('name','ASC')
                            ->get();
        }else{
            $caretakers = Caretaker::select("id","name","customer_id")
                            ->where('status', 'published')
                            ->where('is_blacklist',0)
                            ->orderBy('name','ASC')
                            ->get();
        }
        return response()->json($caretakers);
    }

    public function getCaretakerDetails(Request $request){
        $id = $request->id;
        $caretakers = Caretaker::select("caretakers.*","countries.name as country","states.name as state")
                            ->leftJoin('countries','countries.id', '=', 'caretakers.home_country')
                            ->leftJoin('states','states.id', '=', 'caretakers.state_id')
                            ->where('caretakers.is_blacklist',0)
                            ->where('caretakers.status', 'published')
                            ->where('caretakers.id', $id)
                            ->get();
        return json_encode($caretakers);
    }

    public function searchCat(Request $request)
    {
        $cats = [];
            
        if($request->has('term')){
            $search = $request->term;
            $cats = Cat::select("cats.id","cats.name","cats.cat_id")
                            ->leftJoin('cat_caretakers','cats.id', '=', 'cat_caretakers.cat_id')
                            ->where('cat_caretakers.caretaker_id', $request->caretaker_id)
                            ->where('cats.status', 'published')
                            ->where('cat_caretakers.transfer_status', 0)
                            ->where('cats.name', 'LIKE', "%$search%")
                            ->orWhere('cats.cat_id', 'LIKE', "$search%")
                            ->orderBy('cats.name','ASC')
                            ->get();
        }else{
            $cats = Cat::select("cats.id","cats.name","cats.cat_id")
                            ->leftJoin('cat_caretakers','cats.id', '=', 'cat_caretakers.cat_id')
                            ->where('cat_caretakers.caretaker_id', $request->caretaker_id)
                            ->where('cats.status', 'published')
                            ->where('cat_caretakers.transfer_status', 0)
                            ->orderBy('cats.name','ASC')
                            ->get();
        }
        return response()->json($cats);
    }

    public function getCatDetails(Request $request){
        $id = $request->id;
        $cat = Cat::select("cats.*","countries.name as country","states.name as state")
                    ->leftJoin('countries','countries.id', '=', 'cats.place_of_origin')
                    ->leftJoin('states','states.id', '=', 'cats.state_id')
                    ->where('cats.status', 'published')
                    ->where('cats.id', $id)
                    ->get();
        return json_encode($cat);
    }
    public function searchProcedure(Request $request)
    {
        $procedures = [];
            
        if($request->has('term')){
            $search = $request->term;
            $procedures = Procedures::select("id","name","price")
                            ->where('status', 1)
                            ->Where('name', 'LIKE', "%$search%")
                            ->orderBy('name','ASC')
                            ->get();
        }else{
            $procedures = Procedures::select("id","name","price")
                            ->where('status', 1)
                            ->orderBy('name','ASC')
                            ->get();
        }
        return response()->json($procedures);
    }

    

    public function saveAppointmentDetails(Request $request){
        $appointmentTime = $request->appointment_time;
        $data = [];
      
        if(!empty($appointmentTime)){
            foreach($appointmentTime as $time){
                $hosp = HospitalAppointments::create([
                    'cat_id' => $request->catId,
                    'caretaker_id' => $request->caretaker_id,
                    'procedure_id' => $request->procedure,
                    'vet_id' => $request->vet_id,
                    'date_appointment' => $request->appointment_date,
                    'time_appointment' => $time,
                    'reason' => $request->remarks,
                    'payment_type' => $request->payment_type
                ]);
                $vat = ($request->price/100) * 5;  // 5% VAT calculation
                $total = $request->price + $vat;
                $data[] = array(
                    'booking_id' => $hosp->id,
                    'booking_type' => 'hospital_appointment',
                    'price' => $request->price, 
                    'net' => $request->price, 
                    'vat' => $vat,
                    'net_vat' => $total, 
                    'total' => $total, 
                    'invoice_date' => date('Y-m-d'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }
            if(!empty($data)){
                Invoices::insert($data);
            }
        }
        
        return $request->appointment_date;
    }

    public function getHospitalAppointments(Request $request){
        $result = [];
        // DB::enableQueryLog();
        $resultData = HospitalAppointments::leftJoin('vets','vets.id', '=', 'hospital_appointments.vet_id')
                    ->whereDate('hospital_appointments.date_appointment', '>=', $request->start)
                    ->whereDate('hospital_appointments.date_appointment',   '<=', $request->end)
                    ->get(['hospital_appointments.date_appointment','hospital_appointments.time_appointment','vets.name']);
        // dd(DB::getQueryLog());
        if($resultData){
            $i=0;
            foreach($resultData as $data){
                $date = $data->date_appointment;
                $time = $data->time_appointment;
                $timeNew = explode('-',$time);
                $from_time = trim($timeNew[0]);
                $to_time = trim($timeNew[1]);
            
                $result[$i]['title'] = $data->name;
                $result[$i]['start'] = $date.' '.$from_time;
                $result[$i]['end'] = $date.' '.$to_time;
                $i++;
            }
        }
        
        return response()->json($result);
       
    }

    public function getSelectedSlots(Request $request){
        $date = $request->date;
        $vet_id = $request->vet_id;
        $allSlots  = [];

        $slots = Vetschedule::where('vet_id', $vet_id)->where('date', $date)
								->select('available_from','available_to')
								->get()->toArray();

		if($slots){
			foreach($slots as $sl){
				$allSlots = Helper::getTimeSlotHrMIn('30', $sl['available_from'], $sl['available_to']);
			}
        }

        $bookedSlots = HospitalAppointments::select('time_appointment')
                                    ->whereDate('date_appointment', $date)
                                    ->where('vet_id',$vet_id)
                                    ->get()->pluck('time_appointment')->toArray();
        $result =  array_diff($allSlots,$bookedSlots);
        return json_encode($result);
    }

    public function getDayAppointments(){
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->orderBy('name','ASC')
                    ->get();

        $procedures = Procedures::select("id","name","price")
                    ->where('status', 1)
                    ->orderBy('name','ASC')
                    ->get();

        $timeslots = Helper::getTimeSlot(30,env('SLOT_FROM_TIME'),env('SLOT_TO_TIME'));

        return view('admin.hospital.day_appointment')-> with([
            'vets' => $vets,
            'timeslots' => $timeslots,
            'procedures' => $procedures
        ]);
    }
    public function ajaxGetDayAppointments(Request $request){
        $date = $request->date; 
        $vets = Vetschedule::getVetsByDatesScheduled($date);
        // $vetSlots = VetShifts::getVetDateShifts($date);
        $vetSlots = [];
        if($vets){
			foreach($vets as $sl){
				$vetSlots[$sl['id']] = Helper::getTimeSlotHrMIn('30', $sl['available_from'], $sl['available_to']);
			}
		}

        $timeslots = Helper::getTimeSlotHrMIn(30,env('SLOT_FROM_TIME'),env('SLOT_TO_TIME'));
        $vetBookings = HospitalAppointments::leftJoin('vets','vets.id', '=', 'hospital_appointments.vet_id')
                                        ->leftJoin('caretakers','hospital_appointments.caretaker_id','=','caretakers.id')
                                        ->leftJoin('cats','hospital_appointments.cat_id','=','cats.id')
                                        ->whereDate('hospital_appointments.date_appointment', '=',  $date)
                                        ->get(['hospital_appointments.vet_id','hospital_appointments.time_appointment','vets.name','caretakers.name as caretaker_name','cats.name as cat_name']);
        $vetBooks = $details = [];
        if($vetBookings){
            foreach($vetBookings as $booking){
                $vetBooks[$booking->vet_id][] = $booking->time_appointment;
                $details[$booking->time_appointment]['caretaker'] = $booking->caretaker_name;
                $details[$booking->time_appointment]['cat'] = $booking->cat_name;
            }
        }

        // print_r($vetBooks);
        // die;
        
        $viewData = view('admin.hospital.day_appointment', compact('vets','timeslots','vetBooks','date','vetSlots','details'))->render();
        return $viewData;
    }
    public function manageHospitalAppointments(Request $request){
        // print_r($request->all());die;
        $request->session()->put('last_url', url()->full());
        
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->orderBy('name','ASC')
                    ->get();

        $procedures = Procedures::select("id","name","price")
                    ->where('status', 1)
                    ->orderBy('name','ASC')
                    ->get();

        $timeslots = Helper::getTimeSlotHrMIn(30,env('SLOT_FROM_TIME'),env('SLOT_TO_TIME'));

        $search = $request->has('search') ? $request->search : '';
        $from_date = $request->has('from_date') ? $request->from_date : '';
        $to_date = $request->has('to_date') ?  $request->to_date : '';
        
        $query  = HospitalAppointments::leftJoin('vets','vets.id', '=', 'hospital_appointments.vet_id')
                                ->leftJoin('caretakers','hospital_appointments.caretaker_id','=','caretakers.id')
                                ->leftJoin('cats','hospital_appointments.cat_id','=','cats.id')
                                ->leftJoin('procedures','hospital_appointments.procedure_id','=','procedures.id');
        if($search){  
            $query->where(function ($query) use ($search) {
                $query->orWhere('procedures.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('vets.name', 'LIKE', $search . '%')
                        ->orWhere('hospital_appointments.time_appointment', 'LIKE', $search . '%')
                        ->orWhere('cats.cat_id', 'LIKE', $search . '%')
                        ->orWhere('caretakers.customer_id', 'LIKE', $search . '%')
                        ->orWhere('caretakers.name', 'LIKE', $search . '%')
                        ->orWhere('cats.name', 'LIKE', $search . '%');
            });                    
        }
        if($from_date != '' || $to_date != ''){
            if($from_date != '' && $to_date != ''){
                $query->whereDate('hospital_appointments.date_appointment', '>=', $from_date)
                ->whereDate('hospital_appointments.date_appointment',   '<=', $to_date);
            }elseif($from_date == '' && $to_date != ''){
                $query->whereDate('hospital_appointments.date_appointment', '=', $to_date);
            }elseif($from_date != '' && $to_date == ''){
                $query->whereDate('hospital_appointments.date_appointment', '=', $from_date);
            }
        }
        $hosp = $query->orderBy('hospital_appointments.id','DESC')
        ->select(['hospital_appointments.payment_confirmation','vets.is_deleted as vet_deleted','hospital_appointments.created_at','procedures.name as procedure_name','hospital_appointments.id','hospital_appointments.date_appointment','hospital_appointments.time_appointment','vets.name','cats.cat_id','caretakers.customer_id','caretakers.name as caretaker_name','cats.name as cat_name'])->paginate(10);;

        return view('admin.hospital.list_appointments')-> with([
            'vets' => $vets,
            'timeslots' => $timeslots,
            'procedures' => $procedures,
            'hosp' => $hosp,
            'search' => $search,
            'from_date' => $from_date,
            'to_date' => $to_date
        ]);
    }

    public function deleteAppointment(Request $request){
        $id = $request->id;
        $app = HospitalAppointments::find($id);
        $app->delete();
        Invoices::where('booking_id',$id)->where('booking_type','hospital_appointment')->delete();
    }
    // public function getAppointmentList(Request $request){
    //     if ($request->ajax()) {
    //         $hosp  = HospitalAppointments::leftJoin('vets','vets.id', '=', 'hospital_appointments.vet_id')
    //                 ->leftJoin('caretakers','hospital_appointments.caretaker_id','=','caretakers.id')
    //                 ->leftJoin('cats','hospital_appointments.cat_id','=','cats.id')
    //                 ->leftJoin('procedures','hospital_appointments.procedure_id','=','procedures.id')
    //                 ->orderBy('hospital_appointments.id','DESC')
    //                 ->get(['procedures.name as procedure_name','hospital_appointments.id','hospital_appointments.date_appointment','hospital_appointments.time_appointment','vets.name','cats.cat_id','caretakers.customer_id','caretakers.name as caretaker_name','cats.name as cat_name']);

    //         return Datatables::of($hosp)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //             $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
    //             return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    public function getAppointmentsList(Request $request){
        $search = $request->search;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        
        $query  = HospitalAppointments::leftJoin('vets','vets.id', '=', 'hospital_appointments.vet_id')
                                ->leftJoin('caretakers','hospital_appointments.caretaker_id','=','caretakers.id')
                                ->leftJoin('cats','hospital_appointments.cat_id','=','cats.id')
                                ->leftJoin('procedures','hospital_appointments.procedure_id','=','procedures.id');
        if($search){  
            $query->where(function ($query) use ($search) {
                $query->orWhere('procedures.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('vets.name', 'LIKE', $search . '%')
                        ->orWhere('hospital_appointments.time_appointment', 'LIKE', $search . '%')
                        ->orWhere('cats.cat_id', 'LIKE', $search . '%')
                        ->orWhere('caretakers.customer_id', 'LIKE', $search . '%')
                        ->orWhere('caretakers.name', 'LIKE', $search . '%')
                        ->orWhere('cats.name', 'LIKE', $search . '%');
            });                    
        }
        if($from_date != '' || $to_date != ''){
            if($from_date != '' && $to_date != ''){
                $query->whereDate('hospital_appointments.date_appointment', '>=', $from_date)
                ->whereDate('hospital_appointments.date_appointment',   '<=', $to_date);
            }elseif($from_date == '' && $to_date != ''){
                $query->whereDate('hospital_appointments.date_appointment', '=', $to_date);
            }elseif($from_date != '' && $to_date == ''){
                $query->whereDate('hospital_appointments.date_appointment', '=', $from_date);
            }
        }
        $hosp = $query->orderBy('hospital_appointments.id','DESC')
        ->get(['hospital_appointments.payment_confirmation','vets.is_deleted as vet_deleted','hospital_appointments.created_at','procedures.name as procedure_name','hospital_appointments.id','hospital_appointments.date_appointment','hospital_appointments.time_appointment','vets.name','cats.cat_id','caretakers.customer_id','caretakers.name as caretaker_name','cats.name as cat_name']);
     
        $viewData = view('admin.hospital.ajax_list', compact('hosp'))->render();

        return $viewData;
    }

    function getAppointmentsDetails(Request $request){
        $app_id = $request->id;
        $hosp  = HospitalAppointments::leftJoin('vets','vets.id', '=', 'hospital_appointments.vet_id')
                                ->leftJoin('caretakers as care','hospital_appointments.caretaker_id','=','care.id')
                                ->leftJoin('cats','hospital_appointments.cat_id','=','cats.id')
                                ->leftJoin('procedures as pro','hospital_appointments.procedure_id','=','pro.id')
                                ->leftJoin('countries as care_country','care_country.id', '=', 'care.home_country')
                                ->leftJoin('countries as cat_country','cat_country.id', '=', 'cats.place_of_origin')
                                ->leftJoin('states as careState','careState.id', '=', 'care.state_id')
                                ->leftJoin('states as catState','catState.id', '=', 'cats.state_id')
                                ->where('hospital_appointments.id', $app_id)
                                ->get(['care_country.name as care_country','cat_country.name as cat_country','hospital_appointments.created_at','pro.price','pro.name as procedure_name','hospital_appointments.id',
                                'hospital_appointments.payment_type','hospital_appointments.reason','hospital_appointments.date_appointment','hospital_appointments.time_appointment','vets.name as vet_name','cats.cat_id',
                                'care.*','care.work_place as caretaker_work_place','care.name as caretaker_name','cats.name as cat_name','cats.*', 'careState.name as caretaker_state','catState.name as cat_state']);                 
        $viewData = view('admin.hospital.appointment_view_details', compact('hosp'))->render();

        return $viewData;
    }

    function editAppointments(Request $request){
        $app_id = $request->id;
        $hosp  = HospitalAppointments::leftJoin('vets','vets.id', '=', 'hospital_appointments.vet_id')
                                ->leftJoin('caretakers as care','hospital_appointments.caretaker_id','=','care.id')
                                ->leftJoin('cats','hospital_appointments.cat_id','=','cats.id')
                                ->leftJoin('procedures as pro','hospital_appointments.procedure_id','=','pro.id')
                                ->leftJoin('countries as care_country','care_country.id', '=', 'care.home_country')
                                ->leftJoin('countries as cat_country','cat_country.id', '=', 'cats.place_of_origin')
                                ->where('hospital_appointments.id', $app_id)
                                ->get(['hospital_appointments.vet_id','hospital_appointments.procedure_id','cats.id as catId','hospital_appointments.caretaker_id as app_caretaker_id','vets.id as vet_id','hospital_appointments.id as app_id',
                                'hospital_appointments.payment_type','hospital_appointments.reason','hospital_appointments.date_appointment','hospital_appointments.time_appointment']);                 

        $caretakers = Caretaker::select("id","name","customer_id")
                            ->where('status', 'published')
                            ->where('is_blacklist',0)
                            ->orderBy('name','ASC')
                            ->get();

        $cats = Cat::select("cats.id","cats.name","cats.cat_id")
                            ->leftJoin('cat_caretakers','cats.id', '=', 'cat_caretakers.cat_id')
                            ->where('cat_caretakers.caretaker_id', $hosp[0]->app_caretaker_id)
                            ->where('cats.status', 'published')
                            ->where('cat_caretakers.transfer_status', 0)
                            ->orderBy('cats.name','ASC')
                            ->get();

        $vets = Vet::select("vets.id","vets.name")
                            ->leftJoin('vetschedules as vs','vs.vet_id','=','vets.id')
                            ->where('vets.status', 'published')
                            ->where('vs.date', $hosp[0]->date_appointment)
                            ->where('vets.is_deleted',0)
                            ->orderBy('vets.name','ASC')
                            ->get();
        
        $procedures = Procedures::select("id","name","price")
                            ->where('status', 1)
                            ->orderBy('name','ASC')
                            ->get();
        

       return json_encode(array('appointment' => $hosp , 'caretakers' => $caretakers,'cats' => $cats, 'vets' => $vets, 'procedures' => $procedures));
    }

    public function getVetsOnDate(Request $request){
        $vets = Vet::select("vets.id","vets.name")
                            ->leftJoin('vetschedules as vs','vs.vet_id','=','vets.id')
                            ->where('vets.status', 'published')
                            ->where('vs.date', $request->date)
                            ->where('vets.is_deleted',0)
                            ->orderBy('vets.name','ASC')
                            ->get();
        return json_encode($vets);
    }

    public function getCaretakerCats(Request $result){

        $cats = Cat::select("cats.id","cats.name","cats.cat_id")
                    ->leftJoin('cat_caretakers','cats.id', '=', 'cat_caretakers.cat_id')
                    ->where('cat_caretakers.caretaker_id', $result->cid)
                    ->where('cats.status', 'published')
                    ->where('cat_caretakers.transfer_status', 0)
                    ->orderBy('cats.name','ASC')
                    ->get();

        return json_encode($cats);
    }
    public function getSelectedEditSlots(Request $request){
        $date = $request->date;
        $vet_id = $request->vet_id;
        $result = [];
        $checkAssigned = Vetschedule::where('vet_id',$vet_id)->whereDate('date', $date)
                        ->where('status', 'published')
                        ->select('available_from','available_to')
                        ->first();
                      
        if($checkAssigned){
            $checkAssigned = $checkAssigned->toArray();
            $allSlots  = Helper::getTimeSlotHrMIn('30', $checkAssigned['available_from'], $checkAssigned['available_to']);
           
            $bookedSlots = HospitalAppointments::select('time_appointment')
                                        ->whereDate('date_appointment', $date)
                                        ->where('vet_id',$vet_id)
                                        ->get()->pluck('time_appointment')->toArray();
            $result =  array_diff($allSlots,$bookedSlots);
            if($request->slot != ''){
                array_unshift($result , $request->slot);
            }
        }
       
        return json_encode($result);
    }

    public function updateAppointmentDetails(Request $request){
        $hosp = HospitalAppointments::find($request->appointment_id)->update([
                        'cat_id' => $request->catId,
                        'caretaker_id' => $request->caretaker_id,
                        'procedure_id' => $request->procedure,
                        'vet_id' => $request->vet_id,
                        'date_appointment' => $request->appointment_date,
                        'time_appointment' => $request->appointment_time,
                        'reason' => $request->remarks,
                        'payment_type' => $request->payment_type
                    ]);
        
        return $request->appointment_date;
    }
    public function changePaymentStatus(Request $request){
        $hotel = HospitalAppointments::find($request->id)->update([
            'payment_confirmation' => $request->status
        ]);
    }

    public function ajaxGetYearAppointments(Request $request){
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
           
            $vets = Vetschedule::selectRaw('GROUP_CONCAT(vets.name) as vet_name,YEAR(vetschedules.date) as year, MONTH(vetschedules.date) as month')
                            ->leftJoin('vets','vetschedules.vet_id','=','vets.id')
                            ->where('vetschedules.status', 'published')
                            ->where('vets.status', 'published')
                            ->whereYear('vetschedules.date',$dt->format("Y"))
                            ->whereMonth('vetschedules.date',$dt->format("m"))
                            ->groupBy('year','month')
                            ->get();
                          
            if(isset($vets[0])){
                $vetnames =  ($vets[0]) ? $vets[0]['vet_name'] : '';
            }         
            $vetnames = explode(',',$vetnames);     
            $result[$i]['vet'] = implode('<br>',array_unique($vetnames));
            $result[$i]['year'] = $dt->format("Y");
            $result[$i]['month'] = $dt->format("m");
            $result[$i]['name'] = $dt->format("M-Y");
            $i++; 
        }

        $viewData = view('admin.hospital.year_appointment', compact('month','startMonthWord','endMonthWord','year','newYear','result'))->render();
        return $viewData;
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
}
