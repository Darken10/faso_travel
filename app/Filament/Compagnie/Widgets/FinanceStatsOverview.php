<?php

namespace App\Filament\Compagnie\Widgets;

use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Helper\QueryHelpers;
use App\Models\Finance\Depense;
use App\Models\Finance\Recette;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class FinanceStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $compagnieId = Auth::user()?->compagnie_id;

        // Revenue from tickets (completed payments with validated tickets)
        $recetteTickets = QueryHelpers::AllPaymentsOfMyCompagnie(StatutPayement::Complete, StatutTicket::Valider)
            ->sum('montant');

        // Manual revenue
        $recetteManuelles = Recette::where('compagnie_id', $compagnieId)->sum('montant');

        $totalRecettes = $recetteTickets + $recetteManuelles;

        // Total expenses
        $totalDepenses = Depense::where('compagnie_id', $compagnieId)->sum('montant');

        // Balance
        $solde = $totalRecettes - $totalDepenses;

        // This month
        $depensesMois = Depense::where('compagnie_id', $compagnieId)
            ->whereMonth('date_depense', now()->month)
            ->whereYear('date_depense', now()->year)
            ->sum('montant');

        $recetteTicketsMois = QueryHelpers::AllPaymentsOfMyCompagnie(StatutPayement::Complete, StatutTicket::Valider)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('montant');

        $recetteManuellesMois = Recette::where('compagnie_id', $compagnieId)
            ->whereMonth('date_recette', now()->month)
            ->whereYear('date_recette', now()->year)
            ->sum('montant');

        return [
            Stat::make('Recettes Tickets', number_format($recetteTickets, 0, ',', ' ') . ' F')
                ->description('Tickets validés')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('success'),

            Stat::make('Autres Recettes', number_format($recetteManuelles, 0, ',', ' ') . ' F')
                ->description('Recettes manuelles')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),

            Stat::make('Total Dépenses', number_format($totalDepenses, 0, ',', ' ') . ' F')
                ->description('Toutes les dépenses')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Solde', number_format($solde, 0, ',', ' ') . ' F')
                ->description($solde >= 0 ? 'Bénéfice' : 'Déficit')
                ->descriptionIcon($solde >= 0 ? 'heroicon-m-arrow-up-circle' : 'heroicon-m-arrow-down-circle')
                ->color($solde >= 0 ? 'success' : 'danger'),

            Stat::make('Dépenses ce mois', number_format($depensesMois, 0, ',', ' ') . ' F')
                ->description(now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),

            Stat::make('Recettes ce mois', number_format($recetteTicketsMois + $recetteManuellesMois, 0, ',', ' ') . ' F')
                ->description(now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('success'),
        ];
    }
}
