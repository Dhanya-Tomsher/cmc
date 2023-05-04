<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCatRequest;
use App\Http\Requests\UpdateCatRequest;
use Illuminate\Http\Request;
use App\Models\Cat; 
use App\Models\CatCaretakers; 
use App\Models\Country;
use App\Models\Caretaker;
use DB;
use Str;
use Storage;
use File;

class CatController extends Controller
{
    public function index(Request $request)
    {
        $cat  = Cat::orderBy('name','ASC')->get();
        return view('admin.cat.index')->with([
            'cat' => $cat,
        ]);
    }
    public function create()
    {
        $countries = Country::all();
        $caretakers = Caretaker::orderBy('name','ASC')->get();
        return view('admin.cat.create', compact('countries','caretakers'));
    }
    public function search()
    {
        return view('admin.cat.create');
    }
    public function update(UpdateCatRequest $request)
    {
        $imageUrl = '';
        $presentImage = $request->image_url;
      
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $filename =    strtolower(Str::random(2)).time().'.'. $uploadedFile->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs(
                'cats',
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
            'cat_id' => $request->cat_id,
            'date_birth' => $request->date_birth,
            'gender' => $request->gender,
            'pregnant'=>$request->pregnantstatus,
            'blood_type' => $request->blood_type,
            'castrated' => $request->castrated,
            'spayed'=>$request->spayed,
            'neutered' => $request->neutered,
            'neutered_with_us' => $request->neutered_with_us,
            'fur_color' => $request->fur_color,
            'eye_color' => $request->eye_color,
            'place_of_origin' => $request->place_of_origin,
            'emirate' => $request->emirate,
            'origin' => $request->origin,
            'microchip_number' => $request->microchip_number,
            'dead_alive' => $request->dead_alive,   
            'image_url' => ($imageUrl !='') ? $imageUrl : $presentImage,
            'status' => (isset($request->status)) ? $request->status : 'published',
        ];
        Cat::where('id',$request->catId)->update($data);
        CatCaretakers::where('cat_id',$request->catId)->where('transfer_status',0)->update(['caretaker_id' => $request->caretaker_id]);
    }
    public function view(cat $cat)
    {
        $query  = Cat::select('cats.*','care_country.name as care_country','cat_country.name as cat_country','ct.name as caretaker_name','cc.caretaker_id', 'ct.emirates_id_number','ct.name as caretaker_name', 'ct.customer_id', 'ct.email', 'ct.address', 'ct.phone_number', 'ct.whatsapp_number', 'ct.home_country', 'ct.emirate as caretaker_emirate', 'ct.work_place', 'ct.work_address', 'ct.position', 'ct.work_contact_number', 'ct.passport_number', 'ct.visa_status', 'ct.number_of_registered_cats', 'ct.image_url as caretaker_image')
                    ->leftJoin('cat_caretakers as cc','cc.cat_id', '=', 'cats.id')
                    ->leftJoin('caretakers as ct','cc.caretaker_id','=','ct.id')
                    ->leftJoin('countries as care_country','care_country.id', '=', 'ct.home_country')
                    ->leftJoin('countries as cat_country','cat_country.id', '=', 'cats.place_of_origin')
                    ->where('cats.id', '=', $cat->id)
                    ->where('cc.transfer_status', 0)->get();
                    
        return view('admin.cat.show')->with([
            'cat' => $query,
        ]);
    } 
    public function edit(Cat $cat)
    {
        $query  = Cat::select('cats.*','cat_caretakers.caretaker_id')
                    ->leftJoin('cat_caretakers','cat_caretakers.cat_id', '=', 'cats.id')
                    ->where('cats.id', '=', $cat->id)
                    ->where('cat_caretakers.transfer_status', 0)->get();
        $countries = Country::all();
        $caretakers = Caretaker::orderBy('name','ASC')->get();
        return view('admin.cat.edit')->with([
            'cat' => $query,
            'countries' => $countries,
            'caretakers' => $caretakers
        ]);
    }
    public function store(StoreCatRequest $request)
    {
        $imageUrl = '';
        if ($request->hasFile('image_url')) {
            $uploadedFile = $request->file('image_url');
            $filename =    strtolower(Str::random(2)).time().'.'. $uploadedFile->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs(
                'cats',
                $uploadedFile,
                $filename
            );
           $imageUrl = Storage::url($name);
        }   
       
        $cat = Cat::create([
            'name' => $request->name,
            'cat_id' => $request->cat_id,
            'date_birth' => $request->date_birth,
            'gender' => $request->gender,
            'pregnant'=>$request->pregnantstatus,
            'blood_type' => $request->blood_type,
            'castrated' => $request->castrated,
            'spayed'=>$request->spayed,
            'neutered' => $request->neutered,
            'neutered_with_us' => $request->neutered_with_us,
            'fur_color' => $request->fur_color,
            'eye_color' => $request->eye_color,
            'place_of_origin' => $request->place_of_origin,
            'emirate' => $request->emirate,
            'origin' => $request->origin,
            'microchip_number' => $request->microchip_number,
            'dead_alive' => $request->dead_alive,
            'caretaker_id' => $request->caretaker_id,            
            'comments' => $request->comments,
            'image_url' => $imageUrl,
            'status' => (isset($request->status)) ? $request->status : 'published',
        ]);

        $caretaker = CatCaretakers::create([
            'cat_id' => $request->cat_id,
            'caretaker_id' => $request->caretaker_id,
            'transfer_status' => 0,
          ]);
        return redirect()->route('cat.index')->with('status', 'cat created!');
    }

    public function getCatsList(Request $request){
        $search = $request->search;
        // DB::enableQueryLog();
        $query  = Cat::leftJoin('cat_caretakers','cat_caretakers.cat_id', '=', 'cats.id')
                        ->leftJoin('caretakers','cat_caretakers.caretaker_id','=','caretakers.id')
                        ->where('cat_caretakers.transfer_status', 0);
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('cats.gender', 'LIKE', $search . '%')
                        ->orWhere('cats.cat_id', 'LIKE', $search . '%')
                        ->orWhere('caretakers.customer_id', 'LIKE', $search . '%')
                        ->orWhere('caretakers.name', 'LIKE', $search . '%')
                        ->orWhere('cats.name', 'LIKE', $search . '%');
            });                    
        }
        $cats = $query->orderBy('cats.id','DESC')
                    ->get(['cats.created_at','cats.id','cats.status','cats.gender','cats.cat_id','caretakers.customer_id','caretakers.name as caretaker_name','cats.name as cat_name','cats.image_url']);
    //  dd(DB::getQueryLog());
        $viewData = view('admin.cat.ajax_list', compact('cats'))->render();

        return $viewData;
    }

    public function journal(Cat $cat)
    {
        return view('admin.cat.journal')->with([
            'cat' =>  $cat,
        ]);
    }

    public function getJournalData(Request $request)
    {
        $viewData = [];
        switch($request->type) {
            case 'medical_history':
                
                $viewData = view('admin.journal.medical_history')->render();
                break;
            case 'dental':

                break;
            case 'hospitalization':

                break;
            case 'hotel':

                break;
            case 'laboratory_test':

                break;
            case 'laser':

                break;
            case 'medicine':

                break;
            case 'medical_treatment':

                break;
            case 'surgery':

                break;
            case 'ultrasound':

                break;
            case 'virus_test':

                break;
            case 'xray':

                break;
 
            default:
                $viewData = [];
        }
 
        return $viewData;
    }
}