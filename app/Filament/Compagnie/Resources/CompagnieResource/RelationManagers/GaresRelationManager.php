<?php

namespace App\Filament\Compagnie\Resources\CompagnieResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Compagnie\Resources\Compagnie\GareResource;

class GaresRelationManager extends RelationManager
{
    protected static string $relationship = 'gares';

    public function form(Form $form): Form
    {
        return GareResource::form($form);
    }

    public function table(Table $table): Table
    {
        return GareResource::table($table)
            ->recordTitleAttribute('name')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    function isReadOnly(): bool
    {
        return False;
    }
}
