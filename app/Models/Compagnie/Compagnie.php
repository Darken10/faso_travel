<?php

namespace App\Models\Compagnie;

use App\Models\User;
use App\Models\Statut;
use App\Models\Voyage\Voyage;
use App\Models\Compagnie\Gare;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $sigle
 * @property string|null $slogant
 * @property string|null $description
 * @property string|null $logo_uri
 * @property int|null $user_id
 * @property int $statut_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Gare> $gares
 * @property-read int|null $gares_count
 * @property-read Statut $statut
 * @property-read User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $voyages
 * @property-read int|null $voyages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereLogoUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereSigle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereSlogant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereStatutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compagnie whereUserId($value)
 * @mixin \Eloquent
 */
class Compagnie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sigle',
        'slogant',
        'description',
        'logo_uri',
        'user_id',
    ];

    protected $with = [
        'statut'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(callback: function (Compagnie $compagnie) {
            $compagnie->user()->associate(Auth::user());
        });
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function statut():BelongsTo{
        return $this->belongsTo(Statut::class);
    }

    function gares():HasMany{
        return $this->hasMany(Gare::class);
    }

    function voyages():HasMany{
        return $this->hasMany(Voyage::class);
    }

    function users():HasMany{
        return $this->hasMany(User::class);
    }


}
