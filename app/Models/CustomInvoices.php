<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomInvoices extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'vet_id', 
        'vet_name', 
        'cat_name', 
        'invoice_note', 
        'net', 
        'vat', 
        'net_vat', 
        'service_charge', 
        'total', 
        'invoice_date'
    ];

    public function custom_invoice_details()
    {
        return $this->hasMany(CustomInvoiceDetails::class,'custom_invoice_id');
    }
    
    public function vet()
    {
        return $this->belongsTo(Vet::class, 'vet_id','id');
    }
}
