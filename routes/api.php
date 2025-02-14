<?php

use App\Http\Controllers\api\admin\ticket\TicketApiController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/ticket')
    ->name('api.ticket.')
    ->controller(TicketApiController::class)
    ->group(function (){
        Route::post('/verification/with-number','verificationByNumber')->name('verification-by-number');
        Route::get('/verification/{ticket_code}','verificationByQrCode')->name('verification-by-QrCode');
        //les informations a fournir en post (ticket_id,numero_ticket)
        Route::post('/verification/{ticket_code}','validerTicket')->name('valider-ticket');
    });


Route::prefix('/user')->controller(UserController::class)->group(function (){
    Route::post('/register','register');
    Route::post('/login','login');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


