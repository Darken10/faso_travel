# 04 — Architecture technique

## Stack
- Framework: Laravel ^11.9 (`composer.json`)
- Auth: Sanctum ^4.0, Jetstream ^5.1 (sessions, vérification email), Socialite ^5.15
- Admin/UI: Filament ^3.2, Livewire ^3.5
- Files/Images: Intervention Image ^3.8
- PDF/Export: barryvdh/laravel-dompdf ^3.0, spatie/browsershot ^4.3
- QR Code: endroid/qr-code ^5.1
- Temps réel / Push: pusher/pusher-php-server ^7.2
- File/Queue: Laravel Horizon ^5.31
- SMS/Voix: twilio/sdk ^8.4

## Modules principaux
- API V1: `routes/api.php`
- API V2: `routes/api-v2.php`
- Web: `routes/web.php` (tickets, paiement, validation, compagnies, pages légales)

## Organisation
- Domaines fonctionnels sous `app/Http/Controllers/...`
- Enums sous `app/Enums/`
- Migrations/Seeders sous `database/`
- Vues sous `resources/views/`

## Asynchrone et workers
- Horizon pour file d’attente (génération PDF/QR, envoi notification/SMS, traitements paiement)

## Config & env
- Fichiers `config/*.php` et `.env` pour clés providers (Pusher, Twilio, paiement), DB, cache, queue.

## Logging & observabilité
- Laravel log + debugbar (dev). Ajout conseillé: structured logging, Sentry (optionnel).
