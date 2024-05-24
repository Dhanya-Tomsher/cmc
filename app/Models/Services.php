<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'category_id',
        'name', 
        'price', 
        'status', 
    ];

    public function category()
    {
        return $this->belongsTo(PricelistCategories::class, 'category_id','id');
    }
}
