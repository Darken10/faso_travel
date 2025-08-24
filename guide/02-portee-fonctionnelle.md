# 02 — Portée fonctionnelle

## Acteurs
- Utilisateur (client)
- Compagnie (opérateur)
- Administrateur

## Parcours utilisateur (web/app)
- Découverte voyages: liste/filtre `GET /api/voyages`, `GET /api/v2/trips`.
- Détails voyage: horaires, sièges `GET /api/v2/trips/{id}`, `seats`.
- Réservation/achat: `POST /api/v2/tickets` ou `/tickets/{voyageInstance}`.
- Paiement: `POST /api/process-payment/{provider}`; callbacks succès/annulation (`routes/web.php`).
- Ticket: liste/détails, QR code, pause/annulation, transfert.
- Notifications: liste, marquer comme lues (`/api/v2/notifications`).

## Parcours compagnie/opérateur
- Vue voyages et passagers: `/api/compagnie/voyages`, `show-with-passagers`, `instance-details`.
- Validation ticket: `/validation/*` (web) et `/api/ticket/*` (QR/numéro/valider).

## Gestion de contenu (Articles/Posts)
- Articles (V2): liste, détails, like, commentaires, catégories (`routes/api-v2.php`).
- Posts (V1): like/unlike, commentaires (`routes/api.php`).

## Règles métier clés
- Un ticket est associé à une `voyageInstance` et un siège.
- Statuts ticket: valid/pause/blocked/used/upcoming/past/cancelled (réf. `docs/api-architecture.md`).
- Achat pour soi ou pour autrui (collecte identité/numéro). Transfert avec infos receveur.
- Validation par QR ou couple (ticket_id, numero_ticket). Traçabilité des validations.
- Créneaux/instances générées via `VoyageInstanceController::createAllInstance()`.

## Notifications
- Événements: achat, paiement, annulation, validation, messages système.

## Internationalisation
- Français par défaut. Extension possible ultérieure.
