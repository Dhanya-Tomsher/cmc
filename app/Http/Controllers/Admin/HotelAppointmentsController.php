<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelAppointmentRequest;
use App\Http\Requests\StoreHotelAppointmentsRequest;
use App\Http\Requests\UpdateHotelAppointmentRequest;
use App\Http\Requests\UpdateHotelAppointmentsRequest;
use Illuminate\Http\Request;
use App\Models\HotelAppointments;

class HotelAppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $hote  = HotelAppointments::all();
        return view('admin.hote.index')->with([
            'hote' => $hote,
        ]);
    }
    public function create()
    {
        return view('admin.hote.create');
    }
    public function search()
    {
        return view('admin.hote.create');
    }
    public function update(UpdateHotelAppointmentRequest $request, HotelAppointments $hote)
    {
        $hote->update($request->all());
        return back()->with('status', 'Hotel Appointment Upated!');
    }
    public function view(HotelAppointments $hote)
    {
        return view('admin.hote.show')->with([
            'hote' => $hote,
        ]);
    }
    public function edit(HotelAppointments $hote)
    {
        return view('admin.hote.edit')->with([
            'hote' => $hote
        ]);
    }
    public function store(StoreHotelAppointmentRequest $request)
    {

        $hote = HotelAppointments::create([
            'cat_id' => $request->cat_id,
            'caretaker_id' => $request->caretaker_id,
            'room_number' => $request->room_number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_amount' => $request->total_amount,
            'caretaker_comment' => $request->caretaker_comment,
            'status' => $request->status,
        ]);
        return redirect()->route('hote.index')->with('status', 'Hotel Appointment created!');
    }
}
