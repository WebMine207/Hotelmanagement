<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {

            if($exception instanceof AuthenticationException){
                $response = [
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'status' => false,
                    'message' => "Unauthorized! Please contact to support",
                    'data' => [],
                    "timestamp" => time()
                ];
                return response()->json($response,Response::HTTP_UNAUTHORIZED);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                $response = [
                    'code' => Response::HTTP_METHOD_NOT_ALLOWED,
                    'status' => true,
                    'message' => "Method Not Allowed",
                    'data' => [],
                    "timestamp" => time()
                ];
                return response()->json($response,Response::HTTP_METHOD_NOT_ALLOWED);
            }

            if ($exception instanceof NotFoundHttpException) {

                $response = [
                    'code' => Response::HTTP_NOT_FOUND,
                    'status' => true,
                    'message' => "Not Found",
                    'data' => [],
                    "timestamp" => time()
                ];
                return response()->json($response,Response::HTTP_NOT_FOUND);
            }
        }

        return parent::render($request, $exception);
    }


}
