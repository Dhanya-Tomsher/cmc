<?php 

namespace App\Helpers;
use DateTime;

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
}