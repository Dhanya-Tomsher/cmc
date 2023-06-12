<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomInvoiceDetails extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'custom_invoice_id', 
        'procedure', 
        'quantity', 
        'unit_price', 
        'net', 
        'vat', 
        'net_vat', 
        'service_charge', 
        'total'
    ];

    public function custom_invoice()
    {
        return $this->belongsTo(CustomInvoices::class, 'custom_invoice_id','id');
    }
    
}
