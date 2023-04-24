<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use App\Models\Invoice; 

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoice  = Invoice::all();
        return view('admin.invoice.index')->with([
            'invoice' => $invoice,
        ]);
    }
    public function create()
    {
        return view('admin.invoice.create');
    }
    public function search()
    {
        return view('admin.invoice.create');
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
    public function store(StoreInvoiceRequest $request)
    {
        
        $invoice = Invoice::create([
            'cat_id' => $request->cat_id,
            'caretaker_id' => $request->caretaker_id,
            'appointment_type' => $request->appointment_type,
            'appointment_id'=>$request->appointment_id,
            'invoice_date' => $request->invoice_date,
            'amount' => $request->amount,
            'vat' => $request->vat,
            'total_amount'=>$request->total_amount,
            'paid' => $request->paid,
            'balance' => $request->balance,
            'status' => $request->status,
        ]);
        return redirect()->route('invoice.index')->with('status', 'Invoice created!');
    }
}
