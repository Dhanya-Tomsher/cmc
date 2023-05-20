<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalDetails extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'cat_id', 
        'journal_type',
        'heading', 
        'remarks', 
        'report_date', 
        'status'
    ];

}
