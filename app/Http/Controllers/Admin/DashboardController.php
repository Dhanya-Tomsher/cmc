<?php

namespace App\Http\Controllers\Admin;

Use App\Http\Controllers\Controller;
Use App\Models\Caretaker;
Use App\Models\Cat;
Use App\Models\Vet;
Use App\Models\States;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class DashboardController extends Controller
{
    public function index()
    {
      //  $countCats = Cat::count();
      //  $countCaretaker = Caretaker::count();
      //  $countVet = Vet::count();
       // return view('admin.dashboard')->with([
       //     'countCats' => $countCats,
          //  'countCaretaker' => $countCaretaker,
          //  'countVet' => $countVet,
      //  ]);
      $countCats = Cat::count();
      $countCaretaker = Caretaker::count();
      $countNeutered = Cat::where('neutered',1)->count();
      $countSpayed = Cat::where('gender','Female')->where('spayed',1)->count();
      $countCastrated  = Cat::where('gender','Male')->where('castrated',1)->count();
      return view('admin.dashboard')->with([
            'countCats' => $countCats,
            'countCaretaker' => $countCaretaker,
            'countNeutered' => $countNeutered,
            'countSpayed' => $countSpayed,
            'countCastrated' => $countCastrated
        ]);
    }

    public function searchCaretaker(Request $request)
    {
        $caretakers = [];
            
        if($request->has('term')){
            $search = $request->term;
            $query = Caretaker::select("id","name","customer_id")->where('is_blacklist',0);
            if($search){  
                $query->Where(function ($query) use ($search) {
                    $query->orWhere('name', 'LIKE', "%$search%")
                    ->orWhere('customer_id', 'LIKE', "$search%")
                    ->orWhere('phone_number', 'LIKE', "$search%")
                    ->orWhere('whatsapp_number', 'LIKE', "$search%")
                    ->orWhere('work_contact_number', 'LIKE', "$search%")
                    ->orWhere('emirates_id_number', 'LIKE', "$search%");
                });                    
            }
            $caretakers = $query->orderBy('name','ASC')
                            ->get();
        }else{
            $caretakers = Caretaker::select("id","name","customer_id")
                                    ->where('is_blacklist',0)
                                    ->orderBy('name','ASC')
                                    ->get();
        }
        return response()->json($caretakers);
    }

    public function searchCat(Request $request)
    {
        $cats = [];
        if($request->has('term')){
            $search = $request->term;
            $query = Cat::select("cats.id","cats.name","cats.cat_id");
            if($search){  
                $query->Where(function ($query) use ($search) {
                    $query->orWhere('cats.name', 'LIKE', "%$search%")
                    ->orWhere('cats.cat_id', 'LIKE', "$search%")
                    ->orWhere('cats.gender', 'LIKE', "$search%")
                    ->orWhere('cats.fur_color', 'LIKE', "%$search%")
                    ->orWhere('cats.eye_color', 'LIKE', "%$search%")
                    ->orWhere('cats.microchip_number', 'LIKE', "$search%");
                });                    
            }      
            $cats = $query->orderBy('cats.name','ASC')->get();
        }else{
            $cats = Cat::select("cats.id","cats.name","cats.cat_id")
                            ->orderBy('cats.name','ASC')
                            ->get();
        }
        return response()->json($cats);
    }

    public function getCaretakerList(Request $request){
      $search = $request->search;
      $query  = Caretaker::select('id','name', 'customer_id', 'email', 'phone_number', 'whatsapp_number', 'status','address')->where('is_blacklist',0);
      if($search){  
          $query->Where(function ($query) use ($search) {
              $query->orWhere('name', 'LIKE', '%'.$search . '%')
                      ->orWhere('customer_id', 'LIKE', '%'.$search . '%')
                      ->orWhere('email', 'LIKE', '%'.$search . '%')
                      ->orWhere('phone_number', 'LIKE', '%'.$search . '%')
                      ->orWhere('address', 'LIKE', '%'.$search . '%')
                      ->orWhere('whatsapp_number', 'LIKE', '%'.$search . '%');
          });                    
      }
      $caretaker = $query->orderBy('name','ASC')->get();
      $viewData = view('admin.contact_directory', compact('caretaker'))->render();

      return $viewData;
  }

    public function countsApi()
    {
        $data = json_decode($this->catsCountApi());
        $counts = $data->data;
       
        return view('admin.dashboard-counts')->with([
            'countNeutered' =>  $counts->neutered,
            'countSpayed' => $counts->spayed,
            'countCastrated' => $counts->castrated
        ]);
    }

    public function catsCountApi(){
        $data['neutered'] = Cat::where('neutered',1)->count();
        $data['spayed'] = Cat::where('gender','Female')->where('spayed',1)->count();
        $data['castrated']  = Cat::where('gender','Male')->where('castrated',1)->count();

        return json_encode(array('status'=>'success','data'=>$data));
    }

    public function getStates(Request $request){
        $states = States::select("name","id")->where("country_id",$request->country_id)->orderBy('name')->get();
        
        $options = "<option value=''>Select </option>";
        foreach($states as $key=>$value){
            $options .= '<option value="'.$value->id.'">'.ucfirst($value->name).'</option>';
        }
        return $options;
    }
}

