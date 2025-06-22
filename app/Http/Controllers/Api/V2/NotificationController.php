<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Get all notifications for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $notifications = $this->notificationService->getUserNotifications($perPage);

            return response()->json([
                'status' => 'success',
                'message' => 'Notifications récupérées avec succès',
                'data' => $notifications
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark a notification as read
     *
     * @param int $id
     * @return JsonResponse
     */
    public function markAsRead(int $id): JsonResponse
    {
        try {
            $notification = $this->notificationService->markAsRead($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Notification marquée comme lue',
                'data' => $notification
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Mark all notifications as read
     *
     * @return JsonResponse
     */
    public function markAllAsRead(): JsonResponse
    {
        try {
            $count = $this->notificationService->markAllAsRead();

            return response()->json([
                'status' => 'success',
                'message' => $count . ' notifications marquées comme lues',
                'data' => ['count' => $count]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a notification
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $result = $this->notificationService->deleteNotification($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Notification supprimée avec succès',
                'data' => ['deleted' => $result]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Delete all notifications for the authenticated user
     *
     * @return JsonResponse
     */
    public function destroyAll(): JsonResponse
    {
        try {
            $count = $this->notificationService->deleteAllNotifications();

            return response()->json([
                'status' => 'success',
                'message' => $count . ' notifications supprimées',
                'data' => ['count' => $count]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
