<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatCaretakers extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'cat_id', 
        'caretaker_id', 
        'transfer_status', 
    ];

    
}
