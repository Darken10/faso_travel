<?php

namespace App\Models;

use App\Enums\StatutUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Compagnie\Compagnie;
use Carbon\Carbon;
use App\Enums\UserRole;
use App\Models\Post\Like;
use App\Models\Post\Post;
use App\Models\Post\Comment;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'sexe',
        'numero_identifiant',
        'numero',
        'role',
        'compagnie_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'statut' => StatutUser::class,
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(callback: function (User $user) {
            $user->name = Str::upper($user->first_name) .' '. $user->last_name;
        });
    }


    function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    function comments():HasMany{
        return $this->hasMany(Comment::class);
    }

    function likes():HasMany{
        return $this->hasMany(Like::class);
    }


    function tickets():HasMany{
        return $this->hasMany(Ticket::class);
    }

    function compagnie(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Compagnie::class);
    }

    function autrePersonnes():HasMany
    {
        return $this->hasMany(Authenticatable::class);

    }

    function ticketsAutrePersonne()
    {
        return $this->morphMany(Ticket::class,'autre_personne');
    }



}
