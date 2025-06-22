# Documentation de l'API Faso Travel V2

## Introduction

Bienvenue dans la documentation de l'API Faso Travel V2. Cette API permet d'interagir avec les différentes fonctionnalités de la plateforme Faso Travel, notamment la gestion des utilisateurs, des voyages, des tickets, des notifications et des articles.

### Base URL

Toutes les requêtes doivent être préfixées par la base URL suivante :

```
https://api.fasotravel.com/api/v2
```

### Format des réponses

Toutes les réponses sont au format JSON. La structure générale des réponses est la suivante :

```json
{
  "status": "success|error",
  "message": "Message explicatif (optionnel)",
  "data": { ... } // Données de la réponse (optionnel)
}
```

### Codes de statut HTTP

L'API utilise les codes de statut HTTP standards :

- `200 OK` : Requête traitée avec succès
- `201 Created` : Ressource créée avec succès
- `400 Bad Request` : Erreur dans la requête
- `401 Unauthorized` : Authentification requise
- `403 Forbidden` : Accès refusé
- `404 Not Found` : Ressource non trouvée
- `422 Unprocessable Entity` : Validation échouée
- `500 Internal Server Error` : Erreur serveur

## Authentification

L'API utilise Laravel Sanctum pour l'authentification. La plupart des endpoints nécessitent un token d'authentification qui doit être inclus dans l'en-tête `Authorization` de chaque requête.

### Inscription

**Endpoint** : `POST /auth/register`

**Description** : Permet de créer un nouveau compte utilisateur.

**Corps de la requête** :

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "first_name": "John",
  "last_name": "Doe",
  "sexe": "homme",
  "numero": 70123456,
  "numero_identifiant": "+226"
}
```

**Réponse** :

```json
{
  "status": "success",
  "message": "Utilisateur enregistré avec succès",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "first_name": "John",
      "last_name": "Doe",
      "sexe": "homme",
      "numero": 70123456,
      "numero_identifiant": "+226",
      "role": "user",
      "created_at": "2025-06-22T14:30:00.000000Z",
      "updated_at": "2025-06-22T14:30:00.000000Z"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz123456"
  }
}
```

### Connexion

**Endpoint** : `POST /auth/login`

**Description** : Permet de se connecter à un compte existant.

**Corps de la requête** :

```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Réponse** :

```json
{
  "status": "success",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "first_name": "John",
      "last_name": "Doe",
      "sexe": "homme",
      "numero": 70123456,
      "numero_identifiant": "+226",
      "role": "user",
      "created_at": "2025-06-22T14:30:00.000000Z",
      "updated_at": "2025-06-22T14:30:00.000000Z"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz123456"
  }
}
```

### Déconnexion

**Endpoint** : `POST /auth/logout`

**Description** : Permet de se déconnecter et de révoquer le token d'authentification actuel.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "message": "Déconnexion réussie"
}
```

### Mot de passe oublié

**Endpoint** : `POST /auth/forgot-password`

**Description** : Permet d'envoyer un lien de réinitialisation de mot de passe.

**Corps de la requête** :

```json
{
  "email": "john@example.com"
}
```

**Réponse** :

```json
{
  "status": "success",
  "message": "Lien de réinitialisation envoyé"
}
```

### Réinitialisation du mot de passe

**Endpoint** : `POST /auth/reset-password`

**Description** : Permet de réinitialiser le mot de passe avec un token valide.

**Corps de la requête** :

```json
{
  "email": "john@example.com",
  "token": "abcdefghijklmnopqrstuvwxyz123456",
  "password": "newpassword123"
}
```

**Réponse** :

```json
{
  "status": "success",
  "message": "Mot de passe réinitialisé avec succès"
}
```

## Utilisateurs

Cette section couvre les endpoints relatifs à la gestion des utilisateurs.

### Profil utilisateur

**Endpoint** : `GET /user/profile`

**Description** : Récupère les informations du profil de l'utilisateur connecté.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "first_name": "John",
      "last_name": "Doe",
      "sexe": "homme",
      "numero": 70123456,
      "numero_identifiant": "+226",
      "role": "user",
      "profile_photo_url": "https://ui-avatars.com/api/?name=John+Doe",
      "created_at": "2025-06-22T14:30:00.000000Z",
      "updated_at": "2025-06-22T14:30:00.000000Z"
    }
  }
}
```

