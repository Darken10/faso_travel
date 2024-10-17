<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 * @property string $sexe
 * @property string|null $email
 * @property int|null $numero
 * @property string $numero_identifiant
 * @property string|null $lien_relation
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne query()
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereLienRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereNumeroIdentifiant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AutrePersonne whereUserId($value)
 * @mixin \Eloquent
 */
class AutrePersonne extends Model
{
    use HasFactory;

    protected $fillable = [
      'first_name',
      'last_name',
      'name',
      'email',
      'sexe',
      'numero',
      'numero_identifiant',
      'lien_relation',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(callback: function (User $user) {
            $user->name = Str::upper($user->first_name) .' '. $user->last_name;
            $user->user_id = auth()->user()->id;
        });
    }

    function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
