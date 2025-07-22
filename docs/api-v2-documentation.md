# Documentation API V2

## Introduction

Cette documentation décrit les endpoints de l’API V2, leur usage, les conditions d’accès, les entrées attendues et les sorties possibles (succès et erreurs). Toutes les routes nécessitent l’authentification (token Bearer) sauf indication contraire.

---

## Conventions de réponse

- **Succès** : Les données sont retournées directement, sans wrapper `status` ou `message`.
- **Erreur** :
  ```json
  {
    "error": true,
    "message": "Message d’erreur",
    "status": 400,
    "errors": [
      { "name": "champ", "message": "Erreur sur ce champ" }
    ] // présent uniquement pour les erreurs de validation
  }
  ```

---

## Authentification

### POST /api/v2/register
**Description** : Inscription d’un nouvel utilisateur.

**Conditions** : Accessible sans authentification.

**Entrée** :
- name (string, requis)
- email (string, requis)
- password (string, requis)
- ... autres champs optionnels

**Sortie (succès)** :
```json
{
  "id": 1,
  "name": "Alice",
  "email": "alice@mail.com"
}
```

**Sortie (erreur validation)** :
Voir format d’erreur global.

---

### POST /api/v2/login
**Description** : Connexion utilisateur.

**Conditions** : Accessible sans authentification.

**Entrée** :
- email (string, requis)
- password (string, requis)

**Sortie (succès)** :
```json
{
  "token": "...",
  "user": { "id": 1, "name": "Alice" }
}
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/logout
**Description** : Déconnexion de l’utilisateur.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
{ "message": "Déconnexion réussie" }
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/send-otp
**Description** : Envoi d’un code OTP.

**Conditions** : Accessible sans authentification.

**Entrée** :
- phone_or_email (string, requis)

**Sortie (succès)** :
```json
{ "sent": true }
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/verify-otp
**Description** : Vérification d’un code OTP.

**Conditions** : Accessible sans authentification.

**Entrée** :
- phone_or_email (string, requis)
- otp (string, requis)

**Sortie (succès)** :
```json
{ "verified": true }
```

**Sortie (erreur)** :
```json
{
  "error": true,
  "message": "Code OTP invalide ou expiré",
  "status": 400
}
```

---

### POST /api/v2/forgot
**Description** : Envoi d’un lien de réinitialisation de mot de passe.

**Conditions** : Accessible sans authentification.

**Entrée** :
- email (string, requis)

**Sortie (succès)** :
```json
{ "sent": true }
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/reset
**Description** : Réinitialisation du mot de passe.

**Conditions** : Accessible sans authentification.

**Entrée** :
- email (string, requis)
- token (string, requis)
- password (string, requis)

**Sortie (succès)** :
```json
{ "reset": true }
```

**Sortie (erreur)** :
```json
{
  "error": true,
  "message": "Impossible de réinitialiser le mot de passe",
  "status": 400
}
```

---

## Utilisateur

### GET /api/v2/user/profile
**Description** : Récupère le profil de l’utilisateur connecté.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
{
  "id": 1,
  "name": "Alice",
  "email": "alice@mail.com",
  "compagnie": "Faso"
}
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### PUT /api/v2/user/profile
**Description** : Met à jour le profil utilisateur.

**Conditions** : Authentification requise.

**Entrée** :
- name (string, optionnel)
- email (string, optionnel)
- ...

**Sortie (succès)** : profil mis à jour (voir ci-dessus)

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/user/photo
**Description** : Met à jour la photo de profil.

**Conditions** : Authentification requise.

**Entrée** :
- photo (fichier image, requis)

**Sortie (succès)** : profil mis à jour

**Sortie (erreur)** :
Voir format d’erreur global.

---

### GET /api/v2/user/history
**Description** : Historique des voyages de l’utilisateur.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
[
  { "voyage_id": 1, "date": "2025-06-28" },
  ...
]
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### GET /api/v2/user/favorites
**Description** : Trajets favoris de l’utilisateur.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
[
  { "route_id": 1, "from": "Ouaga", "to": "Bobo" },
  ...
]
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### GET /api/v2/user/stats
**Description** : Statistiques de l’utilisateur.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
{
  "total_trips": 12,
  "total_spent": 50000
}
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

## Articles

### GET /api/v2/articles
**Description** : Liste paginée des articles.

**Conditions** : Accessible sans authentification.

**Entrée** :
- page (int, optionnel)
- per_page (int, optionnel)
- category_id (int, optionnel)
- search (string, optionnel)

**Sortie (succès)** :
```json
{
  "data": [
    {
      "id": 1,
      "title": "Mon article",
      "user": { "name": "Alice", "compagnie": "Faso", "avatarUrl": "..." },
      "tags": ["voyage", "promo"],
      "image": "https://...",
      "created_at": "2025-06-28T13:34:35.000000Z"
    },
    ...
  ],
  "current_page": 1,
  "last_page": 3,
  ...
}
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### GET /api/v2/articles/{id}
**Description** : Détail d’un article.

**Conditions** : Accessible sans authentification.

**Entrée** : aucune

