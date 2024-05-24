<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicInvoices extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'vet_id', 'cat_name', 'invoice_note', 'net', 'vat', 'total', 'invoice_date'
    ];

    public function dynamic_invoice_details()
    {
        return $this->hasMany(DynamicInvoiceDetails::class,'dynamic_invoice_id')->with(['service']);
    }

    public function vet()
    {
        return $this->belongsTo(Vet::class, 'vet_id','id');
    }
    
}
