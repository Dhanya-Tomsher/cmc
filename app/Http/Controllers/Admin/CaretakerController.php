<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCaretakerRequest;
use App\Http\Requests\UpdateCaretakerRequest;
use App\Http\Controllers\Controller;
use App\Models\Caretaker;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;
use File;
use Validator;

class CaretakerController extends Controller
{
    public function index(Request $request)
    {
        $caretaker  = Caretaker::orderBy('name','ASC')->get();
        return view('admin.caretaker.index')->with([
            'caretaker' => $caretaker,
        ]);
    }
    public function create()
    {
        $countries = Country::all();
        return view('admin.caretaker.create', compact('countries'));
    }

    public function view(Caretaker $caretaker)
    {
        $query  = Caretaker::select('caretakers.*','care_country.name as care_country')
                    ->leftJoin('countries as care_country','care_country.id', '=', 'caretakers.home_country')
                    ->where('caretakers.id', '=', $caretaker->id)->get();
                    
        return view('admin.caretaker.show')->with([
            'caretaker' => $query,
        ]);
    } 

    public function edit(Caretaker $caretaker)
    {
        $countries = Country::all();
        return view('admin.caretaker.edit')->with([
            'caretaker' => $caretaker,
            'countries' => $countries
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
            'emirate' => $request->emirate,
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
            'emirate' => $request->emirate,
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
            'status' => 'published',
            'image_url' => $image_name,
            'is_blacklist' => $request->is_blacklist,
            'blacklist_reason' => $request->blacklist_reason
        ]);

        $caretaker->customer_id = 'CMC' . str_pad($caretaker->id, 4, 0, STR_PAD_LEFT);

        return redirect()->route('caretaker.index')->with('status', 'Caretaker created!');
    }

    public function getCaretakerList(Request $request){
        $search = $request->search;
        $query  = Caretaker::select('id','name', 'customer_id', 'email', 'phone_number', 'whatsapp_number', 'status');
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
