<?php

namespace App\Exceptions;

use App\Exceptions\BaseException;

class RouteException extends BaseException
{
    public static function notFound(): self
    {
        return new self(
            "The requested route does not exits.",
            404
        );
    }
    public static function methodNotAllowed(): self
    {
        return new self(
            "The requested HTTP method is now supported for this route.",
            405
        );
    }
}
