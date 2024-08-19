<?php

namespace App\Filament\Resources\Ville;

use Filament\Forms;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Ville\Pays;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Ville\PaysResource\Pages;
use App\Filament\Resources\Ville\PaysResource\RelationManagers;
use App\Filament\Resources\PaysResource\RelationManagers\RegionsRelationManager;

class PaysResource extends Resource
{
    protected static ?string $model = Pays::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationGroup = 'Gestion des Villes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('money')
                    ->required(),
                Forms\Components\TextInput::make('identity_number')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('iso2')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('money')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identity_number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('iso2')
                    ->searchable(),
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
           Section::make("Informations")
            ->schema([
                TextEntry::make('name'),
                TextEntry::make('money'),
                TextEntry::make('identity_number'),
                TextEntry::make('iso2'),
            ])->columns(2),

        ]);
    }

    public static function getRelations(): array
    {
        return [
            RegionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPays::route('/'),
            'create' => Pages\CreatePays::route('/create'),
            'view' => Pages\ViewPays::route('/{record}'),
            'edit' => Pages\EditPays::route('/{record}/edit'),
        ];
    }
}
