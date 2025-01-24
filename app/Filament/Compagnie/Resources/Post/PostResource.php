<?php

namespace App\Filament\Compagnie\Resources\Post;

use App\Filament\Compagnie\Resources\Post\PostResource\Pages;
use App\Filament\Compagnie\Resources\Post\PostResource\RelationManagers;
use App\Models\Post\Post;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Articles & Publications';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('content')
                    ->required(),
                Forms\Components\FileUpload::make('images_uri')
                    ->image()->imageEditor(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                    ])->required()->preload()->searchable(),
                Forms\Components\Select::make('tags')->multiple()
                    ->relationship('tags', 'name')
                    ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                ])->preload()->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nb_views')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
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
            Section::make('Information de la Publicité')
                ->schema([
                    TextEntry::make('title')->label('Titre'),
                    TextEntry::make('category.name')->label('Categorie'),
                    TextEntry::make('tags.name')->label('Etiquette')->columnSpanFull(),
                    TextEntry::make('content')->label('Contenu')->columnSpanFull(),
                    ImageEntry::make('images_uri')->label('Image')->columnSpanFull(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
