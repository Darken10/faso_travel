# Documentation API Faso Travel

## Table des matières
- [Authentification](#authentification)
- [Tickets](#tickets)
- [Voyages](#voyages)
- [Posts](#posts)
- [Paiements](#paiements)

## Authentification

### Inscription
- **URL**: `/api/auth/register`
- **Méthode**: `POST`
- **Description**: Permet de créer un nouveau compte utilisateur
**Données d'entrée:**
```json
{
    "name": "string",
    "email": "string",
    "password": "string",
    "password_confirmation": "string"
}
```
**Réponse:**
```json
{
    "user": {
        "id": "integer",
        "name": "string",
        "email": "string",
        "created_at": "timestamp"
    },
    "token": "string"
}
```

### Connexion
- **URL**: `/api/auth/login`
- **Méthode**: `POST`
- **Description**: Permet de se connecter et obtenir un token d'authentification
**Données d'entrée:**
```json
{
    "email": "string",
    "password": "string"
}
```
**Réponse:**
```json
{
    "token": "string",
    "user": {
        "id": "integer",
        "name": "string",
        "email": "string"
    }
}
```

### Profil Utilisateur
- **URL**: `/api/auth/me`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Récupère les informations de l'utilisateur connecté

## Tickets

### Vérification par numéro
- **URL**: `/api/ticket/verification/with-number`
- **Méthode**: `POST`
- **Auth**: Requise
- **Paramètres**:
  - `ticket_id`
  - `numero_ticket`
- **Description**: Vérifie un ticket par son numéro
**Données d'entrée:**
```json
{
    "ticket_id": "integer",
    "numero_ticket": "string"
}
```
**Réponse:**
```json
{
    "status": "boolean",
    "ticket": {
        "id": "integer",
        "numero": "string",
        "status": "string",
        "passager": {
            "nom": "string",
            "prenom": "string"
        },
        "voyage": {
            "depart": "string",
            "destination": "string",
            "date": "date",
            "heure": "time"
        }
    }
}
```

### Vérification par QR Code
- **URL**: `/api/ticket/verification/{ticket_code}`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Vérifie un ticket en utilisant son code QR

### Validation de Ticket
- **URL**: `/api/ticket/valider`
- **Méthode**: `POST`
- **Auth**: Requise
- **Description**: Valide un ticket existant
**Données d'entrée:**
```json
{
    "ticket_id": "integer"
}
```
**Réponse:**
```json
{
    "success": "boolean",
    "message": "string",
    "ticket": {
        "id": "integer",
        "status": "string",
        "validated_at": "timestamp"
    }
}
```

### Statistiques des Tickets

#### Tickets payés aujourd'hui
- **URL**: `/api/tickets/today-paid`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Liste les passagers ayant payé aujourd'hui

#### Tickets validés aujourd'hui
- **URL**: `/api/tickets/today-validated`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Liste les tickets validés aujourd'hui

#### Tous les tickets validés
- **URL**: `/api/tickets/validated`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Liste tous les tickets validés

## Voyages

### Liste des voyages
- **URL**: `/api/voyages`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Récupère la liste des voyages disponibles

### Voyages du jour
- **URL**: `/api/voyages/today`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Liste les instances de voyage du jour

### Tickets par voyage
- **URL**: `/api/voyages/{voyageInstanceId}/tickets`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Liste les tickets pour une instance de voyage spécifique

### Gestion des voyages (Compagnie)
#### Liste des voyages
- **URL**: `/api/compagnie/voyages`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Liste les voyages de la compagnie

#### Détails voyage avec passagers
- **URL**: `/api/compagnie/voyages/{voyage}`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Détails d'un voyage avec la liste des passagers

## Posts

### Liste des posts
- **URL**: `/api/posts`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Récupère la liste des posts

### Détails d'un post
- **URL**: `/api/posts/{id}`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Récupère les détails d'un post spécifique

### Création d'un post
**Données d'entrée:**
```json
{
    "content": "string",
    "media": "file?",
    "type": "string"
}
```
**Réponse:**
```json
{
    "id": "integer",
    "content": "string",
    "media_url": "string?",
    "type": "string",
    "created_at": "timestamp",
    "user": {
        "id": "integer",
        "name": "string"
    }
}
```

### Interactions avec les posts

#### Aimer un post
- **URL**: `/api/posts/{post}/like`
- **Méthode**: `POST`
- **Auth**: Requise
- **Description**: Ajoute un "j'aime" à un post

#### Retirer son "j'aime"
- **URL**: `/api/posts/{post}/like`
- **Méthode**: `DELETE`
- **Auth**: Requise
- **Description**: Retire son "j'aime" d'un post

#### Ajouter un commentaire
- **URL**: `/api/posts/{post}/addcomment`
- **Méthode**: `POST`
- **Auth**: Requise
- **Description**: Ajoute un commentaire à un post
**Données d'entrée:**
```json
{
    "content": "string"
}
```
**Réponse:**
```json
{
    "id": "integer",
    "content": "string",
    "created_at": "timestamp",
    "user": {
        "id": "integer",
        "name": "string"
    }
}
```

#### Liste des "j'aime"
- **URL**: `/api/posts/{post}/likes`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Liste les "j'aime" d'un post

#### Liste des commentaires
- **URL**: `/api/posts/{post}/comments`
- **Méthode**: `GET`
- **Auth**: Requise
- **Description**: Liste les commentaires d'un post

## Paiements

### Traitement du paiement
- **URL**: `/api/process-payment/{provider}`
- **Méthode**: `POST`
- **Description**: Traite un paiement via le fournisseur spécifié
**Données d'entrée:**
```json
{
    "amount": "number",
    "currency": "string",
    "phone_number": "string",
    "ticket_ids": "array"
}
```
**Réponse:**
```json
{
    "success": "boolean",
    "transaction_id": "string",
    "message": "string",
    "tickets": [
        {
            "id": "integer",
            "numero": "string",
            "status": "string"
        }
    ]
}
```

## Notes
- Toutes les routes nécessitant une authentification doivent inclure un token Bearer dans l'en-tête de la requête
- Les réponses sont au format JSON
- Les erreurs retournent un code HTTP approprié avec un message d'erreur
