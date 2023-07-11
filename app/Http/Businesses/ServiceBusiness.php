<?php

namespace App\Http\Businesses;

use App\Http\Services\ServiceService;
use App\Http\Services\ServiceUnAvailableService;

class ServiceBusiness
{
    public static function getServices($request)
    {
        $serviceAvailable = [];
        $date = $request->date ? $request->date : date('Y-m-d');
        $day = strtolower(date('D', strtotime($date)));

        $services = ServiceService::get(['availability' => function($q) use ($day){
            $q->where('day', $day);
        }]);
        
        $serviceUnavailable = ServiceUnAvailableService::byDateAndDay($date, $day);

        foreach ($services as $s) {
            $serviceAvailable[] = [
                'id' => $s->id,
                'name' => $s->name,
                'time_available' => collect(self::getTimeSlot($date, $s, $s->availability, $serviceUnavailable))
            ];

        }

        return $serviceAvailable;

    }

    public static function getTimeSlot($date, $service, $availability, $unavailability)
    {
        $time = [];
        
        if(!$availability) return $time;

        $start = new \DateTime($availability->time_start);
        $end = new \DateTime($availability->time_end);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');

        while(strtotime($startTime) <= strtotime($endTime)){
            $start = $startTime;
            $end = date('H:i',strtotime('+'.$service->duration_minutes.' minutes',strtotime($startTime)));
            $startTime = date('H:i',strtotime('+'.$service->sloting_minutes.' minutes',strtotime($startTime)));

            $slotAvailable = true;
            foreach ($unavailability as $u) {
                if( 
                    (strtotime($startTime) >= strtotime($endTime)) || 
                    (strtotime($startTime) >= strtotime($availability->time_end)) || 
                    (strtotime($start) >= strtotime($u?->time_start) && strtotime($start) < strtotime($u?->time_end))
                ){
                    $slotAvailable = false;
                }
            }

            if($slotAvailable){
                $time[] = [
                        'date' => $date,
                        'start_time' => $start,
                        'end_time' => $end
                    ];
            }
        }
        return $time;
    }

}