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

    public static function create($slot, $customers, $service)
    {
        $bookings = [];
        foreach ($customers as $customer) {
            $booking['service_id'] = $service->id;
            $booking['date'] = $slot['date'];
            $booking['time_start'] = $slot['start_time'];
            $booking['time_end'] = $slot['end_time'];
            $booking['time_buffered'] = date("H:i", strtotime('+' . $service->sloting_break .' minutes', strtotime($slot['end_time'])));
            $booking['first_name'] = $customer['first_name'];
            $booking['last_name'] = $customer['last_name'];
            $booking['email'] = $customer['email'];

            $bookings[] = $booking;
        }
        return Booking::insert($bookings);
    }
    
}