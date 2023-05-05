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
use App\Models\JournalMedicalHistories;
use App\Models\JournalDetails;
use App\Models\JournalFiles;
use App\Models\JournalVirusTests;
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
        $cat_id = $request->cat_id;
        $type = $request->type;
        $keyword = $request->keyword;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        switch($type) {
            case 'medical_history':
              
                $query = JournalMedicalHistories::select('*')
                                                ->where('cat_id',$cat_id);
                if($keyword){  
                    $query->Where(function ($query) use ($keyword) {
                        $query->orWhere('weight', 'LIKE','%'. $keyword . '%')
                                ->orWhere('temperature', 'LIKE','%'. $keyword . '%')
                                ->orWhere('blood_pressure', 'LIKE', '%'.$keyword . '%');
                    });                    
                }

                if($from_date != '' || $to_date != ''){
                    if($from_date != '' && $to_date != ''){
                        $query->whereDate('report_date', '>=', $from_date)
                        ->whereDate('report_date',   '<=', $to_date);
                    }elseif($from_date == '' && $to_date != ''){
                        $query->whereDate('report_date', '=', $to_date);
                    }elseif($from_date != '' && $to_date == ''){
                        $query->whereDate('report_date', '=', $from_date);
                    }
                }
                $data = $query->orderBy('id','DESC')->get();

                $viewData = view('admin.journal.medical_history',compact('data','cat_id'))->render();
                break;
            case 'dental':
                $title = 'Dental';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
            case 'hospitalization':
                $title = 'Hospitalization';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
            case 'hotel':
                $title = 'Hotel';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
            case 'laboratory_test':
                $title = 'Laboratory Test';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
            case 'laser':
                $title = 'Laser';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
            case 'medicine':
                $title = 'Medicine';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
            case 'medical_treatment':
                $title = 'Medical Treatment';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
            case 'surgery':
                $title = 'Surgery';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
            case 'ultrasound':
                $title = 'Ultrasound';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
            case 'virus_test':
                $title = 'Virus Test';
                $query = JournalVirusTests::select('*')
                                        ->where('cat_id',$cat_id);
                if($keyword){
                    $query->where('calicivirus', 'LIKE', '%'.$keyword. '%');
                } 
                if($from_date != '' || $to_date != ''){
                    if($from_date != '' && $to_date != ''){
                        $query->whereDate('report_date', '>=', $from_date)
                        ->whereDate('report_date',   '<=', $to_date);
                    }elseif($from_date == '' && $to_date != ''){
                        $query->whereDate('report_date', '=', $to_date);
                    }elseif($from_date != '' && $to_date == ''){
                        $query->whereDate('report_date', '=', $from_date);
                    }
                }
                $data = $query->orderBy('id','DESC')->get();
                $viewData = view('admin.journal.virus_tests',compact('data','cat_id','type','title'))->render();
                break;
            case 'xray':
                $title = 'X-ray';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title'))->render();
                break;
 
            default:
                $viewData = [];
        }
 
        return $viewData;
    }

    public function deleteMedicalHistory(Request $request){
        $med_id = $request->med_id;
        $medical = JournalMedicalHistories::find($med_id);
        $medical->delete();
    }

    public function deleteVirusTest(Request $request){
        $vid = $request->vid;
        $virus = JournalVirusTests::find($vid);
        $virus->delete();
    }

    public function storeMedicalHistory(Request $request){
        JournalMedicalHistories::create([
            'cat_id' => $request->cat_id, 
            'weight' => $request->weight,  
            'temperature' => $request->temperature, 
            'blood_pressure' => $request->blood_pressure,  
            'report_date' => date('Y-m-d')
        ]);
    }

    public function storeVirusTest(Request $request){
        JournalVirusTests::create([
            'cat_id' => $request->cat_id, 
            'calicivirus' => $request->calicivirus, 
            'coronavirus' => $request->coronavirus, 
            'herpesvirus' => $request->herpes,  
            'felv'  => $request->felv, 
            'fiv'  => $request->fiv, 
            'panleukopenia'  => $request->panleukopenia, 
            'report_date' => date('Y-m-d')
        ]);
    }

    public function storeJournalDetails(Request $request){

        $journal = JournalDetails::create([
            'cat_id' => $request->cat_id, 
            'journal_type' => $request->type,  
            'remarks'  => $request->remarks, 
            'report_date'=> date('Y-m-d')
        ]);
        $journal_id = $journal->id;

        $imageData = [];
        if ($request->hasFile('files')) {
            $uploadedFile = $request->file('files');
            $i = 0;
            foreach($uploadedFile as $file){
                $filename =    strtolower(Str::random(2)).time().'.'. $file->getClientOriginalName();
                $name = Storage::disk('public')->putFileAs(
                    'journals/'.$request->type,
                    $file,
                    $filename
                );
               $imageData[$i]['journal_id'] = $journal_id;
               $imageData[$i]['image_url'] = Storage::url($name);
               $i++;
            }
        }   
        if(!empty($imageData)){
            JournalFiles::insert($imageData);
        }
    }

    public function getJournalDetails($type, $cat_id, $keyword,$from_date,$to_date){
        $query = JournalDetails::select("*")
                ->where('status', 1)
                ->where('cat_id', $cat_id)
                ->where('journal_type', $type);
        if($keyword){
            $query->where('remarks', 'LIKE', '%'.$keyword. '%');
        } 
        if($from_date != '' || $to_date != ''){
            if($from_date != '' && $to_date != ''){
                $query->whereDate('report_date', '>=', $from_date)
                ->whereDate('report_date',   '<=', $to_date);
            }elseif($from_date == '' && $to_date != ''){
                $query->whereDate('report_date', '=', $to_date);
            }elseif($from_date != '' && $to_date == ''){
                $query->whereDate('report_date', '=', $from_date);
            }
        }
        $journals = $query->orderBy('id','desc')
                ->get();
        if($journals){
            foreach($journals as $key=>$journal){
                $files = JournalFiles::where('journal_id',$journal->id)->get()->pluck('image_url')->toArray();
                $journals[$key]['files'] = $files;
                $journals[$key]['file_names'] = implode(',',$files);
            }
        }
        return $journals;
    }

    public function deleteJournalData(Request $request){
        $jid = $request->jid;
        $journal = JournalDetails::find($jid);
        $journal->delete();
        $files = JournalFiles::select('image_url')->where('journal_id',$jid)->get()->toArray();
        if($files){
            foreach($files as $file){
                if(File::exists(public_path($file['image_url']))){
                    unlink(public_path($file['image_url']));
                }
            }
            JournalFiles::where('journal_id',$jid)->delete();
        }
    }
}