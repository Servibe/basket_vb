<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
    'password',
    'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception)) {
            switch ($exception->getStatusCode()) {
                case '404':
                    return response()->view('errores.404', [], 404);
                break;
                case '500':
                    return response()->view('errores.500', [], 500);
                break;
                case '403':
                    return response()->view('errores.403', [], 403);
                break;
                case '401':
                    return response()->view('errores.401', [], 401);
                break;
                case '419':
                    return response()->view('errores.419', [], 419);
                break;
                case '409':
                    return response()->view('errores.409', [], 409);
                break;
                default:
                    return $this->renderHttpException($exception);
                break;
            }
        } else {
            return parent::render($request, $exception);
        }
    }
}
