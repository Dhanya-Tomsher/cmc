<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class VetShifts extends Model
{
    use HasFactory;

    public static function getAllShiftsByVets($vetIds){
        $result = [];
        $vets = VetShifts::select("vet_id","slots")
                    ->whereIn('vet_id',$vetIds)
                    ->where('status', 1)
                    ->orderBy('vet_id','ASC')
                    ->get();
        if($vets){
            foreach($vets as $vet){
                $result[$vet->vet_id][] = $vet->slots;
            }
        }

        return $result;
    }
}
