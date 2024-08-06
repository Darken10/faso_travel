<?php

namespace App\Filament\Resources\Ville;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Ville\Pays;
use Filament\Tables\Table;
use App\Models\Ville\Ville;
use App\Models\Ville\Region;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Ville\VilleResource\Pages;
use App\Filament\Resources\Ville\VilleResource\RelationManagers;
use App\Filament\Resources\RegionResource\RelationManagers\VillesRelationManager;

class VilleResource extends Resource
{
    protected static ?string $model = Ville::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    
    protected static ?string $navigationGroup = 'Gestion des Villes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([
                    Wizard\Step::make('Information Sur Region')
                        ->schema([
                            Forms\Components\Select::make('pays_id')
                                ->options(fn (Get $get): Collection => Pays::all()->pluck('name', 'id'))
                                ->afterStateUpdated(fn (Set $set) => $set('region_id', null))
                                ->searchable()->native(False)->preload()->live()->label('Pays')
                                ->hiddenOn(VillesRelationManager::class),
                            Forms\Components\Select::make('region_id')
                                ->options(fn (Get $get): Collection => Region::where('pays_id', $get('pays_id'))->get()->pluck('name', 'id'))
                                ->searchable()->native(False)->preload()->live()->label('Region')
                                ->hiddenOn(VillesRelationManager::class),
                        ])->columns(2)->hiddenOn(VillesRelationManager::class),
                    Wizard\Step::make('Information de la Ville')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->label('Le Nom')
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('lat')
                                ->required()
                                ->label('La Latitude')
                                ->numeric(),
                            Forms\Components\TextInput::make('lng')
                                ->required()
                                ->label('La Longitude')
                                ->numeric(),
                        ])->columns(2),
                ])->columnSpanFull(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nom'),
                Tables\Columns\TextColumn::make('region.name')
                    ->numeric()
                    ->sortable()
                    ->label('Region'),
                Tables\Columns\TextColumn::make('region.pays.name')
                    ->numeric()
                    ->label('Pays')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lat')
                    ->numeric()
                    ->sortable()
                    ->label('Latitude')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('lng')
                    ->numeric()
                    ->sortable()
                    ->label('Longitude')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Information de la ville')
                ->schema([
                    TextEntry::make('region.name')->label('region'),
                    TextEntry::make('region.pays.name')->label('Pays'),
                    TextEntry::make('name')->label('Nom')->columnSpanFull(),
                    TextEntry::make('lat')->label('Latitude'),
                    TextEntry::make('lng')->label('Longitude'),
                ])->columns(2),

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
            'index' => Pages\ListVilles::route('/'),
            'create' => Pages\CreateVille::route('/create'),
            'view' => Pages\ViewVille::route('/{record}'),
            'edit' => Pages\EditVille::route('/{record}/edit'),
        ];
    }
}
