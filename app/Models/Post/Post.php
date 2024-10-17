<?php

namespace App\Models\Post;

use App\Models\User;
use App\Models\Post\Tag;
use App\Models\Post\Like;
use App\Models\Post\Comment;
use App\Models\Post\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property array|null $images_uri
 * @property int $nb_views
 * @property int|null $user_id
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Like> $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Tag> $tags
 * @property-read int|null $tags_count
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereImagesUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereNbViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'images_uri',
        'nb_views',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(callback: function (Post $post) {
            $post->user()->associate(Auth::user());
        });
    }

    protected function casts(): array
    {
        return [
            'images_uri' => 'array',
        ];
    }




    /**********Les Relations*************** */

    function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function tags():BelongsToMany{
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    function likes():HasMany{
        return $this->hasMany(Like::class);
    }

    /*************Les Autres Fonctions***************** */

    function count_likes():int{
        $nb = count($this->likes);
        return $nb;
    }

    function is_like():bool{
        return count($this->likes()->where('user_id',auth()->user()->id)->get())>0;
    }

    function getImageUrl():string
    {
        return Storage::url($this->images_uri);
    }

}
