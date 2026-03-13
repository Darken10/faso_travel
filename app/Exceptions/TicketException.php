<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketException extends Exception
{
    public static function noSeatsAvailable(): self
    {
        return new self('Plus de places disponibles pour ce voyage', 422);
    }

    public static function alreadyCancelled(): self
    {
        return new self('Ce ticket est déjà annulé', 422);
    }

    public static function alreadyValidated(): self
    {
        return new self('Ce ticket a déjà été validé et ne peut plus être modifié', 422);
    }

    public static function voyageAlreadyStarted(): self
    {
        return new self('Le voyage a déjà commencé, cette opération n\'est plus possible', 422);
    }

    public static function alreadyExists(): self
    {
        return new self('Un ticket existe déjà pour ce voyage', 409);
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $this->getMessage(),
        ], $this->getCode() ?: 422);
    }
}
