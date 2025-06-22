<?php

use App\Http\Controllers\api\admin\ticket\TicketApiController;
use App\Http\Controllers\api\admin\voyage\VoyageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Voyage\VoyageApiContoller;
use App\Http\Controllers\Ticket\Payement\PaymentController2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TicketController;

// Imports pour l'API V2
use App\Http\Controllers\Api\V2\AuthController as AuthControllerV2;
use App\Http\Controllers\Api\V2\UserController as UserControllerV2;
use App\Http\Controllers\Api\V2\ArticleController as ArticleControllerV2;
use App\Http\Controllers\Api\V2\NotificationController as NotificationControllerV2;
use App\Http\Controllers\Api\V2\TicketController as TicketControllerV2;
use App\Http\Controllers\Api\V2\VoyageController as VoyageControllerV2;

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
        Route::get('/instance/{voyageInstance}','getVoyageInstanceDetails')->name('instance-details');
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


Route::middleware('auth:sanctum')->prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/{post}/like', [PostController::class, 'likePost']);
    Route::delete('/{post}/like', [PostController::class, 'unlikePost']);
    Route::post('/{post}/addcomment', [PostController::class, 'addComment']);
    Route::get('/{post}/likes', [PostController::class, 'getPostLikes'])->name('post.likes');
    Route::get('/{post}/comments', [PostController::class, 'getPostComments'])->name('post.comments');
    Route::get('/{id}', [PostController::class, 'show'])->name('show')->where('id', '[0-9]+');
});

Route::middleware('auth:sanctum')->prefix('voyages')->name('api.user.')->group(function () {
    Route::get('/', [VoyageApiContoller::class, 'index'])->name('index');
    Route::get('/{voyageInstanceId}/details', [VoyageApiContoller::class, 'details'])->name('details')->where('voyageInstanceId', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}');
    Route::get('/{voyageInstanceId}/tickets', [VoyageApiContoller::class, 'tickets'])->name('tickets')->where('voyageInstanceId', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}');
    Route::post('/{voyageInstanceId}/book', [VoyageApiContoller::class, 'book'])->name('book')->where('voyageInstanceId', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}');
    Route::post('/{voyageInstanceId}/cancel', [VoyageApiContoller::class, 'cancel'])->name('cancel')->where('voyageInstanceId', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}');
    Route::get('/{voyageInstanceId}/available-seats', [VoyageApiContoller::class, 'availableSeats'])->name('available-seats')->where('voyageInstanceId', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}');
    Route::get('/{voyageInstanceId}/passengers', [VoyageApiContoller::class, 'passengers'])->name('passengers')->where('voyageInstanceId', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}');
    Route::get('/{voyageInstanceId}/status', [VoyageApiContoller::class, 'status'])->name('status')->where('voyageInstanceId', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}');
    Route::get('/{voyageInstanceId}', [VoyageApiContoller::class, 'show'])->name('show')->whereUuid('voyageInstanceId', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}');

});


Route::middleware('auth:sanctum')->prefix('tickets')->name('api.ticket.')->group(function () {
    Route::post('/{voyageInstance}', [TicketApiController::class, 'debutAchat'])->name('debut-achat')->where('voyageInstance', '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}');


});




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/process-payment/{provider}', [PaymentController2::class, 'processPayment']);

// API V2 - Nouvelle version avec rétrocompatibilité
Route::prefix('v2')->group(function () {
    // Routes d'authentification V2
    Route::prefix('/auth')->controller(AuthControllerV2::class)->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
        Route::post('/send-otp', 'sendOtp');
        Route::post('/verify-otp', 'verifyOtp');
        Route::post('/forgot-password', 'forgotPassword');
        Route::post('/reset-password', 'resetPassword');
    });

    // Routes utilisateur V2
    Route::prefix('/user')->middleware('auth:sanctum')->controller(UserControllerV2::class)->name('api.v2.user.')->group(function () {
        Route::get('/profile', 'getProfile')->name('profile');
        Route::put('/profile', 'updateProfile')->name('update-profile');
        Route::post('/profile/photo', 'updateProfilePicture')->name('update-photo');
        Route::get('/travel-history', 'getTravelHistory')->name('travel-history');
        Route::get('/favorite-routes', 'getFavoriteRoutes')->name('favorite-routes');
        Route::get('/stats', 'getUserStats')->name('stats');
    });

    // Routes articles V2
    Route::prefix('/articles')->controller(ArticleControllerV2::class)->name('api.v2.articles.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/categories', 'getCategories')->name('categories');
        Route::get('/{id}', 'show')->name('show');
        
        // Routes protégées par authentification
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/like', 'toggleLike')->name('toggle-like');
            Route::post('/{id}/comment', 'addComment')->name('add-comment');
            Route::delete('/comment/{commentId}', 'deleteComment')->name('delete-comment');
        });
    });

    // Routes notifications V2
    Route::prefix('/notifications')->middleware('auth:sanctum')->controller(NotificationControllerV2::class)->name('api.v2.notifications.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/{id}/read', 'markAsRead')->name('mark-as-read');
        Route::patch('/read-all', 'markAllAsRead')->name('mark-all-as-read');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::delete('/', 'destroyAll')->name('destroy-all');
    });

    // Routes tickets V2
    Route::prefix('/tickets')->middleware('auth:sanctum')->controller(TicketControllerV2::class)->name('api.v2.tickets.')->group(function () {
        Route::get('/', 'getUserTickets')->name('index');
        Route::get('/{ticketId}', 'getUserTicketDetails')->name('show');
        Route::post('/', 'createTicket')->name('store');
        Route::patch('/{ticketId}/cancel', 'cancelTicket')->name('cancel');
        Route::patch('/{ticketId}/transfer', 'transferTicket')->name('transfer');
        Route::get('/{ticketId}/qr-code', 'getTicketQrCode')->name('qr-code');
    });
    
    // Routes voyages V2
    Route::prefix('/trips')->controller(VoyageControllerV2::class)->name('api.v2.trips.')->group(function () {
        Route::get('/', 'getTrips')->name('index');
        Route::get('/{id}', 'getTripDetails')->name('show');
        Route::get('/{id}/seats', 'getTripSeats')->name('seats');
        Route::post('/search', 'searchTrips')->name('search');
    });
});

Route::name("api.tickets.")->middleware('auth:sanctum')->group(function () {
    Route::get('/tickets/today-paid', [TicketController::class, 'todaysPaidPassengers'])->name('todays-paid-passengers');
    Route::get('/tickets/today-validated', [TicketController::class, 'todaysValidatedTickets'])->name('todays-validated-tickets');
    Route::get('/voyages/today', [TicketController::class, 'todayVoyageInstances'])->name('today-voyage-instances');
    Route::get('/voyages/{voyageInstanceId}/tickets', [TicketController::class, 'ticketsByVoyageInstance'])->name('voyage-instance-tickets');
    Route::get('/tickets/validated', [TicketController::class, 'allValidatedTickets'])->name('all-validated-tickets');
    Route::get('/tickets/qr/{code}', [TicketController::class, 'findByQrCode'])->name('find-by-qr');
    Route::get('/tickets/search', [TicketController::class, 'findByPhoneAndCode'])->name('find-by-phone-code');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('show');
});





