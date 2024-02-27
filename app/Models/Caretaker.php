<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Str;

class Caretaker extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];

    public function getImage()
    {
        return Storage::url(Str::replace('/storage/', '', $this->image_url));
    }
}
