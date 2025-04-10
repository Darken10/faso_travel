<?php

namespace App\Filament\Compagnie\Resources\Voyage;

use App\Enums\StatutVoyageInstance;
use App\Filament\Compagnie\Resources\Voyage\VoyageInstanceResource\Pages;
use App\Filament\Compagnie\Resources\Voyage\VoyageInstanceResource\RelationManagers;
use App\Models\Voyage\VoyageInstance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VoyageInstanceResource extends Resource
{
    protected static ?string $model = VoyageInstance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Voyage';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Select::make('voyage_id')
                            ->relationship('voyage', 'id')
                            ->required(),
                        Forms\Components\DatePicker::make('date')
                            ->required(),
                        Forms\Components\Select::make('care_id')
                            ->relationship('care', 'immatrculation')
                            ->required(),
                        Forms\Components\TextInput::make('heure')
                            ->required(),
                        Forms\Components\TextInput::make('nb_place')
                            ->required(),
                        Forms\Components\Select::make('chauffer_id')
                            ->relationship('chauffer', 'first_name')
                            ->required(),
                        Forms\Components\Select::make('statut')
                            ->options(StatutVoyageInstance::values())
                            ->required(),
                        Forms\Components\TextInput::make('prix')
                            ->required(),
                    ]),
                // "voyage_id",
                //        "date",
                //        "care_id",
                //        "heure",
                //        "nb_place",
                //        "chauffer_id",
                //        'statut',
                //        'prix',
                //        'classe_id'
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('voyage.trajet.depart.name')
                    ->label('Ville de Départ'),
                Tables\Columns\TextColumn::make('voyage.trajet.arriver.name')
                    ->label('Ville d\'Arrivée'),
                Tables\Columns\TextColumn::make('date')
                    ->date("d/m/Y"),
                Tables\Columns\TextColumn::make('care.immatrculation')
                    ->label('Imatruclation du Care')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('heure')
                ->label('Heure de Départ')
                ->dateTime("H:i"),
                Tables\Columns\TextColumn::make('nb_place')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('chauffer.first_name')
                    ->label('Nom du Chauffer')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('statut')
                    ->label('Statut'),
                Tables\Columns\TextColumn::make('prix')
                    ->suffix(' XOF')
                    ->label('Prix'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVoyageInstances::route('/'),
            'create' => Pages\CreateVoyageInstance::route('/create'),
            'edit' => Pages\EditVoyageInstance::route('/{record}/edit'),
        ];
    }
}
