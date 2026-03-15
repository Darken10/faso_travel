<?php

namespace App\Filament\Compagnie\Pages;

use App\Filament\Compagnie\Widgets\DepensesByCategorieChart;
use App\Filament\Compagnie\Widgets\FinanceChartWidget;
use App\Filament\Compagnie\Widgets\FinanceStatsOverview;
use Filament\Pages\Page;

class BilanFinancier extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Bilan Financier';

    protected static ?string $title = 'Bilan Financier';

    protected static ?string $navigationGroup = 'Comptabilité';

    protected static ?int $navigationSort = 0;

    protected static string $view = 'filament.compagnie.pages.bilan-financier';

    protected function getHeaderWidgets(): array
    {
        return [
            FinanceStatsOverview::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            FinanceChartWidget::class,
            DepensesByCategorieChart::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 3;
    }

    public function getFooterWidgetsColumns(): int | array
    {
        return 2;
    }
}
