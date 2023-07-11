<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Businesses\BookingBusiness;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function store(BookingRequest $request)
    {
        return BookingBusiness::makeBooking($request);
    }
}
