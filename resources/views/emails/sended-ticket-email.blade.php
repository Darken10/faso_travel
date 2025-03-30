<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Voyage - Transfert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #007bff;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            text-align: left;
        }
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777;
        }
        .button {
            display: inline-block;
            background: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Ticket de Voyage - Transfert</h2>
    </div>
    <div class="content">
        @php
            $trans = \App\Models\User::find($ticket->transferer_a_user_id)
        @endphp
        <p>Bonjour <strong>{{auth()->user()->name}}</strong>,</p>
        <p>Vous avez transféré votre ticket de voyage avec succès à <strong>{{$trans->name}}</strong>.</p>
        <p><strong>Détails du Ticket Transféré :</strong></p>
        <ul>
            <li><strong>Numéro du ticket :</strong> {{$ticket->numero_ticket}}</li>
            <li><strong>Départ :</strong> {{$ticket->voyageInstance->villeDepart()->name}}</li>
            <li><strong>Destination :</strong> {{$ticket->voyageInstance->villeArrive()->name}}</li>
            <li><strong>Date et Heure :</strong> {{$ticket->voyageInstance->date->format("d/m/y")}} a {{$ticket->voyageInstance->heure->format("H\h i")}}</li>
            <li><strong>Siège :</strong> Chaise n°{{$ticket->numero_chaise }}</li>
            <li><strong>Prix :</strong> {{$ticket->prix()}} XOF</li>
            <li><strong>Statut :</strong> Transféré</li>
        </ul>
        <p>Si vous avez des questions, n'hésitez pas à nous contacter :</p>
        <p><a href="[Lien support]" class="button">Contacter le support</a></p>
    </div>
    <div class="footer">
        <p>&copy; 2025 Votre Compagnie de Voyage. Tous droits réservés.</p>
    </div>
</div>
</body>
</html>