### Mise à jour du profil

**Endpoint** : `PUT /user/profile`

**Description** : Met à jour les informations du profil de l'utilisateur connecté.

**En-têtes** :
- `Authorization: Bearer {token}`

**Corps de la requête** :

```json
{
  "name": "John Smith",
  "first_name": "John",
  "last_name": "Smith",
  "numero": 70123456,
  "numero_identifiant": "+226"
}
```

**Réponse** :

```json
{
  "status": "success",
  "message": "Profil mis à jour avec succès",
  "data": {
    "user": {
      "id": 1,
      "name": "John Smith",
      "email": "john@example.com",
      "first_name": "John",
      "last_name": "Smith",
      "sexe": "homme",
      "numero": 70123456,
      "numero_identifiant": "+226",
      "role": "user",
      "profile_photo_url": "https://ui-avatars.com/api/?name=John+Smith",
      "created_at": "2025-06-22T14:30:00.000000Z",
      "updated_at": "2025-06-22T14:35:00.000000Z"
    }
  }
}
```

### Changement de mot de passe

**Endpoint** : `PUT /user/password`

**Description** : Permet à l'utilisateur connecté de changer son mot de passe.

**En-têtes** :
- `Authorization: Bearer {token}`

**Corps de la requête** :

```json
{
  "current_password": "password123",
  "password": "newpassword123",
  "password_confirmation": "newpassword123"
}
```

**Réponse** :

```json
{
  "status": "success",
  "message": "Mot de passe changé avec succès"
}
```

### Mise à jour de la photo de profil

**Endpoint** : `POST /user/profile/photo`

**Description** : Permet à l'utilisateur connecté de mettre à jour sa photo de profil.

**En-têtes** :
- `Authorization: Bearer {token}`
- `Content-Type: multipart/form-data`

**Corps de la requête** :
- `photo` : Fichier image (jpg, png, gif)

**Réponse** :

```json
{
  "status": "success",
  "message": "Photo de profil mise à jour avec succès",
  "data": {
    "profile_photo_url": "https://fasotravel.com/storage/profiles/user_1.jpg"
  }
}
```

## Notifications

Cette section couvre les endpoints relatifs à la gestion des notifications.

### Liste des notifications

**Endpoint** : `GET /notifications`

**Description** : Récupère la liste des notifications de l'utilisateur connecté.

**En-têtes** :
- `Authorization: Bearer {token}`

**Paramètres de requête** :
- `page` : Numéro de la page (par défaut : 1)
- `per_page` : Nombre d'éléments par page (par défaut : 15)

**Réponse** :

```json
{
  "status": "success",
  "data": {
    "notifications": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "user_id": 1,
          "type": "ticket_confirmation",
          "message": "Votre ticket a été confirmé",
          "data": { "ticket_id": 123 },
          "read_at": null,
          "created_at": "2025-06-22T14:30:00.000000Z",
          "updated_at": "2025-06-22T14:30:00.000000Z"
        },
        {
          "id": 2,
          "user_id": 1,
          "type": "voyage_reminder",
          "message": "Rappel : Votre voyage est prévu pour demain",
          "data": { "voyage_id": 456 },
          "read_at": "2025-06-22T14:35:00.000000Z",
          "created_at": "2025-06-21T14:30:00.000000Z",
          "updated_at": "2025-06-22T14:35:00.000000Z"
        }
      ],
      "first_page_url": "https://api.fasotravel.com/api/v2/notifications?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "https://api.fasotravel.com/api/v2/notifications?page=1",
      "next_page_url": null,
      "path": "https://api.fasotravel.com/api/v2/notifications",
      "per_page": 15,
      "prev_page_url": null,
      "to": 2,
      "total": 2
    },
    "unread_count": 1
  }
}
```

### Marquer une notification comme lue

**Endpoint** : `PATCH /notifications/{id}/read`

**Description** : Marque une notification spécifique comme lue.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "message": "Notification marquée comme lue"
}
```

### Marquer toutes les notifications comme lues

**Endpoint** : `PATCH /notifications/read-all`

**Description** : Marque toutes les notifications de l'utilisateur connecté comme lues.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "message": "Toutes les notifications ont été marquées comme lues"
}
```

