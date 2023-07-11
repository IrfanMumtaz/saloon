<?php

namespace App\Http\Businesses;

use App\Http\Services\BookingService;
use App\Http\Services\ServiceService;
use App\Http\Services\ServiceUnAvailableService;
use App\Exceptions\BookingException;

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
        if($service->availability == null) throw BookingException::serviceNotAvailable($date);

        //validate the request date is not more than the date allowed to book
        $futureDate = new \DateTime('now');
        $futureDate->add(new \DateInterval('P'.$service->booking_capacity_days.'D'));
        if($date > $futureDate->format('Y-m-d')) throw BookingException::futureCapBooking($service->booking_capacity_days);

        //validate request time is between available working hours
        if(
            (strtotime($request->time_start) < strtotime($service->availability->time_start)) || 
            (strtotime($request->time_start) > strtotime($service->availability->time_end))
        ) throw BookingException::nonWorkingHours();
        
        $start = new \DateTime($request->time_start);
        $end = new \DateTime($request->time_end);
        $mins = abs($start->getTimestamp() - $end->getTimestamp()) / 60;
        if($mins != $service->duration_minutes) throw BookingException::durationExceed();

        //validate if the request date has any unavailability marked
        $serviceUnavailable = ServiceUnAvailableService::byDateAndDay($date, $day);
        foreach($serviceUnavailable as $s){
            //if request time collapse between unavailability hours return error
            if(
                (strtotime($request->time_start) >= strtotime($s->time_start)) && 
                (strtotime($request->time_start) < strtotime($s->time_end))
            ) throw BookingException::nonWorkingHours();
        }

        //check if the selected time is already fully booked or not
        $bookingCount = BookingService::booking($request->service_id, $date, $request->time_start, $request->time_end);
        if($bookingCount->count() >= $service->capacity) throw BookingException::fullyBooked();

        //validate the slot is according to the slots available to us
        $slots = ServiceBusiness::getTimeSlot($date, $service, $service->availability, $serviceUnavailable);
        $matchSlot = array_filter($slots, function ($s) use ($request) {
            return ($s['start_time'] == $request->time_start && $s['end_time'] == $request->time_end);
        });
        if(count($matchSlot) == 0) throw BookingException::invalidTimeSlot();

        return BookingService::create(reset($matchSlot), $request->customers, $service);

    }

}