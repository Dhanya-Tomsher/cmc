<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalMedicalHistories extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'cat_id', 
        'weight', 
        'temperature', 
        'blood_pressure', 
        'report_date'
    ];
}
