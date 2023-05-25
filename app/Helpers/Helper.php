<?php 

namespace App\Helpers;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\CatCaretakers; 
use DateTime;
use DatePeriod;
use DateInterval;
use DB;
use Route;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }
    public static function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
        $times = array();
        if ( empty( $format ) ) {
            $format = 'g:i a';
        }
        foreach ( range( $lower, $upper, $step ) as $increment ) {
            $increment = gmdate( 'H:i', $increment );
            list( $hour, $minutes ) = explode( ':', $increment );
            $date = new DateTime( $hour . ':' . $minutes );
            $times[(string) $increment] = $date->format( $format );
        }
        return $times;
    }

    public static function getTimeSlot($interval, $start_time, $end_time){
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i=0;
        $time = [];
        while(strtotime($startTime) <= strtotime($endTime)){
            $start = $startTime;
            $end = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $startTime = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $i++;
            if(strtotime($startTime) <= strtotime($endTime)){
                $time[$i]['slot_start_time'] = $start;
                $time[$i]['slot_end_time'] = $end;
            }
        }
        return $time;
    }
    public static function generateVetTimeSlot($interval, $start_time, $end_time, $vet_id){
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i=0;
        $time = [];
        while(strtotime($startTime) <= strtotime($endTime)){
            $start = $startTime;
            $end = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $startTime = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $i++;
            if(strtotime($startTime) <= strtotime($endTime)){
                $time[$i]['slots'] = $start.'-'.$end;
                $time[$i]['vet_id'] = $vet_id;
                $time[$i]['created_at'] = date('Y-m-d H:i:s');
                $time[$i]['from_date'] = date('Y-m-d');
            }
        }
        return $time;
    }

    public static function getTimeSlotHrMIn($interval, $start_time, $end_time){
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i=0;
        $time = [];
        while(strtotime($startTime) <= strtotime($endTime)){
            $start = $startTime;
            $end = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $startTime = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $i++;
            if(strtotime($startTime) <= strtotime($endTime)){
                $time[$i] = $start.'-'.$end;
            }
        }
        return $time;
    }

    public static function getDatesBetween2Dates($startDate, $endDate){
        $dates = [];
       
        $period = CarbonPeriod::create($startDate,  $endDate);
        foreach ($period as $date) {
            $dates[] =  $date->format('Y-m-d');
        }
        return $dates;
    }

    public static function getAgeFromDate($dateOfBirth){
        $dob = new DateTime($dateOfBirth);
        $now = new DateTime();
        $diff = $now->diff($dob);

        $day = ($diff->d == 1) ? $diff->d."day" : $diff->d." days.";
        $month = ($diff->m == 1) ? $diff->m."month" : $diff->m." months";
        $year = ($diff->y == 1) ? $diff->y."year" : $diff->y." years";

        if($diff->y == 0 && $diff->m == 0){
            $age = $day;
        }elseif($diff->y == 0 && $diff->m != 0){
            $age = $month.' '.$day;
        }else{
           
            $age = $year.' '.$month.' '.$day;
        }
        echo $age;
    }
    public static function getCatCaretakerLatestStatus($catId, $caretakerId){
        $transfer_status =  CatCaretakers::where('cat_id', $catId)->where('caretaker_id', $caretakerId)->orderBy('id', 'desc')->pluck('transfer_status')->first();
        return $transfer_status;
    }

    //highlights the selected navigation on admin panel
    public static function areActiveRoutes(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}