<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function successResponse(mixed $data = null, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function createdResponse(mixed $data = null, string $message = 'Ressource créée avec succès'): JsonResponse
    {
        return $this->successResponse($data, $message, 201);
    }

    protected function errorResponse(string $message = 'Une erreur est survenue', int $code = 400, mixed $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    protected function notFoundResponse(string $message = 'Ressource non trouvée'): JsonResponse
    {
        return $this->errorResponse($message, 404);
    }

    protected function unauthorizedResponse(string $message = 'Non autorisé'): JsonResponse
    {
        return $this->errorResponse($message, 401);
    }

    protected function forbiddenResponse(string $message = 'Accès interdit'): JsonResponse
    {
        return $this->errorResponse($message, 403);
    }
}
