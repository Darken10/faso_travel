<?php

namespace App\Models\Voyage;

use App\Enums\JoursSemain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    use HasFactory;

    protected $casts=[
        'name'=> JoursSemain::class
    ];

    protected $fillable =[
        'name',
    ];

    function voyages()
    {
        return $this->belongsToMany(Voyage::class);
    }
}
