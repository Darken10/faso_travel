<?php

namespace App\Models\Compagnie;

use App\Models\User;
use App\Models\Statut;
use App\Models\Ville\Ville;
use App\Models\Compagnie\Compagnie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
