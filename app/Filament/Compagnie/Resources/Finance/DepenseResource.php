<?php

namespace App\Filament\Compagnie\Resources\Finance;

use App\Models\Finance\CategorieDepense;
use App\Models\Finance\Depense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DepenseResource extends Resource
{
    protected static ?string $model = Depense::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-down';

    protected static ?string $navigationLabel = 'Dépenses';

    protected static ?string $modelLabel = 'Dépense';

    protected static ?string $pluralModelLabel = 'Dépenses';

    protected static ?string $navigationGroup = 'Comptabilité';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Détails de la dépense')->schema([
                Forms\Components\TextInput::make('libelle')
                    ->label('Libellé')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ex: Achat carburant bus 01')
                    ->columnSpanFull(),
                Forms\Components\Select::make('categorie_depense_id')
                    ->label('Catégorie')
                    ->options(fn () => CategorieDepense::where('compagnie_id', Auth::user()?->compagnie_id)->pluck('nom', 'id'))
                    ->searchable()
                    ->preload()
                    ->placeholder('Sélectionner une catégorie')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nom')
                            ->label('Nom de la catégorie')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('description')
                            ->label('Description')
                            ->maxLength(255),
                    ])
                    ->createOptionUsing(function (array $data): int {
                        $data['compagnie_id'] = Auth::user()->compagnie_id;
                        return CategorieDepense::create($data)->getKey();
                    }),
                Forms\Components\TextInput::make('montant')
                    ->label('Montant (F CFA)')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->suffix('F CFA')
                    ->placeholder('0'),
                Forms\Components\DatePicker::make('date_depense')
                    ->label('Date')
                    ->required()
                    ->default(now())
                    ->maxDate(now()),
            ])->columns(2),

            Forms\Components\Section::make('Informations complémentaires')
                ->schema([
                    Forms\Components\TextInput::make('reference')
                        ->label('N° Référence / Reçu')
                        ->maxLength(255)
                        ->placeholder('Numéro de facture ou reçu (optionnel)'),
                    Forms\Components\Textarea::make('note')
                        ->label('Note')
                        ->rows(2)
                        ->placeholder('Remarques ou détails supplémentaires...')
                        ->columnSpanFull(),
                ])->columns(2)
                ->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('date_depense', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('date_depense')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('libelle')
                    ->label('Libellé')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('categorie.nom')
                    ->label('Catégorie')
                    ->badge()
                    ->color('warning')
                    ->placeholder('Non classée'),
                Tables\Columns\TextColumn::make('montant')
                    ->label('Montant')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', ' ') . ' F CFA')
                    ->sortable()
                    ->color('danger')
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
                Tables\Filters\SelectFilter::make('categorie_depense_id')
                    ->label('Catégorie')
                    ->options(fn () => CategorieDepense::where('compagnie_id', Auth::user()?->compagnie_id)->pluck('nom', 'id'))
                    ->preload(),
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')->label('Du'),
                        Forms\Components\DatePicker::make('date_to')->label('Au'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['date_from'], fn ($q, $date) => $q->where('date_depense', '>=', $date))
                            ->when($data['date_to'], fn ($q, $date) => $q->where('date_depense', '<=', $date));
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
            'index' => \App\Filament\Compagnie\Resources\Finance\DepenseResource\Pages\ListDepenses::route('/'),
            'create' => \App\Filament\Compagnie\Resources\Finance\DepenseResource\Pages\CreateDepense::route('/create'),
            'edit' => \App\Filament\Compagnie\Resources\Finance\DepenseResource\Pages\EditDepense::route('/{record}/edit'),
        ];
    }
}
