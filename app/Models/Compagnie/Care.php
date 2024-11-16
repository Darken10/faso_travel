<?php

namespace App\Models\Compagnie;

use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Care extends Model
{
    use HasFactory;

    protected $fillable = [
        'immatrculation',
        'number_place',
        'statut',
        'etat',
        'image_uri'
    ];

    function voyages():HasMany
    {
        return  $this->hasMany(Voyage::class);
    }

    function compagnie():BelongsTo
    {
        return  $this->belongsTo(Compagnie::class);
    }

}
