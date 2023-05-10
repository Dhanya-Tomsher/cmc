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
use App\Http\Requests\StoreHospitalAppointmentRequest;
use App\Http\Requests\StoreHospitalAppointmentsRequest;
use App\Http\Requests\UpdateHospitalAppointmentRequest;
use App\Http\Requests\UpdateHospitalAppointmentsRequest;
use Illuminate\Http\Request;
use App\Models\HospitalAppointments;
use DB;
use DateTime;
use Helper;


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
        $caretakers = Caretaker::select("caretakers.*","countries.name as country")
                            ->leftJoin('countries','countries.id', '=', 'caretakers.home_country')
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
        $cat = Cat::select("cats.*","countries.name as country")
                    ->leftJoin('countries','countries.id', '=', 'cats.place_of_origin')
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
        $allSlots  = VetShifts::getVetDateShiftsByVet($date, $vet_id);
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
        $vetSlots = VetShifts::getVetDateShifts($date);
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
        
        $viewData = view('admin.hospital.day_appointment', compact('vets','timeslots','vetBooks','date','vetSlots','details'))->render();
        return $viewData;
    }
    public function manageHospitalAppointments(){
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->orderBy('name','ASC')
                    ->get();

        $procedures = Procedures::select("id","name","price")
                    ->where('status', 1)
                    ->orderBy('name','ASC')
                    ->get();

        $timeslots = Helper::getTimeSlotHrMIn(30,env('SLOT_FROM_TIME'),env('SLOT_TO_TIME'));

        return view('admin.hospital.list_appointments')-> with([
            'vets' => $vets,
            'timeslots' => $timeslots,
            'procedures' => $procedures
        ]);
    }

    public function deleteAppointment(Request $request){
        $id = $request->id;
        $app = HospitalAppointments::find($id);
        $app->delete();
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
        ->get(['hospital_appointments.created_at','procedures.name as procedure_name','hospital_appointments.id','hospital_appointments.date_appointment','hospital_appointments.time_appointment','vets.name','cats.cat_id','caretakers.customer_id','caretakers.name as caretaker_name','cats.name as cat_name']);
     
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
                                ->where('hospital_appointments.id', $app_id)
                                ->get(['care_country.name as care_country','cat_country.name as cat_country','hospital_appointments.created_at','pro.price','pro.name as procedure_name','hospital_appointments.id',
                                'hospital_appointments.payment_type','hospital_appointments.reason','hospital_appointments.date_appointment','hospital_appointments.time_appointment','vets.name as vet_name','cats.cat_id',
                                'care.*','care.work_place as caretaker_work_place','care.name as caretaker_name','cats.name as cat_name','cats.*', 'care.emirate as caretaker_emirate','cats.emirate as cat_emirate']);                 
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
        $checkAssigned = Vetschedule::where('vet_id',$vet_id)->whereDate('date', $date)->count();
        if($checkAssigned > 0){
            $allSlots  = VetShifts::getVetDateShiftsByVet($date, $vet_id);
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
}
