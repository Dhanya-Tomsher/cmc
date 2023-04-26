<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caretaker;
use App\Models\Cat;
use App\Models\Vet;
use App\Models\Procedures;
use App\Models\Country;
use App\Http\Requests\StoreHospitalAppointmentRequest;
use App\Http\Requests\StoreHospitalAppointmentsRequest;
use App\Http\Requests\UpdateHospitalAppointmentRequest;
use App\Http\Requests\UpdateHospitalAppointmentsRequest;
use Illuminate\Http\Request;
use App\Models\HospitalAppointments;
use DB;
use DateTime;

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
        // $hosp  = HospitalAppointments::all();
        // return view('admin.hospital.appointments')->with([
        //     'hosp' => $hosp,
        // ]);

        $events = [];
 
        // $appointments = HospitalAppointments::with(['client', 'employee'])->get();
 
        // foreach ($appointments as $appointment) {
        //     $events[] = [
        //         'title' => $appointment->client->name . ' ('.$appointment->employee->name.')',
        //         'start' => $appointment->start_time,
        //         'end' => $appointment->finish_time,
        //     ];
        // }
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->orderBy('name','ASC')
                    ->get();

        $procedures = Procedures::select("id","name","price")
                    ->where('status', 1)
                    ->orderBy('name','ASC')
                    ->get();

        $timeslots = $this->getTimeSlot(30,env('SLOT_FROM_TIME'),env('SLOT_TO_TIME'));
        
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
            $caretakers = Caretaker::select("id","name","customer_id")
                            ->where('status', 'published')
                            ->Where('name', 'LIKE', "%$search%")
                            ->orWhere('customer_id', 'LIKE', "$search%")
                            ->orWhere('phone_number', 'LIKE', "$search%")
                            ->orWhere('whatsapp_number', 'LIKE', "$search%")
                            ->orWhere('work_contact_number', 'LIKE', "$search%")
                            ->orderBy('name','ASC')
                            ->get();
        }else{
            $caretakers = Caretaker::select("id","name","customer_id")
                            ->where('status', 'published')
                            ->orderBy('name','ASC')
                            ->get();
        }
        return response()->json($caretakers);
    }

    public function getCaretakerDetails(Request $request){
        $id = $request->id;
        $caretakers = Caretaker::select("caretakers.*","countries.name as country")
                            ->leftJoin('countries','countries.id', '=', 'caretakers.home_country')
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

    function getTimeSlot($interval, $start_time, $end_time)
    {
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i=0;
        $time = [];
        while(strtotime($startTime) <= strtotime($endTime)){
            $start = $startTime;
            $end = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $startTime = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $i++;
            if(strtotime($startTime) <= strtotime($endTime)){
                $time[$i]['slot_start_time'] = $start;
                $time[$i]['slot_end_time'] = $end;
            }
        }
        return $time;
    }

    public function saveAppointmentDetails(Request $request){
        $hosp = HospitalAppointments::create([
            'cat_id' => $request->catId,
            'caretaker_id' => $request->caretaker_id,
            'procedure_id' => $request->procedure,
            'vet_id' => $request->vet_id,
            'date_appointment' => $request->appointment_date,
            'time_appointment' => $request->appointment_time,
            'reason' => $request->remarks,
        ]);
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
        $date = $request->id;
        $result = HospitalAppointments::select('time_appointment')
                                    ->whereDate('date_appointment', $date)
                                    ->get();
        return json_encode($result);
    }
}
