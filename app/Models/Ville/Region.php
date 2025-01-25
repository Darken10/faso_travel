<?php

namespace App\Models\Ville;

use App\Models\Ville\Pays;
use App\Models\Ville\Ville;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pays_id',
    ];

    function pays(): BelongsTo
    {
        return $this->belongsTo(Pays::class);
    }

    function villes():HasMany{
        return $this->hasMany(Ville::class);
    }
}
