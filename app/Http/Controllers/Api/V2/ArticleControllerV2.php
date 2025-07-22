<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;

class ArticleControllerV2 extends Controller
{
    public function getAllComments($id)
    {
        try {
            $article = Article::findOrFail($id);
            
            $comments = $article->comments()
                ->with('user:id,name,profile_photo_path') // Inclure les informations de l'utilisateur
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'content' => $comment->content,
                        'created_at' => $comment->created_at->format('Y-m-d H:i:s'),
                        'user' => [
                            'id' => $comment->user->id,
                            'name' => $comment->user->name,
                            'profile_photo' => $comment->user->profile_photo_path
                        ]
                    ];
                });

            return response()->json([
                'status' => 'success',
                'message' => 'Comments retrieved successfully',
                'data' => [
                    'comments' => $comments
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve comments',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
