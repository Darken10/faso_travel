<?php

namespace App\Filament\Resources;

use App\Enums\CompagnieSettingKey;
use App\Filament\Resources\CompagnieSettingResource\Pages;
use App\Filament\Resources\CompagnieSettingResource\RelationManagers;
use App\Models\CompagnieSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompagnieSettingResource extends Resource
{
    protected static ?string $model = CompagnieSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('compagnie_id')
                ->relationship('compagnie', 'name') // ou autre champ
                ->required(),

            Forms\Components\Select::make('key')
                ->options(array_combine(
                    CompagnieSettingKey::values(),
                    CompagnieSettingKey::values()
                ))
                ->required(),

            Forms\Components\TextInput::make('value')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('compagnie.nom'),
                Tables\Columns\TextColumn::make('key'),
                Tables\Columns\TextColumn::make('value'),
            ])
            ->defaultSort('compagnie_id')
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
            'index' => Pages\ListCompagnieSettings::route('/'),
            'create' => Pages\CreateCompagnieSetting::route('/create'),
            'edit' => Pages\EditCompagnieSetting::route('/{record}/edit'),
        ];
    }
}