### Supprimer une notification

**Endpoint** : `DELETE /notifications/{id}`

**Description** : Supprime une notification spécifique.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "message": "Notification supprimée avec succès"
}
```

### Supprimer toutes les notifications

**Endpoint** : `DELETE /notifications`

**Description** : Supprime toutes les notifications de l'utilisateur connecté.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "message": "Toutes les notifications ont été supprimées",
  "data": {
    "count": 2
  }
}
```

## Articles

Cette section couvre les endpoints relatifs à la gestion des articles (blog posts).

### Liste des articles

**Endpoint** : `GET /articles`

**Description** : Récupère la liste des articles publiés.

**Paramètres de requête** :
- `page` : Numéro de la page (par défaut : 1)
- `per_page` : Nombre d'éléments par page (par défaut : 10)
- `category_id` : Filtrer par catégorie (optionnel)
- `search` : Recherche par titre ou contenu (optionnel)

**Réponse** :

```json
{
  "status": "success",
  "data": {
    "posts": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "title": "Nouvelles destinations pour l'été",
          "slug": "nouvelles-destinations-pour-lete",
          "excerpt": "Découvrez nos nouvelles destinations pour l'été 2025...",
          "content": "Lorem ipsum dolor sit amet, consectetur adipiscing elit...",
          "featured_image": "https://fasotravel.com/storage/posts/post_1.jpg",
          "category_id": 2,
          "user_id": 1,
          "published_at": "2025-06-20T10:30:00.000000Z",
          "created_at": "2025-06-20T10:30:00.000000Z",
          "updated_at": "2025-06-20T10:30:00.000000Z",
          "category": {
            "id": 2,
            "name": "Destinations",
            "slug": "destinations"
          },
          "author": {
            "id": 1,
            "name": "John Doe"
          },
          "likes_count": 15,
          "comments_count": 5
        },
        {
          "id": 2,
          "title": "Conseils pour voyager en sécurité",
          "slug": "conseils-pour-voyager-en-securite",
          "excerpt": "Quelques conseils pratiques pour voyager en toute sécurité...",
          "content": "Lorem ipsum dolor sit amet, consectetur adipiscing elit...",
          "featured_image": "https://fasotravel.com/storage/posts/post_2.jpg",
          "category_id": 3,
          "user_id": 2,
          "published_at": "2025-06-18T14:15:00.000000Z",
          "created_at": "2025-06-18T14:15:00.000000Z",
          "updated_at": "2025-06-18T14:15:00.000000Z",
          "category": {
            "id": 3,
            "name": "Conseils",
            "slug": "conseils"
          },
          "author": {
            "id": 2,
            "name": "Jane Smith"
          },
          "likes_count": 8,
          "comments_count": 2
        }
      ],
      "first_page_url": "https://api.fasotravel.com/api/v2/articles?page=1",
      "from": 1,
      "last_page": 5,
      "last_page_url": "https://api.fasotravel.com/api/v2/articles?page=5",
      "next_page_url": "https://api.fasotravel.com/api/v2/articles?page=2",
      "path": "https://api.fasotravel.com/api/v2/articles",
      "per_page": 10,
      "prev_page_url": null,
      "to": 10,
      "total": 45
    }
  }
}
```

### Détails d'un article

**Endpoint** : `GET /articles/{id}`

**Description** : Récupère les détails d'un article spécifique.

**Réponse** :

