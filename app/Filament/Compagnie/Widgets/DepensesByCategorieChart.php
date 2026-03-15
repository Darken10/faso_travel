<?php

namespace App\Filament\Compagnie\Widgets;

use App\Models\Finance\Depense;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepensesByCategorieChart extends ChartWidget
{
    protected static ?string $heading = 'Répartition des dépenses par catégorie';

    protected static ?string $pollingInterval = null;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $compagnieId = Auth::user()?->compagnie_id;

        $data = Depense::where('depenses.compagnie_id', $compagnieId)
            ->join('categorie_depenses', 'depenses.categorie_depense_id', '=', 'categorie_depenses.id')
            ->select('categorie_depenses.nom', DB::raw('SUM(depenses.montant) as total'))
            ->groupBy('categorie_depenses.id', 'categorie_depenses.nom')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $colors = [
            'rgba(245, 158, 11, 0.8)',
            'rgba(59, 130, 246, 0.8)',
            'rgba(239, 68, 68, 0.8)',
            'rgba(34, 197, 94, 0.8)',
            'rgba(168, 85, 247, 0.8)',
            'rgba(236, 72, 153, 0.8)',
            'rgba(20, 184, 166, 0.8)',
            'rgba(107, 114, 128, 0.8)',
        ];

        return [
            'datasets' => [
                [
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => array_slice($colors, 0, $data->count()),
                ],
            ],
            'labels' => $data->pluck('nom')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
