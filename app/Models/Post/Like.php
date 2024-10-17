<?php

namespace App\Models\Post;

use App\Models\User;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

/**
 * 
 *
 * @property int $id
 * @property int|null $post_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Post|null $post
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Like query()
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereUserId($value)
 * @mixin \Eloquent
 */
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