```json
{
  "status": "success",
  "data": {
    "post": {
      "id": 1,
      "title": "Nouvelles destinations pour l'été",
      "slug": "nouvelles-destinations-pour-lete",
      "excerpt": "Découvrez nos nouvelles destinations pour l'été 2025...",
      "content": "Lorem ipsum dolor sit amet, consectetur adipiscing elit...",
      "featured_image": "https://fasotravel.com/storage/posts/post_1.jpg",
      "category_id": 2,
      "user_id": 1,
      "published_at": "2025-06-20T10:30:00.000000Z",
      "created_at": "2025-06-20T10:30:00.000000Z",
      "updated_at": "2025-06-20T10:30:00.000000Z",
      "category": {
        "id": 2,
        "name": "Destinations",
        "slug": "destinations"
      },
      "author": {
        "id": 1,
        "name": "John Doe"
      },
      "likes_count": 15,
      "comments_count": 5,
      "liked_by_user": false,
      "comments": [
        {
          "id": 1,
          "post_id": 1,
          "user_id": 3,
          "content": "Super article, merci pour ces informations !",
          "created_at": "2025-06-20T11:45:00.000000Z",
          "updated_at": "2025-06-20T11:45:00.000000Z",
          "user": {
            "id": 3,
            "name": "Alice Johnson"
          }
        },
        {
          "id": 2,
          "post_id": 1,
          "user_id": 4,
          "content": "J'ai hâte de découvrir ces nouvelles destinations !",
          "created_at": "2025-06-20T14:30:00.000000Z",
          "updated_at": "2025-06-20T14:30:00.000000Z",
          "user": {
            "id": 4,
            "name": "Bob Williams"
          }
        }
      ]
    }
  }
}
```

### Catégories d'articles

**Endpoint** : `GET /articles/categories`

**Description** : Récupère la liste des catégories d'articles.

**Réponse** :

```json
{
  "status": "success",
  "data": {
    "categories": [
      {
        "id": 1,
        "name": "Actualités",
        "slug": "actualites",
        "posts_count": 12
      },
      {
        "id": 2,
        "name": "Destinations",
        "slug": "destinations",
        "posts_count": 15
      },
      {
        "id": 3,
        "name": "Conseils",
        "slug": "conseils",
        "posts_count": 8
      },
      {
        "id": 4,
        "name": "Promotions",
        "slug": "promotions",
        "posts_count": 10
      }
    ]
  }
}
```

### Ajouter un commentaire

**Endpoint** : `POST /articles/{id}/comments`

**Description** : Ajoute un commentaire à un article spécifique.

**En-têtes** :
- `Authorization: Bearer {token}`

**Corps de la requête** :

```json
{
  "content": "Très bon article, merci pour le partage !"
}
```

**Réponse** :

```json
{
  "status": "success",
  "message": "Commentaire ajouté avec succès",
  "data": {
    "comment": {
      "id": 6,
      "post_id": 1,
      "user_id": 1,
      "content": "Très bon article, merci pour le partage !",
      "created_at": "2025-06-22T15:30:00.000000Z",
      "updated_at": "2025-06-22T15:30:00.000000Z",
      "user": {
        "id": 1,
        "name": "John Doe"
      }
    }
  }
}
```

### Supprimer un commentaire

**Endpoint** : `DELETE /articles/comments/{id}`

**Description** : Supprime un commentaire spécifique. L'utilisateur doit être l'auteur du commentaire ou un administrateur.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "message": "Commentaire supprimé avec succès"
}
```

### Aimer un article

**Endpoint** : `POST /articles/{id}/like`

**Description** : Ajoute ou retire un "j'aime" à un article spécifique (toggle).

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "message": "Article aimé avec succès",
  "data": {
    "liked": true,
    "likes_count": 16
  }
}
```

ou

```json
{
  "status": "success",
  "message": "J'aime retiré avec succès",
  "data": {
    "liked": false,
    "likes_count": 15
  }
}
```

## Tickets

Cette section couvre les endpoints relatifs à la gestion des tickets.

### Liste des tickets de l'utilisateur

**Endpoint** : `GET /tickets`

**Description** : Récupère la liste des tickets de l'utilisateur connecté.

**En-têtes** :
- `Authorization: Bearer {token}`

**Paramètres de requête** :
- `page` : Numéro de la page (par défaut : 1)
- `per_page` : Nombre d'éléments par page (par défaut : 10)
- `status` : Filtrer par statut (optionnel, valeurs possibles : `active`, `used`, `cancelled`, `expired`)

**Réponse** :

