<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Vet extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];

    public function getImage()
    {
        return Storage::url(Str::replace('/storage/', '', $this->image_url));
    }

    public static function getActiveVets(){
        $vets = Vet::select("id","name")
                    ->where('status', 'published')
                    ->where('is_deleted',0)
                    ->orderBy('name','ASC')
                    ->get();

        return $vets;
    }

    public static function getVetName($id){
        $vets = Vet::select("name")
                    ->where('status', 'published')
                    ->where('is_deleted',0)
                    ->where('id',$id)
                    ->get();

        return $vets;
    }
}
