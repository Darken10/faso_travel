<?php

namespace App\Services;

use App\Models\Voyage\VoyageInstance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class VoyageService
{
    public function getTodayVoyages(): Collection
    {
        $compagnieId = Auth::user()->compagnie_id;

        return VoyageInstance::with([
            'voyage.trajet.depart',
            'voyage.trajet.arriver',
            'chauffer',
            'care',
            'tickets'
        ])
        ->whereDate('date', Carbon::today())
        ->whereHas('voyage', function($query) use ($compagnieId) {
            $query->where('compagnie_id', $compagnieId);
        })
        ->get();
    }
}