```json
{
  "status": "success",
  "data": {
    "tickets": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "reference": "TKT-2025062201",
          "voyage_instance_id": 123,
          "user_id": 1,
          "passenger_name": "John Doe",
          "passenger_phone": "70123456",
          "passenger_email": "john@example.com",
          "seat_number": "A12",
          "price": 5000,
          "status": "active",
          "qr_code": "https://fasotravel.com/storage/tickets/qr/TKT-2025062201.png",
          "created_at": "2025-06-22T10:15:00.000000Z",
          "updated_at": "2025-06-22T10:15:00.000000Z",
          "voyage_instance": {
            "id": 123,
            "voyage_id": 45,
            "departure_date": "2025-07-10",
            "departure_time": "08:00:00",
            "arrival_time": "12:30:00",
            "status": "scheduled",
            "voyage": {
              "id": 45,
              "trajet_id": 12,
              "compagnie_id": 3,
              "vehicle_id": 22,
              "price": 5000,
              "trajet": {
                "id": 12,
                "departure_city_id": 1,
                "arrival_city_id": 2,
                "departure_city": {
                  "id": 1,
                  "name": "Ouagadougou"
                },
                "arrival_city": {
                  "id": 2,
                  "name": "Bobo-Dioulasso"
                }
              },
              "compagnie": {
                "id": 3,
                "name": "TransFaso",
                "logo": "https://fasotravel.com/storage/compagnies/transfaso.png"
              }
            }
          }
        },
        {
          "id": 2,
          "reference": "TKT-2025062202",
          "voyage_instance_id": 124,
          "user_id": 1,
          "passenger_name": "John Doe",
          "passenger_phone": "70123456",
          "passenger_email": "john@example.com",
          "seat_number": "B05",
          "price": 6500,
          "status": "active",
          "qr_code": "https://fasotravel.com/storage/tickets/qr/TKT-2025062202.png",
          "created_at": "2025-06-22T11:30:00.000000Z",
          "updated_at": "2025-06-22T11:30:00.000000Z",
          "voyage_instance": {
            "id": 124,
            "voyage_id": 50,
            "departure_date": "2025-07-15",
            "departure_time": "14:00:00",
            "arrival_time": "17:45:00",
            "status": "scheduled",
            "voyage": {
              "id": 50,
              "trajet_id": 15,
              "compagnie_id": 2,
              "vehicle_id": 18,
              "price": 6500,
              "trajet": {
                "id": 15,
                "departure_city_id": 1,
                "arrival_city_id": 3,
                "departure_city": {
                  "id": 1,
                  "name": "Ouagadougou"
                },
                "arrival_city": {
                  "id": 3,
                  "name": "Koudougou"
                }
              },
              "compagnie": {
                "id": 2,
                "name": "BurkiTravel",
                "logo": "https://fasotravel.com/storage/compagnies/burkitravel.png"
              }
            }
          }
        }
      ],
      "first_page_url": "https://api.fasotravel.com/api/v2/tickets?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "https://api.fasotravel.com/api/v2/tickets?page=1",
      "next_page_url": null,
      "path": "https://api.fasotravel.com/api/v2/tickets",
      "per_page": 10,
      "prev_page_url": null,
      "to": 2,
      "total": 2
    }
  }
}
```

### Détails d'un ticket

**Endpoint** : `GET /tickets/{ticketId}`

