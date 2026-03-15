<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\VoyageTicketController;
use App\Http\Controllers\Api\Admin\TicketController;


Route::prefix('/admin')->name('admin.')->middleware('auth:sanctum')->group(function () {
    // Routes pour la gestion des voyages et tickets
    Route::prefix('/voyages')->name('voyages.')->group(function () {
        Route::get('/', [VoyageTicketController::class, 'getVoyageInstancesByDate'])->name('instances-by-date');
        Route::get('/{voyageInstance}/tickets', [VoyageTicketController::class, 'getTicketsByVoyageInstance'])->name('tickets');
        Route::get('/{voyageInstance}/passengers', [TicketController::class, 'getPassengers'])->name('passengers');
    });

    // Routes pour la gestion des tickets (mobile admin)
    Route::prefix('/tickets')->name('tickets.')->group(function () {
        Route::get('/verify/{ticketCode}', [TicketController::class, 'verifyByQrCode'])->name('verify-qr');
        Route::post('/verify-phone', [TicketController::class, 'verifyByPhoneAndCode'])->name('verify-phone');
        Route::post('/validate', [TicketController::class, 'validate'])->name('validate');
        Route::post('/{ticket}/change-status', [TicketController::class, 'changeStatus'])->name('change-status');
        Route::post('/batch-sync', [TicketController::class, 'batchSync'])->name('batch-sync');
    });
});
