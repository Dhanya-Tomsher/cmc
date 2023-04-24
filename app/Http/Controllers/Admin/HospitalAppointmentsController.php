<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHospitalAppointmentsRequest;
use App\Http\Requests\UpdateHospitalAppointmentsRequest;
use Illuminate\Http\Request;
use App\Models\HospitalAppointments; 

class HospitalAppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $hosp  = HospitalAppointment::all();
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
    public function update(UpdateHospitalAppointmentRequest $request, Hosp $hosp)
    {
        $hosp->update($request->all());
        return back()->with('status', 'Hospital Appointment Upated!');
    }
    public function view(Hosp $hosp)
    {
        return view('admin.hosp.show')->with([
            'hosp' => $hosp,
        ]);
    } 
    public function edit(Hosp $hosp)
    {
        return view('admin.hosp.edit')->with([
            'hosp' => $hosp
        ]);
    }
    public function store(StoreHospitalAppointmentRequest $request)
    {
        
        $hosp = HospitalAppointment::create([
            'cat_id' => $request->cat_id,
            'vet_id' => $request->vet_id,
            'date_appointment' => $request->date_appointment,
            'time_appointment'=>$request->time_appointment,
            'caretaker_id' => $request->caretaker_id,
            'reason' => $request->reason,
            'vet_comment'=>$request->vet_comment,
            'medicine' => $request->medicine,
            'caretaker_comment' => $request->caretaker_comment,
            'status' => $request->status,
        ]);
        return redirect()->route('hosp.index')->with('status', 'Hospital Appointment created!');
    }
}