**Description** : Récupère les détails d'un ticket spécifique.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "data": {
    "ticket": {
      "id": 1,
      "reference": "TKT-2025062201",
      "voyage_instance_id": 123,
      "user_id": 1,
      "passenger_name": "John Doe",
      "passenger_phone": "70123456",
      "passenger_email": "john@example.com",
      "seat_number": "A12",
      "price": 5000,
      "status": "active",
      "qr_code": "https://fasotravel.com/storage/tickets/qr/TKT-2025062201.png",
      "created_at": "2025-06-22T10:15:00.000000Z",
      "updated_at": "2025-06-22T10:15:00.000000Z",
      "voyage_instance": {
        "id": 123,
        "voyage_id": 45,
        "departure_date": "2025-07-10",
        "departure_time": "08:00:00",
        "arrival_time": "12:30:00",
        "status": "scheduled",
        "voyage": {
          "id": 45,
          "trajet_id": 12,
          "compagnie_id": 3,
          "vehicle_id": 22,
          "price": 5000,
          "trajet": {
            "id": 12,
            "departure_city_id": 1,
            "arrival_city_id": 2,
            "departure_city": {
              "id": 1,
              "name": "Ouagadougou"
            },
            "arrival_city": {
              "id": 2,
              "name": "Bobo-Dioulasso"
            }
          },
          "compagnie": {
            "id": 3,
            "name": "TransFaso",
            "logo": "https://fasotravel.com/storage/compagnies/transfaso.png"
          },
          "vehicle": {
            "id": 22,
            "registration_number": "11 AA 1234",
            "type": "bus",
            "capacity": 52,
            "features": ["climatisation", "wifi", "prises_usb"]
          }
        }
      },
      "payment": {
        "id": 1,
        "ticket_id": 1,
        "amount": 5000,
        "payment_method": "mobile_money",
        "transaction_id": "MM123456789",
        "status": "completed",
        "created_at": "2025-06-22T10:15:00.000000Z"
      }
    }
  }
}
```

### Créer un ticket

**Endpoint** : `POST /tickets`

**Description** : Crée un nouveau ticket pour un voyage.

**En-têtes** :
- `Authorization: Bearer {token}`

**Corps de la requête** :

```json
{
  "voyage_instance_id": 123,
  "passenger_name": "John Doe",
  "passenger_phone": "70123456",
  "passenger_email": "john@example.com",
  "seat_number": "A12",
  "payment_method": "mobile_money",
  "payment_details": {
    "phone_number": "70123456",
    "provider": "orange_money"
  }
}
```

**Réponse** :

```json
{
  "status": "success",
  "message": "Ticket créé avec succès",
  "data": {
    "ticket": {
      "id": 3,
      "reference": "TKT-2025062203",
      "voyage_instance_id": 123,
      "user_id": 1,
      "passenger_name": "John Doe",
      "passenger_phone": "70123456",
      "passenger_email": "john@example.com",
      "seat_number": "A12",
      "price": 5000,
      "status": "pending_payment",
      "created_at": "2025-06-22T16:00:00.000000Z",
      "updated_at": "2025-06-22T16:00:00.000000Z"
    },
    "payment": {
      "id": 3,
      "ticket_id": 3,
      "amount": 5000,
      "payment_method": "mobile_money",
      "status": "pending",
      "payment_url": "https://payment.fasotravel.com/checkout/MM987654321",
      "created_at": "2025-06-22T16:00:00.000000Z"
    }
  }
}
```

### Annuler un ticket

**Endpoint** : `PATCH /tickets/{ticketId}/cancel`

**Description** : Annule un ticket spécifique.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "message": "Ticket annulé avec succès",
  "data": {
    "ticket": {
      "id": 1,
      "reference": "TKT-2025062201",
      "status": "cancelled",
      "updated_at": "2025-06-22T16:30:00.000000Z"
    },
    "refund": {
      "amount": 4000,
      "status": "processing",
      "estimated_date": "2025-06-25"
    }
  }
}
```

### Transférer un ticket

**Endpoint** : `PATCH /tickets/{ticketId}/transfer`

**Description** : Transfère un ticket à un autre passager.

**En-têtes** :
- `Authorization: Bearer {token}`

**Corps de la requête** :

```json
{
  "passenger_name": "Jane Smith",
  "passenger_phone": "70654321",
  "passenger_email": "jane@example.com"
}
```

**Réponse** :

```json
{
  "status": "success",
  "message": "Ticket transféré avec succès",
  "data": {
    "ticket": {
      "id": 1,
      "reference": "TKT-2025062201",
      "passenger_name": "Jane Smith",
      "passenger_phone": "70654321",
      "passenger_email": "jane@example.com",
      "updated_at": "2025-06-22T17:00:00.000000Z"
    }
  }
}
```

### Générer le QR code d'un ticket

**Endpoint** : `GET /tickets/{ticketId}/qr-code`

**Description** : Génère ou récupère le QR code d'un ticket spécifique.

**En-têtes** :
- `Authorization: Bearer {token}`

**Réponse** :

```json
{
  "status": "success",
  "data": {
    "qr_code": "https://fasotravel.com/storage/tickets/qr/TKT-2025062201.png",
    "reference": "TKT-2025062201"
  }
}
```

## Voyages (Trips)

Cette section couvre les endpoints relatifs à la gestion des voyages.

### Liste des voyages disponibles

**Endpoint** : `GET /trips`

