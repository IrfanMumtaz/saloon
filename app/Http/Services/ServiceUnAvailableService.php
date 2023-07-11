<?php

namespace App\Http\Services;

use App\Models\ServiceUnavailable;

class ServiceUnAvailableService
{
    public static function byDateAndDay($date, $day)
    {
        return ServiceUnavailable::where('date', $date)->orWhere('day', $day)->get();
    }

    public static function byDay($day)
    {
        return ServiceUnavailable::where('day', $day)->get();
    }
    
}