<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vet;
use App\Models\HotelAppointments;
use App\Models\Hotelrooms; 
use App\Models\Caretaker;
use App\Models\Cat;
use App\Models\Invoices;
use App\Http\Requests\StoreHotelAppointmentRequest;
use App\Http\Requests\StoreHotelAppointmentsRequest;
use App\Http\Requests\UpdateHotelAppointmentRequest;
use App\Http\Requests\UpdateHotelAppointmentsRequest;
use Illuminate\Http\Request;
use Helper;
use DB;
use DateTime;
use DateInterval;
use DatePeriod;

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
        $rooms = Hotelrooms::where('room_status', 1)->orderBy('room_number','ASC')->get()->pluck('room_number','id')->toArray();
        $roomsCount = count($rooms);
        
        $betweenDates = Helper::getDatesBetween2Dates($params['start'], $params['end']);
       
        if($betweenDates){
            $i=0;
            foreach($betweenDates as $bdate){
                $bookingCount = $this->getDateAvailabilityColor($bdate, $rooms);
                $response = json_decode($bookingCount);

                $result[$i]['title'] =  implode(' <br> ',$response->roomNames);
                $result[$i]['start'] = $bdate;
                $result[$i]['end'] = $bdate;
                $result[$i]['display'] = 'background';
                $result[$i]['allDay'] = true;
                $result[$i]['className'] = ($response->count != 0) ? 'scheduled' : '';
                $i++;
            }
        }
        return response()->json($result);
    }

    public function getDateAvailabilityColor($date, $rooms){
        $count = 0;
        $roomNames = [];
       
        foreach($rooms as $key=>$room){
            $bookingCount = HotelAppointments::select('id')
                                                ->whereRaw('"'.$date.'" between start_date and end_date')
                                                ->where('room_number',$key)
                                                ->count();
            if($bookingCount == 0){
                $count++;
                $roomNames[] = '<span class="not-booked">'.$room.'</span>';
            }else{
                $roomNames[] = '<span class="booked-red">'.$room.'</span>';
            }
        }
       
        return json_encode(array('count' => $count, 'roomNames' => $roomNames));
    }

    public function getAvailableRooms(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $availableRooms = array();
        $rooms = [];
        if($startDate != '' && $endDate != ''){
            $dates = Helper::getDatesBetween2Dates($startDate, $endDate);
           
            foreach($dates as $date){
                $availableRooms[]  = Hotelrooms::where('room_status', 1)
                                    ->whereNotIN('id', DB::table('hotel_appointments')->whereRaw('"'.$date.'" between start_date and end_date')->get()->pluck('room_number'))
                                    ->orderBy('room_number','ASC')->get()->pluck('id')->toArray();
            }
            
            // $inter = array_intersect(...$availableRooms);
            
            if(count($availableRooms) >1){
                $inter = call_user_func_array('array_intersect', $availableRooms);
            }else{
                $inter = $availableRooms[0];
            }
            $rooms  = Hotelrooms::select('id','room_number','amount')
                                    ->where('room_status', 1)
                                    ->whereIN('id', $inter)
                                    ->orderBy('room_number','ASC')
                                    ->get()->toArray();
        }
        return json_encode($rooms);
    }
   
    public function saveHotelBooking(Request $request){
        $hotel = HotelAppointments::create([
            'cat_id' => $request->catId,
            'caretaker_id' => $request->caretaker_id,
            'room_number' => $request->rooms,
            'start_date' => $request->from_date,
            'end_date' => $request->to_date,
            'caretaker_comment' => $request->remarks,
            'payment_type' => $request->payment_type
        ]);
        $vat = ($request->price/100) * 5;  // 5% VAT calculation
        $total = $request->price + $vat;
        $data = array(
            'booking_id' => $hotel->id,
            'booking_type' => 'hotel_booking',
            'price' => $request->price, 
            'net' => $request->price, 
            'vat' => $vat,
            'net_vat' => $total, 
            'total' => $total, 
            'invoice_date' => date('Y-m-d')
        );
        Invoices::create($data);

    }
    public function manageHotelBookings(){
        
        return view('admin.hote.list_appointments');
    }

    public function getBookingList(Request $request){
        $search = $request->search;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query  = HotelAppointments::leftJoin('caretakers','hotel_appointments.caretaker_id','=','caretakers.id')
                                        ->leftJoin('cats','hotel_appointments.cat_id','=','cats.id')
                                        ->leftJoin('hotelrooms','hotel_appointments.room_number','=','hotelrooms.id');

        if($search){  
            $query->where(function ($query) use ($search) {
                $query->orWhere('hotelrooms.room_number', 'LIKE', $search . '%')
                        ->orWhere('cats.cat_id', 'LIKE', $search . '%')
                        ->orWhere('caretakers.customer_id', 'LIKE', $search . '%')
                        ->orWhere('caretakers.name', 'LIKE', $search . '%')
                        ->orWhere('cats.name', 'LIKE', $search . '%');
            });                    
        }
        if($from_date != '' || $to_date != ''){
            $query->where(function ($query) use ($from_date,$to_date) {
                if($from_date != '' && $to_date != ''){
                    $query->whereRaw("start_date <=  '$to_date' AND end_date >= '$from_date'");
                }elseif($from_date == '' && $to_date != ''){
                    $query->whereRaw("start_date <=  '$to_date' AND end_date >= '$to_date'");
                }elseif($from_date != '' && $to_date == ''){
                    $query->whereRaw("start_date <=  '$from_date' AND end_date >= '$from_date'");
                }
            });   
        }

        $bookings = $query->orderBy('hotel_appointments.id','DESC')
        ->get(['hotel_appointments.payment_confirmation','hotel_appointments.created_at','hotelrooms.room_number as room_no','hotel_appointments.id','hotel_appointments.start_date','hotel_appointments.end_date','cats.cat_id','caretakers.customer_id','caretakers.name as caretaker_name','cats.name as cat_name']);
       
        $viewData = view('admin.hote.ajax_list', compact('bookings'))->render();

        return $viewData;
    }
    public function deleteBooking(Request $request){
        $id = $request->id;
        $app = HotelAppointments::find($id);
        $app->delete();

        Invoices::where('booking_id',$id)->where('booking_type','hotel_booking')->delete();
    }

    function getBookingDetails(Request $request){
        $app_id = $request->id;
       
        $hotel  = HotelAppointments::leftJoin('caretakers as care','hotel_appointments.caretaker_id','=','care.id')
                                ->leftJoin('cats','hotel_appointments.cat_id','=','cats.id')
                                ->leftJoin('hotelrooms as room','hotel_appointments.room_number','=','room.id')
                                ->leftJoin('countries as care_country','care_country.id', '=', 'care.home_country')
                                ->leftJoin('countries as cat_country','cat_country.id', '=', 'cats.place_of_origin')
                                ->where('hotel_appointments.id', $app_id)
                                ->get(['care_country.name as care_country','cat_country.name as cat_country','hotel_appointments.created_at','room.amount','room.room_number as room_no','hotel_appointments.id',
                                'hotel_appointments.payment_confirmation','hotel_appointments.caretaker_comment','hotel_appointments.payment_type','hotel_appointments.room_number','hotel_appointments.start_date','hotel_appointments.end_date','cats.cat_id',
                                'care.*','care.work_place as caretaker_work_place','care.name as caretaker_name','cats.name as cat_name','cats.*', 'care.emirate as caretaker_emirate','cats.emirate as cat_emirate']);                 
       
        $viewData = view('admin.hote.booking_view_details', compact('hotel'))->render();

        return $viewData;
    }

    function editBookings(Request $request){
        $app_id = $request->id;
        $hotel  = HotelAppointments::where('hotel_appointments.id', $app_id)->get(['hotel_appointments.*']);                 

        $caretakers = Caretaker::select("id","name","customer_id")
                            ->where('status', 'published')
                            ->where('is_blacklist',0)
                            ->orderBy('name','ASC')
                            ->get();

        $cats = Cat::select("cats.id","cats.name","cats.cat_id")
                            ->leftJoin('cat_caretakers','cats.id', '=', 'cat_caretakers.cat_id')
                            ->where('cat_caretakers.caretaker_id', $hotel[0]->caretaker_id)
                            ->where('cats.status', 'published')
                            ->where('cat_caretakers.transfer_status', 0)
                            ->orderBy('cats.name','ASC')
                            ->get();
        
        $rooms = Hotelrooms::select("id","room_number","amount")
                            ->where('room_status', 1)
                            ->orderBy('room_number','ASC')
                            ->get();
        

       return json_encode(array('appointment' => $hotel , 'caretakers' => $caretakers,'cats' => $cats, 'rooms' => $rooms));
    }

    public function getAvailableEditRooms(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $editStart = $request->editStart;
        $editEnd = $request->editEnd;
        
        $availableRooms = array();
        $rooms = [];
        if($startDate != '' && $endDate != ''){
            $dates = Helper::getDatesBetween2Dates($startDate, $endDate);
            foreach($dates as $date){
                $availableRooms[]  = Hotelrooms::where('room_status', 1)
                                    ->whereNotIN('id', DB::table('hotel_appointments')->whereRaw('"'.$date.'" between start_date and end_date')->get()->pluck('room_number'))
                                    ->orderBy('room_number','ASC')->get()->pluck('id')->toArray();
            }
            
            // $inter = array_intersect(...$availableRooms);
            
            if(count($availableRooms) >1){
                $inter = call_user_func_array('array_intersect', $availableRooms);
            }else{
                $inter = $availableRooms[0];
            }
            if( $editStart == $startDate && $editEnd == $endDate){
                array_unshift($inter , $request->editRoom);
            }
          
            $rooms  = Hotelrooms::select('id','room_number','amount')
                                    ->where('room_status', 1)
                                    ->whereIN('id', $inter)
                                    ->orderBy('room_number','ASC')
                                    ->get()->toArray();
        }
        return json_encode($rooms);
    }

    public function updateHotelBooking(Request $request){
        $hotel = HotelAppointments::find($request->appointment_id)->update([
            'cat_id' => $request->catId,
            'caretaker_id' => $request->caretaker_id,
            'room_number' => $request->rooms,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'caretaker_comment' => $request->remarks,
            'payment_type' => $request->payment_type
        ]);
    }

    public function changePaymentStatus(Request $request){
        $hotel = HotelAppointments::find($request->id)->update([
            'payment_confirmation' => $request->status
        ]);
    }

    public function ajaxGetYearHotelAppointments(Request $request){
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
            $rooms = Hotelrooms::where('room_status', 1)->orderBy('room_number','ASC')->get()->pluck('room_number','id')->toArray();   
            $result[$i]['rooms'] = implode('<br>',array_unique($rooms));
            $result[$i]['year'] = $dt->format("Y");
            $result[$i]['month'] = $dt->format("m");
            $result[$i]['name'] = $dt->format("M-Y");
            $i++; 
        }

        $viewData = view('admin.hote.year_appointment', compact('month','startMonthWord','endMonthWord','year','newYear','result'))->render();
        return $viewData;
    }

}