**Description** : Récupère la liste des voyages disponibles avec filtres optionnels.

**Paramètres de requête** :
- `departureCity` : ID de la ville de départ (optionnel)
- `arrivalCity` : ID de la ville d'arrivée (optionnel)
- `date` : Date du voyage au format YYYY-MM-DD (optionnel)
- `company` : ID de la compagnie (optionnel)
- `passengers` : Nombre de passagers (optionnel, par défaut : 1)

**Réponse** :

```json
{
  "status": "success",
  "trips": [
    {
      "id": 123,
      "voyage_id": 45,
      "departure_date": "2025-07-10",
      "departure_time": "08:00:00",
      "arrival_time": "12:30:00",
      "duration": "4h 30min",
      "available_seats": 32,
      "total_seats": 52,
      "price": 5000,
      "status": "scheduled",
      "voyage": {
        "id": 45,
        "trajet_id": 12,
        "compagnie_id": 3,
        "vehicle_id": 22,
        "trajet": {
          "id": 12,
          "departure_city_id": 1,
          "arrival_city_id": 2,
          "departure_city": {
            "id": 1,
            "name": "Ouagadougou"
          },
          "arrival_city": {
            "id": 2,
            "name": "Bobo-Dioulasso"
          }
        },
        "compagnie": {
          "id": 3,
          "name": "TransFaso",
          "logo": "https://fasotravel.com/storage/compagnies/transfaso.png",
          "rating": 4.5
        },
        "vehicle": {
          "id": 22,
          "registration_number": "11 AA 1234",
          "type": "bus",
          "capacity": 52,
          "features": ["climatisation", "wifi", "prises_usb"]
        }
      }
    },
    {
      "id": 124,
      "voyage_id": 46,
      "departure_date": "2025-07-10",
      "departure_time": "10:30:00",
      "arrival_time": "15:00:00",
      "duration": "4h 30min",
      "available_seats": 45,
      "total_seats": 52,
      "price": 5200,
      "status": "scheduled",
      "voyage": {
        "id": 46,
        "trajet_id": 12,
        "compagnie_id": 2,
        "vehicle_id": 18,
        "trajet": {
          "id": 12,
          "departure_city_id": 1,
          "arrival_city_id": 2,
          "departure_city": {
            "id": 1,
            "name": "Ouagadougou"
          },
          "arrival_city": {
            "id": 2,
            "name": "Bobo-Dioulasso"
          }
        },
        "compagnie": {
          "id": 2,
          "name": "BurkiTravel",
          "logo": "https://fasotravel.com/storage/compagnies/burkitravel.png",
          "rating": 4.2
        },
        "vehicle": {
          "id": 18,
          "registration_number": "11 BB 5678",
          "type": "bus",
          "capacity": 52,
          "features": ["climatisation", "wifi"]
        }
      }
    }
  ]
}
```

### Détails d'un voyage

**Endpoint** : `GET /trips/{id}`

**Description** : Récupère les détails d'un voyage spécifique.

**Réponse** :

```json
{
  "id": 123,
  "voyage_id": 45,
  "departure_date": "2025-07-10",
  "departure_time": "08:00:00",
  "arrival_time": "12:30:00",
  "duration": "4h 30min",
  "available_seats": 32,
  "total_seats": 52,
  "price": 5000,
  "status": "scheduled",
  "voyage": {
    "id": 45,
    "trajet_id": 12,
    "compagnie_id": 3,
    "vehicle_id": 22,
    "trajet": {
      "id": 12,
      "departure_city_id": 1,
      "arrival_city_id": 2,
      "distance": 365,
      "estimated_time": 270,
      "departure_city": {
        "id": 1,
        "name": "Ouagadougou",
        "region": "Centre"
      },
      "arrival_city": {
        "id": 2,
        "name": "Bobo-Dioulasso",
        "region": "Hauts-Bassins"
      }
    },
    "compagnie": {
      "id": 3,
      "name": "TransFaso",
      "logo": "https://fasotravel.com/storage/compagnies/transfaso.png",
      "description": "Transport confortable et sécurisé à travers le Burkina Faso",
      "contact_phone": "+226 70 12 34 56",
      "contact_email": "info@transfaso.com",
      "website": "https://www.transfaso.com",
      "rating": 4.5,
      "reviews_count": 128
    },
    "vehicle": {
      "id": 22,
      "registration_number": "11 AA 1234",
      "type": "bus",
      "model": "Mercedes Travego",
      "capacity": 52,
      "features": ["climatisation", "wifi", "prises_usb", "toilettes"],
      "year": 2022
    }
  },
  "boarding_points": [
    {
      "id": 1,
      "name": "Gare routière de Ouagadougou",
      "address": "Avenue de l'Indépendance, Ouagadougou",
      "coordinates": {
        "latitude": 12.371427,
        "longitude": -1.519660
      }
    }
  ],
  "dropping_points": [
    {
      "id": 2,
      "name": "Gare routière de Bobo-Dioulasso",
      "address": "Avenue de la Nation, Bobo-Dioulasso",
      "coordinates": {
        "latitude": 11.178025,
        "longitude": -4.291773
      }
    }
  ]
}
```

