<?php

namespace App\Filament\Resources\PaysResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Ville\RegionResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class RegionsRelationManager extends RelationManager
{
    protected static string $relationship = 'regions';

    public function form(Form $form): Form
    {
        return RegionResource::form($form);
    }

    public function table(Table $table): Table
    {
        return RegionResource::table($table)
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
