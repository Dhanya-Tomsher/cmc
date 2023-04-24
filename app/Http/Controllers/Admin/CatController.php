<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCatRequest;
use App\Http\Requests\UpdateCatRequest;
use Illuminate\Http\Request;
use App\Models\Cat; 

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
        return view('admin.cat.create');
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
        
        $cat = Cat::create([
            'name' => $request->name,
            'cat_id' => $request->cat_id,
            'date_birth' => $request->date_birth,
            'gender' => $request->gender,
            'pregnantstatus'=>$request->pregnantstatus,
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
            $cat->image_url = Storage::url($name);
            $cat->save();
        }   */    
       // $cat->save();
        return redirect()->route('cat.index')->with('status', 'cat created!');
    }
}