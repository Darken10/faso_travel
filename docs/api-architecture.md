# Architecture de l'API Liptra

Ce document décrit l'architecture globale de l'API backend nécessaire pour l'application mobile Liptra, ainsi que les modèles de données et leurs relations.

## Table des matières

1. [Vue d'ensemble](#vue-densemble)
2. [Modèles de données](#modèles-de-données)
3. [Relations entre les modèles](#relations-entre-les-modèles)
4. [Authentification et sécurité](#authentification-et-sécurité)
5. [Bonnes pratiques](#bonnes-pratiques)

## Vue d'ensemble

L'API Liptra est organisée autour de six domaines fonctionnels principaux :

1. **Authentification** : Gestion des utilisateurs, connexion, inscription, et récupération de mot de passe
2. **Voyages** : Recherche et gestion des voyages disponibles
3. **Tickets** : Achat, gestion et transfert de tickets
4. **Articles** : Contenu informatif pour les utilisateurs
5. **Notifications** : Alertes et messages pour les utilisateurs
6. **Utilisateurs** : Gestion des profils utilisateurs

L'architecture suit les principes REST avec des endpoints clairement définis pour chaque ressource.

## Modèles de données

### Utilisateur (User)

```
User {
  id: string (UUID)
  name: string
  email: string (unique)
  password: string (hashed)
  phone: string (optional)
  profileImage: string (URL, optional)
  createdAt: datetime
  updatedAt: datetime
}
```

### Voyage (Trip)

```
Trip {
  id: string (UUID)
  departure: {
    city: string
    station: string
    time: datetime
  }
  arrival: {
    city: string
    station: string
    time: datetime
  }
  company: string
  price: number
  duration: string
  availableSeats: number
  vehicleType: enum ('bus', 'train', 'ferry')
  popularity: number (optional)
  createdAt: datetime
  updatedAt: datetime
}
```

### Siège (Seat)

```
Seat {
  id: string (UUID)
  tripId: string (reference to Trip)
  number: string
  status: enum ('available', 'occupied', 'selected')
  price: number
  type: enum ('standard', 'premium', 'vip')
  createdAt: datetime
  updatedAt: datetime
}
```

### Ticket

```
Ticket {
  id: string (UUID)
  tripId: string (reference to Trip)
  userId: string (reference to User)
  passengerName: string
  passengerEmail: string (optional)
  passengerPhone: string (optional)
  seatNumber: string
  purchaseDate: datetime
  travelDate: datetime
  qrCode: string
  status: enum ('valid', 'paused', 'blocked', 'used', 'upcoming', 'past', 'cancelled')
  isForSelf: boolean
  relationToPassenger: string (optional)
  tripType: enum ('one-way', 'round-trip')
  createdAt: datetime
  updatedAt: datetime
}
```

### Article

```
Article {
  id: string (UUID)
  title: string
  summary: string
  content: string
  image: string (URL)
  category: string
  tags: string[]
  publishedAt: datetime
  likes: number
  comments: number
  authorId: string (reference to User)
  createdAt: datetime
  updatedAt: datetime
}
```

### Notification

```
Notification {
  id: string (UUID)
  userId: string (reference to User)
  title: string
  message: string
  type: enum ('info', 'success', 'warning', 'error')
  read: boolean
  createdAt: datetime
  updatedAt: datetime
}
```

## Relations entre les modèles

1. **User - Ticket** : Un utilisateur peut avoir plusieurs tickets (one-to-many)
2. **Trip - Seat** : Un voyage a plusieurs sièges (one-to-many)
3. **Trip - Ticket** : Un voyage peut avoir plusieurs tickets (one-to-many)
4. **User - Notification** : Un utilisateur peut avoir plusieurs notifications (one-to-many)
5. **User - Article** : Un utilisateur (auteur) peut avoir écrit plusieurs articles (one-to-many)

## Authentification et sécurité

L'API utilise JWT (JSON Web Tokens) pour l'authentification :

1. L'utilisateur s'authentifie avec son email et mot de passe
2. Le serveur vérifie les identifiants et génère un token JWT
3. Le client inclut ce token dans l'en-tête Authorization de chaque requête
4. Le serveur vérifie la validité du token pour chaque requête protégée

Endpoints protégés nécessitant une authentification :
- Tous les endpoints `/api/tickets`
- Tous les endpoints `/api/notifications`
- Tous les endpoints `/api/users/me`
- POST `/api/articles/:id/like`

## Bonnes pratiques

1. **Gestion des erreurs** : Toutes les réponses d'erreur doivent suivre un format cohérent avec un code HTTP approprié et un message d'erreur explicite.

2. **Pagination** : Les endpoints retournant des listes (voyages, tickets, articles, notifications) doivent supporter la pagination avec des paramètres `page` et `limit`.

3. **Filtrage** : Les endpoints de liste doivent supporter le filtrage via des paramètres de requête.

4. **Versionnage** : L'API doit être versionnée (ex: `/api/v1/...`) pour permettre des évolutions futures sans casser la compatibilité.

5. **Documentation** : L'API doit être documentée avec OpenAPI/Swagger pour faciliter son utilisation.

6. **Validation** : Toutes les entrées utilisateur doivent être validées côté serveur.

7. **Rate Limiting** : Implémenter des limites de taux pour prévenir les abus.

8. **CORS** : Configurer correctement les en-têtes CORS pour permettre l'accès depuis l'application mobile.

9. **Logging** : Mettre en place un système de journalisation pour suivre les erreurs et l'utilisation de l'API.

10. **Tests** : Couvrir l'API avec des tests unitaires et d'intégration.
