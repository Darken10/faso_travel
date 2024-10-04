<?php

use App\Http\Controllers\api\admin\ticket\TicketApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/ticket')
    ->name('api.ticket.')
    ->controller(TicketApiController::class)
    ->group(function (){
        Route::get('/verification/{ticket_code}','verificationByQrCode')->name('verification-by-QrCode');
    });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


