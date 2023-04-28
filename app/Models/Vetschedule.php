<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Vetschedule extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];

    public static function getVetSchedules($params){
       
        $vets = Vetschedule::select("date")
                    ->where('status', 'published')
                    ->whereDate('date','>=' ,$params['start'])
                    ->whereDate('date','<=' ,$params['end'])
                    ->where('vet_id',$params['vet_id'])
                    ->orderBy('date','ASC')
                    ->get();

        return $vets;
    }
    public static function getVetSchedulesByDates($params){
        $vets = Vetschedule::select("vetschedules.date")
                            ->selectRaw('GROUP_CONCAT(vets.name) as vet_name, GROUP_CONCAT(vets.id) as vet_ids')
                            ->leftJoin('vets','vetschedules.vet_id','=','vets.id')
                            ->where('vetschedules.status', 'published')
                            ->where('vets.status', 'published')
                            ->whereDate('vetschedules.date','>=' ,$params['start'])
                            ->whereDate('vetschedules.date','<=' ,$params['end'])
                            ->groupBy('vetschedules.date')
                            ->orderBy('vetschedules.date','ASC')
                            ->get();
        return $vets;
    }
}
