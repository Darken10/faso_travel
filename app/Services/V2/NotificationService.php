<?php

namespace App\Services\V2;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

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
        return  Auth::user()->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
    
    /**
     * Mark a notification as read
     *
     * @param int $notificationId
     * @return Notification
     */
    public function markAsRead(int $notificationId)
    {
        $notification = Auth::user()->notifications()
            ->where('id', $notificationId)
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
        return Auth::user()->notifications()
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
        $notification = Auth::user()->notifications()
            ->where('id', $notificationId)
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
        return Auth::user()->notifications()->delete();
    }
    
  /*   /* *
     * Create a notification
     *
     * @param int $userId
     * @param string $type
     * @param string $message
     * @param array $data
     
    public function createNotification(int $userId, string $type, string $message, array $data = [])
    {
        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->type = $type;
        $notification->message = $message;
        $notification->data = json_encode($data);
        $notification->save();
        
        return $notification;
    } */
}
