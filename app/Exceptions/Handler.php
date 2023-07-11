<?php

namespace App\Exceptions;

use Throwable;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\Resources\ErrorResponse;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                return $this->apiErrorHandling($e);
            }

            return parent::render($request, $e);
        });
    }

    private function apiErrorHandling($e)
    {
        if ($e instanceof NotFoundHttpException) {
            return response()->json(new ErrorResponse(RouteException::notFound()), 404);
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            return response()->json(new ErrorResponse(RouteException::methodNotAllowed()), 405);
        } elseif ($e instanceof ValidationException) {
            return response()->json(new ErrorResponse($e), 422);
        } elseif ($e instanceof BaseException) {
            return response()->json(new ErrorResponse($e), $e->getCode());
        } elseif ($e instanceof QueryException) {
            $ex = new Exception("We have found some exception in SQL query. please be patient we are trying to fix this", 500);
            return response()->json(new ErrorResponse($e), 500);
        } else {
            $error = new Exception($e->getMessage(), 500);
            return response()->json(new ErrorResponse($error), 500);
        }
    }
}
