<?php

namespace App\Services\V2;


use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;

class NotificationService
{
    /**
     * Get all notifications for the authenticated user
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUserNotifications(int $perPage = 15): LengthAwarePaginator
    {
        return Notification::where('notifiable_id', Auth::id())
            ->where('notifiable_type', User::class)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
    
    /**
     * Mark a notification as read
     *
     * @param int $notificationId
     * @return Notification
     */
    public function markAsRead(int $notificationId): Notification
    {
        $notification = Notification::where('id', $notificationId)
            ->where('notifiable_id', Auth::id())
            ->where('notifiable_type', User::class)
            ->firstOrFail();
            
        $notification->read_at = Carbon::now();
        $notification->save();
        
        return $notification;
    }
    
    /**
     * Mark all notifications as read
     *
     * @return int Number of notifications marked as read
     */
    public function markAllAsRead(): int
    {
        return Notification::where('notifiable_id', Auth::id())
            ->where('notifiable_type', User::class)
            ->whereNull('read_at')
            ->update(['read_at' => Carbon::now()]);
    }
    
    /**
     * Delete a notification
     *
     * @param int $notificationId
     * @return bool
     */
    public function deleteNotification(int $notificationId): bool
    {
        $notification = Notification::where('id', $notificationId)
            ->where('notifiable_id', Auth::id())
            ->where('notifiable_type', User::class)
            ->firstOrFail();
            
        return $notification->delete();
    }
    
    /**
     * Delete all notifications for the authenticated user
     *
     * @return int Number of notifications deleted
     */
    public function deleteAllNotifications(): int
    {
        return Notification::where('notifiable_id', Auth::id())
            ->where('notifiable_type', User::class)
            ->delete();
    }
    
    /**
     * Create a notification
     *
     * @param int $userId
     * @param string $type
     * @param string $message
     * @param array $data
     * @return Notification
     */
    public function createNotification(int $userId, string $type, string $message, array $data = []): Notification
    {
        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->type = $type;
        $notification->message = $message;
        $notification->data = json_encode($data);
        $notification->save();
        
        return $notification;
    }
}
