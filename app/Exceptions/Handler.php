<?php

namespace App\Exceptions;

use Error;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ServiceUnavailableHttpException) {
            return response()->view('errors.503', [], 503);
        }elseif($exception instanceof NotFoundHttpException){
            return response()->view('errors.404', [], 404);
        }elseif($exception instanceof Error){
            return response()->view('errors.500', [], 500);
        }elseif ($exception instanceof TokenMismatchException) {
            return redirect('/'); // atau arahkan ke halaman login jika lebih tepat
        }

        return parent::render($request, $exception);
    }
}
