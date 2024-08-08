<?php

namespace App\Filament\Compagnie\Resources\Compagnie;

use Filament\Forms;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Position de la Gare')->schema([
                            Forms\Components\Select::make('pays_id')
                                ->options(fn (Get $get): Collection => Pays::all()->pluck('name', 'id'))
                                ->afterStateUpdated(fn (Set $set) => $set('region_id', null))
                                ->searchable()->native(False)->preload()->live()->label('Pays'),
                                //->hiddenOn(VillesRelationManager::class),
                            Forms\Components\Select::make('region_id')
                                ->options(fn (Get $get): Collection => Region::where('pays_id', $get('pays_id'))->get()->pluck('name', 'id'))
                                ->searchable()->native(False)->preload()->live()->label('Region')
                                ->afterStateUpdated(fn (Set $set) => $set('ville_id', null)),
                                //->hiddenOn(VillesRelationManager::class),
                            Forms\Components\Select::make('ville_id')
                                ->options(fn (Get $get): Collection => Ville::where('region_id', $get('region_id'))->get()->pluck('name', 'id'))
                                ->searchable()->native(False)->preload()->live()->label('Ville')
                                ->columnSpanFull(),
                                //->hiddenOn(VillesRelationManager::class),
                            
                            Forms\Components\TextInput::make('lng')
                                ->required()
                                ->numeric(),
                            Forms\Components\TextInput::make('lat')
                                ->required()
                                ->numeric(),
                        
                    ])->columns(2),
                    Step::make('Information de la Gare')->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(), 
                        Forms\Components\Select::make('statut_id')
                            ->relationship('statut', 'name')
                            ->searchable()->native(False)->preload()->label('Statut')
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->options([auth()->user()->id,auth()->user()->name])
                            ->searchable()->native(False)->preload()->label('Auteur')
                            ->required(),
                        Forms\Components\Select::make('compagnie_id')
                            ->relationship('compagnie', 'name')
                            ->searchable()->native(False)->preload()->label('Compagnie'),
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
                Tables\Columns\TextColumn::make('lng')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lat')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ville.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statut.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('compagnie.name')
                    ->numeric()
                    ->sortable(),
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
