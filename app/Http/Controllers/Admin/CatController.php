<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCatRequest;
use App\Http\Requests\UpdateCatRequest;
use Illuminate\Http\Request;
use App\Models\Cat; 
use App\Models\CatCaretakers; 
use App\Models\Country;
use App\Models\CustomForms;
use App\Models\Caretaker;
use App\Models\JournalMedicalHistories;
use App\Models\JournalDetails;
use App\Models\JournalFiles;
use App\Models\JournalVirusTests;
use DB;
use Str;
use Storage;
use File;
use PDF;
use Mail;

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
        $caretakers = Caretaker::where('is_blacklist',0)->orderBy('name','ASC')->get();
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
            'virus' => (isset($request->virusstatus)) ? $request->virusstatus : 2,
            'behaviour' => $request->behaviour,
        ];
        Cat::where('id',$request->catId)->update($data);
        $currentCaretaker = CatCaretakers::where('cat_id',$request->catId)->where('transfer_status',0)->get()->toArray();
        
        if($currentCaretaker[0]['caretaker_id'] != $request->caretaker_id){
            CatCaretakers::where('cat_id',$request->catId)->where('transfer_status',0)->update(['transfer_status' => 1, 'transfer_to_caretaker' => $request->caretaker_id]);
            $caretaker = CatCaretakers::create([
                'cat_id' => $request->catId,
                'caretaker_id' => $request->caretaker_id,
                'transfer_status' => 0,
              ]);
            Caretaker::find($currentCaretaker[0]['caretaker_id'])->decrement('number_of_registered_cats');
            Caretaker::find($request->caretaker_id)->increment('number_of_registered_cats');
        }
    }
    public function view(cat $cat)
    {
        $query  = Cat::select('cats.*','care_country.name as care_country','cat_country.name as cat_country','ct.name as caretaker_name','cc.caretaker_id', 'ct.emirates_id_number','ct.name as caretaker_name', 'ct.customer_id', 'ct.email', 'ct.address', 'ct.phone_number', 'ct.whatsapp_number', 'ct.home_country', 'ct.emirate as caretaker_emirate', 'ct.work_place', 'ct.work_address', 'ct.position', 'ct.work_contact_number', 'ct.passport_number', 'ct.visa_status', 'ct.number_of_registered_cats', 'ct.image_url as caretaker_image')
                    ->leftJoin('cat_caretakers as cc','cc.cat_id', '=', 'cats.id')
                    ->leftJoin('caretakers as ct','cc.caretaker_id','=','ct.id')
                    ->leftJoin('countries as care_country','care_country.id', '=', 'ct.home_country')
                    ->leftJoin('countries as cat_country','cat_country.id', '=', 'cats.place_of_origin')
                    ->where('cats.id', '=', $cat->id)
                    ->where('cc.transfer_status', 0)
                    ->get();
                    
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
        $presentCaretaker = Caretaker::select('id','name')->where('id',$query[0]->caretaker_id)->where('is_blacklist',1)->get()->toArray();
        $caretakers = Caretaker::select('id','name')->orderBy('name','ASC')->where('is_blacklist',0)->get()->toArray();
        $editCaretakers = array_merge($presentCaretaker, $caretakers);
        return view('admin.cat.edit')->with([
            'cat' => $query,
            'countries' => $countries,
            'caretakers' => $editCaretakers
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
            'virus' => (isset($request->virusstatus)) ? $request->virusstatus : 2,
            'behaviour' => $request->behaviour,
            'status' => (isset($request->status)) ? $request->status : 'published',
        ]);

        $caretaker = CatCaretakers::create([
            'cat_id' => $cat->id,
            'caretaker_id' => $request->caretaker_id,
            'transfer_status' => 0,
        ]);
        Caretaker::find($request->caretaker_id)->increment('number_of_registered_cats');
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

    public function journal(Cat $cat, $care_id = '')
    {
        $transfer_date = '';
        if($care_id){
            $transfer_status_check = CatCaretakers::where('cat_id', $cat->id)
                                            ->where('caretaker_id', $care_id)
                                            ->orderBy('id', 'desc')
                                            ->first()->toArray();
            $transfer_status = $transfer_status_check['transfer_status'];
            if($transfer_status == 1){
                $transfer_date = $transfer_status_check['updated_at'];
            }
            
        }
        $counts = $this->getJournalAllCounts($cat->id, $transfer_date);
       
        return view('admin.cat.journal')->with([
            'cat' =>  $cat,
            'counts' => $counts,
            'transfer_date' => $transfer_date
        ]);
    }

    public function getJournalAllCounts($cat_id, $transfer_date, $keyword = '', $from_date = '', $to_date = ''){
        $counts = $this->getJournalCounts($cat_id, $transfer_date, $keyword, $from_date, $to_date);
       
        $medCountcheck = JournalMedicalHistories::where('cat_id',$cat_id);

        if($transfer_date != ''){
            $medCountcheck->where('created_at','<=', $transfer_date);
        }
        if($keyword){  
            $medCountcheck->Where(function ($medCountcheck) use ($keyword) {
                $medCountcheck->orWhere('weight', 'LIKE','%'. $keyword . '%')
                        ->orWhere('temperature', 'LIKE','%'. $keyword . '%')
                        ->orWhere('blood_pressure', 'LIKE', '%'.$keyword . '%');
            });                    
        }
        if($from_date != '' || $to_date != ''){
            if($from_date != '' && $to_date != ''){
                $medCountcheck->whereDate('report_date', '>=', $from_date)
                ->whereDate('report_date',   '<=', $to_date);
            }elseif($from_date == '' && $to_date != ''){
                $medCountcheck->whereDate('report_date', '=', $to_date);
            }elseif($from_date != '' && $to_date == ''){
                $medCountcheck->whereDate('report_date', '=', $from_date);
            }
        }
        $medCount = $medCountcheck->count();
       
        if($medCount != 0){
            $counts['vital'] = $medCount;
        }
      
        $virusCountCheck = JournalVirusTests::where('cat_id',$cat_id);

        if($keyword){
            $virusCountCheck->Where(function ($virusCountCheck) use ($keyword) {
                $virusCountCheck->orWhere('other_name', 'LIKE','%'. $keyword . '%')
                        ->orWhere('other2_name', 'LIKE','%'. $keyword . '%')
                        ->orWhere('other3_name', 'LIKE', '%'.$keyword . '%');
            });    
        } 
        if($transfer_date != ''){
            $virusCountCheck->where('created_at','<=', $transfer_date);
        }

        if($from_date != '' || $to_date != ''){
            if($from_date != '' && $to_date != ''){
                $virusCountCheck->whereDate('report_date', '>=', $from_date)
                ->whereDate('report_date',   '<=', $to_date);
            }elseif($from_date == '' && $to_date != ''){
                $virusCountCheck->whereDate('report_date', '=', $to_date);
            }elseif($from_date != '' && $to_date == ''){
                $virusCountCheck->whereDate('report_date', '=', $from_date);
            }
        }
        $virusCount = $virusCountCheck->count();

        if($virusCount != 0){
            $counts['virus_test'] = $virusCount;
        }

        $formsCountCheck = CustomForms::where('cat_id',$cat_id)->where('signed_status',1)
                                    ->leftJoin('forms as for','custom_forms.form_id','=','for.id');
    
        if($keyword){
            $formsCountCheck->Where(function ($formsCountCheck) use ($keyword) {
                $formsCountCheck->orWhere('for.form_title', 'LIKE','%'. $keyword . '%')
                        ->orWhere('for.form_content', 'LIKE','%'. $keyword . '%');
            });    
        } 
        if($transfer_date != ''){
            $formsCountCheck->where('custom_forms.signed_date','<=', $transfer_date);
        }
        if($from_date != '' || $to_date != ''){
            if($from_date != '' && $to_date != ''){
                $formsCountCheck->whereDate('signed_date', '>=', $from_date)
                ->whereDate('signed_date',   '<=', $to_date);
            }elseif($from_date == '' && $to_date != ''){
                $formsCountCheck->whereDate('signed_date', '=', $to_date);
            }elseif($from_date != '' && $to_date == ''){
                $formsCountCheck->whereDate('signed_date', '=', $from_date);
            }
        }
        $formsCount = $formsCountCheck->count();

        if($formsCount != 0){
            $counts['forms'] = $formsCount;
        }
        return $counts;
    }

    public function getJournalCounts($cat_id, $transfer_date, $keyword = '', $from_date = '', $to_date = ''){
        $query = JournalDetails::select(DB::raw("COUNT(*) as count"),"journal_type")
                                ->where('status', 1);

        if($keyword){
            $query->Where(function ($query) use ($keyword) {
                $query->orWhere('remarks', 'LIKE','%'. $keyword . '%')
                        ->orWhere('heading', 'LIKE','%'. $keyword . '%');
            });    
        } 
        if($transfer_date != ''){
            $query->where('created_at','<=', $transfer_date);
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
        $result = $query->groupBy('journal_type')
            ->where('cat_id', $cat_id)->get()->pluck("count", "journal_type")->toArray();
            
        return $result;
    }

    public function getJournalData(Request $request)
    {
        $viewData = [];
        $cat_id = $request->cat_id;
        $transfer_date = $request->transfer_date;
        $type = $request->type;
        $keyword = $request->keyword;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $counts = $this->getJournalAllCounts($cat_id, $transfer_date, $keyword, $from_date, $to_date);
        switch($type) {
            case 'vital':
                $query = JournalMedicalHistories::select('*')
                                                ->where('cat_id',$cat_id);
                if($transfer_date != ''){
                    $query->where('created_at','<=', $transfer_date);
                }
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
                $viewData = view('admin.journal.medical_history',compact('data','cat_id','transfer_date'))->render();
                break;
            case 'dental':
                $title = 'Dental';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'med_history':
                    $title = 'Medical History';
                    $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                    $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'hospitalization':
                $title = 'Hospitalization';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'hotel':
                $title = 'Hotel';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'laboratory_test':
                $title = 'Laboratory Test';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'laser':
                $title = 'Laser';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'medicine':
                $title = 'Medicine';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'medical_treatment':
                $title = 'Medical Treatment';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'surgery':
                $title = 'Surgery';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'ultrasound':
                $title = 'Ultrasound';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date, $transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'virus_test':
                $title = 'Virus Test';
                $query = JournalVirusTests::select('*')
                                        ->where('cat_id',$cat_id);
                if($keyword){
                    $query->Where(function ($query) use ($keyword) {
                        $query->orWhere('other_name', 'LIKE','%'. $keyword . '%')
                                ->orWhere('other2_name', 'LIKE','%'. $keyword . '%')
                                ->orWhere('other3_name', 'LIKE', '%'.$keyword . '%');
                    });    
                } 
                if($transfer_date != ''){
                    $query->where('created_at','<=', $transfer_date);
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
                $viewData = view('admin.journal.virus_tests',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'xray':
                $title = 'X-ray';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date,$transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;

            case 'forms':
                $title = 'Forms';
                $data = $this->getFormDetails($type,$cat_id, $keyword,$from_date,$to_date,$transfer_date);
                $viewData = view('admin.journal.form_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;

            case 'prescriptions':
                $title = 'Prescriptions';
                $data = $this->getJournalDetails($type,$cat_id, $keyword,$from_date,$to_date,$transfer_date);
                $viewData = view('admin.journal.common_details',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            case 'transfer_history':
                $title = 'Transfer History';
                $data = CatCaretakers::select('care_from.name as care_from_name','care_to.name as care_to_name',DB::raw('DATE(cat_caretakers.updated_at) as transfer_date'),'cat_caretakers.transfer_status')
                                        ->leftJoin('caretakers as care_from','cat_caretakers.caretaker_id','=','care_from.id')
                                        ->leftJoin('caretakers as care_to','cat_caretakers.transfer_to_caretaker','=','care_to.id')
                                        ->where('cat_caretakers.cat_id',$cat_id)->orderBy('cat_caretakers.id','ASC')->get();
                $viewData = view('admin.journal.transfer_history',compact('data','cat_id','type','title','transfer_date'))->render();
                break;
            default:
                $viewData = [];
        }
 
        return json_encode(array('viewData' => $viewData, 'counts' => $counts));
    }

    public function deleteMedicalHistory(Request $request){
        $med_id = $request->med_id;
        $medical = JournalMedicalHistories::find($med_id);
        $mCat_id =  $medical->cat_id;
        $medical->delete();

        $count = JournalMedicalHistories::where('cat_id', $mCat_id)->count();
        return $count;
    }

    public function deleteVirusTest(Request $request){
        $vid = $request->vid;
        $virus = JournalVirusTests::find($vid);
        $vCat_id =  $virus->cat_id;
        $virus->delete();
        $count = JournalVirusTests::where('cat_id', $vCat_id)->count();
        return $count;
    }

    public function storeMedicalHistory(Request $request){
        JournalMedicalHistories::create([
            'cat_id' => $request->cat_id, 
            'weight' => $request->weight,  
            'temperature' => $request->temperature, 
            'blood_pressure' => $request->blood_pressure,  
            'report_date' => isset($request->report_date) ? $request->report_date : date('Y-m-d')
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
            'others' => $request->others,
            'other_name' => $request->text_other_name,
            'others_2' => $request->others2,
            'other2_name' => $request->text_other2_name,
            'others_3' => $request->others3,
            'other3_name' => $request->text_other3_name,
            'report_date' => isset($request->report_date) ? $request->report_date : date('Y-m-d')
        ]);
    }

    public function storeJournalDetails(Request $request){

        $journal = JournalDetails::create([
            'cat_id' => $request->cat_id, 
            'journal_type' => $request->type,  
            'heading' => $request->heading,
            'remarks'  => $request->remark_content, 
            'report_date'=> isset($request->report_date) ? $request->report_date : date('Y-m-d')
        ]);
        $journal_id = $journal->id;

        $imageData = [];
        if ($request->hasFile('files')) {
            $uploadedFile = $request->file('files');
            $i = 0;
            foreach($uploadedFile as $file){
                $filename =    strtolower(Str::random(2)).time().'.'. $file->getClientOriginalName();
                $name = Storage::disk('public')->putFileAs(
                    'journals/'.$request->type.'/'.$request->cat_id,
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

    public function getJournalDetails($type, $cat_id, $keyword,$from_date,$to_date, $transfer_date){
        $query = JournalDetails::select("*")
                ->where('status', 1)
                ->where('cat_id', $cat_id)
                ->where('journal_type', $type);
        if($keyword){
            $query->Where(function ($query) use ($keyword) {
                $query->orWhere('remarks', 'LIKE','%'. $keyword . '%')
                        ->orWhere('heading', 'LIKE','%'. $keyword . '%');
            });    
        } 
        if($transfer_date != ''){
            $query->where('created_at','<=', $transfer_date);
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

    public function getFormDetails($type, $cat_id, $keyword,$from_date,$to_date,$transfer_date){
        $query =  CustomForms::select('custom_forms.*','care.name as caretaker_name','cats.name as cat_name','for.form_title','for.form_content')
                            ->leftJoin('caretakers as care','custom_forms.caretaker_id','=','care.id')
                            ->leftJoin('cats','custom_forms.cat_id','=','cats.id')
                            ->leftJoin('forms as for','custom_forms.form_id','=','for.id')
                            ->where('custom_forms.cat_id',$cat_id)->where('custom_forms.signed_status',1);
        if($keyword){
            $query->Where(function ($query) use ($keyword) {
                $query->orWhere('for.form_title', 'LIKE','%'. $keyword . '%')
                        ->orWhere('for.form_content', 'LIKE','%'. $keyword . '%');
            });    
        } 
        if($transfer_date != ''){
            $query->where('custom_forms.signed_date','<=', $transfer_date);
        }
        if($from_date != '' || $to_date != ''){
            if($from_date != '' && $to_date != ''){
                $query->whereDate('signed_date', '>=', $from_date)
                ->whereDate('signed_date',   '<=', $to_date);
            }elseif($from_date == '' && $to_date != ''){
                $query->whereDate('signed_date', '=', $to_date);
            }elseif($from_date != '' && $to_date == ''){
                $query->whereDate('signed_date', '=', $from_date);
            }
        }
        $forms = $query->orderBy('id','desc')
                ->get();

        return $forms;
    }

    public function deleteJournalData(Request $request){
        $jid = $request->jid;
        $journal = JournalDetails::find($jid);
        $jType = $journal->journal_type;
        $jCat_id =  $journal->cat_id;
        $journalPdf = $journal->file_url;
        $journal->delete();
        $files = JournalFiles::select('image_url')->where('journal_id',$jid)->get()->toArray();

        if($journalPdf != null){
            if(File::exists(public_path($journalPdf))){
                unlink(public_path($journalPdf));
            }
        }
        if($files){
            foreach($files as $file){
                if(File::exists(public_path($file['image_url']))){
                    unlink(public_path($file['image_url']));
                }
            }
            JournalFiles::where('journal_id',$jid)->delete();
        }

        $count = JournalDetails::where('journal_type', $jType)->where('cat_id', $jCat_id)->count();
        return json_encode(array('count' => $count, 'type' => $jType));
    }

    public function checkCatIdAvailability(Request $request){
        
        $query = Cat::where('cat_id',$request->cat_id);
        
        if(isset($request->id)) {
            $query->where('id','!=',$request->id);
        }
        $result = $query->count();
        
        $check = ($result === 0) ?  'true' : 'false';
        echo $check;
    }
    public function viewJournalDetails(Request $request){
        $id = $request->id;
        $query = JournalDetails::select("*")
                                ->where('id', $id)
                                ->get();
        return $query;
    }

    public function viewJournalFormDetails(Request $request){
        $form  = CustomForms::select('custom_forms.*','care.name as caretaker_name','cats.name as cat_name','for.form_title','for.form_content')
                            ->leftJoin('caretakers as care','custom_forms.caretaker_id','=','care.id')
                            ->leftJoin('cats','custom_forms.cat_id','=','cats.id')
                            ->leftJoin('forms as for','custom_forms.form_id','=','for.id')
                            ->where('custom_forms.id',$request->id)
                            ->get()->toArray();

        $viewData = view('admin.journal.view_form', compact('form'))->render();

        return $viewData;
    }

    public function viewJournalPrescriptionDetails(Request $request){
        $id = $request->id;
        $journal = JournalDetails::select("journal_details.*","cats.name as cat_name","ct.name as caretaker_name","cats.id as cat_id","cats.cat_id as catId")
                                    ->leftJoin('cats','journal_details.cat_id','=','cats.id')
                                    ->leftJoin('cat_caretakers as cc','cc.cat_id', '=', 'cats.id')
                                    ->leftJoin('caretakers as ct','cc.caretaker_id','=','ct.id')
                                    ->where('cc.transfer_status', 0)
                                    ->where('journal_details.id', $id)
                                    ->get();
        $viewData = view('admin.journal.view_prescription', compact('journal'))->render();

        return $viewData;
    }

    public function generatePrescriptionPdf($id){
        $journal = JournalDetails::select("journal_details.*","cats.name as cat_name","ct.name as caretaker_name","cats.id as cat_id","cats.cat_id as catId")
                                    ->leftJoin('cats','journal_details.cat_id','=','cats.id')
                                    ->leftJoin('cat_caretakers as cc','cc.cat_id', '=', 'cats.id')
                                    ->leftJoin('caretakers as ct','cc.caretaker_id','=','ct.id')
                                    ->where('cc.transfer_status', 0)
                                    ->where('journal_details.id', $id)
                                    ->get()->toArray();
                                    
        $journal[0]['imagePath'] = public_path('assets/images/logo.png');
        
        $pdf = PDF::loadView('admin.journal.pdf_prescription', $journal[0]);
        $pdf->render();
        $output = $pdf->output();
        $filename = 'journals/prescriptions/'.$journal[0]['cat_id'] . '/'.strtolower(Str::random(2)).time().'.pdf';
        
        Storage::disk('public')->put($filename, $output); 
        return '/storage/'.$filename;
    }

    public function storeJournalPrescriptionDetails(Request $request){

        $journal = JournalDetails::create([
            'cat_id' => $request->cat_id, 
            'journal_type' => $request->type,  
            'heading' => $request->heading_pre,
            'remarks'  => $request->prescription_content, 
            'report_date'=> isset($request->pre_date) ? $request->pre_date : date('Y-m-d')
        ]);

        $filename = $this->generatePrescriptionPdf($journal->id);
        $journal->file_url = $filename;
        $journal->save();
    }

    public function journalSendMail(Request $request){

        $id = $request->jid;
        $journal = JournalDetails::select("journal_details.*","cats.name as cat_name","ct.name as caretaker_name","cats.id as cat_id","ct.email as caretaker_email","cats.cat_id as catId")
                                    ->leftJoin('cats','journal_details.cat_id','=','cats.id')
                                    ->leftJoin('cat_caretakers as cc','cc.cat_id', '=', 'cats.id')
                                    ->leftJoin('caretakers as ct','cc.caretaker_id','=','ct.id')
                                    ->where('cc.transfer_status',0)
                                    ->where('journal_details.id', $id)
                                    ->get()->toArray();
        if(isset($journal[0]) && $journal[0]['file_url'] != NULL){
            $caretaker_email = $journal[0]['caretaker_email'];
            if(File::exists(public_path($journal[0]['file_url']))){
                $data['email'] = $caretaker_email;            // $caretaker_email;
                $data['title'] = 'Prescription';
                $data['body'] = "Hi ".$journal[0]['caretaker_name'].",<br> Please find the prescription attached below.";
                $file = public_path($journal[0]['file_url']);
                
                Mail::send('admin.prescription_mail', $data, function($message)use($data, $file) {
                    $message->to($data["email"])
                            ->subject($data["title"]);
                    $message->attach($file);
                            
                });
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }
}