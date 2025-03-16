<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class AutrePersonne extends Model
{
    use HasFactory, Notifiable;

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
        static::creating(callback: function (AutrePersonne $autrePersonne) {
            $autrePersonne->name = Str::upper($autrePersonne->first_name) .' '. $autrePersonne->last_name;
            $autrePersonne->user_id = auth()->user()->id;
        });
    }

    function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function tickets()
    {
        return $this->morphMany(Ticket::class,'autre_personne');
    }

}
