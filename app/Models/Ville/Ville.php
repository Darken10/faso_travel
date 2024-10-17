<?php

namespace App\Models\Ville;

use App\Models\Ville\Region;
use App\Models\Compagnie\Gare;
use App\Models\Voyage\Trajet;
use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property float $lat
 * @property float $lng
 * @property int|null $region_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Trajet> $arrivers
 * @property-read int|null $arrivers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Trajet> $departs
 * @property-read int|null $departs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Gare> $gares
 * @property-read int|null $gares_count
 * @property-read Region|null $region
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $voyage_arriver
 * @property-read int|null $voyage_arriver_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Voyage> $voyage_depart
 * @property-read int|null $voyage_depart_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ville newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ville newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ville query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ville whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_id',
        'lat',
        'lng',
    ];

    function region():BelongsTo{
        return $this->belongsTo(Region::class);
    }

    function gares():HasMany{
        return $this->hasMany(Gare::class);
    }

    function departs():HasMany{
        return $this->hasMany(Trajet::class,'depart_id');
    }

    function arrivers():HasMany{
        return $this->hasMany(Trajet::class,'arrivers_id');
    }

    function voyage_depart(){
        return $this->hasManyThrough(Voyage::class,Trajet::class,'depart_id','trajet_id','id','id');
    }

    function voyage_arriver(){
        return $this->hasManyThrough(Voyage::class,Trajet::class,'arriver_id','trajet_id','id','id');
    }
}
