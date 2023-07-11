<?php

namespace App\Http\Services;

use App\Models\Booking;

class BookingService
{
    public static function booking($serviceId, $date, $timeStart, $timeEnd)
    {
        return Booking::where('service_id', $serviceId)
            ->where('date', $date)
            ->where('time_start', $timeStart)
            ->where('time_end', $timeEnd)
            ->get();
    }
    
}