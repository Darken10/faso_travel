<?php

namespace App\Filament\Compagnie\Resources\Voyage;

use App\Enums\JoursSemain;
use App\Filament\Compagnie\Resources\Voyage\VoyageResource\Pages;
use App\Filament\Compagnie\Resources\Voyage\VoyageResource\RelationManagers;
use App\Models\Compagnie\Gare;
use App\Models\Ville\Ville;
use App\Models\Voyage\Classe;
use App\Models\Voyage\Voyage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class VoyageResource extends Resource
{
    protected static ?string $model = Voyage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Voyage';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ville_depart')
                    ->options(fn(Get $get):Collection => Ville::all()->where('id','!=',$get('ville_arrive'))->pluck('name', 'id'))
                    ->native(False)->searchable()->preload()
                    ->required(),
                Forms\Components\Select::make('ville_arrive')
                    ->options(fn(Get $get):Collection => Ville::all()->where('id','!=',$get('ville_depart'))->pluck('name', 'id'))
                    ->native(False)->searchable()->preload()
                    ->required(),
                Forms\Components\Select::make('depart_id')
                    ->options(fn(Get $get):Collection => Gare::query()->where('ville_id',$get('ville_depart'))->where('statut_id',1)->pluck('name', 'id'))
                    ->label('Gare de  Depart')
                    ->native(False)->searchable()->preload()
                    ->required(),
                Forms\Components\Select::make('arrive_id')
                    ->options(fn(Get $get):Collection => Gare::query()->where('ville_id',$get('ville_arrive'))->where('statut_id',1)->pluck('name', 'id'))
                    ->label('Gare d\'Arrive')
                    ->native(False)->searchable()->preload()
                    ->required(),
                Forms\Components\Select::make('statut_id')
                    ->relationship('statut', 'name')
                    ->label('Statut')
                    ->native(False)->searchable()->preload()
                    ->required(),
                Forms\Components\TimePicker::make('heure')
                    ->required(),
                Forms\Components\Select::make('compagnie_id')
                    ->relationship('compagnie', 'name')
                    ->required(),
                Forms\Components\TextInput::make('prix')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('nb_pace')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('days')
                    ->options(JoursSemain::values())
                    ->native(False)->searchable()->preload()
                    ->multiple()
                    ->required(),
                Forms\Components\Select::make('classe_id')
                    ->options(fn(Get $get):Collection => \Auth::user()->compagnie->classes->pluck('name', 'id'))
                    ->native(False)->searchable()->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('trajet.depart.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('trajet.arriver.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('depart.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('arrive.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('heure')->time('H\h i\m\n'),

                Tables\Columns\TextColumn::make('prix')->money('F CFA')->suffix(' F CFA')
                    ->numeric()
                    ->sortable(),
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
            Section::make('Information du Voyage')
                ->schema([
                    TextEntry::make('compagnie.name')->columnSpanFull(),
                    TextEntry::make('trajet.depart.name')->label('Depart'),
                    TextEntry::make('trajet.arriver.name')->label('Arriver'),
                    TextEntry::make('depart.name')->label('Gare de Depart'),
                    TextEntry::make('arrive.name')->label('Gare de d\'Arrive'),
                    TextEntry::make('heure')->label('Heure de Depart'),
                    TextEntry::make('trajet.distance')->label('Distance'),
                    TextEntry::make('prix')->label('Prix'),
                    TextEntry::make('statut.name')->label('Statut Voyage'),
                    TextEntry::make('days')->label('Les Jours'),

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
            'index' => Pages\ListVoyages::route('/'),
            'create' => Pages\CreateVoyage::route('/create'),
            'view' => Pages\ViewVoyage::route('/{record}'),
            'edit' => Pages\EditVoyage::route('/{record}/edit'),
        ];
    }
}
