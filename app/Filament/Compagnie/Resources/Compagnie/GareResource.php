<?php

namespace App\Filament\Compagnie\Resources\Compagnie;

use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Ville\Pays;
use Filament\Tables\Table;
use App\Models\Ville\Ville;
use App\Models\Ville\Region;
use App\Models\Compagnie\Gare;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Compagnie\Resources\Compagnie\GareResource\Pages;
use App\Filament\Compagnie\Resources\Compagnie\GareResource\RelationManagers;
use App\Filament\Resources\RegionResource\RelationManagers\VillesRelationManager;

class GareResource extends Resource
{
    protected static ?string $model = Gare::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Compagnie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Position de la Gare')->schema([
                        Forms\Components\Select::make('pays_id')
                            ->options(fn (Get $get): Collection => Pays::all()->pluck('name', 'id'))
                            ->afterStateUpdated(fn (Set $set) => $set('region_id', null))
                            ->searchable()->native(false)->preload()->live()->label('Pays'),

                        Forms\Components\Select::make('region_id')
                            ->options(fn (Get $get): Collection => Region::where('pays_id', $get('pays_id'))->get()->pluck('name', 'id'))
                            ->searchable()->native(false)->preload()->live()->label('Region')
                            ->afterStateUpdated(fn (Set $set) => $set('ville_id', null)),

                        Forms\Components\Select::make('ville_id')
                            ->options(fn (Get $get): Collection => Ville::where('region_id', $get('region_id'))->get()->pluck('name', 'id'))
                            ->searchable()->native(false)->preload()->live()->label('Ville')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('lng')
                            ->id('lngField')
                            ->required()
                            ->numeric()
                            ->label('Longitude'),

                        Forms\Components\TextInput::make('lat')
                            ->id('latField')
                            ->required()
                            ->numeric()
                            ->label('Latitude')
                        ->prefixAction(Action::make('getLocation')
                            ->label('Détecter ma position')
                            ->action(fn () => request()->session()->flash('get-location', true))
                            ->icon('heroicon-o-rectangle-stack')),


                    ])->columns(2),

                    Step::make('Information de la Gare')->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\Select::make('statut_id')
                            ->relationship('statut', 'name')
                            ->searchable()->native(false)->preload()->label('Statut')
                            ->required(),
                    ])
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ville.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statut.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lng')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('lat')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('compagnie.name')
                    ->numeric()
                    ->sortable()
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
            Section::make('Information de la Gare')
                ->schema([
                    TextEntry::make('name')->label('Nom'),
                    TextEntry::make('ville.name')->label('Ville'),
                    TextEntry::make('ville.region.name')->label('Region'),
                    TextEntry::make('ville.region.pays.name')->label('Pays'),
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
            'index' => Pages\ListGares::route('/'),
            'create' => Pages\CreateGare::route('/create'),
            'view' => Pages\ViewGare::route('/{record}'),
            'edit' => Pages\EditGare::route('/{record}/edit'),
        ];
    }
}
