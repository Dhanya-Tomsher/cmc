<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalVirusTests extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'cat_id', 
        'calicivirus', 
        'coronavirus', 
        'herpesvirus', 
        'felv', 
        'fiv', 
        'panleukopenia', 
        'report_date',
        'others',
        'other_name', 
        'others_2', 
        'other2_name', 
        'others_3', 
        'other3_name'
    ];
}


