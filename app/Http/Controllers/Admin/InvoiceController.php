<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use App\Models\Invoices; 
use App\Models\CustomInvoices; 
use App\Models\CustomInvoiceDetails; 
use App\Models\Vet; 
use PDF;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoice  = CustomInvoices::orderBy('id','DESC')->get();
        return view('admin.invoice.index')->with([
            'invoice' => $invoice,
        ]);
    }
   
    public function create()
    {
        $invoice = json_encode(array());
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->where('is_deleted',0)
                    ->orderBy('name','ASC')
                    ->get();
        return view('admin.invoice.create')->with([
            'invoice' => $invoice,
            'vets' => $vets
        ]);
    }

    public function store(Request $request){
        $vetName =  Vet::getVetName($request->vet_name);

        if($request->invoice_id){
            $invoice = CustomInvoices::find($request->invoice_id);
        }else{
            $invoice = new CustomInvoices;
        }

        $invoice->vet_id = $request->vet_name;
        $invoice->vet_name = (isset($vetName[0])) ? $vetName[0]->name : 'vet';

        $invoice->cat_name = $request->cat_name;
        $invoice->net = $request->total_net;
        $invoice->vat = $request->total_vat;
        $invoice->service_charge = $request->total_service;
        $invoice->net_vat = (float)$request->total_net + (float)$request->total_vat;
        $invoice->total = $request->grand_total;
        $invoice->invoice_date = date('Y-m-d');
        $invoice->invoice_note = $request->invoice_note;
        $invoice->save();

        $procedure = $request->procedure;
        $quantity = $request->quantity;
        $price = $request->price;
        $net = $request->net;
        $service_charge = $request->service_charge;
        $vat = $request->vat;
        $total = $request->total;
        
        $insert_data = [];
        $count = count($procedure);
        for($i = 0; $i < $count; $i++)
        {
            if($procedure[$i] != ''){
                $dataHis = array(
                    'custom_invoice_id' => $invoice->id,
                    'procedure' => $procedure[$i],
                    'quantity'  => $quantity[$i],
                    'unit_price' => $price[$i],
                    'net' => $net[$i],
                    'service_charge' => $service_charge[$i],
                    'vat' => $vat[$i],
                    'total' => $total[$i],
                    'net_vat' => (float)$net[$i] + (float)$vat[$i],
                    'created_at' => now()
                );
                $insert_data[] = $dataHis; 
            }
        }
        if($insert_data){
            if($request->invoice_id){
                CustomInvoiceDetails::where('custom_invoice_id',$request->invoice_id )->delete();
                CustomInvoiceDetails::insert($insert_data);
                return back()->with('status', 'Invoice Updated!');
            }else{
                CustomInvoiceDetails::insert($insert_data);
            } 
        }
        return back()->with('status', 'Invoice Created!');
    }
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());
        return back()->with('status', 'Invoice Upated!');
    }
    public function view(Request $request)
    {
        $invoice  = CustomInvoices::where('id',$request->id)->get();
        return view('admin.invoice.show')->with([
            'invoice' => $invoice,
        ]);
    } 

    public function delete(Request $request)
    {
        CustomInvoices::where('id',$request->id)->delete();
        CustomInvoiceDetails::where('custom_invoice_id',$request->id)->delete();
       
    } 
    public function edit(Request $request)
    {
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->where('is_deleted',0)
                    ->orderBy('name','ASC')
                    ->get();

        $invoice = CustomInvoices::where('id',$request->id)->get()->toArray();
        $invoice[0]['details'] = CustomInvoiceDetails::where('custom_invoice_id',$request->id)->get()->toArray();

        return view('admin.invoice.edit')->with([
            'invoice' => $invoice,
            'vets' => $vets,
            'detailsCount' => count($invoice[0]['details'])
        ]);
    }
  
    public function getHospitalInvoiceDetails(Request $request){
       
        $query = Invoices::leftJoin('hospital_appointments as ha','invoices.booking_id','=','ha.id')
                        ->leftJoin('caretakers as ct','ha.caretaker_id','=','ct.id')
                        ->leftJoin('cats as c','ha.cat_id','=','c.id')
                        ->leftJoin('procedures as pro','ha.procedure_id','=','pro.id')
                        ->where('invoices.booking_id',$request->invoice)
                        ->where('invoices.booking_type','hospital_appointment')
                        ->get(['ha.payment_confirmation','pro.name as service','c.cat_id','c.cat_id as cat_ids','ct.customer_id','ct.name as caretaker_name','ct.address','ct.email','ct.phone_number','invoices.*']);
     
        return view('admin.invoice')->with([
            'invoice' => $query,
            'type' => 'hospital'
        ]);
    }

    public function getHotelInvoiceDetails(Request $request){
       
        $query = Invoices::leftJoin('hotel_appointments as ha','invoices.booking_id','=','ha.id')
                        ->leftJoin('hotel_booking_cats as hbc','hbc.booking_id','=','ha.id')
                        ->leftJoin('caretakers as ct','ha.caretaker_id','=','ct.id')
                        ->leftJoin('cats as c','hbc.cat_id','=','c.id')
                        ->leftJoin('hotelrooms as room','ha.room_number','=','room.id')
                        ->where('invoices.booking_id',$request->invoice)
                        ->where('invoices.booking_type','hotel_booking')
                        ->select('ha.payment_confirmation','room.room_number as service','c.cat_id','ct.customer_id','ct.name as caretaker_name','ct.address','ct.email','ct.phone_number','invoices.*')
                        ->selectRaw("GROUP_CONCAT(`c`.`id` SEPARATOR ', ')  as cat_ids")
                        ->get();
     
        return view('admin.invoice')->with([
            'invoice' => $query,
            'type' => 'hotel'
        ]);
    }

    public function updateInvoice(Request $request){
        Invoices::find($request->invoice_id)->update([
            'price' => $request->price, 
            'net' => $request->net, 
            'vat' => $request->vat, 
            'net_vat' => $request->net_vat, 
            'service_charge' => ($request->service_charge) ? $request->service_charge : 0, 
            'total' => $request->total, 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function generateInvoicePDF(Request $request) 
    {
        if($request->type == 'hospital_appointment'){
            $invoice = Invoices::leftJoin('hospital_appointments as ha','invoices.booking_id','=','ha.id')
                            ->leftJoin('caretakers as ct','ha.caretaker_id','=','ct.id')
                            ->leftJoin('cats as c','ha.cat_id','=','c.id')
                            ->leftJoin('procedures as pro','ha.procedure_id','=','pro.id')
                            ->where('invoices.id',$request->id)
                            ->where('invoices.booking_type','hospital_appointment')
                            ->get(['ha.payment_confirmation','pro.name as service','c.cat_id','c.cat_id as cat_ids','ct.customer_id','ct.name as caretaker_name','ct.address','ct.email','ct.phone_number','invoices.*'])->toArray();
        $invoice[0]['type'] = 'hospital';
        }else{
            $invoice = Invoices::leftJoin('hotel_appointments as ha','invoices.booking_id','=','ha.id')
                        ->leftJoin('hotel_booking_cats as hbc','hbc.booking_id','=','ha.id')
                        ->leftJoin('caretakers as ct','ha.caretaker_id','=','ct.id')
                        ->leftJoin('cats as c','hbc.cat_id','=','c.id')
                        ->leftJoin('hotelrooms as room','ha.room_number','=','room.id')
                        ->where('invoices.id',$request->id)
                        ->where('invoices.booking_type','hotel_booking')
                        ->select('ha.payment_confirmation','room.room_number as service','c.cat_id','ct.customer_id','ct.name as caretaker_name','ct.address','ct.email','ct.phone_number','invoices.*')
                        ->selectRaw("GROUP_CONCAT(`c`.`id` SEPARATOR ', ')  as cat_ids")
                        ->get()->toArray();
            $invoice[0]['type'] = 'hotel'; 
        }
      
        $invoice[0]['imagePath'] = public_path('assets/images/logo.png');
        $invoice[0]['backlogo'] = public_path('assets/images/backlogo.png');
        $pdf = PDF::loadView('admin.invoice_pdf', $invoice[0]);
        return $pdf->stream('invoice.pdf',array('Attachment'=>0));
    }

    public function generateCustomInvoicePDF(Request $request) 
    {
        $invoice = CustomInvoices::where('id',$request->id)->get()->toArray();
        $invoice[0]['details'] = CustomInvoiceDetails::where('custom_invoice_id',$request->id)->get()->toArray();
      
        $invoice[0]['imagePath'] = public_path('assets/images/logo.png');
        $invoice[0]['backlogo'] = public_path('assets/images/backlogo.png');

        $pdf = PDF::loadView('admin.invoice.invoice_pdf', $invoice[0]);
        return $pdf->stream('invoice.pdf',array('Attachment'=>0));
    }
}
