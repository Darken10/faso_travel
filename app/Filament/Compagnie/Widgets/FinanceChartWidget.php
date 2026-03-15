<?php

namespace App\Filament\Compagnie\Widgets;

use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Helper\QueryHelpers;
use App\Models\Finance\Depense;
use App\Models\Finance\Recette;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FinanceChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Recettes vs Dépenses (6 derniers mois)';

    protected static ?string $pollingInterval = null;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $compagnieId = Auth::user()?->compagnie_id;
        $months = collect();
        $recettesData = collect();
        $depensesData = collect();

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $month = $date->month;
            $year = $date->year;

            $months->push($date->translatedFormat('M Y'));

            // Ticket revenue for this month
            $ticketRevenue = QueryHelpers::AllPaymentsOfMyCompagnie(StatutPayement::Complete, StatutTicket::Valider)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('montant');

            // Manual revenue for this month
            $manualRevenue = Recette::where('compagnie_id', $compagnieId)
                ->whereMonth('date_recette', $month)
                ->whereYear('date_recette', $year)
                ->sum('montant');

            $recettesData->push($ticketRevenue + $manualRevenue);

            // Expenses for this month
            $expenses = Depense::where('compagnie_id', $compagnieId)
                ->whereMonth('date_depense', $month)
                ->whereYear('date_depense', $year)
                ->sum('montant');

            $depensesData->push($expenses);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Recettes',
                    'data' => $recettesData->toArray(),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
                [
                    'label' => 'Dépenses',
                    'data' => $depensesData->toArray(),
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                    'borderColor' => 'rgb(239, 68, 68)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
