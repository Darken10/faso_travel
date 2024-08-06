<?php

namespace App\Filament\Resources\RegionResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Ville\VilleResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class VillesRelationManager extends RelationManager
{
    protected static string $relationship = 'villes';

    public function form(Form $form): Form
    {
        return VilleResource::form($form);
    }

    public function table(Table $table): Table
    {
        return VilleResource::table($table)
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
        return false;
    }
}
