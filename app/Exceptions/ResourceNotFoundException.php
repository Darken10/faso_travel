<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ResourceNotFoundException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        // You can log the exception or perform any other reporting logic here
        // For example, you might want to log it to a file or send it to an external service
        Log::error('Resource not found: ' . $this->getMessage());
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => 'Resource not found',
            'message' => $this->getMessage(),
        ], 404);
    }
}
