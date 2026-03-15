<?php

namespace App\Filament\Compagnie\Resources\Finance;

use App\Models\Finance\Recette;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RecetteResource extends Resource
{
    protected static ?string $model = Recette::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    protected static ?string $navigationLabel = 'Recettes';

    protected static ?string $modelLabel = 'Recette';

    protected static ?string $pluralModelLabel = 'Recettes';

    protected static ?string $navigationGroup = 'Comptabilité';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Détails de la recette')->schema([
                Forms\Components\TextInput::make('libelle')
                    ->label('Libellé')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ex: Location bus mariage Koudougou')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('montant')
                    ->label('Montant (F CFA)')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->suffix('F CFA')
                    ->placeholder('0'),
                Forms\Components\DatePicker::make('date_recette')
                    ->label('Date')
                    ->required()
                    ->default(now())
                    ->maxDate(now()),
                Forms\Components\TextInput::make('source')
                    ->label('Source / Provenance')
                    ->maxLength(255)
                    ->placeholder('Ex: Location bus, Bagages, Colis...'),
                Forms\Components\TextInput::make('reference')
                    ->label('N° Référence / Reçu')
                    ->maxLength(255)
                    ->placeholder('Optionnel'),
            ])->columns(2),

            Forms\Components\Section::make('Note')
                ->schema([
                    Forms\Components\Textarea::make('note')
                        ->label('Note')
                        ->rows(2)
                        ->placeholder('Remarques ou détails supplémentaires...')
                        ->columnSpanFull(),
                ])
                ->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('date_recette', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('date_recette')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('libelle')
                    ->label('Libellé')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('source')
                    ->label('Source')
                    ->badge()
                    ->color('info')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('montant')
                    ->label('Montant')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', ' ') . ' F CFA')
                    ->sortable()
                    ->color('success')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('reference')
                    ->label('Réf.')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.first_name')
                    ->label('Enregistré par')
                    ->formatStateUsing(fn ($record) => $record->user?->first_name . ' ' . $record->user?->last_name)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')->label('Du'),
                        Forms\Components\DatePicker::make('date_to')->label('Au'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['date_from'], fn ($q, $date) => $q->where('date_recette', '>=', $date))
                            ->when($data['date_to'], fn ($q, $date) => $q->where('date_recette', '<=', $date));
                    }),
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

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Compagnie\Resources\Finance\RecetteResource\Pages\ListRecettes::route('/'),
            'create' => \App\Filament\Compagnie\Resources\Finance\RecetteResource\Pages\CreateRecette::route('/create'),
            'edit' => \App\Filament\Compagnie\Resources\Finance\RecetteResource\Pages\EditRecette::route('/{record}/edit'),
        ];
    }
}
