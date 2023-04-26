<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCaretakerRequest;
use App\Http\Requests\UpdateCaretakerRequest;
use App\Http\Controllers\Controller;
use App\Models\Caretaker;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $countries = Country::all();
        return view('admin.caretaker.create', compact('countries'));
    }
    public function view(Caretaker $caretaker)
    {
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
            'is_passport_no' => $request->is_passport_no  == 'hide' ? 0 : 1,
            'passport_number' => $request->passport_number,
            'is_emirates_id' => $request->is_emirates_id == 'hide' ? 0 : 1,
            'emirates_id_number' => $request->emirates_id_number,
            'visa_status' => $request->visa_status,
            'number_of_registered_cats' => $request->number_of_registered_cats,
            'comments' => $request->comments,
            'status' => 'published',
        ]);

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
        $caretaker->image_url = $image_name;
        $caretaker->customer_id = 'CMC' . str_pad($caretaker->id, 4, 0, STR_PAD_LEFT);

        return redirect()->route('caretaker.index')->with('status', 'Caretaker created!');
    }
}
