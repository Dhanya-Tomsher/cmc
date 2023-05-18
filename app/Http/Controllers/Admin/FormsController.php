<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forms;
use App\Models\CustomForms;  
use App\Models\Caretaker;  
use App\Models\HospitalAppointments; 
use DB;
use Validator;
use File;

class FormsController extends Controller
{
    public function index(Request $request)
    {
        $forms = Forms::orderBy('id', 'DESC')->get();
        return view('admin.forms.index')->with(['forms' => $forms]);
    }
    public function create()
    {
        return view('admin.forms.create');
    }
   
    public function delete(Request $request)
    {
        Forms::where('id',$request->id)->delete();
    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if($request->form_id != ''){
            $form = Forms::find($request->form_id);
            $form->form_title = $request->title;
            $form->form_content = $request->content;
            $form->status = $request->status;
            $form->save();

            $msg = "Form details updated successfully.";
        }else{
            $procedure = Forms::create([
                'form_title' => $request->title,
                'form_content' => $request->content,
            ]);
            $msg = "Form added successfully.";
        }
        return back()->with('status', $msg);
    }

    public function edit(Forms $form)
    {
        return view('admin.forms.edit', compact('form'));
    }

    public function view(Forms $form)
    {
        return view('admin.forms.view', compact('form'));
    }

    public function customFormsList(Request $request)
    {
        $caretakers = Caretaker::where('status','published')->where('is_blacklist',0)->orderBy('name','ASC')->get();
        $forms = Forms::where('status',1)->orderBy('form_title', 'ASC')->get();

        return view('admin.forms.custom_index')->with(['caretakers' => $caretakers, 'forms' => $forms]);
    }

    public function generateCustomForm(Request $request)
    {
        $form = CustomForms::create([
            'caretaker_id' => $request->caretaker_id,
            'cat_id' => $request->cat_id,
            'form_id' => $request->form_id,
        ]);
    }

    public function customFormsListing(Request $request){
        $search = $request->search;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query  = CustomForms::select('custom_forms.*','care.name as caretaker_name','cats.name as cat_name','for.form_title')
                            ->leftJoin('caretakers as care','custom_forms.caretaker_id','=','care.id')
                            ->leftJoin('cats','custom_forms.cat_id','=','cats.id')
                            ->leftJoin('forms as for','custom_forms.form_id','=','for.id');
        if($search){  
            $query->where(function ($query) use ($search) {
                $query->orWhere('for.form_title', 'LIKE','%' . $search . '%')
                        ->orWhere('cats.cat_id', 'LIKE', '%' .$search . '%')
                        ->orWhere('care.customer_id', 'LIKE', '%' .$search . '%')
                        ->orWhere('care.name', 'LIKE', '%' .$search . '%')
                        ->orWhere('cats.name', 'LIKE', '%' .$search . '%');
            });                    
        }
        if($from_date != '' || $to_date != ''){
            if($from_date != '' && $to_date != ''){
                $query->whereDate('for.created_at', '>=', $from_date)
                ->whereDate('for.created_at',   '<=', $to_date);
            }elseif($from_date == '' && $to_date != ''){
                $query->whereDate('for.created_at', '=', $to_date);
            }elseif($from_date != '' && $to_date == ''){
                $query->whereDate('for.created_at', '=', $from_date);
            }
        }
        $custom_forms = $query->orderBy('custom_forms.id','DESC')->get();
        $viewData = view('admin.forms.ajax_custom_forms', compact('custom_forms'))->render();

        return $viewData;
    }
    public function customFormDelete(Request $request)
    {
        CustomForms::where('id',$request->id)->delete();
    }

    public function viewCustom(Request $request)
    {
        $form  = CustomForms::select('custom_forms.*','care.name as caretaker_name','cats.name as cat_name','for.form_title','for.form_content')
                            ->leftJoin('caretakers as care','custom_forms.caretaker_id','=','care.id')
                            ->leftJoin('cats','custom_forms.cat_id','=','cats.id')
                            ->leftJoin('forms as for','custom_forms.form_id','=','for.id')
                            ->where('custom_forms.id',$request->cid)
                            ->get()->toArray();
        return view('admin.forms.custom_form_view', compact('form'));
    }

    public function signatureUpload(Request $request)
    {
	    $folderPath = public_path('storage/signatures/');
        if(!File::isDirectory($folderPath)){
            File::makeDirectory($folderPath, 0777, true, true);
        }  
	  
	    $image_parts = explode(";base64,", $request->signature);
	        
	    $image_type_aux = explode("image/", $image_parts[0]);
	      
	    $image_type = $image_type_aux[1];
	      
	    $image_base64 = base64_decode($image_parts[1]);
	      
	     
        $filename = uniqid() . '.'.$image_type;
        $file = $folderPath . $filename;
	    file_put_contents($file, $image_base64);

        $form = CustomForms::find($request->cid);
        $form->signature_url = 'storage/signatures/'.$filename;
        $form->signed_date = date('Y-m-d');
        $form->signed_status = 1;
        $form->save();

	    return back()->with('success', 'Signature updated successfully');
    }
    public function customSignature(Request $request)
    {
        $form  = CustomForms::select('custom_forms.*','care.name as caretaker_name','cats.name as cat_name','for.form_title','for.form_content')
                            ->leftJoin('caretakers as care','custom_forms.caretaker_id','=','care.id')
                            ->leftJoin('cats','custom_forms.cat_id','=','cats.id')
                            ->leftJoin('forms as for','custom_forms.form_id','=','for.id')
                            ->where('custom_forms.id',$request->cid)
                            ->where('custom_forms.status', 1)
                            ->get()->toArray();
        return view('admin.forms.customer_signature', compact('form'));
    }
    
}


