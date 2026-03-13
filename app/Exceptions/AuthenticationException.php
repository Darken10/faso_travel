<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticationException extends Exception
{
    public static function invalidCredentials(): self
    {
        return new self('Email ou mot de passe incorrect', 401);
    }

    public static function userNotFound(): self
    {
        return new self('Aucun compte trouvé avec ces informations', 404);
    }

    public static function invalidOtp(): self
    {
        return new self('Code OTP invalide ou expiré', 400);
    }

    public static function resetFailed(): self
    {
        return new self('Impossible de réinitialiser le mot de passe', 400);
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $this->getMessage(),
        ], $this->getCode() ?: 401);
    }
}
