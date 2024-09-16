<?php

namespace App\Filament\Resources\Compagnie;

use App\Filament\Resources\Compagnie\CompagnieResource\Pages;
use App\Filament\Resources\Compagnie\CompagnieResource\RelationManagers;
use App\Models\Compagnie\Compagnie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
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
                Forms\Components\TextInput::make('slogant')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('logo_uri')
                ->image()->imageEditor()->nullable(),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Information de la Gare')
                ->schema([
                    TextEntry::make('name')->label('Nom'),
                    TextEntry::make('sigle')->label('Sigle'),
                    TextEntry::make('slogant')->label('Slogant'),
                    TextEntry::make('statut.name')->label('StatutTicket'),
                    ImageEntry::make('logo_uri')->label('Logo')->columnSpanFull(),
                    TextEntry::make('description')->label('Description')->columnSpanFull(),
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
            'index' => Pages\ListCompagnies::route('/'),
            'create' => Pages\CreateCompagnie::route('/create'),
            'view' => Pages\ViewCompagnie::route('/{record}'),
            'edit' => Pages\EditCompagnie::route('/{record}/edit'),
        ];
    }
}
