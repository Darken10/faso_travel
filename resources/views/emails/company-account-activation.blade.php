@component('mail::message')
# Bienvenue {{ $userName }} !

Un compte a été créé pour vous au sein de **{{ $companyName }}** sur la plateforme **{{ config('app.name') }}**.

**Vos rôles :** {{ $roles ?: 'Non définis' }}

Pour activer votre compte et définir votre mot de passe, cliquez sur le bouton ci-dessous :

@component('mail::button', ['url' => $activationUrl, 'color' => 'primary'])
Activer mon compte
@endcomponent

Ce lien est valide jusqu'au **{{ $expiresAt }}** (24 heures).

Si vous n'avez pas demandé la création de ce compte, vous pouvez ignorer cet email.

Cordialement,<br>
L'équipe {{ config('app.name') }}
@endcomponent