**Sortie (succès)** :
```json
{
  "id": 1,
  "title": "Mon article",
  "content": "...",
  "user": { "name": "Alice", "compagnie": "Faso", "avatarUrl": "..." },
  "comments_count": 2,
  "likes_count": 5,
  "tags": ["voyage"],
  "image": "https://...",
  "created_at": "2025-06-28T13:34:35.000000Z"
}
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/articles
**Description** : Créer un article.

**Conditions** : Authentification requise.

**Entrée** :
- title (string, requis)
- content (string, requis)
- category_id (int, requis)
- image (fichier, optionnel)
- tags (array, optionnel)

**Sortie (succès)** : article créé (voir ci-dessus)

**Sortie (erreur)** :
Voir format d’erreur global.

---

### PUT /api/v2/articles/{id}
**Description** : Modifier un article.

**Conditions** : Authentification requise.

**Entrée** :
- title, content, category_id, image, tags (optionnels)

**Sortie (succès)** : article modifié (voir ci-dessus)

**Sortie (erreur)** :
Voir format d’erreur global.

---

### DELETE /api/v2/articles/{id}
**Description** : Supprimer un article.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
true
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/articles/{id}/like
**Description** : Like/unlike un article.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
{ "action": "liked", "likes_count": 6 }
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/articles/{id}/comments
**Description** : Ajouter un commentaire à un article.

**Conditions** : Authentification requise.

**Entrée** :
- content (string, requis)

**Sortie (succès)** :
```json
{
  "id": 1,
  "user_id": 7,
  "message": "Bravo !",
  "created_at": "2025-06-28T13:34:35.000000Z",
  ...
}
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### DELETE /api/v2/comments/{id}
**Description** : Supprimer un commentaire.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
true
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### GET /api/v2/categories
**Description** : Liste des catégories d’articles.

**Conditions** : Accessible sans authentification.

**Entrée** : aucune

**Sortie (succès)** :
```json
[
  { "id": 1, "name": "Promo" },
  ...
]
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

## Tickets

### GET /api/v2/tickets
**Description** : Liste des tickets de l’utilisateur.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
[
  { "id": 1, "voyage": "Ouaga-Bobo", ... },
  ...
]
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### GET /api/v2/tickets/{id}
**Description** : Détail d’un ticket.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
{
  "id": 1,
  "voyage": "Ouaga-Bobo",
  ...
}
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/tickets
**Description** : Créer un ticket.

**Conditions** : Authentification requise.

**Entrée** :
- voyage_instance_id (int, requis)
- type (string, optionnel)
- autre_personne (bool, optionnel)
- nom_autre_personne, prenom_autre_personne, telephone_autre_personne (si autre_personne)

**Sortie (succès)** : ticket créé (voir ci-dessus)

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/tickets/{id}/cancel
**Description** : Annuler un ticket.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** : ticket annulé (voir ci-dessus)

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/tickets/{id}/transfer
**Description** : Transférer un ticket.

**Conditions** : Authentification requise.

**Entrée** :
- nom, prenom, telephone (tous requis)

**Sortie (succès)** : ticket transféré (voir ci-dessus)

**Sortie (erreur)** :
Voir format d’erreur global.

---

### GET /api/v2/tickets/{id}/qrcode
**Description** : Récupérer le QR code d’un ticket.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
{ "qr_code": "..." }
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

## Notifications

### GET /api/v2/notifications
**Description** : Liste paginée des notifications.

**Conditions** : Authentification requise.

**Entrée** :
- per_page (int, optionnel)
- page (int, optionnel)

**Sortie (succès)** :
```json
{
  "data": [
    { "id": 1, "type": "info", "data": { ... }, ... },
    ...
  ],
  "current_page": 1,
  ...
}
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/notifications/read-all
**Description** : Marquer toutes les notifications comme lues.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
{ "count": 5 }
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/notifications/{id}/read
**Description** : Marquer une notification comme lue.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** : notification modifiée (voir ci-dessus)

**Sortie (erreur)** :
Voir format d’erreur global.

---

### DELETE /api/v2/notifications/{id}
**Description** : Supprimer une notification.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
{ "deleted": true }
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### DELETE /api/v2/notifications
**Description** : Supprimer toutes les notifications.

**Conditions** : Authentification requise.

**Entrée** : aucune

**Sortie (succès)** :
```json
{ "count": 5 }
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

## Voyages

### GET /api/v2/voyages
**Description** : Liste des voyages (filtres disponibles).

**Conditions** : Accessible sans authentification.

**Entrée** :
- departureCity, arrivalCity, date, company, passengers (optionnels)

**Sortie (succès)** :
```json
[
  { "id": 1, "from": "Ouaga", "to": "Bobo", ... },
  ...
]
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### GET /api/v2/voyages/{id}
**Description** : Détail d’un voyage.

**Conditions** : Accessible sans authentification.

**Entrée** : aucune

**Sortie (succès)** :
```json
{
  "id": 1,
  "from": "Ouaga",
  "to": "Bobo",
  ...
}
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### GET /api/v2/voyages/{id}/seats
**Description** : Places disponibles pour un voyage.

**Conditions** : Accessible sans authentification.

**Entrée** : aucune

**Sortie (succès)** :
```json
[
  { "seat": 1, "available": true },
  ...
]
```

**Sortie (erreur)** :
Voir format d’erreur global.

---

### POST /api/v2/voyages/search
**Description** : Recherche avancée de voyages.

**Conditions** : Accessible sans authentification.

**Entrée** :
- departureCity, arrivalCity, date, company, passengers, vehicleType (optionnels)

**Sortie (succès)** : liste des voyages (voir ci-dessus)

**Sortie (erreur)** :
Voir format d’erreur global.

---

## Notes

- Toutes les dates sont au format ISO 8601.
- Les endpoints paginés retournent la pagination Laravel standard.
- Les champs des resources sont adaptés pour le front (ex : tags = array de string, user simplifié, image = URL absolue).
- Pour toute erreur, se référer au format d’erreur global décrit en début de fichier.
