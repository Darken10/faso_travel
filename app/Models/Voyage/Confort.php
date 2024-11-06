<?php

namespace App\Models\Voyage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

/**
 *
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Voyage\Classe> $classes
 * @property-read int|null $classes_count
 * @method static \Database\Factories\Voyage\ConfortFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Confort newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Confort newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Confort query()
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confort whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Confort extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function (Confort $confort) {
            $confort->user_id = $confort->user_id ?? Auth::id();
        });
    }

    function classes():BelongsToMany
    {
        return $this->belongsToMany(Classe::class);
    }
}
