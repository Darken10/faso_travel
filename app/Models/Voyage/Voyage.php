<?php

namespace App\Models\Voyage;

use App\Models\Compagnie\Gare;
use App\Models\Statut;
use App\Models\User;
use App\Models\Voyage\Trajet;
use App\Models\Voyage\Confort;
use App\Models\Compagnie\Compagnie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'trajet_id',
        'user_id',
        'heure',
        'compagnie_id',
        'prix',
        'statut_id',
        'depart_id',
        'arrive_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($voyage) {
            $voyage->user_id = Auth::id();
        });
    }

    function depart():BelongsTo
    {
        return $this->belongsTo(Gare::class, 'depart_id');
    }

    function arrive():BelongsTo{
        return $this->belongsTo(Gare::class, 'arrive_id');
    }

    function statut():BelongsTo
    {
        return $this->belongsTo(Statut::class, 'statut_id');
    }

    function trajet():BelongsTo{
        return $this->belongsTo(Trajet::class);
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function compagnie():BelongsTo{
        return $this->belongsTo(Compagnie::class);
    }

    function conforts():BelongsToMany{
        return $this->belongsToMany(Confort::class);
    }

     

}