### Sièges disponibles pour un voyage

**Endpoint** : `GET /trips/{id}/seats`

**Description** : Récupère la disponibilité des sièges pour un voyage spécifique.

**Réponse** :

```json
{
  "trip_id": 123,
  "total_seats": 52,
  "available_seats": 32,
  "booked_seats": ["A1", "A2", "A3", "B1", "B2", "C4", "D5", "E1", "E2"],
  "seat_map": {
    "layout": "2-2",
    "rows": 13,
    "columns": ["A", "B", "C", "D"],
    "unavailable_positions": ["A13", "B13", "C13", "D13"],
    "seats": [
      {
        "id": "A1",
        "row": 1,
        "column": "A",
        "status": "booked",
        "price": 5000,
        "features": ["window"]
      },
      {
        "id": "B1",
        "row": 1,
        "column": "B",
        "status": "booked",
        "price": 5000,
        "features": ["aisle"]
      },
      {
        "id": "C1",
        "row": 1,
        "column": "C",
        "status": "available",
        "price": 5000,
        "features": ["aisle"]
      },
      {
        "id": "D1",
        "row": 1,
        "column": "D",
        "status": "available",
        "price": 5000,
        "features": ["window"]
      }
      // ... autres sièges
    ]
  }
}
```

### Recherche avancée de voyages

**Endpoint** : `POST /trips/search`

**Description** : Effectue une recherche avancée de voyages avec des filtres spécifiques.

**Corps de la requête** :

```json
{
  "departureCity": 1,
  "arrivalCity": 2,
  "date": "2025-07-10",
  "company": 3,
  "passengers": 2,
  "vehicleType": "bus"
}
```

**Réponse** :

```json
{
  "status": "success",
  "trips": [
    {
      "id": 123,
      "voyage_id": 45,
      "departure_date": "2025-07-10",
      "departure_time": "08:00:00",
      "arrival_time": "12:30:00",
      "duration": "4h 30min",
      "available_seats": 32,
      "total_seats": 52,
      "price": 5000,
      "status": "scheduled",
      "voyage": {
        "id": 45,
        "trajet_id": 12,
        "compagnie_id": 3,
        "vehicle_id": 22,
        "trajet": {
          "id": 12,
          "departure_city_id": 1,
          "arrival_city_id": 2,
          "departure_city": {
            "id": 1,
            "name": "Ouagadougou"
          },
          "arrival_city": {
            "id": 2,
            "name": "Bobo-Dioulasso"
          }
        },
        "compagnie": {
          "id": 3,
          "name": "TransFaso",
          "logo": "https://fasotravel.com/storage/compagnies/transfaso.png",
          "rating": 4.5
        },
        "vehicle": {
          "id": 22,
          "registration_number": "11 AA 1234",
          "type": "bus",
          "capacity": 52,
          "features": ["climatisation", "wifi", "prises_usb"]
        }
      }
    }
  ]
}
```

## Conclusion

Cette documentation couvre les principales fonctionnalités de l'API Faso Travel V2. Pour toute question ou assistance supplémentaire, veuillez contacter l'équipe technique à l'adresse api-support@fasotravel.com.

### Versions

- Version actuelle : 2.0.0
- Dernière mise à jour : 22 juin 2025
