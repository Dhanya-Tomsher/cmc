<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelroomsRequest;
use App\Http\Requests\UpdateHotelroomsRequest;
use Illuminate\Http\Request;
use App\Models\Hotelrooms; 
use App\Models\HotelAppointments; 
use DB;

class HotelroomsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.hrooms.index');
    }
    public function create()
    {
        return view('admin.hrooms.create');
    }
    public function search()
    {
        return view('admin.hrooms.create');
    }
    public function update(StoreHotelroomsRequest $request, Hotelrooms $hrooms)
    {
        $request['amount'] = $request->amount ? $request->amount : 0;

        $hrooms->update($request->all());
        return back()->with('status', 'Room details upated successfully!');
    }
    public function view(Hotelrooms $hrooms)
    {
        // echo '<pre>';
        // print_r($hrooms);die;
        return view('admin.hrooms.show')->with([
            'hrooms' => $hrooms,
        ]);
    } 
    public function edit(Hotelrooms $hrooms)
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
            'branch' => $request->branch,
            'amount'=> $request->amount ? $request->amount : 0,
            'room_status' => $request->room_status
        ]);
        return redirect()->route('hrooms.index')->with('status', 'Hotel Room created successfully!');
    }

    public function getRoomsList(Request $request){
        $search = $request->search;
        $query  = Hotelrooms::select('id', 'room_number', 'room_type', 'branch', 'amount', 'room_status');
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('room_number', 'LIKE', '%'.$search . '%')
                        ->orWhere('room_type', 'LIKE', '%'.$search . '%')
                        ->orWhere('branch', 'LIKE', '%'.$search . '%')
                        ->orWhere('amount', 'LIKE', '%'.$search . '%');
            });                    
        }
        $rooms = $query->orderBy('id','DESC')->get();
        $viewData = view('admin.hrooms.ajax_list', compact('rooms'))->render();

        return $viewData;
    }

    public function delete(Request $request)
    {
        $checkBooking = HotelAppointments::where('room_number',$request->room_id)->count();
        if($checkBooking == 0){
            Hotelrooms::where('id',$request->room_id)->delete();
            $result = array('status'=>1,'msg'=>'Deleted successfully.');
        }else{
            $result = array('status'=>0,'msg'=>'Deletion is not possible. There are hotel bookings for this room.');
        }
        return json_encode($result);
    }
}
