<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\V2\NotificationService;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Get all notifications for the authenticated user
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 15);
        $notifications = $this->notificationService->getUserNotifications($perPage);
        return response()->json($notifications);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead(int $id): JsonResponse
    {
        $notification = $this->notificationService->markAsRead($id);
        return response()->json($notification);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(): JsonResponse
    {
        $count = $this->notificationService->markAllAsRead();
        return response()->json(['count' => $count]);
    }

    /**
     * Delete a notification
     */
    public function destroy(int $id): JsonResponse
    {
        $result = $this->notificationService->deleteNotification($id);
        return response()->json(['deleted' => $result]);
    }

    /**
     * Delete all notifications for the authenticated user
     */
    public function destroyAll(): JsonResponse
    {
        $count = $this->notificationService->deleteAllNotifications();
        return response()->json(['count' => $count]);
    }
}
