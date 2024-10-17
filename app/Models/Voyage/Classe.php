<?php

namespace App\Models\Voyage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Classe $classe) {
            $classe->user_id = Auth::id();
        });
    }

    function conforts():BelongsToMany
    {
        return $this->belongsToMany(Confort::class);
    }
}
