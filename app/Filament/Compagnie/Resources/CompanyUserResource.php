<?php

namespace App\Filament\Compagnie\Resources;

use App\Enums\CompanyRole;
use App\Enums\SexeUser;
use App\Enums\StatutUser;
use App\Mail\CompanyAccountActivationMail;
use App\Models\AccountActivation;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CompanyUserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Utilisateurs';

    protected static ?string $modelLabel = 'Utilisateur';

    protected static ?string $pluralModelLabel = 'Utilisateurs';

    protected static ?string $navigationGroup = 'Compagnie';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations personnelles')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Prénom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Adresse email')
                            ->email()
                            ->required()
                            ->unique(User::class, 'email', ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('sexe')
                            ->label('Sexe')
                            ->options(collect(SexeUser::cases())->mapWithKeys(fn ($s) => [$s->value => $s->value]))
                            ->required()
                            ->native(false),
                        Forms\Components\TextInput::make('numero')
                            ->label('Numéro de téléphone')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\TextInput::make('numero_identifiant')
                            ->label('Indicatif')
                            ->default('+226')
                            ->maxLength(10),
                    ])->columns(2),

                Forms\Components\Section::make('Rôles')
                    ->description('Attribuez un ou plusieurs rôles à cet utilisateur')
                    ->schema([
                        Forms\Components\CheckboxList::make('roles')
                            ->label('')
                            ->relationship('roles', 'label')
                            ->options(function () {
                                return Role::whereIn('name', CompanyRole::values())
                                    ->pluck('label', 'id');
                            })
                            ->columns(3)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $compagnieId = Auth::user()?->compagnie_id;

        return $table
            ->query(fn () => User::query()->where('compagnie_id', $compagnieId))
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.label')
                    ->label('Rôles')
                    ->badge()
                    ->separator(', '),
                Tables\Columns\TextColumn::make('statut')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (StatutUser $state): string => match ($state) {
                        StatutUser::Active => 'success',
                        StatutUser::EnAttente => 'warning',
                        StatutUser::Bloquer => 'danger',
                        StatutUser::Suspendre => 'gray',
                    }),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('Activé')
                    ->formatStateUsing(fn ($state) => $state ? 'Oui' : 'Non')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('statut')
                    ->options(collect(StatutUser::cases())->mapWithKeys(fn ($s) => [$s->value => $s->value])),
                Tables\Filters\SelectFilter::make('roles')
                    ->relationship('roles', 'label')
                    ->multiple()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('resend_activation')
                    ->label('Renvoyer le lien')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->visible(fn (User $record) => $record->email_verified_at === null)
                    ->requiresConfirmation()
                    ->modalHeading('Renvoyer le lien d\'activation')
                    ->modalDescription('Un nouveau lien d\'activation sera envoyé à cet utilisateur. L\'ancien lien sera invalidé.')
                    ->action(function (User $record) {
                        // Invalidate old activations
                        AccountActivation::where('user_id', $record->id)
                            ->whereNull('used_at')
                            ->update(['used_at' => now()]);

                        // Create new activation
                        $activation = AccountActivation::create([
                            'user_id' => $record->id,
                            'token' => Str::random(64),
                            'expires_at' => now()->addHours(24),
                        ]);

                        $companyName = Auth::user()->compagnie?->name ?? 'Votre entreprise';
                        Mail::to($record->email)->send(new CompanyAccountActivationMail($record, $activation, $companyName));

                        Notification::make()
                            ->title('Lien d\'activation renvoyé')
                            ->body("Un email a été envoyé à {$record->email}")
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('block')
                    ->label('Bloquer')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->visible(fn (User $record) => $record->statut !== StatutUser::Bloquer && $record->id !== Auth::id())
                    ->requiresConfirmation()
                    ->modalHeading('Bloquer cet utilisateur')
                    ->modalDescription(fn (User $record) => "Êtes-vous sûr de vouloir bloquer {$record->first_name} {$record->last_name} ? Il ne pourra plus accéder au système.")
                    ->modalSubmitActionLabel('Oui, bloquer')
                    ->action(function (User $record) {
                        $record->update(['statut' => StatutUser::Bloquer]);

                        Notification::make()
                            ->title('Utilisateur bloqué')
                            ->body("{$record->first_name} {$record->last_name} a été bloqué.")
                            ->warning()
                            ->send();
                    }),
                Tables\Actions\Action::make('unblock')
                    ->label('Débloquer')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (User $record) => $record->statut === StatutUser::Bloquer)
                    ->requiresConfirmation()
                    ->modalHeading('Débloquer cet utilisateur')
                    ->modalDescription(fn (User $record) => "Voulez-vous réactiver le compte de {$record->first_name} {$record->last_name} ?")
                    ->action(function (User $record) {
                        $record->update(['statut' => StatutUser::Active]);

                        Notification::make()
                            ->title('Utilisateur débloqué')
                            ->body("{$record->first_name} {$record->last_name} a été réactivé.")
                            ->success()
                            ->send();
                    }),
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
            Section::make('Informations personnelles')
                ->schema([
                    TextEntry::make('first_name')->label('Prénom'),
                    TextEntry::make('last_name')->label('Nom'),
                    TextEntry::make('email')->label('Email'),
                    TextEntry::make('numero')->label('Téléphone')
                        ->formatStateUsing(fn ($record) => ($record->numero_identifiant ?? '') . ' ' . ($record->numero ?? '')),
                    TextEntry::make('sexe')->label('Sexe'),
                    TextEntry::make('statut')->label('Statut')
                        ->badge()
                        ->color(fn (StatutUser $state): string => match ($state) {
                            StatutUser::Active => 'success',
                            StatutUser::EnAttente => 'warning',
                            StatutUser::Bloquer => 'danger',
                            StatutUser::Suspendre => 'gray',
                        }),
                ])->columns(2),
            Section::make('Rôles')
                ->schema([
                    TextEntry::make('roles.label')
                        ->label('Rôles attribués')
                        ->badge(),
                ]),
            Section::make('Dates')
                ->schema([
                    TextEntry::make('created_at')->label('Créé le')->dateTime('d/m/Y H:i'),
                    TextEntry::make('email_verified_at')->label('Activé le')
                        ->dateTime('d/m/Y H:i')
                        ->placeholder('Non activé'),
                ])->columns(2),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Compagnie\Resources\CompanyUserResource\Pages\ListCompanyUsers::route('/'),
            'create' => \App\Filament\Compagnie\Resources\CompanyUserResource\Pages\CreateCompanyUser::route('/create'),
            'view' => \App\Filament\Compagnie\Resources\CompanyUserResource\Pages\ViewCompanyUser::route('/{record}'),
            'edit' => \App\Filament\Compagnie\Resources\CompanyUserResource\Pages\EditCompanyUser::route('/{record}/edit'),
        ];
    }
}
