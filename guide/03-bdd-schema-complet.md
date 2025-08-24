# Schéma complet de la base de données

Ce document synthétise les tables, colonnes clés, contraintes et relations d'après les migrations dans `database/migrations/`.

## 1) Référentiels géographiques

- pays
  - id PK
  - name, money, identity_number, iso2

- regions
  - id PK
  - name
  - pays_id FK -> pays.id (cascadeOnDelete)

- villes
  - id PK
  - name, lat, lng
  - region_id FK nullable -> regions.id (cascadeOnDelete)

## 2) Organisation (compagnies, gares, paramètres)

- statuts
  - id PK, name

- compagnies
  - id PK
  - name (unique), sigle (unique), slogant?, description?, logo_uri?
  - user_id FK nullable -> users.id (owner, nullOnDelete)
  - statut_id FK -> statuts.id (noActionOnDelete)

- gares
  - id PK
  - name, lng, lat
  - ville_id FK -> villes.id (restrictOnDelete)
  - statut_id FK -> statuts.id (restrictOnDelete)
  - user_id FK -> users.id (restrictOnDelete)
  - compagnie_id FK nullable -> compagnies.id (nullOnDelete)

- compagnie_settings
  - id PK
  - compagnie_id FK -> compagnies.id (cascade)
  - key, value, type('string' par défaut)

## 3) Trajets, classes, conforts, voyages, véhicules, instances

- classes
  - id PK, name, description?
  - user_id FK -> users.id (cascadeOnDelete)

- conforts
  - id PK, title, description?
  - user_id FK -> users.id

- classe_confort (pivot)
  - id PK
  - classe_id FK -> classes.id (cascadeOnDelete)
  - confort_id FK -> conforts.id (cascadeOnDelete)

- trajets
  - id PK
  - user_id FK -> users.id
  - depart_id FK -> villes.id
  - arriver_id FK -> villes.id
  - distance int?, temps time?, etat tinyInt?

- voyages
  - id PK
  - heure time
  - prix unsignedBigInt default 0
  - prix_aller_retour unsignedBigInt default 0
  - is_quotidient bool default true
  - temps time?, days JSON?
  - trajet_id FK -> trajets.id (restrictOnDelete)
  - user_id FK -> users.id (restrictOnDelete)
  - compagnie_id FK -> compagnies.id (restrictOnDelete)
  - classe_id FK -> classes.id (restrictOnDelete, default 1)
  - depart_id FK nullable -> gares.id (cascade)
  - arrive_id FK nullable -> gares.id (cascade)
  - statut_id FK -> statuts.id (default 1)
  - nb_pace int default 0

- cares (véhicules)
  - id PK
  - immatrculation (plaque)
  - number_place smallint default 1
  - statut enum App\Enums\StatutCare
  - etat smallint default 1
  - image_uri?
  - compagnie_id FK nullable -> compagnies.id (nullOnDelete)

- care_voyage (pivot planification par date)
  - id PK
  - care_id FK -> cares.id (cascadeOnDelete)
  - voyage_id FK -> voyages.id (cascadeOnDelete)
  - date

- chauffers (chauffeurs)
  - id UUID PK
  - first_name, last_name, date_naissance, genre
  - compagnie_id (FK logique)
  - statut (string)
  - timestamps, softDeletes

- voyage_instances
  - id UUID PK
  - voyage_id FK -> voyages.id
  - care_id FK nullable -> cares.id
  - chauffer_id FK nullable -> chauffers.id
  - date, heure, nb_place uint
  - statut enum App\Enums\StatutVoyageInstance default DISPONIBLE
  - timestamps, softDeletes

## 4) Tickets et paiements

- autre_personnes (passager tiers)
  - id PK
  - first_name, last_name, name, sexe enum App\Enums\SexeUser
  - email unique nullable, numero?, numero_identifiant '+226' par défaut
  - lien_relation?
  - user_id FK nullable -> users.id (nullOnDelete)

- tickets
  - id PK
  - user_id FK nullable -> users.id (nullOnDelete)
  - voyage_id FK nullable -> voyages.id (nullOnDelete)
  - voyage_instance_id FK nullable -> voyage_instances.id
  - a_bagage bool default false, bagages_data JSON?
  - date (voyage)
  - type enum App\Enums\TypeTicket
  - statut enum App\Enums\StatutTicket
  - numero_ticket (string)
  - numero_chaise uint nullable
  - code_sms, code_qr
  - image_uri?, pdf_uri?, code_qr_uri?
  - autre_personne_id FK nullable -> autre_personnes.id (nullOnDelete)
  - is_my_ticket bool default true
  - transferer_at datetime?, transferer_a_user_id bigint nullable (FK logique vers users)
  - valider_by_id bigint nullable (FK logique vers users), valider_at datetime?
  - retour_validate_by FK -> users.id nullable, retour_validate_at datetime?
  - timestamps

