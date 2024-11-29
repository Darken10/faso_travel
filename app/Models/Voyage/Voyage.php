<?php

namespace App\Models\Voyage;

use App\Models\Compagnie\Care;
use App\Models\User;
use App\Models\Statut;
use App\Models\Ticket\Ticket;
use App\Models\Voyage\Trajet;
use App\Models\Compagnie\Gare;
use App\Models\Voyage\Confort;
use App\Models\Compagnie\Compagnie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Enums\JoursSemain;

/**
 *
 *
 * @property int $id
 * @property int $trajet_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $heure
 * @property int $compagnie_id
 * @property int $prix
 * @property int $classe_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $depart_id
 * @property int|null $arrive_id
 * @property int $statut_id
 * @property int $nb_pace
 * @property-read Gare|null $arrive
 * @property-read Compagnie $compagnie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Confort> $conforts
 * @property-read int|null $conforts_count
 * @property-read Gare|null $depart
 * @property-read Gare|null $gareArriver
 * @property-read Gare|null $gareDepart
 * @property-read Statut|null $statut
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Ticket> $tickets
 * @property-read int|null $tickets_count
 * @property-read Trajet $trajet
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage query()
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereArriveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereDepartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereHeure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereNbPace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereStatutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereTrajetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voyage whereUserId($value)
 * @mixin \Eloquent
 */
class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'trajet_id',
        'user_id',
        'heure',
        'compagnie_id',
        'prix',
        'statut_id',
        'depart_id',
        'arrive_id',
        'days',
        'care_id',
        'temps'
    ];



    protected $casts = [
        'heure' => 'datetime',
        'days'=> 'array',
        'temps'=>'datetime',
    ];

    public function getDays(): \Illuminate\Support\Collection
    {
        return collect(json_decode($this->days))->map(fn ($jour)=>JoursSemain::from($jour));

    }

    public function setDays(): void
    {
        $this->attributes['days'] = json_encode(collect($this->days)->map(fn ($jour)=>$jour->value));
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($voyage) {
            $voyage->user_id = Auth::id();
        });
    }

    function gareDepart():BelongsTo
    {
        return $this->belongsTo(Gare::class, 'depart_id');
    }

    function gareArrive(): BelongsTo
    {
        return $this->belongsTo(Gare::class, 'arrive_id');
    }

    function gareArriver(): BelongsTo
    {
        return $this->belongsTo(Gare::class, 'arrive_id');
    }


    function statut(): BelongsTo
    {
        return $this->belongsTo(Statut::class, 'statut_id');
    }

    function trajet(): BelongsTo
    {
        return $this->belongsTo(Trajet::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function compagnie(): BelongsTo
    {
        return $this->belongsTo(Compagnie::class);
    }

    function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    function conforts()
    {
        return $this->classe?->conforts();
    }

    function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    function cares(): BelongsToMany
    {
        return $this->belongsToMany(Care::class);
    }

    function care()
    {
        return $this->hasOne(Care::class)->latestOfMany();
    }

    function days():BelongsToMany
    {
        return $this->belongsToMany(Days::class);
    }

}
