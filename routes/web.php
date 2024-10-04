<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Ticket\Payement\OrangePayementController;
use App\Http\Controllers\Ticket\TicketController;
use App\Http\Controllers\Ticket\VoyageController;

/** Client */
//Post
Route::prefix('/')->name('post.')->middleware(['auth','verified'])->controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('index');

     Route::get('/{post}','show')->name('show')->where([
        'post'=>'[0-9]+',
    ])->middleware('auth');

    Route::get('/tag/{tag}','filterByTag')->name('filterByTag')->where([
        'tag'=>'[0-9]+',
    ])->middleware('auth');

    Route::get('/like/list/{post}','likeList')->name('likeList')->where([
        'post'=>'[0-9]+',
    ])->middleware('auth');


/*
    Route::post('/{post}','storeComment')->name('storeComment')->where([
        'post'=>'[0-9]+',
    ])->middleware('auth');

    Route::get('/{comment}/comment','reponse')->name('reponse')->where([
        'comment'=>'[0-9]+',
    ])->middleware('auth');

    Route::post('/{comment}/reponse','storeReponse')->name('storeReponse')->where([
        'comment'=>'[0-9]+',
    ])->middleware('auth');

    Route::get('/{comment}/comment/like','storeLikeComment')->name('storeLikeComment')->where([
        'comment'=>'[0-9]+',
    ])->middleware('auth');

    Route::get('/{reponse}/reponse/like','storeLikeReponse')->name('storeLikeReponse')->where([
        'reponse'=>'[0-9]+',
    ])->middleware('auth');

    Route::get('/{compagnie}/compagnie','filterByCompagnie')->name('filterByCompagnie')->where([
        'compagnie'=>'[0-9]+',
    ])->middleware('auth');
*/

});



Route::prefix('/voyage')->name('voyage.')->middleware('auth')->controller(VoyageController::class)->group(function (){
    Route::get('/','index')->name('index');
    Route::get('/{voyage}','show')->name('show')->where([
        'voyage'=>'[0-9]+',
    ]);
    Route::get('/achete/{voyage}','acheter')->name('acheter')->where([
        'voyage'=>'[0-9]+',
    ]);
});


Route::prefix('/ticket')->name('ticket.')->middleware('auth')->controller(TicketController::class)->group(function (){
    Route::post('/payer/{voyage}','createTicket')->name('payer')->where(['voyage'=>'[0-9]+',]);
    Route::get('/mes-tickets','myTickets')->name('myTickets');
    Route::get('/mes-tickets/{ticket}','showMyTicket')->name('show-ticket')->where(['ticket'=>'[0-9]+',]);
    Route::get('/regenerer/{ticket}','regenerer')->name('regenerer')->where(['ticket'=>'[0-9]+']);

});

Route::prefix('/payement')->name('payement.')->middleware('auth')->group(function (){
    Route::prefix('/orange')->name('orange.')->controller(OrangePayementController::class)->group(function (){
        Route::get('/{ticket}','paymentPage')->name('paymentPage')->where(['ticket'=>'[0-9]+']);
        Route::post('/{ticket}','payer')->name('payer')->where(['ticket'=>'[0-9]+']);
    });
});


Route::prefix('/validation')->name('admin.')->middleware('auth')->group(function (){
    Route::prefix('/')->name('validation.')->controller(\App\Http\Controllers\Admin\Ticket\TicketController::class)->group(function (){
        Route::get('/verification/{ticket}','verification')->name('verification')->where(['ticket'=>'[0-9]+']);
        Route::post('/validation/{ticket}','valider')->name('valider')->where(['ticket'=>'[0-9]+']);
        Route::get('/verification-by-numero-code','searchByTelAndCodePage')->name('search-by-tel-and-code-page');
        Route::post('/verification-by-numero-code','searchByTelAndCode')->name('search-by-tel-and-code-page');
    });
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/test',function (){

});
