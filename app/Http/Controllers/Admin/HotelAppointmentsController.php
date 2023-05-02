<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vet;
use App\Models\HotelAppointments;
use App\Models\HotelRooms;
use App\Http\Requests\StoreHotelAppointmentRequest;
use App\Http\Requests\StoreHotelAppointmentsRequest;
use App\Http\Requests\UpdateHotelAppointmentRequest;
use App\Http\Requests\UpdateHotelAppointmentsRequest;
use Illuminate\Http\Request;
use Helper;
use DB;

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

    public function getHotelAppointments(){
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->orderBy('name','ASC')
                    ->get();

        $rooms = Hotelrooms::select("id","room_number","amount","room_status")
                    ->where('room_status', 1)
                    ->orderBy('room_number','ASC')
                    ->get();

        return view('admin.hote.hotel_appointments')-> with([
            'vets' => $vets,
            'rooms' => $rooms
        ]);
    }

    public function getHotelSchedules(Request $request, $vet_id =NULL){
        $result = [];
		$params['start'] = date('Y-m-d',strtotime($request->get('start')));
		$params['end'] = date('Y-m-d',strtotime($request->get('end')));
        $rooms = Hotelrooms::where('room_status', 1)->get()->pluck('id')->toArray();
        $roomsCount = count($rooms);
        
        $betweenDates = Helper::getDatesBetween2Dates($params['start'], $params['end']);
       
        if($betweenDates){
            $i=0;
            foreach($betweenDates as $bdate){
                $bookingCount = HotelAppointments::select('id')
                                                ->whereRaw('"'.$bdate.'" between start_date and end_date')
                                                ->whereIn('room_number',$rooms)
                                                ->count();
                $result[$i]['title'] ='';
                $result[$i]['start'] = $bdate;
                $result[$i]['end'] = $bdate;
                $result[$i]['display'] = 'background';
                $result[$i]['allDay'] = true;
                $result[$i]['className'] = ($bookingCount >= $roomsCount) ? 'fully-booked' : 'scheduled';
                $i++;
            }
        }
        return response()->json($result);
    }
    public function getAvailableRooms(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $availableRooms = $rooms = [];
        if($startDate != '' && $endDate != ''){
            $dates = Helper::getDatesBetween2Dates($startDate, $endDate);
            foreach($dates as $date){
                $availableRooms[]  = Hotelrooms::where('room_status', 1)
                                    ->whereNotIN('id', DB::table('hotel_appointments')->whereRaw('"'.$date.'" between start_date and end_date')->get()->pluck('room_number'))
                                    ->get()->pluck('id')->toArray();
            }
            
            $inter = array_intersect(...$availableRooms);
            $rooms  = Hotelrooms::select('id','room_number','amount')
                                    ->where('room_status', 1)
                                    ->whereIN('id', $inter)
                                    ->get()->toArray();
        }
        return json_encode($rooms);
    }
   
    public function saveHotelBooking(Request $request){
        HotelAppointments::create([
            'cat_id' => $request->catId,
            'caretaker_id' => $request->caretaker_id,
            'room_number' => $request->rooms,
            'start_date' => $request->from_date,
            'end_date' => $request->to_date,
            'caretaker_comment' => $request->remarks,
        ]);
    }
}
