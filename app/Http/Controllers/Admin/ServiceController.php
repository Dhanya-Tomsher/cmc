<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\PricelistCategories; 
use App\Models\HospitalAppointments; 
use DB;

class ServiceController extends Controller
{

    public function categoryServices(Request $request, $id){
        $request->session()->put('slast_url', url()->full());

        $search     = $request->has('name') ? $request->name : '';
        $status     = $request->has('status_filter') ? $request->status_filter : '';

        $query      = Services::with(['category'])->where('category_id', $id)->select('id', 'category_id','name', 'price', 'status');

        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%')
                        ->orWhere('price', 'LIKE', '%'.$search . '%');
            });                    
        }
        if($status){
            $query->where('status', ($status == 2) ? 0 : 1);
        }

        $service = $query->orderBy('id','DESC')->paginate(15);
    
        $categories = PricelistCategories::find($id);

        return view('admin.service.category_index')->with([
            'service' => $service,'search'=>$search, 'category' => $categories?->name, 'category_id' => $id, 'status' => $status
        ]);
    }
    public function index(Request $request)
    {
        $request->session()->put('last_url', url()->full());

        $search     = $request->has('name') ? $request->name : '';
        $category   = $request->has('category_filter') ? $request->category_filter : '';
        $status     = $request->has('status_filter') ? $request->status_filter : '';

        $query      = Services::with(['category'])->select('id', 'category_id','name', 'price', 'status');

        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%')
                        ->orWhere('price', 'LIKE', '%'.$search . '%');
            });                    
        }

        if($category){
            $query->where('category_id', $category);
        }

        if($status){
            $query->where('status', ($status == 2) ? 0 : 1);
        }

        $service = $query->orderBy('id','DESC')->paginate(15);
    
        $categories = PricelistCategories::where('is_active',1)->orderBy('name', 'ASC')->get();
        return view('admin.service.index')->with([
            'service' => $service,'search'=>$search, 'categories' => $categories, 'category' => $category, 'status' => $status
        ]);
    }
    public function create()
    {
        $categories = PricelistCategories::where('is_active',1)->orderBy('name', 'ASC')->get();
        return view('admin.service.create',compact('categories'));
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
            $service                = Services::find($request->pro_id);
            $service->name          = $request->service;
            $service->category_id   = $request->category;
            $service->price         = $request->price ? $request->price : 0;
            $service->status        = $request->pstatus;
            $service->save();

            $msg = "Service/Product details updated successfully.";
        }else{
            $service = Services::create([
                'name' => $request->service,
                'category_id' => $request->category,
                'price' => $request->price ? $request->price : 0,
                'status' => $request->pstatus
            ]);
            $msg = "Service/Product added successfully.";
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

    public function categoryList(Request $request){
        $request->session()->put('price_cat_last_url', url()->full());

        $search = $request->has('name') ? $request->name : '';
        $status     = $request->has('status_filter') ? $request->status_filter : '';

        $query  = PricelistCategories::select('id', 'name', 'is_active');

        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%'.$search . '%');
            });                    
        }

        if($status){
            $query->where('is_active', ($status == 2) ? 0 : 1);
        }

        $category = $query->orderBy('name','ASC')->paginate(15);

        return view('admin.pricelist_categories.index')->with([
            'category' => $category,'search'=>$search, 'status' => $status
        ]);
    }

    public function categoryStore(Request $request){
        if($request->cat_id != ''){
            $category               = PricelistCategories::find($request->cat_id);
            $category->name         = $request->category;
            $category->is_active    = $request->pstatus;
            $category->save();

            $msg = "Category details updated successfully.";
        }else{
            $category = PricelistCategories::create([
                'name' => $request->category,
                'is_active' => $request->pstatus
            ]);
            $msg = "Category added successfully.";
        }
        return $msg;
    }
}



