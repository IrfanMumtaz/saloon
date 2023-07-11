<?php

namespace App\Http\Services;

use App\Models\ServiceUnavailable;

class ServiceUnAvailableService
{
    public static function firstByDate($date)
    {
        return ServiceUnavailable::where('date', $date)->first();
    }
    
}