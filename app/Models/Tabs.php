<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabs extends Model
{
    use HasFactory;

    protected $fillable = [
        'tab_type',
        'customer_form_id'
    ];
}
