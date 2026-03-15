<?php

namespace App\Filament\Compagnie\Resources\CompanyUserResource\Pages;

use App\Enums\StatutUser;
use App\Enums\UserRole;
use App\Filament\Compagnie\Resources\CompanyUserResource;
use App\Mail\CompanyAccountActivationMail;
use App\Models\AccountActivation;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreateCompanyUser extends CreateRecord
{
    protected static string $resource = CompanyUserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['compagnie_id'] = Auth::user()->compagnie_id;
        $data['role'] = UserRole::CompagnieBosse->value;
        $data['statut'] = StatutUser::EnAttente->value;
        // Random password — user won't know it but will set their own via activation
        $data['password'] = Hash::make(Str::random(32));

        return $data;
    }

    protected function afterCreate(): void
    {
        $user = $this->record;

        // Create activation token
        $activation = AccountActivation::create([
            'user_id' => $user->id,
            'token' => Str::random(64),
            'expires_at' => now()->addHours(24),
        ]);

        // Send activation email
        $companyName = Auth::user()->compagnie?->name ?? 'Votre entreprise';
        Mail::to($user->email)->send(new CompanyAccountActivationMail($user, $activation, $companyName));
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Utilisateur créé — un email d\'activation a été envoyé';
    }
}
