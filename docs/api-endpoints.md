# Documentation des Endpoints API pour Liptra

Cette documentation décrit tous les endpoints nécessaires pour le backend de l'application mobile Liptra. Chaque section détaille les endpoints par domaine fonctionnel, leurs paramètres d'entrée et leurs réponses attendues.

## Table des matières

1. [Authentification](#authentification)
2. [Voyages](#voyages)
3. [Tickets](#tickets)
4. [Articles](#articles)
5. [Notifications](#notifications)
6. [Utilisateurs](#utilisateurs)

---

## Authentification

### POST /api/auth/login

Authentifie un utilisateur avec son email et mot de passe.

**Requête**
```json
{
  "email": "string",
  "password": "string"
}
```

**Réponse (200 OK)**
```json
{
  "token": "string",
  "user": {
    "id": "string",
    "name": "string",
    "email": "string",
    "phone": "string",
    "profileImage": "string"
  }
}
```

**Réponse (401 Unauthorized)**
```json
{
  "error": "Email ou mot de passe incorrect"
}
```

### POST /api/auth/register

Crée un nouveau compte utilisateur.

**Requête**
```json
{
  "name": "string",
  "email": "string",
  "phone": "string",
  "password": "string"
}
```

**Réponse (201 Created)**
```json
{
  "token": "string",
  "user": {
    "id": "string",
    "name": "string",
    "email": "string",
    "phone": "string",
    "profileImage": "string"
  }
}
```

**Réponse (400 Bad Request)**
```json
{
  "error": "Un compte avec cet email existe déjà"
}
```

### POST /api/auth/send-otp

Envoie un code OTP à l'email ou au numéro de téléphone fourni.

**Requête**
```json
{
  "phoneOrEmail": "string"
}
```

**Réponse (200 OK)**
```json
{
  "success": true,
  "message": "Un code de vérification a été envoyé"
}
```

### POST /api/auth/verify-otp

Vérifie un code OTP.

**Requête**
```json
{
  "phoneOrEmail": "string",
  "otp": "string"
}
```

**Réponse (200 OK)**
```json
{
  "success": true,
  "verified": true
}
```

**Réponse (400 Bad Request)**
```json
{
  "success": false,
  "error": "Code de vérification incorrect"
}
```

### POST /api/auth/reset-password

Demande de réinitialisation du mot de passe.

**Requête**
```json
{
  "email": "string"
}
```

**Réponse (200 OK)**
```json
{
  "success": true,
  "message": "Un lien de réinitialisation a été envoyé"
}
```

### POST /api/auth/set-password

Définit un nouveau mot de passe après réinitialisation.

**Requête**
```json
{
  "token": "string",
  "password": "string"
}
```

**Réponse (200 OK)**
```json
{
  "success": true,
  "message": "Mot de passe mis à jour avec succès"
}
```

---

## Voyages

### GET /api/trips

Récupère la liste des voyages disponibles.

**Paramètres de requête**
- `departureCity` (optionnel): Filtrer par ville de départ
- `arrivalCity` (optionnel): Filtrer par ville d'arrivée
- `date` (optionnel): Filtrer par date de départ (format ISO)
- `company` (optionnel): Filtrer par compagnie
- `passengers` (optionnel): Nombre de passagers

**Réponse (200 OK)**
```json
{
  "trips": [
    {
      "id": "string",
      "departure": {
        "city": "string",
        "station": "string",
        "time": "string"
      },
      "arrival": {
        "city": "string",
        "station": "string",
        "time": "string"
      },
      "company": "string",
      "price": 0,
      "duration": "string",
      "availableSeats": 0,
      "vehicleType": "bus | train | ferry",
      "popularity": 0
    }
  ]
}
```

### GET /api/trips/:id

Récupère les détails d'un voyage spécifique.

**Réponse (200 OK)**
```json
{
  "id": "string",
  "departure": {
    "city": "string",
    "station": "string",
    "time": "string"
  },
  "arrival": {
    "city": "string",
    "station": "string",
    "time": "string"
  },
  "company": "string",
  "price": 0,
  "duration": "string",
  "availableSeats": 0,
  "vehicleType": "bus | train | ferry",
  "popularity": 0,
  "seats": [
    {
      "id": "string",
      "number": "string",
      "status": "available | occupied | selected",
      "price": 0,
      "type": "standard | premium | vip"
    }
  ]
}
```

### GET /api/trips/:id/seats

Récupère la disponibilité des sièges pour un voyage spécifique.

**Réponse (200 OK)**
```json
{
  "seats": [
    {
      "id": "string",
      "number": "string",
      "status": "available | occupied | selected",
      "price": 0,
      "type": "standard | premium | vip"
    }
  ]
}
```

### POST /api/trips/search

Recherche avancée de voyages.

**Requête**
```json
{
  "departureCity": "string",
  "arrivalCity": "string",
  "date": "string",
  "company": "string",
  "passengers": 0,
  "vehicleType": "bus | train | ferry"
}
```

**Réponse (200 OK)**
```json
{
  "trips": [
    {
      "id": "string",
      "departure": {
        "city": "string",
        "station": "string",
        "time": "string"
      },
      "arrival": {
        "city": "string",
        "station": "string",
        "time": "string"
      },
      "company": "string",
      "price": 0,
      "duration": "string",
      "availableSeats": 0,
      "vehicleType": "bus | train | ferry",
      "popularity": 0
    }
  ]
}
```

---

## Tickets

### GET /api/tickets

Récupère tous les tickets de l'utilisateur connecté.

**Paramètres de requête**
- `status` (optionnel): Filtrer par statut (valid, paused, blocked, used, upcoming, past, cancelled)

**Réponse (200 OK)**
```json
{
  "tickets": [
    {
      "id": "string",
      "tripId": "string",
      "userId": "string",
      "passengerName": "string",
      "seatNumber": "string",
      "purchaseDate": "string",
      "travelDate": "string",
      "qrCode": "string",
      "status": "valid | paused | blocked | used | upcoming | past | cancelled",
      "trip": {
        "departure": {
          "city": "string",
          "station": "string",
          "time": "string"
        },
        "arrival": {
          "city": "string",
          "station": "string",
          "time": "string"
        },
        "company": "string",
        "vehicleType": "bus | train | ferry",
        "duration": "string"
      }
    }
  ]
}
```

### GET /api/tickets/:id

Récupère les détails d'un ticket spécifique.

**Réponse (200 OK)**
```json
{
  "id": "string",
  "tripId": "string",
  "userId": "string",
  "passengerName": "string",
  "seatNumber": "string",
  "purchaseDate": "string",
  "travelDate": "string",
  "qrCode": "string",
  "status": "valid | paused | blocked | used | upcoming | past | cancelled",
  "trip": {
    "departure": {
      "city": "string",
      "station": "string",
      "time": "string"
    },
    "arrival": {
      "city": "string",
      "station": "string",
      "time": "string"
    },
    "company": "string",
    "vehicleType": "bus | train | ferry",
    "duration": "string"
  },
  "isForSelf": true,
  "relationToPassenger": "string",
  "passengerEmail": "string",
  "passengerPhone": "string",
  "tripType": "one-way | round-trip"
}
```

### POST /api/tickets

Crée un nouveau ticket.

**Requête**
```json
{
  "tripId": "string",
  "seats": ["string"],
  "passengerName": "string",
  "passengerEmail": "string",
  "passengerPhone": "string",
  "isForSelf": true,
  "relationToPassenger": "string",
  "tripType": "one-way | round-trip"
}
```

**Réponse (201 Created)**
```json
{
  "id": "string",
  "tripId": "string",
  "userId": "string",
  "passengerName": "string",
  "seatNumber": "string",
  "purchaseDate": "string",
  "travelDate": "string",
  "qrCode": "string",
  "status": "valid",
  "trip": {
    "departure": {
      "city": "string",
      "station": "string",
      "time": "string"
    },
    "arrival": {
      "city": "string",
      "station": "string",
      "time": "string"
    },
    "company": "string",
    "vehicleType": "bus | train | ferry",
    "duration": "string"
  },
  "isForSelf": true,
  "relationToPassenger": "string",
  "passengerEmail": "string",
  "passengerPhone": "string",
  "tripType": "one-way | round-trip"
}
```

### PUT /api/tickets/:id/cancel

Annule un ticket.

**Réponse (200 OK)**
```json
{
  "success": true,
  "ticket": {
    "id": "string",
    "status": "cancelled"
  }
}
```

### PUT /api/tickets/:id/transfer

Transfère un ticket à un autre utilisateur.

**Requête**
```json
{
  "recipientId": "string"
}
```

**Réponse (200 OK)**
```json
{
  "success": true,
  "ticket": {
    "id": "string",
    "userId": "string"
  }
}
```

### GET /api/tickets/:id/qr

Récupère le code QR d'un ticket.

**Réponse (200 OK)**
```json
{
  "qrCode": "string",
  "qrImageUrl": "string"
}
```

---

## Articles

### GET /api/articles

Récupère la liste des articles.

**Paramètres de requête**
- `category` (optionnel): Filtrer par catégorie
- `tag` (optionnel): Filtrer par tag

**Réponse (200 OK)**
```json
{
  "articles": [
    {
      "id": "string",
      "title": "string",
      "summary": "string",
      "content": "string",
      "image": "string",
      "category": "string",
      "tags": ["string"],
      "publishedAt": "string",
      "likes": 0,
      "comments": 0,
      "author": {
        "id": "string",
        "name": "string",
        "avatar": "string"
      }
    }
  ],
  "categories": ["string"],
  "tags": ["string"]
}
```

### GET /api/articles/:id

Récupère les détails d'un article spécifique.

**Réponse (200 OK)**
```json
{
  "id": "string",
  "title": "string",
  "summary": "string",
  "content": "string",
  "image": "string",
  "category": "string",
  "tags": ["string"],
  "publishedAt": "string",
  "likes": 0,
  "comments": 0,
  "author": {
    "id": "string",
    "name": "string",
    "avatar": "string"
  }
}
```

### POST /api/articles/:id/like

Ajoute un "j'aime" à un article.

**Réponse (200 OK)**
```json
{
  "success": true,
  "likes": 0
}
```

### GET /api/articles/categories

Récupère la liste des catégories d'articles.

**Réponse (200 OK)**
```json
{
  "categories": ["string"]
}
```

### GET /api/articles/tags

Récupère la liste des tags d'articles.

**Réponse (200 OK)**
```json
{
  "tags": ["string"]
}
```

---

## Notifications

### GET /api/notifications

Récupère les notifications de l'utilisateur connecté.

**Réponse (200 OK)**
```json
{
  "notifications": [
    {
      "id": "string",
      "title": "string",
      "message": "string",
      "type": "info | success | warning | error",
      "read": false,
      "createdAt": "string"
    }
  ],
  "unreadCount": 0
}
```

### PUT /api/notifications/:id/read

Marque une notification comme lue.

**Réponse (200 OK)**
```json
{
  "success": true,
  "notification": {
    "id": "string",
    "read": true
  }
}
```

### PUT /api/notifications/read-all

Marque toutes les notifications comme lues.

**Réponse (200 OK)**
```json
{
  "success": true,
  "unreadCount": 0
}
```

### POST /api/notifications

Crée une nouvelle notification.

**Requête**
```json
{
  "title": "string",
  "message": "string",
  "type": "info | success | warning | error"
}
```

**Réponse (201 Created)**
```json
{
  "id": "string",
  "title": "string",
  "message": "string",
  "type": "info | success | warning | error",
  "read": false,
  "createdAt": "string"
}
```

### DELETE /api/notifications/:id

Supprime une notification.

**Réponse (200 OK)**
```json
{
  "success": true
}
```

### DELETE /api/notifications

Supprime toutes les notifications de l'utilisateur.

**Réponse (200 OK)**
```json
{
  "success": true
}
```

---

## Utilisateurs

### GET /api/users/me

Récupère les informations de l'utilisateur connecté.

**Réponse (200 OK)**
```json
{
  "id": "string",
  "name": "string",
  "email": "string",
  "phone": "string",
  "profileImage": "string"
}
```

### PUT /api/users/me

Met à jour les informations de l'utilisateur connecté.

**Requête**
```json
{
  "name": "string",
  "phone": "string",
  "profileImage": "string"
}
```

**Réponse (200 OK)**
```json
{
  "id": "string",
  "name": "string",
  "email": "string",
  "phone": "string",
  "profileImage": "string"
}
```

### PUT /api/users/me/password

Change le mot de passe de l'utilisateur connecté.

**Requête**
```json
{
  "currentPassword": "string",
  "newPassword": "string"
}
```

**Réponse (200 OK)**
```json
{
  "success": true,
  "message": "Mot de passe mis à jour avec succès"
}
```

**Réponse (400 Bad Request)**
```json
{
  "success": false,
  "error": "Mot de passe actuel incorrect"
}
```

### GET /api/users/:id

Récupère les informations d'un utilisateur spécifique (pour le transfert de ticket).

**Réponse (200 OK)**
```json
{
  "id": "string",
  "name": "string",
  "profileImage": "string"
}
```

### GET /api/users/search

Recherche des utilisateurs (pour le transfert de ticket).

**Paramètres de requête**
- `query`: Terme de recherche (nom ou email)

**Réponse (200 OK)**
```json
{
  "users": [
    {
      "id": "string",
      "name": "string",
      "profileImage": "string"
    }
  ]
}
```
