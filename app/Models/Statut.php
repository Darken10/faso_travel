<?php

namespace App\Models;

use App\Models\Compagnie\Gare;
use App\Models\Compagnie\Compagnie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statut extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ] ;

    function compagnies():HasMany{
        return $this->hasMany(Compagnie::class);
    }

    function gares():HasMany{
        return $this->hasMany(Gare::class);
    }

}
