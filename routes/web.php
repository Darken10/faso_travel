<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Ticket\TicketController;
use App\Http\Controllers\Ticket\VoyageController;
use App\Models\Voyage\Trajet;
use App\Models\Voyage\Voyage;
use PHPUnit\Framework\Attributes\Ticket;

/** Client */
//Post
Route::prefix('/')->name('post.')->middleware('auth')->controller(PostController::class)->group(function () { 
    Route::get('/', 'index')->name('index');

     Route::get('/{post}','show')->name('show')->where([
        'post'=>'[0-9]+',
    ])->middleware('auth');

    Route::get('/{tag}/tag','filterByTag')->name('filterByTag')->where([
        'tag'=>'[0-9]+',
    ])->middleware('auth');

    Route::get('/{post}/like/list','likeList')->name('likeList')->where([
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
    $tagets = Trajet::query()->where('depart_id',1)->get()->pluck('id');
    dd(Voyage::query()->whereIn('trajet_id',$tagets->toArray())->get());
});
