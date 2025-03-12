<?php

namespace App\Models\Voyage;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Classe $classe) {
            $classe->user_id = $classe->user_id ??  Auth::id();
        });
    }

    protected static function booted(): void
    {
        static::addGlobalScope('classeCompany', function (Builder $builder) {
            if (Auth::check() && request()->is('compagnie*')) {
                if (Auth::user()->compagnie_id) {
                    $companyId = Auth::user()->compagnie_id;
                    $users = User::where('compagnie_id', $companyId)->get()->pluck('id')->toArray();

                    $builder->whereIn('user_id', $users);
                }
            }
        });
    }

    function conforts():BelongsToMany
    {
        return $this->belongsToMany(Confort::class);
    }

    function voyages():HasMany
    {
        return $this->hasMany(Voyage::class);
    }
}
