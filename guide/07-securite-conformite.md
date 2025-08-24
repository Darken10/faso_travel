# 07 — Sécurité & conformité

## Authentification/Autorisation
- Sanctum pour tokens API. Cookies/sessions pour web (Jetstream, `routes/web.php`).
- Rôles: utilisateur, opérateur (compagnie), admin. Contrôles via middlewares/policies (à compléter selon `app/`).

## Données & confidentialité
- Données personnelles: profil, téléphone, historique voyages, notifications.
- Journalisation des accès sensibles (validation ticket/paiement).
- Conservation minimale, droit de suppression (prévoir endpoints/UX).

## Communications
- HTTPS obligatoire, HSTS recommandé.
- Webhooks/callbacks paiement: signature/secret par provider.

## Anti-abus
- Rate limiting sur endpoints sensibles (auth, paiement, validation).
- CSRF sur web, CORS restreint pour API.

## Secrets & clés
- Gestion via `.env` (Twilio, Pusher, paiement, DB). Jamais en dépôt.

## Conformité
- Alignement RGPD (minimisation, consentement, rétention, export/suppression à prévoir).
