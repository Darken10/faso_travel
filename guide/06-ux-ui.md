# 06 — UX/UI (portée indicative)

Basé sur `resources/views/`, Filament et routes web.

## Interfaces clés
- Portail client
  - Liste voyages, détail voyage/instance, sélection siège
  - Tunnel d’achat: informations passager, confirmation, paiement
  - Espace tickets: liste, détail (QR), actions (pause, transférer, payer)
  - Notifications utilisateur
  - Pages légales: confidentialité, conditions, contact, about
- Back-office (Filament)
  - Panneau admin/compagnie: voyages, instances, passagers, tickets, validations
  - Tableaux de bord (stats basiques)
- Pages validation
  - Formulaire recherche par téléphone+code
  - Scan QR (depuis mobile/lecteur)

## Lignes directrices UX
- Feedback explicite pour paiements et validations (états transitoires)
- Messages d’erreur clairs (alignés avec format V2)
- Accessibilité: contraste, labels, focus
- Mobile-first; performance perçue (loading states)

## Branding & i18n
- Français par défaut, prévoir extensibilité.
