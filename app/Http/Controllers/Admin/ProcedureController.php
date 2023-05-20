<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedures; 
use App\Models\HospitalAppointments; 
use DB;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.procedure.index');
    }
    public function create()
    {
        return view('admin.procedure.create');
    }
    public function search()
    {
        return view('admin.procedure.create');
    }
    public function delete(Request $request)
    {
        $checkBooking = HospitalAppointments::where('procedure_id',$request->procedure)->count();
        if($checkBooking == 0){
            Procedures::where('id',$request->procedure)->delete();
            $result = array('status'=>1,'msg'=>'Deleted successfully.');
        }else{
            $result = array('status'=>0,'msg'=>'Deletion is not possible. There are hospital appointments for this procedure.');
        }
        return json_encode($result);
    }
 
    public function store(Request $request)
    {
        if($request->pro_id != ''){
            $procedure = Procedures::find($request->pro_id);
            $procedure->name = $request->procedure;
            $procedure->price = $request->price ? $request->price : 0;
            $procedure->status = $request->pstatus;
            $procedure->save();

            $msg = "Procedure details updated successfully.";
        }else{
            $procedure = Procedures::create([
                'name' => $request->procedure,
                'price' => $request->price ? $request->price : 0,
                'status' => $request->pstatus
            ]);
            $msg = "Procedure added successfully.";
        }
        return $msg;
    }

    public function getProcedureList(Request $request){
        $search = $request->search;
        $query  = Procedures::select('id', 'name', 'price', 'status');
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%')
                        ->orWhere('price', 'LIKE', '%'.$search . '%');
            });                    
        }
        $procedure = $query->orderBy('id','DESC')->get();
        $viewData = view('admin.procedure.ajax_list', compact('procedure'))->render();

        return $viewData;
    }
}
