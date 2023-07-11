<?php

namespace App\Http\Services;

use App\Models\Service;

class ServiceService
{
    public static function get($with = [])
    {
        return Service::with($with)->get();
    }
    
}