<?php

namespace App\Models\Voyage;

use App\Models\User;
use App\Models\Voyage\Trajet;
use App\Models\Voyage\Confort;
use App\Models\Compagnie\Compagnie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'trajet_id',
        'user_id',
        'heure',
        'compagnie_id',
        'prix',
    ];

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
