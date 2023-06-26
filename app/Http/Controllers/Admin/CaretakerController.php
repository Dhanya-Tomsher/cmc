<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCaretakerRequest;
use App\Http\Requests\UpdateCaretakerRequest;
use App\Http\Controllers\Controller;
use App\Models\Caretaker;
use App\Models\CatCaretakers;
use App\Models\Cat;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;
use File;
use Validator;
use DB;
use Helper;

class CaretakerController extends Controller
{
    public function index(Request $request)
    {
        $caretaker  = Caretaker::orderBy('name','ASC')->get();
        return view('admin.caretaker.index')->with([
            'caretaker' => $caretaker,
        ]);
    }
    public function getCaretakerBlackListing(){
        return view('admin.caretaker.blacklist');
    }
    public function create()
    {
        $maxId = Caretaker::max('id');
        $careId = ($maxId + 1);
        $countries = Country::orderByRaw('name="United Arab Emirates" DESC')->orderBy('name','ASC')->get();
        return view('admin.caretaker.create', compact('countries','careId'));
    }

    public function view($caretaker)
    {
        $query  = Caretaker::select('caretakers.*','care_country.name as care_country',"states.name as state")
                    ->leftJoin('countries as care_country','care_country.id', '=', 'caretakers.home_country')
                    ->leftJoin('states','states.id', '=', 'caretakers.state_id')
                    ->where('caretakers.id', '=', $caretaker)->get();
          
        $catsQuery  = Cat::select('cat_caretakers.cat_id',DB::raw('cats.*,cats.cat_id as catID'))
                    ->leftJoin('cat_caretakers','cat_caretakers.cat_id', '=', 'cats.id')
                    // ->where('cat_caretakers.transfer_status', 0)
                    ->where('cat_caretakers.caretaker_id', $caretaker)
                    ->groupBy('cat_caretakers.cat_id')
                    ->orderBy('cats.id','ASC')
                    ->get();

        return view('admin.caretaker.show')->with([
            'caretaker' => $query,
            'cats' => $catsQuery
        ]);
    } 

    public function catView($cat)
    {
        $query  = Cat::select('cats.*','care_country.name as care_country','cat_country.name as cat_country','ct.name as caretaker_name','cc.caretaker_id', 'ct.emirates_id_number','ct.name as caretaker_name', 'ct.customer_id', 'ct.email', 'ct.address', 'ct.phone_number', 'ct.whatsapp_number', 'ct.home_country', 'careState.name as caretaker_state','catState.name as cat_state', 'ct.work_place', 'ct.work_address', 'ct.position', 'ct.work_contact_number', 'ct.passport_number', 'ct.visa_status', 'ct.number_of_registered_cats', 'ct.image_url as caretaker_image')
                    ->leftJoin('cat_caretakers as cc','cc.cat_id', '=', 'cats.id')
                    ->leftJoin('caretakers as ct','cc.caretaker_id','=','ct.id')
                    ->leftJoin('countries as care_country','care_country.id', '=', 'ct.home_country')
                    ->leftJoin('countries as cat_country','cat_country.id', '=', 'cats.place_of_origin')
                    ->leftJoin('states as careState','careState.id', '=', 'ct.state_id')
                    ->leftJoin('states as catState','catState.id', '=', 'cats.state_id')
                    ->where('cats.id', '=', $cat)
                    ->where('cc.transfer_status', 0)->get();
                    
        return view('admin.caretaker.cat_view')->with([
            'cat' => $query,
        ]);
    } 

    public function edit(Caretaker $caretaker)
    {
        $countries = Country::orderByRaw('name="United Arab Emirates" DESC')->orderBy('name','ASC')->get();
        $states = Helper::getStates($caretaker->home_country);
        return view('admin.caretaker.edit')->with([
            'caretaker' => $caretaker,
            'countries' => $countries,
            'states' => $states
        ]);
    }
    public function update(Request $request, Caretaker $caretaker)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'customer_id' => 'required|unique:caretakers,customer_id,'.$request->careId,
            'email' => 'required|email|unique:caretakers,email,'.$request->careId
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $imageUrl = '';
        $presentImage = $request->image_url;
      
