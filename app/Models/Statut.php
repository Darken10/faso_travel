<?php

namespace App\Models;

use App\Models\Compagnie\Gare;
use App\Models\Cours\Exercice;
use App\Models\Cours\Evaluation;
use App\Models\Compagnie\Compagnie;
use App\Models\Cours\Partie\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Compagnie> $compagnies
 * @property-read int|null $compagnies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Gare> $gares
 * @property-read int|null $gares_count
 * @method static \Illuminate\Database\Eloquent\Builder|Statut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statut query()
 * @method static \Illuminate\Database\Eloquent\Builder|Statut whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statut whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statut whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statut whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
