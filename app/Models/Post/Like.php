<?php

namespace App\Models\Post;

use App\Models\User;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','post_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(callback: function (Like $like) {
            $like->user()->associate(Auth::user());
        });
    }
    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function post():BelongsTo{
        return $this->belongsTo(Post::class);
    }

}
