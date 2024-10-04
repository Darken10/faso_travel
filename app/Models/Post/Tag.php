<?php

namespace App\Models\Post;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', ];

    function posts():BelongsToMany{
        return $this->belongsToMany(Post::class);
    }

    
}
