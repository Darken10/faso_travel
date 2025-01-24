<?php

namespace App\Models\Compagnie;

use App\Models\Compagnie\Compagnie;
use App\Models\User;
use App\Models\Statut;
use App\Models\Ville\Ville;
use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Gare extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lng',
        'lat',
        'user_id',
        'statut_id',
        'compagnie_id',
        'ville_id',

    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(callback: function (Gare $gare) {
            $gare->user()->associate(Auth::user());
            $gare->compagnie_id = $gare->user->compagnie_id;
        });
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function statut():BelongsTo{
        return $this->belongsTo(Statut::class);
    }

    function compagnie():BelongsTo{
        return $this->belongsTo(Compagnie::class);
    }

    function ville():BelongsTo{
        return $this->belongsTo(Ville::class);
    }

    function departs():HasMany
    {
        return $this->hasMany(Voyage::class, 'depart_id');
    }

    function arrives():HasMany
    {
        return $this->hasMany(Voyage::class, 'arrive_id');
    }
}
