<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class Vet extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];

    public function getImage()
    {
        return $this->image_url ? URL::to($this->image_url) : asset('assets/images/user_img.png');
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
