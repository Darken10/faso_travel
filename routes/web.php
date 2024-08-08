<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

    
    Route::get('/{post}/like','storeLikePost')->name('storeLikePost')->where([
        'post'=>'[0-9]+',
    ])->middleware('auth');
/*
    Route::get('/{post}/like/list','likeList')->name('likeList')->where([
        'post'=>'[0-9]+',
    ])->middleware('auth');


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
    ])->middleware('auth'); */
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
