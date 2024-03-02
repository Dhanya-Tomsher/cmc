<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicInvoiceDetails extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'dynamic_invoice_id', 'service_id', 'quantity', 'unit_price', 'total'
    ];

    public function dynamic_invoice()
    {
        return $this->belongsTo(DynamicInvoices::class, 'dynamic_invoice_id','id');
    }
    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id','id');
    }
}
