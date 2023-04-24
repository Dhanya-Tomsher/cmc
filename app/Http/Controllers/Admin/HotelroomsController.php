<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelroomsRequest;
use App\Http\Requests\UpdateHotelroomsRequest;
use Illuminate\Http\Request;
use App\Models\Hotelrooms; 

class HotelroomsController extends Controller
{
    public function index(Request $request)
    {
        $hrooms  = Hotelrooms::all();
        return view('admin.hrooms.index')->with([
            'hrooms' => $hrooms,
        ]);
    }
    public function create()
    {
        return view('admin.hrooms.create');
    }
    public function search()
    {
        return view('admin.hrooms.create');
    }
    public function update(UpdateHotelroomsRequest $request, Hrooms $hrooms)
    {
        $hrooms->update($request->all());
        return back()->with('status', 'Hotel Rooms Upated!');
    }
    public function view(Hrooms $hrooms)
    {
        return view('admin.hrooms.show')->with([
            'hrooms' => $hrooms,
        ]);
    } 
    public function edit(Hrooms $hrooms)
    {
        return view('admin.hrooms.edit')->with([
            'hrooms' => $hrooms
        ]);
    }
    public function store(StoreHotelroomsRequest $request)
    {
        
        $hrooms = Hotelrooms::create([
            'room_number' => $request->room_number,
            'room_type' => $request->room_type,
            'facilities' => $request->facilities,
            'amount'=>$request->amount,
            'room_status' => $request->room_status,
            'status' => $request->status,
        ]);
        return redirect()->route('hrooms.index')->with('status', 'Hotel Room created!');
    }
}
