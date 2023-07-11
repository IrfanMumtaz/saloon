<?php

namespace App\Http\Services;

use App\Models\Service;

class ServiceService
{
    public static function get($with = [])
    {
        return Service::with($with)->get();
    }

    public static function first($id, $with = [])
    {
        return Service::with($with)->where('id', $id)->first();
    }
    
}