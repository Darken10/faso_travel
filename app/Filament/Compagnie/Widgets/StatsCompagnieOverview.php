<?php

namespace App\Filament\Compagnie\Widgets;

use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Helper\QueryHelpers;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsCompagnieOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Articles',QueryHelpers::AllPostsOfMyCompagnie()->count()),
            Stat::make('Total Voyage',QueryHelpers::AllVoyagesOfMyCompagnie()->count()),
            Stat::make('Total Gare',QueryHelpers::AllGaresOfMyCompagnie()->count()),

            Stat::make('Ticket Non Valider',QueryHelpers::AllTicketOfMyCompagnie()->count()),
            Stat::make('Budget Ticket Non Valider',QueryHelpers::AllPaymentsOfMyCompagnie(StatutPayement::Complete,StatutTicket::Payer)->sum('montant').' F CFA'),

            Stat::make('Ticket Valider',QueryHelpers::AllTicketOfMyCompagnie(StatutTicket::Valider)->count()),
            Stat::make('Budget',QueryHelpers::AllPaymentsOfMyCompagnie(StatutPayement::Complete,StatutTicket::Valider)->sum('montant').' F CFA'),

            Stat::make('Ticket Inactifs',QueryHelpers::AllTicketOfMyCompagnie(StatutTicket::Bloquer)->count()),
            Stat::make('Budget des ticket inactif',QueryHelpers::AllPaymentsOfMyCompagnie(StatutPayement::Complete,StatutTicket::Bloquer)->sum('montant').' F CFA'),
        ];
    }
}
