<?php

namespace App\Http\Resources;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use stdClass;

class BaseResponse extends JsonResource
{

    private static $error = null;
    private static String $message = "Operation successful";
    private static Bool $success = true;
    private static $pagination = null;

    public function __construct($data, int $key = 0, ?Exception $error = null, Bool $success = true, ?String $message = null)
    {
        self::$success = $success;
        self::$message = is_null($message) ? self::$message : $message;

        if (!is_null($error)) {
            self::$error = [
                'code' => $error->getCode(),
                'message' => $error->getMessage()
            ];
        } else {
            self::$error = new stdClass;
        }

        parent::__construct($data);
    }


    public static function wrapped($data = new stdClass)
    {

        $response = [
            'data' => $data,
            'message' => self::$message,
            'success' => self::$success,
            'error' => self::$error,
        ];

        return $response;
    }

    public static function collect($resource)
    {
        return static::wrapped([static::$wrap => static::make($resource)->resolve()]);
    }

    public static function stream($resource)
    {
        
        return static::wrapped([static::$wrap . 's' => tap(new AnonymousResourceCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        })]);
    }
}
