<?php

namespace App\Models\Ville;

use App\Models\Ville\Region;
use App\Models\Compagnie\Gare;
use App\Models\Voyage\Trajet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_id',
        'lat',
        'lng',
    ];

    function region():BelongsTo{
        return $this->belongsTo(Region::class);
    }

    function gares():HasMany{
        return $this->hasMany(Gare::class);
    }

    function departs():HasMany{
        return $this->hasMany(Trajet::class,'depart_id');
    }

    function arrivers():HasMany{
        return $this->hasMany(Trajet::class,'arrivers_id');
    }
}
