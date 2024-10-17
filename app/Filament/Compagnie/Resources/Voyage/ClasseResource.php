<?php

namespace App\Filament\Compagnie\Resources\Voyage;

use App\Filament\Compagnie\Resources\ClasseResource\RelationManagers\ConfortsRelationManager;
use App\Filament\Compagnie\Resources\Voyage\ClasseResource\Pages;
use App\Filament\Compagnie\Resources\Voyage\ClasseResource\RelationManagers;
use App\Models\Voyage\Classe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ClasseResource extends Resource
{
    protected static ?string $model = Classe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        $users = \auth()->user()->compagnie->users->pluck('id')->toArray();
        return $table
            ->query(fn () =>  Classe::query()->whereIn('user_id',$users))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->placeholder('Pas de description.')
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            Section::make('Information de la classe')
                ->description('les informations de la classe de voyage')
                ->schema([
                    TextEntry::make('name')->label('Nom'),
                    TextEntry::make('description')->label('La Description')
                        ->placeholder('Pas de description.'),
                ])->columnSpanFull(),

        ]);
    }

    public static function getRelations(): array
    {
        return [
            ConfortsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClasses::route('/'),
            'create' => Pages\CreateClasse::route('/create'),
            'view' => Pages\ViewClasse::route('/{record}'),
            'edit' => Pages\EditClasse::route('/{record}/edit'),
        ];
    }



}