        if ($request->hasFile('imageUrl')) {
            $uploadedFile = $request->file('imageUrl');
            $filename =    strtolower(Str::random(2)).time().'.'. $uploadedFile->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs(
                'caretaker',
                $uploadedFile,
                $filename
            );
           $imageUrl = Storage::url($name);
            if($presentImage != '' && File::exists(public_path($presentImage))){
                unlink(public_path($presentImage));
            }
        } 
      
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'customer_id' => $request->customer_id,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'whatsapp_number' => $request->whatsapp_number,
            'home_country' => $request->home_country,
            'state_id' => $request->emirate,
            'work_place' => $request->work_place,
            'work_address' => $request->work_address,
            'position' => $request->position,
            'work_contact_number' => $request->work_contact_number,
            'is_passport_no' => $request->is_passport_no  == 'hide' ? 0 : 1,
            'passport_number' => $request->passport_number,
            'is_emirates_id' => $request->is_emirates_id == 'hide' ? 0 : 1,
            'emirates_id_number' => $request->emirates_id_number,
            'visa_status' => $request->visa_status,
            'number_of_registered_cats' => $request->number_of_registered_cats,
            'comments' => $request->comments,
            'image_url' => ($imageUrl !='') ? $imageUrl : $presentImage,
            'status' => (isset($request->status)) ? $request->status : 'published',
            'is_blacklist' => $request->is_blacklist,
            'blacklist_reason' => $request->blacklist_reason
        ];

        Caretaker::where('id',$request->careId)->update($data);
        return back()->with('status', 'Caretaker Details Upated!');
    }
    public function store(StoreCaretakerRequest $request)
    {
        $image_name = '';

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $filename =   time() . $uploadedFile->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs(
                'caretaker',
                $uploadedFile,
                $filename
            );

            $image_name = Storage::url($name);
        }
        $caretaker = Caretaker::create([
            'name' => $request->name,
            'email' => $request->email,
            'customer_id' => $request->customer_id,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'whatsapp_number' => $request->whatsapp_number,
            'home_country' => $request->home_country,
            'state_id' => $request->emirate,
            'work_place' => $request->work_place,
            'work_address' => $request->work_address,
            'position' => $request->position,
            'work_contact_number' => $request->work_contact_number,
            'is_passport_no' => $request->is_passport_no  == 'hide' ? 0 : 1,
            'passport_number' => $request->passport_number,
            'is_emirates_id' => $request->is_emirates_id == 'hide' ? 0 : 1,
            'emirates_id_number' => $request->emirates_id_number,
            'visa_status' => $request->visa_status,
            'number_of_registered_cats' => 0,
            'comments' => $request->comments,
            'status' => 'published',
            'image_url' => $image_name,
            'is_blacklist' => ($request->is_blacklist) ? $request->is_blacklist : 0,
            'blacklist_reason' => $request->blacklist_reason
        ]);

        $caretaker->customer_id = 'CMC' . str_pad($caretaker->id, 4, 0, STR_PAD_LEFT);

        return redirect()->route('caretaker.index')->with('status', 'Caretaker created!');
    }

    public function getCaretakerList(Request $request){
        $search = $request->search;
        $query  = Caretaker::select('id','name', 'customer_id', 'email', 'phone_number', 'whatsapp_number', 'status')->where('is_blacklist',0);
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%')
                        ->orWhere('customer_id', 'LIKE', '%'.$search . '%')
                        ->orWhere('email', 'LIKE', '%'.$search . '%')
                        ->orWhere('phone_number', 'LIKE', '%'.$search . '%')
                        ->orWhere('whatsapp_number', 'LIKE', '%'.$search . '%');
            });                    
        }
        $caretaker = $query->orderBy('id','DESC')->get();
        $viewData = view('admin.caretaker.ajax_list', compact('caretaker'))->render();

        return $viewData;
    }
    public function getCaretakerBlackList(Request $request){
        $search = $request->search;
        $query  = Caretaker::select('id','name', 'customer_id', 'email', 'phone_number', 'whatsapp_number', 'status')->where('is_blacklist',1);
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%')
                        ->orWhere('customer_id', 'LIKE', '%'.$search . '%')
                        ->orWhere('email', 'LIKE', '%'.$search . '%')
                        ->orWhere('phone_number', 'LIKE', '%'.$search . '%')
                        ->orWhere('whatsapp_number', 'LIKE', '%'.$search . '%');
            });                    
        }
        $caretaker = $query->orderBy('id','DESC')->get();
        $viewData = view('admin.caretaker.ajax_list', compact('caretaker'))->render();

        return $viewData;
    }
}
