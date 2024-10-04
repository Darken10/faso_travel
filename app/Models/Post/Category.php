<?php

namespace App\Models\Post;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name',];

    function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
