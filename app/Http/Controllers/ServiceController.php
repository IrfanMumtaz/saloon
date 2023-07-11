<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Businesses\ServiceBusiness;

class ServiceController extends Controller
{
    public function get(Request $request)
    {
        return ServiceBusiness::getServices($request);
    }
}
