<?php

namespace App\Models\Voyage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Confort extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function (Confort $confort) {
            $confort->user_id = $confort->user_id ?? Auth::id();
        });
    }

    function classes():BelongsToMany
    {
        return $this->belongsToMany(Classe::class);
    }
}
