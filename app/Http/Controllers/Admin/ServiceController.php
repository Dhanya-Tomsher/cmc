<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services; 
use App\Models\HospitalAppointments; 
use DB;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('last_url', url()->full());

        $search = $request->has('name') ? $request->name : '';

        $query  = Services::select('id', 'name', 'price', 'status');
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%')
                        ->orWhere('price', 'LIKE', '%'.$search . '%');
            });                    
        }
        $service = $query->orderBy('id','DESC')->paginate(10);

        return view('admin.service.index')->with([
            'service' => $service,'search'=>$search
        ]);
    }
    public function create()
    {
        return view('admin.service.create');
    }
    public function search()
    {
        return view('admin.service.create');
    }
    public function delete(Request $request)
    {
        $checkBooking = HospitalAppointments::where('service_id',$request->service)->count();
        if($checkBooking == 0){
            Services::where('id',$request->service)->delete();
            $result = array('status'=>1,'msg'=>'Deleted successfully.');
        }else{
            $result = array('status'=>0,'msg'=>'Deletion is not possible. There are hospital appointments for this service.');
        }
        return json_encode($result);
    }
 
    public function store(Request $request)
    {
        if($request->pro_id != ''){
            $service = Services::find($request->pro_id);
            $service->name = $request->service;
            $service->price = $request->price ? $request->price : 0;
            $service->status = $request->pstatus;
            $service->save();

            $msg = "Service details updated successfully.";
        }else{
            $service = Services::create([
                'name' => $request->service,
                'price' => $request->price ? $request->price : 0,
                'status' => $request->pstatus
            ]);
            $msg = "Service added successfully.";
        }
        return $msg;
    }

    public function getServiceList(Request $request){
        $search = $request->search;
        $query  = Services::select('id', 'name', 'price', 'status');
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%')
                        ->orWhere('price', 'LIKE', '%'.$search . '%');
            });                    
        }
        $service = $query->orderBy('id','DESC')->get();
        $viewData = view('admin.service.ajax_list', compact('service'))->render();

        return $viewData;
    }
}
