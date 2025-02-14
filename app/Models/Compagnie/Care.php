<?php

namespace App\Models\Compagnie;

use App\Enums\StatutCare;
use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Care extends Model
{
    use HasFactory;

    protected $fillable = [
        'immatrculation',
        'number_place',
        'statut',
        'etat',
        'image_uri',
        'compagnie_id',
    ];


    protected static function boot(): void
    {
        parent::boot();

        static::creating(callback: function (Care $care) {
            $care->compagnie_id = Auth::user()->compagnie_id;
        });
    }

    protected $casts = [
        'statut' => StatutCare::class
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
