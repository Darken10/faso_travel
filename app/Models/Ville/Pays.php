<?php

namespace App\Models\Ville;

use App\Models\Ville\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $money
 * @property int $identity_number
 * @property string $iso2
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Region> $regions
 * @property-read int|null $regions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pays newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pays newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pays query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereIso2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pays whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
