<?php

namespace App\Models\Post;

use App\Models\User;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['message'];

    protected static function boot()
    {
        parent::boot();

        static::creating(callback: function (Comment $comment) {
            $comment->user()->associate(Auth::user());
        });
    }
    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function post():BelongsTo{
        return $this->belongsTo(Post::class);
    }
}
