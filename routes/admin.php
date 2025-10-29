<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\VoyageTicketController;


Route::prefix('/admin')->name('admin.')->middleware('auth:sanctum')->group(function () {
    // Routes pour la gestion des voyages et tickets
    Route::prefix('/voyages')->name('voyages.')->group(function () {
        Route::get('/', [VoyageTicketController::class, 'getVoyageInstancesByDate'])->name('instances-by-date');
        Route::get('/{voyageInstance}/tickets', [VoyageTicketController::class, 'getTicketsByVoyageInstance'])->name('tickets');
    });
});
