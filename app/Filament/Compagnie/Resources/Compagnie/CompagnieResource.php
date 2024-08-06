<?php

namespace App\Filament\Compagnie\Resources\Compagnie;

use App\Filament\Compagnie\Resources\Compagnie\CompagnieResource\Pages;
use App\Filament\Compagnie\Resources\Compagnie\CompagnieResource\RelationManagers;
use App\Models\Compagnie\Compagnie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompagnieResource extends Resource
{
    protected static ?string $model = Compagnie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('sigle')
                    ->required(),
                Forms\Components\TextInput::make('slogant'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('logo_uri'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name'),
                Forms\Components\Select::make('statut_id')
                    ->relationship('statut', 'name')
                    ->required()
                    ->default(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sigle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slogant')
                    ->searchable(),
                Tables\Columns\TextColumn::make('logo_uri')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statut.name')
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
            'index' => Pages\ListCompagnies::route('/'),
            'create' => Pages\CreateCompagnie::route('/create'),
            'view' => Pages\ViewCompagnie::route('/{record}'),
            'edit' => Pages\EditCompagnie::route('/{record}/edit'),
        ];
    }
}
