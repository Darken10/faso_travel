<?php

namespace App\Models\Post;

use App\Models\User;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['message'];

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function post():BelongsTo{
        return $this->belongsTo(Post::class);
    }
}
