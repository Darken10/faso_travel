# 05 — Spécification des APIs

Synthèse basée sur `docs/api.md`, `docs/api-endpoints.md`, `docs/api-v2-documentation.md`, `routes/api.php`, `routes/api-v2.php`.

## Authentification
- V1: `/api/auth/register`, `/api/auth/login`, `/api/auth/me` (Sanctum)
- V2: `/api/v2/auth/*` (register, login, logout, send-otp, verify-otp, forgot-password, reset-password)

## Voyages
- V1: `/api/voyages` (liste), endpoints user pour details/tickets (protégés)
- V2: `/api/v2/trips` (index, show, seats, search)

## Tickets
- V1 (compagnie): `/api/compagnie/voyages/*` (index, show-with-passagers, instance-details)
- V1 (validation): `/api/ticket/verification/*`, `POST /api/ticket/valider`
- V1 (achat): `POST /api/tickets/{voyageInstance}` (début achat)
- V2 (user): `/api/v2/tickets` (index, show, store, cancel, transfer, qr-code)

## Paiements
- `POST /api/process-payment/{provider}`
- Web callbacks: `/process-payment/{ticket}/{provider}/(success|cancel|callback)` dans `routes/web.php`

## Posts & Articles
- Posts (V1): `GET /api/posts`, like/unlike, comments
- Articles (V2): `GET /api/v2/articles`, `/{id}`, like, comments, `categories`

## Notifications (V2)
- `/api/v2/notifications` (index, mark-as-read, mark-all-as-read, delete, delete-all)

## AuthZ & Sécurité
- Sanctum obligatoire sauf endpoints publics. Token Bearer requis.

Voir les docs dans `docs/` pour formats d’entrée/sortie détaillés et les patterns d’erreur V2.
