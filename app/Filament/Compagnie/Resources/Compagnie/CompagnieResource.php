<?php

namespace App\Filament\Compagnie\Resources\Compagnie;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Models\Compagnie\Compagnie;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Compagnie\Resources\Compagnie\CompagnieResource\Pages;
use App\Filament\Compagnie\Resources\Compagnie\CompagnieResource\RelationManagers;
use App\Filament\Compagnie\Resources\CompagnieResource\RelationManagers\GaresRelationManager;

class CompagnieResource extends Resource
{
    protected static ?string $model = Compagnie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Information')->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom de la Compagnie')
                            ->required(),
                        Forms\Components\TextInput::make('sigle')
                            ->label('Le Sigle')
                            ->required(),
                        Forms\Components\TextInput::make('slogant')
                            ->label('Le Slogant')
                            ->columnSpanFull(),
                    ])->columns(2),
                    Step::make('La description')->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('La Description ')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('user_id')
                            ->options([auth()->user()->id => auth()->user()->name])
                            ->default(auth()->user()->id)
                            ->native(False)
                            ->label('Auteur'),
                    ]),
                    Step::make('Information Supplementaire')->schema([
                        Forms\Components\FileUpload::make('logo_uri')
                            ->label('Le Logo')
                            ->image()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('statut_id')
                            ->relationship('statut', 'name')
                            ->required()
                            ->default(2)
                            ->native(False)
                            ->label('Statut'),
                    ])->columns(2),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_uri')->label('Logo'),
                Tables\Columns\TextColumn::make('name')->label('Nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sigle')->label('Sigle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('statut.name')->label('Statut')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Activer' => 'success',
                        'Désactiver' => 'gray',
                        'Pause' => 'warning',
                        'Bloquer' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('slogant')
                    ->searchable()
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
            Section::make('Information de la Compagnie')
                ->schema([
                    ImageEntry::make('logo_uri')->label('Logo')->columnSpanFull(),
                    TextEntry::make('name')->label('Nom de la Compagnie'),
                    TextEntry::make('sigle')->label('Sigle'),
                    TextEntry::make('slogant')->label('Slogant')->columnSpanFull(),
                ])->columns(2),
            Section::make('Information Supplementaire')
                ->schema([
                    TextEntry::make('description')->label('La description')->html()->columnSpanFull(),
                    TextEntry::make('statut.name')->label('Statut')->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Activer' => 'success',
                            'Désactiver' => 'gray',
                            'Pause' => 'warning',
                            'Bloquer' => 'danger',
                        }),
                    TextEntry::make('user.name')->label('Auteur'),
                ])->columns(2),
        ]);
    }



    public static function getRelations(): array
    {
        return [
            GaresRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompagnies::route('/'),
            //'create' => Pages\CreateCompagnie::route('/create'),
            'view' => Pages\ViewCompagnie::route('/{record}'),
            'edit' => Pages\EditCompagnie::route('/{record}/edit'),
        ];
    }
}
