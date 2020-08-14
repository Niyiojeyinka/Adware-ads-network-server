<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;

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
    protected $dontFlash = ['password', 'password_confirmation'];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            $errors = $exception->validator->errors()->getMessages();
            return response()->json(
                [
                    'result' => 0,
                    'error' => $errors,
                    'data' => [],
                ],
                422
            );
        }

        if ($exception instanceof ModelNotFoundException) {
            $model = class_basename($exception->getModel());
            return response()->json(
                [
                    'result' => 0,
                    'error' => $model . ' not found',
                    'data' => [],
                ],
                404
            );
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json(
                [
                    'result' => 0,
                    'error' => 'Unautheticated',
                    'data' => [],
                ],
                401
            );
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json(
                [
                    'result' => 0,
                    'error' => $exception->getMessage(),
                    'data' => [],
                ],
                403
            );
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json(
                [
                    'result' => 0,
                    'error' => 'This URL does not exist',
                    'data' => [],
                ],
                404
            );
        }

        if ($exception instanceof HttpException) {
            return response()->json(
                [
                    'result' => 0,
                    'error' => $exception->getMessage(),
                    'data' => [],
                ],
                $exception->getStatusCode()
            );
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(
                [
                    'success' => 0,
                    'message' =>
                        'Method is not allowed ,please use supported request method.',
                ],
                405
            );
        }

        return parent::render($request, $exception);
    }
}