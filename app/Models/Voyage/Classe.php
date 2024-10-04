<?php

namespace App\Models\voyage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    function conforts():BelongsToMany
    {
        return $this->belongsToMany(Confort::class);
    }
}
