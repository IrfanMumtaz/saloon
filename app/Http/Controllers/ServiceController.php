<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Businesses\ServiceBusiness;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    public function get(Request $request)
    {
        return $this->baseResponse(ServiceResource::stream(ServiceBusiness::getServices($request)), 200);
    }
}
