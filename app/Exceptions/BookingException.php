<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class BookingException extends BaseException
{
    public static function serviceNotAvailable($date): self
    {
        return new self(
            "Service is not available on {$date}",
            422
        );
    }

    public static function futureCapBooking($days): self
    {
        return new self(
            "Future booking of more than {$days} days are not available",
            422
        );
    }

    public static function nonWorkingHours(): self
    {
        return new self(
            "Booking is not available for non working hours",
            422
        );
    }

    public static function durationExceed(): self
    {
        return new self(
            "Selected time duration exceeds more than allowed time duration",
            422
        );
    }

    public static function fullyBooked(): self
    {
        return new self(
            "The selected time is fully booked",
            422
        );
    }

    public static function invalidTimeSlot(): self
    {
        return new self(
            "The selected time slot is invalid",
            422
        );
    }

}
