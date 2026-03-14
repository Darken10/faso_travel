<?php

namespace App\Filament\Compagnie\Resources\Voyage\VoyageResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\VoyageResource;
use App\Services\Voyage\VoyageInstanceService;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListVoyages extends ListRecords
{
    protected static string $resource = VoyageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generer_instances')
                ->label('Générer les voyages instances')
                ->icon('heroicon-o-calendar-days')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Générer les voyages instances')
                ->modalDescription('Cette action va générer les instances de voyages pour les 30 prochains jours, pour tous les voyages actifs. Les instances déjà existantes ne seront pas dupliquées. Voulez-vous continuer ?')
                ->modalSubmitActionLabel('Oui, générer')
                ->modalIcon('heroicon-o-calendar-days')
                ->action(function (VoyageInstanceService $service) {
                    try {
                        $service->createAll();
                        Notification::make()
                            ->title('Génération réussie')
                            ->body('Les voyages instances ont été générés avec succès pour les 30 prochains jours.')
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('Erreur lors de la génération')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),

            Actions\CreateAction::make(),
        ];
    }
}
