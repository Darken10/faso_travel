<?php

namespace App\Models\Compagnie;

use App\Models\User;
use App\Models\Statut;
use App\Models\Voyage\Voyage;
use App\Models\Compagnie\Gare;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Compagnie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sigle',
        'slogant',
        'description',
        'logo_uri',
        'user_id',
    ];

    protected $with = [
        'statut'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(callback: function (Compagnie $compagnie) {
            $compagnie->user()->associate(Auth::user());
        });
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function statut():BelongsTo{
        return $this->belongsTo(Statut::class);
    }

    function gares():HasMany{
        return $this->hasMany(Gare::class);
    }

    function voyages():HasMany{
        return $this->hasMany(Voyage::class);
    }

}
