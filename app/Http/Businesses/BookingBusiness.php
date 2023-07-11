<?php

namespace App\Http\Businesses;

use App\Http\Services\BookingService;
use App\Http\Services\ServiceService;
use App\Http\Services\ServiceUnAvailableService;

class BookingBusiness
{
    public static function makeBooking($request)
    {
        $serviceAvailable = [];
        $date = $request->date ? $request->date : date('Y-m-d');
        $day = strtolower(date('D', strtotime($date)));

        $service = ServiceService::first($request->service_id, ['availability' => function($q) use ($day){
            $q->where('day', $day);
        }]);

        //check the service availability date, if the date is sunday then service is not available
        if($service->availability == null) return "Service is not available in this dates";

        //validate the request date is not a past date
        $futureDate = new \DateTime('now');
        if($date < $futureDate->format('Y-m-d')) return "booking is not possible for past days";

        //validate the request date is not more than the date allowed to book
        $futureDate->add(new \DateInterval('P'.$service->booking_capacity_days.'D'));
        if($date > $futureDate->format('Y-m-d')) return "booking is not possible after x days";

        //validate request time is between available working hours
        if(!(strtotime($request->time_start) >= strtotime($service->availability->time_start)) || (strtotime($request->time_start) > strtotime($service->availability->time_end))) return "service is not available in this time period";
        
        $start = new \DateTime($request->time_start);
        $end = new \DateTime($request->time_end);
        $mins = abs($start->getTimestamp() - $end->getTimestamp()) / 60;
        if($start->getTimestamp() > $end->getTimestamp()) return 'Invalid time slot selection';
        if($mins != $service->duration_minutes) return 'Invalid time slot duration selection';

        //validate if the request date has any unavailability marked
        $serviceUnavailable = ServiceUnAvailableService::byDateAndDay($date, $day);
        foreach($serviceUnavailable as $s){
            //if request time collapse between unavailability hours return error
            if(strtotime($request->time_start) >= strtotime($s->time_start) && strtotime($request->time_start) < strtotime($s->time_end)) return "service is not available in this time period";
        }

        //check if the selected time is already fully booked or not
        $bookingCount = BookingService::booking($request->service_id, $date, $request->time_start, $request->time_end);
        if($bookingCount->count() >= $service->capacity) return "Sorry this timeline is already fully booked";

        //validate the slot is according to the slots available to us
        $slots = ServiceBusiness::getTimeSlot($date, $service, $service->availability, $serviceUnavailable);
        $matchSlot = array_filter($slots, function ($s) use ($request) {
            return ($s['start_time'] == $request->time_start && $s['end_time'] == $request->time_end);
        });
        if(count($matchSlot) == 0) return "Sorry no slot available at your desire time";

        // return $matchSlot['date'];

        return BookingService::create(reset($matchSlot), $request->customers, $service);

    }

}