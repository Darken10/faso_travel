<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

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
