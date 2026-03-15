<?php

namespace App\Filament\Compagnie\Pages;

use App\Enums\StatutCaisse;
use App\Models\Finance\Caisse;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class HistoriqueCaisses extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Guichet';
    protected static ?string $title = 'Historique des Caisses';
    protected static ?string $navigationLabel = 'Historique Caisses';
    protected static ?int $navigationSort = 2;
    protected static string $view = 'filament.compagnie.pages.historique-caisses';

    public function getCaisses(): \Illuminate\Database\Eloquent\Collection
    {
        return Caisse::where('user_id', Auth::id())
            ->with('user')
            ->orderByDesc('opened_at')
            ->get();
    }

    public function getGlobalStats(): array
    {
        $userId = Auth::id();

        $caisses = Caisse::where('user_id', $userId)->get();
        $fermees = $caisses->where('statut', StatutCaisse::Fermee);

        $totalSessions = $caisses->count();
        $totalVentes = 0;
        $totalTickets = 0;

        foreach ($fermees as $caisse) {
            $totalVentes += $caisse->totalVentes();
            $totalTickets += $caisse->nombreTickets();
        }

        return [
            'total_sessions' => $totalSessions,
            'total_ventes' => $totalVentes,
            'total_tickets' => $totalTickets,
            'sessions_fermees' => $fermees->count(),
        ];
    }
}
