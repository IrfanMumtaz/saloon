<?php

namespace App\Http\Resources;

use Exception;

class ErrorResponse extends BaseResponse
{

    public function __construct(Exception $e)
    {
        parent::__construct([], 0, $e, false, "Operation failed!");
    }

    public function toArray($request)
    {
        return $this->wrapped();
    }
}
