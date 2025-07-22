<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;

class Handler extends ExceptionsHandler
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson() ? response()->json([
            'error' => true,
            "success" => false,
            "message" => "Vous devez etre connecte "
        ], 401) :
            redirect()->guest(route('login'));
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            // Gestion des erreurs de validation
            if ($exception instanceof ValidationException) {
                $errors = collect($exception->errors())
                    ->map(function ($messages, $field) {
                        return collect($messages)->map(function ($msg) use ($field) {
                            return [
                                'name' => $field,
                                'message' => $msg
                            ];
                        });
                    })
                    ->flatten(1)
                    ->values();
                return response()->json([
                    'error' => true,
                    'message' => $exception->getMessage(),
                    'status' => 422,
                    'errors' => $errors
                ], 422);
            }
            // Gestion des autres exceptions
            $status = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage(),
                'status' => $status
            ], $status);
        }
        return parent::render($request, $exception);
    }

    public function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return response()->json([
            'message' => 'Les données fournies sont invalides.',
            'errors' => $exception->errors(),
            'status_code' => 422,
        ], 422);
    }
}
