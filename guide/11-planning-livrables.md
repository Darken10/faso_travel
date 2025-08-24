# 11 — Planning & livrables

## Jalons (exemple)
- J0-J3: cadrage final, schéma données, contrat APIs.
- J4-J10: Implémentation Auth + Voyages (liste/détails/sièges).
- J11-J17: Achat tickets, QR, notifications, validations.
- J18-J22: Paiement providers + callbacks.
- J23-J27: Back-office Filament (compagnies, stats de base).
- J28-J30: Durs: sécurité, perfs, logs, tests, CI, déploiement.

## Livrables
- Backend Laravel + docs API (`docs/` et `guide/`).
- Jeux de tests PHPUnit verts.
- Dossier d’exploitation (Horizon, Scheduler, envs).

## Risques & mitigations
- Intégrations paiement: sandbox + feature flags.
- Charge variable: mise en cache + queues + scaling horizontal.
- Données perso: durcissement sécurité + procédures RGPD.
