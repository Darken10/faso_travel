<?php

namespace App\Filament\Compagnie\Resources\Voyage;

use App\Filament\Compagnie\Resources\Voyage\TrajetResource\Pages;
use App\Filament\Compagnie\Resources\Voyage\TrajetResource\RelationManagers;
use App\Models\Ville\Ville;
use App\Models\Voyage\Trajet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class TrajetResource extends Resource
{
    protected static ?string $model = Trajet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Voyage';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('depart_id')
                    ->options(fn (Get $get): Collection => Ville::query()->where('id','!=',$get('arrive_id'))->pluck('name', 'id'))
                    ->label('Depart')
                    ->native(False)
                    ->preload()->live()->searchable()
                    ->required(),
                Forms\Components\Select::make('arriver_id')
                    ->options(fn (Get $get): Collection => Ville::query()->where('id','!=',$get('depart_id'))->pluck('name', 'id'))
                    ->label('Destination')
                    ->native(False)
                    ->preload()->live()->searchable()
                    ->required(),
                Forms\Components\TextInput::make('distance')
                    ->numeric()
                    ->label('Distance')
                    ->postfix('Km')
                    ->default(0),
                Forms\Components\TimePicker::make('temps')
                    ->label('La Durée')
                    ->native(False),
                Forms\Components\TextInput::make('etat')
                    ->label('L\'Etat')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('depart.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('arriver.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('distance')
                    ->numeric()
                    ->sortable()
                ->suffix(' Km'),
                Tables\Columns\TextColumn::make('temps'),
                Tables\Columns\TextColumn::make('etat')
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


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Information du trajet')
                ->schema([
                    TextEntry::make('depart.name')->label('Depart'),
                    TextEntry::make('arriver.name')->label('Arriver'),
                    TextEntry::make('distance')->label('Distance'),
                    TextEntry::make('temps')->label('Durée Moyenne'),
                    TextEntry::make('etat')->label('Etat de la route')->suffix('/10'),

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
            'index' => Pages\ListTrajets::route('/'),
            'create' => Pages\CreateTrajet::route('/create'),
            'view' => Pages\ViewTrajet::route('/{record}'),
            'edit' => Pages\EditTrajet::route('/{record}/edit'),
        ];
    }
}
