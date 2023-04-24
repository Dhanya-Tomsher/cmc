<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\StoreCaretakerRequest;
use App\Http\Requests\UpdateCaretakerRequest;
use App\Http\Controllers\Controller;
use App\Models\Caretaker;
use Illuminate\Http\Request; 

class CaretakerController extends Controller
{
    public function index(Request $request)
    {
        $caretaker  = Caretaker::all();
        return view('admin.caretaker.index')->with([
            'caretaker' => $caretaker,
        ]);
    }
    public function create()
    {
        return view('admin.caretaker.create');
    }
    public function view(Caretaker $caretaker)
    {
      // $caretaker->load('editor', 'creator');
        return view('admin.caretaker.show')->with([
            'caretaker' => $caretaker,
        ]);
    } 
    public function edit(Caretaker $caretaker)
    {
        return view('admin.caretaker.edit')->with([
            'caretaker' => $caretaker,
        ]);
    }  
    public function update(UpdateCaretakerRequest $request, Caretaker $caretaker)
    {
        $caretaker->update($request->all());
        return back()->with('status', 'Caretaker Upated!');
    }
    public function store(StoreCaretakerRequest $request)
    {
        
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
            'is_passport_no' => $request->is_passport_no,
            'passport_number' => $request->passport_number,
            'is_emirates_id' => $request->is_emirates_id,
            'emirates_id_number' => $request->emirates_id_number,
            'visa_status' => $request->visa_status,
            'number_of_registered_cats' => $request->number_of_registered_cats,            
            'comments' => $request->comments,
            'image_url' => $request->image_url,
            'status' => $request->status,
        ]);

      /*  if ($request->hasFile('image_url')) {
            $uploadedFile = $request->file('image_url');
            $filename =   time() . $uploadedFile->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs(
                'image_url',
                $uploadedFile,
                $filename
            );
            $caretaker->image_url = Storage::url($name);
            $caretaker->save();
        }   */    
      //  $caretaker->save();
       return redirect()->route('caretaker.index')->with('status', 'Caretaker created!');
    }
}

