<?php

namespace App\Filament\Compagnie\Resources\Compagnie;

use App\Enums\StatutCare;
use App\Filament\Compagnie\Resources\Compagnie\CareResource\Pages;
use App\Filament\Compagnie\Resources\Compagnie\CareResource\RelationManagers;
use App\Models\Compagnie\Care;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
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

class CareResource extends Resource
{
    protected static ?string $model = Care::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Compagnie';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Information du Car')
                    ->description("Les informatin du car en question")
                ->schema([
                    Forms\Components\TextInput::make('immatrculation')
                        ->required()
                        ->maxLength(20)
                        ->minLength(4),

                    Forms\Components\TextInput::make('number_place')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(200)
                        ->label('Nombre de place')
                        ->default(1),

                    Forms\Components\Select::make('statut')
                        ->required()
                        ->options(StatutCare::valuesString())
                        ->native(false)
                        ->preload(),

                    Forms\Components\TextInput::make('etat')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(10)
                        ->label('Etat')
                        ->default(20),

                    Forms\Components\FileUpload::make('image_uri')
                        ->label("Image du care")
                        ->image()->imageEditor()->columnSpanFull(),

                ])->columns()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('immatrculation'),
                Tables\Columns\TextColumn::make('number_place'),
                Tables\Columns\TextColumn::make('statut'),
                Tables\Columns\TextColumn::make('etat')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Information du Care')
                ->schema([
                    ImageEntry::make('image_uri')->columnSpanFull()->label("Image du care")->placeholder("Non definie"),
                    TextEntry::make('immatrculation')->label('Immatriculation'),
                    TextEntry::make('number_place')->label('Nombre de place'),
                    TextEntry::make('statut')->label('Statut'),
                    TextEntry::make('etat')->label('Etat')
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
            'index' => Pages\ListCares::route('/'),
            'create' => Pages\CreateCare::route('/create'),
            'edit' => Pages\EditCare::route('/{record}/edit'),
            'view' => Pages\ViewCare::route('/{record}'),
        ];
    }
}
