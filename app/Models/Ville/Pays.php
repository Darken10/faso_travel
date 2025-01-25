<?php

namespace App\Models\Ville;

use App\Models\Ville\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pays extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'money',
        'identity_number',
        'iso2',
    ];

    function regions():HasMany{
        return $this->hasMany(Region::class);
    }

}
