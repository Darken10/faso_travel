<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;

class Handler extends ExceptionsHandler
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson() ? response()->json([
            'error' => true,
            "success" => false,
            "message"=> "Vous devez etre connecte "
        ],401) :
        redirect()->guest(route('login'));
    }
}
