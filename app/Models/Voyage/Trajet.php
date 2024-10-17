<?php

namespace App\Models\Voyage;

use App\Models\User;
use App\Models\Ville\Ville;
use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $depart_id
 * @property int $arriver_id
 * @property int|null $distance
 * @property string|null $temps
 * @property int|null $etat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Ville $arriver
 * @property-read Ville $depart
 * @property-read User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $voyages
 * @property-read int|null $voyages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereArriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereDepartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereTemps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trajet whereUserId($value)
 * @mixin \Eloquent
 */
class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'depart_id',
        'arriver_id',
        'distance',
        'temps',
        'etat',
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function depart():BelongsTo{
        return $this->belongsTo(Ville::class,'depart_id');
    }

    function arriver():BelongsTo{
        return $this->belongsTo(Ville::class,'arriver_id');
    }

    function voyages():HasMany{
        return $this->hasMany(Voyage::class);
    }
}
