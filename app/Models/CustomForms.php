<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomForms extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'caretaker_id', 
        'cat_id', 
        'form_id', 
        'signature_url', 
        'signed_date', 
        'signed_status', 
        'status'
    ];
}


