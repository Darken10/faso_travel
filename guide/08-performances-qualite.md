# 08 — Performances & Qualité

## Performance
- Cache config/route/view, OPCache en prod.
- Base de données: indexes sur clés de recherche (voyageInstanceId, userId, ticket_code, etc.).
- Files/Queues (Horizon) pour tâches lourdes: PDF/QR, envoi mails/SMS, notifications.
- Pagination systématique sur listes (articles, voyages, tickets, notifications).

## Observabilité
- Logs Laravel + Horizon dashboard.
- APM/Monitoring (optionnel): Laravel Telescope, Sentry.

## Qualité
- Validation serveur stricte (FormRequest).
- Linting: Laravel Pint.
- Tests: PHPUnit (unitaires, feature API), voir `tests/`.
- Revue de code et CI (à définir).
