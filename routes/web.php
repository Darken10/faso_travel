<?php

use App\Enums\JoursSemain;
use App\Http\Controllers\Auth\MyRegisterController;
use App\Http\Controllers\Divers\NotificationsController;
use App\Http\Controllers\Ticket\Payement\PayementTest;
use App\Http\Controllers\Ticket\Payement\PaymentController2;
use App\Http\Controllers\Voyages\VoyageInstanceController;
use App\Models\User;
use App\Models\Voyage\Days;
use App\Notifications\Ticket\TicketNotification;
use App\Notifications\TicketTestNotification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Ticket\Payement\OrangePayementController;
use App\Http\Controllers\Ticket\TicketController;
use App\Http\Controllers\Ticket\VoyageController;
use App\Models\Voyage\Voyage;

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


});


Route::prefix('/voyage')->name('voyage.')->middleware('auth')->controller(VoyageController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{voyage}', 'show')->name('show')->where(['voyage' => '[0-9]+',]);
    Route::get('/achete/{voyage}', 'acheter')->name('acheter')->where(['voyage' => '[0-9]+',]);
    Route::get('/my-ticket/achete/{ticket}', 'payerAutrePersonneTicket')->name('payerAutrePersonneTicket')->where(['ticket' => '[0-9]+',]);

    Route::get('/is-my-ticket/{voyage}', 'is_my_ticket')->name('is_my_ticket')->where(['voyage' => '[0-9]+',]);
    Route::post('/is-my-ticket/{voyage}', 'is_my_ticket_traitement')->name('is_my_ticket_traitement')->where(['voyage' => '[0-9]+',]);

    Route::get('/is-my-ticket/autre-ticket-info/{voyage}', 'autre_ticket_info')->name('autre-ticket-info')->where(['voyage' => '[0-9]+',]);
    Route::post('/is-my-ticket/autre-ticket-info/{voyage}', 'register_autre_personne')->name('register-autre-personne')->where(['voyage' => '[0-9]+',]);
    Route::get('/is-my-ticket/autre-ticket-info/{voyage}/{autre_personne}', 'payer_ticket_autre_personne')->name('payer-ticket-autre-personne')->where(['voyage' => '[0-9]+',]);
});


Route::prefix('/ticket')->name('ticket.')->middleware('auth')->controller(TicketController::class)->group(function () {
    Route::post('/payer/{voyage}', 'createTicket')->name('payer')->where(['voyage' => '[0-9]+',]);
    /*Route::post('/my-ticket/payer/{voyage}/{ticket}', 'createTicket')->name('my-ticket.payer')->where(['voyage' => '[0-9]+','ticket' =>'[0-9]+']);*/

    Route::get('/mes-tickets', 'myTickets')->name('myTickets');
    Route::get('/mes-tickets/{ticket}/edite', 'editTicket')->name('editTicket');
    Route::get('/mes-tickets/{ticket}', 'showMyTicket')->name('show-ticket')->where(['ticket' => '[0-9]+',]);
    Route::get('/re-envoyer/{ticket}', 'reenvoyer')->name('reenvoyer')->where(['ticket' => '[0-9]+']);
    Route::get('/regenerer/{ticket}', 'regenerer')->name('regenerer')->where(['ticket' => '[0-9]+']);
    Route::post('/mes-tickets/{ticket}/pause', 'mettreEnPause')->name('mettre-en-pause');
    Route::get('/mes-tickets/{ticket}/payement', 'gotoPayment')->name('goto-payment');

    Route::get('/tansferer/{ticket}', 'tranfererTicketToOtherUser')->name('tranferer-ticket-to-other-user')->where(['ticket' => '[0-9]+']);
    Route::post('/tansferer/{ticket}', 'tranfererTicketToOtherUserTraitement')->name('tranferer-ticket-to-other-user-traitement')->where(['ticket' => '[0-9]+']);
    Route::post('/tansferer/{ticket}/traitement', 'tranfererTicketTraitement')->name('tranferer-ticket-traitement')->where(['ticket' => '[0-9]+']);

});

Route::prefix('/payement')->name('payement.')->middleware('auth')->group(function () {
    Route::prefix('/orange')->name('orange.')->controller(OrangePayementController::class)->group(function () {
        Route::get('/{ticket}', 'paymentPage')->name('paymentPage')->where(['ticket' => '[0-9]+']);
        Route::post('/{ticket}', 'payer')->name('payer')->where(['ticket' => '[0-9]+']);
    });
});


Route::prefix('/validation')->name('admin.')->middleware('auth')->group(function () {
    Route::prefix('/')->name('validation.')->controller(\App\Http\Controllers\Admin\Ticket\TicketController::class)->group(function () {
        Route::get('/verification/{ticket}', 'verification')->name('verification')->where(['ticket' => '[0-9]+']);
        Route::post('/validation/{ticket}', 'valider')->name('valider')->where(['ticket' => '[0-9]+']);
        Route::get('/verification-by-numero-code', 'searchByTelAndCodePage')->name('search-by-tel-and-code-page');
        Route::post('/verification-by-numero-code', 'searchByTelAndCode')->name('search-by-tel-and-code-page');
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


Route::get('/test', function () {
    $user = User::findOrFail(1);
    $user->notify(new TicketTestNotification());
    dd($user);
});


Route::prefix('/auth')->name('auth.')->group(function () {
    Route::prefix('/register')->name('register.')->controller(MyRegisterController::class)->group(function () {
        Route::get('/step1', 'step1')->name('step1');
        Route::get('/step2', 'step2')->name('step2');
        Route::get('/step3', 'step3')->name('step3');

        Route::post('/step1', 'post_step1')->name('post_step1');
        Route::post('/step2', 'post_step2')->name('post_step2');
        Route::post('/step3', 'post_step3')->name('post_step3');
    });
});
//auth.register.step2

Route::get('/notifications',[NotificationsController::class,'allNotifications'])->name('user.notifications');
Route::get('/notifications/{notificationId}',[NotificationsController::class,'showNotification'])->name('user.notifications.show');


Route::get("/test",function (){
    dd(\App\Models\Voyage\VoyageInstance::all());
});

Route::post('/process-payment2/{ticket}/{provider}', [PaymentController2::class, 'processPayment'])->name("controller2-payment.payment-process")->where(['ticket' => '[0-9]+','provider' => '[a-zA-Z]+']);


Route::get('/process-payment/{ticket}/{provider}/success', [PaymentController2::class, 'successFunction'])->name("controller-payment.success");
Route::get('/process-payment/{ticket}/{provider}/cancel', [PaymentController2::class, 'cancelFunction'])->name("controller-payment.cancel");
Route::get('/process-payment/{ticket}/{provider}/callback', [PaymentController2::class, 'callbackFunction'])->name("controller-payment.callback");


Route::get("create-all-voyages-instances", [VoyageInstanceController::class, 'createAllInstance'])->name('create-all-voyages-instances');

