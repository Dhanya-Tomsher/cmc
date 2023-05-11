<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use App\Models\Invoices; 
use PDF;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoice  = Invoices::all();
        return view('admin.invoice.index')->with([
            'invoice' => $invoice,
        ]);
    }
   
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());
        return back()->with('status', 'Invoice Upated!');
    }
    public function view(Invoice $invoice)
    {
        return view('admin.invoice.show')->with([
            'invoice' => $invoice,
        ]);
    } 
    public function edit(Invoice $invoice)
    {
        return view('admin.invoice.edit')->with([
            'invoice' => $invoice
        ]);
    }
  
    public function getHospitalInvoiceDetails(Request $request){
       
        $query = Invoices::leftJoin('hospital_appointments as ha','invoices.booking_id','=','ha.id')
                        ->leftJoin('caretakers as ct','ha.caretaker_id','=','ct.id')
                        ->leftJoin('cats as c','ha.cat_id','=','c.id')
                        ->leftJoin('procedures as pro','ha.procedure_id','=','pro.id')
                        ->where('invoices.booking_id',$request->invoice)
                        ->where('invoices.booking_type','hospital_appointment')
                        ->get(['ha.payment_confirmation','pro.name as service','c.cat_id','ct.customer_id','ct.name as caretaker_name','ct.address','ct.email','ct.phone_number','invoices.*']);
     
        return view('admin.invoice')->with([
            'invoice' => $query
        ]);
    }

    public function getHotelInvoiceDetails(Request $request){
       
        $query = Invoices::leftJoin('hotel_appointments as ha','invoices.booking_id','=','ha.id')
                        ->leftJoin('caretakers as ct','ha.caretaker_id','=','ct.id')
                        ->leftJoin('cats as c','ha.cat_id','=','c.id')
                        ->leftJoin('hotelrooms as room','ha.room_number','=','room.id')
                        ->where('invoices.booking_id',$request->invoice)
                        ->where('invoices.booking_type','hotel_booking')
                        ->get(['ha.payment_confirmation','room.room_number as service','c.cat_id','ct.customer_id','ct.name as caretaker_name','ct.address','ct.email','ct.phone_number','invoices.*']);
     
        return view('admin.invoice')->with([
            'invoice' => $query
        ]);
    }

    public function updateInvoice(Request $request){
        Invoices::find($request->invoice_id)->update([
            'price' => $request->price, 
            'net' => $request->net, 
            'vat' => $request->vat, 
            'net_vat' => $request->net_vat, 
            'service_charge' => $request->service_charge, 
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
                            ->get(['ha.payment_confirmation','pro.name as service','c.cat_id','ct.customer_id','ct.name as caretaker_name','ct.address','ct.email','ct.phone_number','invoices.*'])->toArray();
        }else{
            $invoice = Invoices::leftJoin('hotel_appointments as ha','invoices.booking_id','=','ha.id')
                        ->leftJoin('caretakers as ct','ha.caretaker_id','=','ct.id')
                        ->leftJoin('cats as c','ha.cat_id','=','c.id')
                        ->leftJoin('hotelrooms as room','ha.room_number','=','room.id')
                        ->where('invoices.id',$request->id)
                        ->where('invoices.booking_type','hotel_booking')
                        ->get(['ha.payment_confirmation','room.room_number as service','c.cat_id','ct.customer_id','ct.name as caretaker_name','ct.address','ct.email','ct.phone_number','invoices.*'])->toArray(); 
        }
      
       
        $pdf = PDF::loadView('admin.invoice_pdf', $invoice[0]);
        return $pdf->stream('invoice.pdf');
    }
}
