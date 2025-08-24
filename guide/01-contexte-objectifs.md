# 01 — Contexte et objectifs

## Contexte
- Projet: « Faso Travel » — plateforme de réservation de voyages et gestion de tickets.
- Backend: Laravel 11, API REST, interfaces web sécurisées.
- Fronts consommateurs: application mobile (Liptra), interface web client, panneaux admin/compagnie (Filament) selon `composer.json` et `routes/web.php`.

## Problématique
- Numériser la recherche de trajets, la réservation et le paiement.
- Dématérialiser le ticket (QR Code) et sécuriser la validation.
- Fournir des APIs stables (V1 + V2) pour apps mobiles et partenaires.

## Objectifs généraux
- Permettre aux utilisateurs de: chercher, réserver, payer, gérer et transférer des tickets.
- Permettre aux compagnies: gérer voyages, consulter passagers, valider tickets.
- Assurer une API versionnée: `routes/api.php` et `routes/api-v2.php`.
- Garantir performance, traçabilité (Horizon, logs), sécurité (Sanctum).

## Périmètre MVP
- Authentification/inscription (Sanctum), OTP (V2), profil utilisateur.
- Catalogue voyages, instances, sièges disponibles.
- Tunnel d’achat, paiement via providers (`/api/process-payment/{provider}`), génération QR.
- Espace tickets (liste, détails, pause/annulation, transfert).
- Notifications utilisateur.
- Back-office validation ticket et vue compagnies.

## Hors-périmètre (initial)
- Multi-devise avancée, ref. comptable complète, marketplace multi-compagnies (partenaires externes), analytics avancées.
