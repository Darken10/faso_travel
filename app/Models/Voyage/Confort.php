<?php

namespace App\Models\Voyage;

use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Confort extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
    ];

    function voyages():BelongsToMany{
        return $this->belongsToMany(Voyage::class);
    }
}
