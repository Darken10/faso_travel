<?php

namespace App\Http\Controllers\Divers;

use App\Enums\TypeNotification;
use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use PhpParser\Builder\Enum_;

class NotificationsController extends Controller
{
    function allNotifications(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('divers.notifications-liste',[
            'notifications' => \Auth::user()->notifications()->get(),
        ]);
    }

     function showNotification($notificationId): \Illuminate\Http\RedirectResponse
    {
        $notification = \Auth::user()->notifications()->whereId($notificationId)->get()->last();
        $notification->markAsRead();
        $ticket = Ticket::findOrFail($notification->data['ticket']['id']);
        return to_route('ticket.show-ticket', $ticket);
    }
}
