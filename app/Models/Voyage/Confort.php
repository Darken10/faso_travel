<?php

namespace App\Models\Voyage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

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
            // Use the first admin/root user if no user_id is provided (for seeding)
            if (!$confort->user_id) {
                $adminUser = \App\Models\User::whereIn('role', ['admin', 'root'])->first()
                    ?? \App\Models\User::first();
                $confort->user_id = $adminUser->id ?? Auth::id();
            }
        });
    }

    function classes():BelongsToMany
    {
        return $this->belongsToMany(Classe::class);
    }
}
