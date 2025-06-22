<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    /**
     * Get all notifications for the authenticated user
     *
     * @return array
     */
    public function getUserNotifications(): array
    {
        $user = Auth::user();
        $notifications = $user->notifications;
        $unreadCount = $user->unreadNotifications->count();

        return [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ];
    }

    /**
     * Mark a notification as read
     *
     * @param string $id
     * @return DatabaseNotification
     */
    public function markAsRead(string $id): DatabaseNotification
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();

        return $notification;
    }

    /**
     * Mark all notifications as read
     *
     * @return int
     */
    public function markAllAsRead(): int
    {
        $user = Auth::user();
        return $user->unreadNotifications->markAsRead()->count();
    }

    /**
     * Create a new notification
     *
     * @param array $data
     * @return DatabaseNotification
     */
    public function createNotification(array $data): DatabaseNotification
    {
        $user = Auth::user();
        
        return $user->notify(new \App\Notifications\GeneralNotification(
            $data['title'],
            $data['message'],
            $data['type']
        ));
    }

    /**
     * Delete a notification
     *
     * @param string $id
     * @return bool
     */
    public function deleteNotification(string $id): bool
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        
        return $notification->delete();
    }

    /**
     * Delete all notifications
     *
     * @return bool
     */
    public function deleteAllNotifications(): bool
    {
        $user = Auth::user();
        return $user->notifications()->delete();
    }
}
