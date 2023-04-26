<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVetRequest;
use App\Http\Requests\UpdateVetRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Vet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VetController extends Controller
{
    public function index(Request $request)
    {
        $vet  = Vet::all();
        return view('admin.vet.index')->with([
            'vet' => $vet,
        ]);
    }
    public function create()
    {
        $countries = Country::all();
        return view('admin.vet.create', compact('countries'));
    }
    public function schedule()
    {
        return view('admin.vet.schedule');
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
                'caretaker',
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

        $vet->update($request->all());
        return back()->with('status', 'Vet Upated!');
    }
    public function view(Vet $vet)
    {
        return view('admin.vet.show')->with([
            'vet' => $vet,
        ]);
    }
    public function edit(Vet $vet)
    {
        $countries = Country::all();
        return view('admin.vet.edit')->with([
            'vet' => $vet,
            'countries' => $countries,
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
            'emirate' => $request->emirate,
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
        ]);


        return redirect()->route('vet.index')->with('status', 'vet created!');
    }
}
