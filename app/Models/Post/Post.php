<?php

namespace App\Models\Post;

use App\Models\User;
use App\Models\Post\Tag;
use App\Models\Post\Like;
use App\Models\Post\Comment;
use App\Models\Post\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    protected static function booted(): void
    {
        static::addGlobalScope('postCompany', function (Builder $builder) {
            if (Auth::check() && request()->is('compagnie/post*')) {
                if (Auth::user()->compagnie_id) {
                    $companyId = Auth::user()->compagnie_id;
                    $users = User::where('compagnie_id', $companyId)->get()->pluck('id')->toArray();

                    $builder->whereIn('user_id', $users);
                }
            }
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