- payements
  - id PK
  - ticket_id FK nullable -> tickets.id (nullOnDelete)
  - numero_payment? (bigint), montant unsignedBigInt default 0
  - trans_id?, token?, code_otp?
  - statut enum App\Enums\StatutPayement (default: EnAttente)
  - moyen_payment enum App\Enums\MoyenPayment
  - timestamps

## 5) Contenu (posts, tags, catégories, commentaires, likes)

- categories (id PK, name)
- tags (id PK, name)
- posts
  - id PK, title, content, images_uri JSON?, nb_views int default 0
  - user_id FK nullable -> users.id (nullOnDelete)
  - category_id FK nullable -> categories.id

- post_tag (pivot)
  - post_id FK -> posts.id (cascade)
  - tag_id FK -> tags.id (cascade)

- comments
  - id PK, message
  - user_id FK nullable -> users.id (nullOnDelete)
  - commentable_type, commentable_id (morph)
  - nb_likes uint default 0

- likes
  - id PK
  - post_id FK nullable -> posts.id (nullOnDelete)
  - user_id FK nullable -> users.id (nullOnDelete)

## 6) Auth/Jetstream/Sanctum et tables systèmes

- users
  - id PK
  - first_name, last_name, name
  - sexe enum App\Enums\SexeUser
  - email unique
  - numero int nullable, numero_identifiant string default '+226'
  - email_verified_at nullable, password, remember_token
  - current_team_id nullable
  - profile_photo_path nullable
  - role enum App\Enums\UserRole default User
  - statut enum App\Enums\StatutUser default Active
  - compagnie_id FK nullable -> compagnies.id (nullOnDelete)
  - timestamps

- password_reset_tokens (email PK, token, created_at)
- sessions (id PK, user_id?, ip_address, user_agent, payload, last_activity)
- teams (id, user_id, name, personal_team)
- team_user (id, team_id, user_id, role?; unique(team_id,user_id))
- team_invitations (id, team_id FK, email, role?; unique(team_id,email))
- personal_access_tokens (Sanctum)
- cache, jobs (systèmes)
- notifications (uuid id PK, type, notifiable_type, notifiable_id, data TEXT, read_at, timestamps)

## 7) Diagramme ER (Mermaid)

```mermaid
%%{init: { 'theme': 'neutral' }}%%
erDiagram
  PAYS ||--o{ REGIONS : contient
  REGIONS ||--o{ VILLES : contient

  COMPAGNIES ||--o{ GARES : possede
  COMPAGNIES ||--o{ VOYAGES : exploite
  COMPAGNIES ||--o{ COMPAGNIE_SETTINGS : configure
  COMPAGNIES ||--o{ CARES : possede
  USERS ||--o{ COMPAGNIES : owner?

  VILLES ||--o{ GARES : localise
  USERS ||--o{ TRAJETS : cree
  VILLES ||--o{ TRAJETS : depart/arrivee

  CLASSES ||--o{ VOYAGES : type
  CLASSES ||--o{ CLASSE_CONFORT : rel
  CONFORTS ||--o{ CLASSE_CONFORT : rel

  VOYAGES ||--o{ VOYAGE_INSTANCES : planifie
  CARES }o--o{ VOYAGES : "CARE_VOYAGE (date)"
  CARES ||--o{ VOYAGE_INSTANCES : optionnel
  CHAUFFERS ||--o{ VOYAGE_INSTANCES : optionnel

  USERS ||--o{ TICKETS : achete
  VOYAGES ||--o{ TICKETS : concerne
  VOYAGE_INSTANCES ||--o{ TICKETS : concerne
  AUTRE_PERSONNES ||--o{ TICKETS : passager
  TICKETS ||--o{ PAYEMENTS : paye
  USERS ||--o{ TICKETS : transfer/validate

  USERS ||--o{ POSTS : ecrit
  CATEGORIES ||--o{ POSTS : classe
  POSTS }o--o{ TAGS : tag
  USERS ||--o{ COMMENTS : ecrit
  POSTS ||--o{ COMMENTS : commentable
  USERS ||--o{ LIKES : like
  POSTS ||--o{ LIKES : recoit

  USERS ||--o{ TEAMS : owner
  TEAMS ||--o{ TEAM_USER : membership
  USERS ||--o{ TEAM_USER : member

  USERS ||--o{ NOTIFICATIONS : notifiable
```

## 8) Notes et écarts

- Plusieurs FK « logiques » ne sont pas toutes explicitement contraintes (ex: `tickets.transferer_a_user_id`, `tickets.valider_by_id`). La logique applicative se trouve côté modèles `app/Models` et contrôleurs.
- Enums: se référer à `app/Enums/*` pour les valeurs exactes (`UserRole`, `StatutUser`, `SexeUser`, `TypeTicket`, `StatutTicket`, `MoyenPayment`, `StatutPayement`, `StatutCare`, `StatutVoyageInstance`).
- UUID: `voyage_instances.id`, `chauffers.id`, `notifications.id`.
- Polymorphisme: `notifications.notifiable`, `comments.commentable`.
