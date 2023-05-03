<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCatRequest;
use App\Http\Requests\UpdateCatRequest;
use Illuminate\Http\Request;
use App\Models\Cat; 
use App\Models\Country;
use App\Models\Caretaker;
use DB;
use Str;
use Storage;

class CatController extends Controller
{
    public function index(Request $request)
    {
        $cat  = Cat::all();
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
    public function update(UpdateCatRequest $request, Cat $cat)
    {
        $cat->update($request->all());
        return back()->with('status', 'Cat Upated!');
    }
    public function view(cat $cat)
    {
       //$cat->load('editor', 'creator');
        return view('admin.cat.show')->with([
            'cat' => $cat,
        ]);
    } 
    public function edit(Cat $cat)
    {
        return view('admin.cat.edit')->with([
            'cat' => $cat
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

      /*  if ($request->hasFile('image_url')) {
            $uploadedFile = $request->file('image_url');
            $filename =   time() . $uploadedFile->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs(
                'image_url',
                $uploadedFile,
                $filename
            );
            $cat->image_url = Storage::url($name);
            $cat->save();
        }   */    
       // $cat->save();
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
                    ->get(['cats.created_at','cats.id','cats.status','cats.gender','cats.cat_id','caretakers.customer_id','caretakers.name as caretaker_name','cats.name as cat_name']);
    //  dd(DB::getQueryLog());
        $viewData = view('admin.cat.ajax_list', compact('cats'))->render();

        return $viewData;
    }
}