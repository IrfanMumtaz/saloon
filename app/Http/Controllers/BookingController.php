<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Businesses\BookingBusiness;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        return BookingBusiness::makeBooking($request);
    }
}
