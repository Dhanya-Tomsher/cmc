<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use App\Models\Invoices; 
use App\Models\PricelistCategories;
use App\Models\DynamicInvoices; 
use App\Models\DynamicInvoiceDetails; 
use App\Models\Services; 
use App\Models\Vet; 
use PDF;

class DynamicInvoiceController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('last_url', url()->full());

        $search     = $request->has('name') ? $request->name : '';
        $from_date  = $request->has('from_date') ? $request->from_date : '';
        $to_date    = $request->has('to_date') ? $request->to_date : '';
        
        $query      = DynamicInvoices::with(['vet'])->orderBy('id','DESC');
           
        if($search){  
            $query->Where(function ($query) use ($search) {
                $query->orWhere('cat_name', 'LIKE', '%'.$search . '%')
                    ->orWhere('invoice_note', 'LIKE', '%'.$search . '%')
                    ->orWhereHas('vet', function ($query) use($search) {
                        $query->where('name', 'like', '%'.$search . '%');
                    });
            });                    
        }

        if($from_date != '' || $to_date != ''){
            if($from_date != '' && $to_date != ''){
                $query->whereDate('invoice_date', '>=', $from_date)
                ->whereDate('invoice_date',   '<=', $to_date);
            }elseif($from_date == '' && $to_date != ''){
                $query->whereDate('invoice_date', '=', $to_date);
            }elseif($from_date != '' && $to_date == ''){
                $query->whereDate('invoice_date', '=', $from_date);
            }
        }

        $invoice  = $query->paginate(10);
        return view('admin.dynamic_invoices.index')->with([
            'invoice' => $invoice,'search'=>$search, 'to_date' => $to_date, 'from_date' => $from_date
        ]);
    }
   
    public function create(Request $request, $cat_name = NULL)
    {
       
        $invoice = json_encode(array());
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->where('is_deleted',0)
                    ->orderBy('name','ASC')
                    ->get();
        $categories = PricelistCategories::where('is_active',1)->orderBy('name', 'ASC')->get();
       
        return view('admin.dynamic_invoices.create')->with([
            'invoice' => $invoice,
            'vets' => $vets,
            'cat_name' => $cat_name,
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
        if($request->invoice_id){
            $invoice = DynamicInvoices::find($request->invoice_id);
        }else{
            $invoice = new DynamicInvoices;
        }

        $invoice->vet_id = $request->vet_name;
        $invoice->cat_name = $request->cat_name;
        $invoice->net = $request->total_net;
        $invoice->vat = $request->total_vat;
        $invoice->total = $request->grand_total;
        $invoice->invoice_date = date('Y-m-d');
        $invoice->invoice_note = $request->invoice_note;
        $invoice->save();

        $service = $request->service;
        $category = $request->category;
        $quantity = $request->quantity;
        $price = $request->price;
        $total = $request->total;
        
        $insert_data = [];
        $count = count($service);
        for($i = 0; $i < $count; $i++)
        {
            if($service[$i] != ''){
                $dataHis = array(
                    'dynamic_invoice_id' => $invoice->id,
                    'category_id' => $category[$i],
                    'service_id' => $service[$i],
                    'quantity'  => $quantity[$i],
                    'unit_price' => $price[$i],
                    'total' => $total[$i],
                    'created_at' => now()
                );
                $insert_data[] = $dataHis; 
            }
        }
        if($insert_data){
            if($request->invoice_id){
                DynamicInvoiceDetails::where('dynamic_invoice_id',$request->invoice_id )->delete();
                DynamicInvoiceDetails::insert($insert_data);
                return back()->with('status', 'Invoice Updated!');
            }else{
                DynamicInvoiceDetails::insert($insert_data);
            } 
        }
        return back()->with('status', 'Invoice Created!');
    }
  
    public function view(Request $request)
    {
        $invoice  = DynamicInvoices::with(['dynamic_invoice_details'])->where('id',$request->id)->first();
        return view('admin.dynamic_invoices.show')->with([
            'invoice' => $invoice,
        ]);
    } 

    public function delete(Request $request)
    {
        DynamicInvoices::where('id',$request->id)->delete();
        DynamicInvoiceDetails::where('dynamic_invoice_id',$request->id)->delete();
       
    } 
    public function edit(Request $request)
    {
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->where('is_deleted',0)
                    ->orderBy('name','ASC')
                    ->get();

        $invoice = DynamicInvoices::with(['dynamic_invoice_details'])->where('id',$request->id)->first();
       
        $services = Services::where('status',1)->orderBy('name','ASC')->get()->toArray();
        $categories = PricelistCategories::where('is_active',1)->orderBy('name', 'ASC')->get();
      
        return view('admin.dynamic_invoices.edit')->with([
            'invoice' => $invoice,
            'vets' => $vets,
            'detailsCount' => count($invoice->dynamic_invoice_details),
            'services' => $services,
            'categories' => $categories
        ]);
    }
  
    public function generateDynamicInvoicePDF(Request $request) 
    {
        $invoice = DynamicInvoices::with(['dynamic_invoice_details'])->where('id',$request->id)->first();
      
        if(!empty($invoice)){
            $invoice = $invoice->toArray();
            $invoice['imagePath'] = public_path('assets/images/logo.png');
            $invoice['backlogo'] = public_path('assets/images/backlogo.png');
        }
        
        $file_name = date('d-m-Y').'_'.rand(1,10).'_Invoice.pdf';
        $pdf = PDF::loadView('admin.dynamic_invoices.invoice_pdf', $invoice);
        return $pdf->stream($file_name,array('Attachment'=>0));
    }

    public function getServiceList(Request $request)
    {
        $html = '<option value="" data-price="0"> Select Service </option>';
            
        $categ_id = $request->categ_id;
        $services = Services::select("id","name","category_id","price")
                        ->where('status', 1)
                        ->where('category_id', $categ_id)->orderBy('name','ASC')
                        ->get();
        foreach($services as $serv){
            $html .= '<option value="'.$serv['id'] .'" data-price="'.$serv['price'].'">'.$serv['name'].'</option>';
        }
        return $html;
    }
}
