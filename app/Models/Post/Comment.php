<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'commentable_id',
        'commentable_type'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(callback: function (Comment $comment) {
            $comment->user()->associate(Auth::user());
        });
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
