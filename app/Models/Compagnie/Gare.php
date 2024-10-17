<?php

namespace App\Models\Compagnie;

use App\Models\Compagnie\Compagnie;
use App\Models\User;
use App\Models\Statut;
use App\Models\Ville\Ville;
use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property float $lng
 * @property float $lat
 * @property int $ville_id
 * @property int $statut_id
 * @property int $user_id
 * @property int|null $compagnie_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $arrives
 * @property-read int|null $arrives_count
 * @property-read Compagnie|null $compagnie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $departs
 * @property-read int|null $departs_count
 * @property-read Statut $statut
 * @property-read User $user
 * @property-read Ville $ville
 * @method static \Illuminate\Database\Eloquent\Builder|Gare newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gare newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gare query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereStatutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gare whereVilleId($value)
 * @mixin \Eloquent
 */
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

    protected static function boot()
    {
        parent::boot();

        static::creating(callback: function (Gare $gare) {
            $gare->user()->associate(Auth::user());
        });
    }

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

    function departs():HasMany
    {
        return $this->hasMany(Voyage::class, 'depart_id');
    }

    function arrives():HasMany
    {
        return $this->hasMany(Voyage::class, 'arrive_id');
    }
}
