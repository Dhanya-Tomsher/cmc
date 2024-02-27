<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVetRequest;
use App\Http\Requests\UpdateVetRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Vet;
use App\Models\HospitalAppointments;
use App\Models\Vetschedule;
use App\Models\VetShifts;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DateTime;
use Helper;
use DB;

class VetController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('last_url', url()->full());

        $search = $request->has('name') ? $request->name : '';

        $query  = Vet::select('id','name', 'email', 'phone_number', 'whatsapp_number', 'status')->where('is_deleted',0);
           
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%')
                        ->orWhere('email', 'LIKE', '%'.$search . '%')
                        ->orWhere('whatsapp_number', 'LIKE', '%'.$search . '%')
                        ->orWhere('address', 'LIKE', '%'.$search . '%')
                        ->orWhere('phone_number', 'LIKE', '%'.$search . '%');
            });                    
        }
        $vet  = $query->orderBy('id','DESC')->paginate(10);
        return view('admin.vet.index')->with([
            'vet' => $vet,
            'search' => $search
        ]);
    }
    public function create()
    {
        $countries = Country::orderByRaw('name="United Arab Emirates" DESC')->orderBy('name','ASC')->get();
        $timeSlots = Helper::hoursRange( 0, 86400, 60 * 30, 'h:i a' );
        return view('admin.vet.create')->with([
            'countries' => $countries,
            'timeSlots' => $timeSlots
        ]);
    }
    
    public function schedule()
    {
        $vets = Vet::getActiveVets();
        return view('admin.vet.schedule')->with([
            'vets' => $vets,
        ]);
    }
    public function search()
    {
        return view('admin.vet.create');
    }
    public function update(UpdateVetRequest $request, Vet $vet)
    {
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $filename =   time() . $uploadedFile->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs(
                'vets',
                $uploadedFile,
                $filename
            );

            $image_name = Storage::url($name);

            $fileName = 'public' . Str::remove('/storage', $vet->image_url);
            if (Storage::exists($fileName)) {
                Storage::delete($fileName);
            }

            $vet->image_url = $image_name;
            $vet->save();
        }

        if($vet->slot_from != trim($request->shift_from) && ($vet->shift_to != trim($request->shift_to))){
            $dataShifts = ['vet_id' => $vet->id,
                        'shift_from' => trim($request->shift_from),
                        'shift_to'   => trim($request->shift_to)
                    ];

            $this->manageVetShifts($dataShifts);
        }
        $vet->update($request->all());

        return back()->with('status', 'Vet Details Upated!');
    }

    public function manageVetShifts($dataShifts){
        $timeslots = Helper::generateVetTimeSlot(30, trim($dataShifts['shift_from']), trim($dataShifts['shift_to']), $dataShifts['vet_id']);

        $checkTodaysSlot = VetShifts::where('vet_id',$dataShifts['vet_id'])->whereDate('from_date',now())->get();
       
        if(!empty($checkTodaysSlot[0])){
            $checkTodaysBookings = HospitalAppointments::where('vet_id',$dataShifts['vet_id'])
                                                        ->whereDate('date_appointment',now())
                                                        ->get()->pluck('time_appointment')->toArray();
            if(empty($checkTodaysBookings)){
                VetShifts::where('vet_id','=',$dataShifts['vet_id'])->whereDate('from_date',now())->delete();
            }else{
                foreach($timeslots as $newtime){
                    if (($key = array_search($newtime['slots'], $checkTodaysBookings)) !== false) {
                        unset($checkTodaysBookings[$key]);
                    }
                } 
                VetShifts::where('vet_id','=',$dataShifts['vet_id'])
                            ->whereDate('from_date',now())
                            ->whereNotIn('slots',$checkTodaysBookings)->delete();

                VetShifts::where('vet_id',$dataShifts['vet_id'])
                            ->whereDate('from_date',now())
                            ->whereIn('slots',$checkTodaysBookings)
                            ->update(['status' => 0, 'end_date' => date('Y-m-d')]);
            }
        }else{
            $result = VetShifts::where('vet_id',$dataShifts['vet_id'])
                            ->where('status', 1)
                            ->update(['status' => 0, 'end_date' => date('Y-m-d',strtotime("-1 days"))]);
        }
        VetShifts::insert($timeslots);
    }

    public function view(Vet $vet)
    {
        $vetResult = Vet::select("vets.*","countries.name as country","states.name as state")
                    ->leftJoin('countries','countries.id', '=', 'vets.home_country')
                    ->leftJoin('states','states.id', '=', 'vets.state_id')
                    ->where('vets.id', $vet->id)
                    ->get();
        $image = $vet->getImage();
        return view('admin.vet.show')->with([
            'vet' => $vetResult,
            'image' => $image
        ]);
    }
    public function edit(Vet $vet)
    {
        $countries = Country::orderByRaw('name="United Arab Emirates" DESC')->orderBy('name','ASC')->get();
        $timeSlots = Helper::hoursRange( 0, 86400, 60 * 30, 'h:i a' );
        $states = Helper::getStates($vet->home_country);
        return view('admin.vet.edit')->with([
            'vet' => $vet,
            'countries' => $countries,
            'timeSlots' => $timeSlots,
            'states' => $states
        ]);
    }

    public function store(StoreVetRequest $request)
    {
        $image_name = '';

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $filename =   time() . $uploadedFile->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs(
                'vet',
                $uploadedFile,
                $filename
            );

            $image_name = Storage::url($name);
        }

        $vet = Vet::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'whatsapp_number' => $request->whatsapp_number,
            'home_country' => $request->home_country,
            'state_id' => $request->emirate,
            'gender' => $request->gender,
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'emirates_id' => $request->emirates_id,
            'gender' => $request->gender,
            'license_number' => $request->license_number,
            'designation' => $request->designation,
            'specialization' => $request->specialization,
            'image_url' => $image_name,
            'status' => 'published',
            'shift_from' => $request->shift_from,
            'shift_to' => $request->shift_to,
        ]);
        $vet_id = $vet->id;

        $timeslots = Helper::generateVetTimeSlot(30,$request->shift_from,$request->shift_to,$vet_id);
        VetShifts::insert($timeslots);
        return redirect()->route('vet.index')->with('status', 'vet created!');
    }
    public function getVetList(Request $request){
        $search = $request->search;
        $query  = Vet::select('id','name', 'email', 'phone_number', 'whatsapp_number', 'status')->where('is_deleted',0);
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%')
                        ->orWhere('email', 'LIKE', '%'.$search . '%')
                        ->orWhere('phone_number', 'LIKE', '%'.$search . '%')
                        ->orWhere('whatsapp_number', 'LIKE', '%'.$search . '%');
            });                    
        }
        $vet = $query->orderBy('id','DESC')->get();
        $viewData = view('admin.vet.ajax_list', compact('vet'))->render();

        return $viewData;
    }

    public function delete(Request $request){
        $vet = Vet::find($request->id);
        $vet->is_deleted = 1;
        $vet->save();

        $bookingDates = HospitalAppointments::where('date_appointment' ,'>',date('Y-m-d'))->pluck('date_appointment')->toArray();
       
        $vetSchedules = VetSchedule::where('date' ,'>',date('Y-m-d'))->whereNotIn('date',$bookingDates)->delete();
    }
   
}
