<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Businesses\BookingBusiness;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\SuccessResponse;

class BookingController extends Controller
{
    public function store(BookingRequest $request)
    {
        BookingBusiness::makeBooking($request);
        return $this->baseResponse(new SuccessResponse([]), 200);
    }
}
