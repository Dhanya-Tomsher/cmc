<?php
 namespace App\Http\Controllers\Admin;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\StoreVetRequest;
    use App\Http\Requests\UpdateVetRequest;
    use Illuminate\Http\Request;
    use App\Models\Vet;
    
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
            return view('admin.vet.create');
        }
        public function schedule()
        {
            return view('admin.vet.schedule');
        }
        public function search()
        {
            return view('admin.vet.create');
        }
        public function update(UpdateCatRequest $request, Vet $vet)
    {
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
            return view('admin.vet.edit')->with([
                'vet' => $vet
            ]);
        }

        public function store(StoreVetRequest $request)
        {
            
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
                'license_number' => $request->license_number,
                'designation' => $request->designation,
                'specialization' => $request->specialization,
                'image_url' => $request->image_url,
                'status' => $request->status,
            ]);
    
          
            return redirect()->route('vet.index')->with('status', 'vet created!');
        
    }
}