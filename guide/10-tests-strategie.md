# 10 — Stratégie de tests

## Pyramide de tests
- Unitaires: Services, Helpers, Rules, Policies.
- Intégration/Feature: Endpoints API (`routes/api.php`, `api-v2.php`), middlewares, paiement.
- E2E (optionnel): scénarios achat->paiement->validation.

## Outils
- PHPUnit ^11, Mockery.
- Factories/Seeders (`database/factories`, `database/seeders`).

## Données de test
- Utiliser factories pour Users, Voyages, VoyageInstances, Tickets, Articles.
- Jeux réalistes pour cas limites (sièges épuisés, annulations, transferts, callbacks partiels).

## Automatisation
- CI: exécuter lint + tests, coverage minimal.
