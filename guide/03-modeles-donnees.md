# 03 — Modèles de données (vue conceptuelle)

Basé sur `docs/api-architecture.md` et les routes.

## User
- id, name, email, password, phone?, profileImage?, timestamps
- Relations: hasMany Ticket, Notification, Article

## Voyage (Trip) et VoyageInstance
- Voyage: départ/arrivée (ville, station, heure), compagnie, prix, durée, type véhicule, seatsAvailable.
- VoyageInstance: occurrence datée (jour/heure), statut, capacité, liens vers Voyage.

## Seat (Siège)
- id, tripId/voyageInstanceId, number, status (available|occupied|selected), price, type (standard|premium|vip)

## Ticket
- id (UUID/int), voyageInstanceId, userId, seatNumber, purchaseDate, travelDate, qrCode, status, isForSelf, relationToPassenger?, passengerEmail?, passengerPhone?, type (one-way|round-trip)

## Article / Post
- Article: id, title, summary, content, image, category, tags[], publishedAt, likes, comments, authorId
- Post (social): content, media?, type; likes, comments

## Notification
- id, userId, title, message, type (info|success|warning|error), read, timestamps

## Paiement/Transaction (à préciser)
- id, provider, amount, currency, phone_number, tickets[], status, transaction_id, callbacks

## Enum/Constantes
- Statuts ticket: valid, paused, blocked, used, upcoming, past, cancelled
- Types siège: standard, premium, vip
- Types véhicule: bus, train, ferry (extensible)

Notes: Les structures exactes se déduisent des Eloquent Models sous `app/` (non détaillés ici).
