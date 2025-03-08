<?php

use App\Http\Controllers\api\admin\ticket\TicketApiController;
use App\Http\Controllers\api\admin\voyage\VoyageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Ticket\Payement\PaymentController2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/ticket')->name('api.ticket.')
    ->controller(TicketApiController::class)->middleware('auth:sanctum')
    ->group(function (){
        Route::post('/verification/with-number','verificationByNumber')->name('verification-by-number');
        Route::get('/verification/{ticket_code}','verificationByQrCode')->name('verification-by-QrCode');
        //les informations a fournir en post (ticket_id,numero_ticket)
        Route::post('/valider','validerTicket')->name('valider-ticket');
    });

Route::prefix('/compagnie/voyages')->name('api.compagnie.voyage.')
    ->controller(VoyageController::class)->middleware('auth:sanctum')
    ->group(function (){
        Route::get('/','index')->name('index');
        Route::get('/{voyage}','showWithPassagers')->name('show-with-passagers');
    });



Route::prefix('/auth')->controller(UserController::class)->group(function (){
    Route::post('/register','register');
    Route::post('/login','login');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/process-payment/{provider}', [PaymentController2::class, 'processPayment']);

