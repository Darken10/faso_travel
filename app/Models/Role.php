<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ] ;

    function users():BelongsToMany{
        return $this->belongsToMany(User::class);
    }

}
