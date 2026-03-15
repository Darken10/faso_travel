<?php

namespace App\Filament\Compagnie\Resources\Finance;

use App\Models\Finance\CategorieDepense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class CategorieDepenseResource extends Resource
{
    protected static ?string $model = CategorieDepense::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Catégories';

    protected static ?string $modelLabel = 'Catégorie de dépense';

    protected static ?string $pluralModelLabel = 'Catégories de dépenses';

    protected static ?string $navigationGroup = 'Comptabilité';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nom')
                ->label('Nom de la catégorie')
                ->required()
                ->maxLength(255)
                ->placeholder('Ex: Carburant, Entretien...'),
            Forms\Components\TextInput::make('description')
                ->label('Description')
                ->maxLength(255)
                ->placeholder('Description courte (optionnel)'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')
                    ->label('Catégorie')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('depenses_count')
                    ->label('Nb dépenses')
                    ->counts('depenses')
                    ->sortable(),
                Tables\Columns\TextColumn::make('depenses_sum_montant')
                    ->label('Total dépensé')
                    ->sum('depenses', 'montant')
                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', ' ') . ' F CFA')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('compagnie_id', Auth::user()?->compagnie_id);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Compagnie\Resources\Finance\CategorieDepenseResource\Pages\ListCategorieDepenses::route('/'),
            'create' => \App\Filament\Compagnie\Resources\Finance\CategorieDepenseResource\Pages\CreateCategorieDepense::route('/create'),
            'edit' => \App\Filament\Compagnie\Resources\Finance\CategorieDepenseResource\Pages\EditCategorieDepense::route('/{record}/edit'),
        ];
    }
}
