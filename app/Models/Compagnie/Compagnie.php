<?php

namespace App\Models\Compagnie;

use App\Models\CompagnieSetting;
use App\Models\User;
use App\Models\Statut;
use App\Models\Voyage\Classe;
use App\Models\Voyage\Voyage;
use App\Models\Compagnie\Gare;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Builder;

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

    function classes():HasManyThrough
    {
        return $this->hasManyThrough(Classe::class,User::class);
    }


    function chauffeurs():HasMany
    {
        return $this->hasMany(Chauffer::class);
    }

    function scopeActives(Builder $query)
    {
        return $query;
    }

    public function settings(): Compagnie|Builder|HasMany
    {
        return $this->hasMany(CompagnieSetting::class);
    }

    /*public function getSetting(string $key, $default = null)
    {
        return optional($this->settings->firstWhere('key', $key))->value ?? $default;
    }*/

    public function getSetting(string $key, $default = null): mixed
    {
        $setting = $this->settings->firstWhere('key', $key);
        return $setting ? $setting->getCastedValue() : $default;
    }


}
