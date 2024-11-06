<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ConnectionRequest;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create($request->validated());
            return response()->json([
                'success' => true,
                'error' => false,
                "user" => $user
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function login(LoginRequest $request)
    {

        try {
            if(auth()->attempt($request->only(['email', 'password']))){
                $user = auth()->user();
                $token = $user->createToken('SECRET_ACCESS_TOKEN_LOGIN_USER')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'error' => false,
                    "user" => $user,
                    'token' => $token,
                ]);
            } else{
                response()->json([
                    'success' => false,
                    'error' => true,
                    'message' => 'information non valide',
                ]);
            }
        } catch(\Exception $e){
            response()->json($e);
        }

        return response()->json([
            'success' => false,
            'error' => true,
            'message' => 'information non valide',
        ]);
    }

}
