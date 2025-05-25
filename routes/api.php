<?php

use App\Http\Controllers\api\admin\ticket\TicketApiController;
use App\Http\Controllers\api\admin\voyage\VoyageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Voyage\VoyageApiContoller;
use App\Http\Controllers\Ticket\Payement\PaymentController2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

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

Route::prefix('/auth')->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->prefix("voyages")->controller(VoyageApiContoller::class)->name('api.')->group(function () {

    Route::get('/', 'index')->name('voyages.index');
});


Route::middleware('auth:sanctum')->prefix('posts')->name("api.posts")->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');
    Route::post('/{post}/like', [PostController::class, 'LikePost'])->name('like');
    Route::post('/{post}/dislike', [PostController::class, 'disLikePost'])->name('dislike');

    Route::post('/{post}/comment', [PostController::class, 'addComment'])->name('add-comment');
    Route::get('/{post}/comments', [PostController::class, 'getComments'])->name('get-comments');
    Route::get('/{post}/likes', [PostController::class, 'getPostLikes'])->name('get-likes');


});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/process-payment/{provider}', [PaymentController2::class, 'processPayment']);



