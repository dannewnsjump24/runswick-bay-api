<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        });
    }

    /**
     * @param Request $request
     * @return JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($request->expectsJson() && $this->isApiRoute($request) && !$e instanceof ValidationException) {
            $statusCode = $this->getStatusCode($e);

            return new JsonResponse([
                'error' => $e->getMessage(),
                'status_code' => $statusCode,
            ], $statusCode);
        }

        return parent::render($request, $e);
    }

    protected function isApiRoute(Request $request): bool
    {
        return $request->is('api/*');
    }

    protected function getStatusCode(Throwable $exception): int
    {
        if ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
