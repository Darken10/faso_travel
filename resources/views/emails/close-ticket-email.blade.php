<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Voyage - Blocage</title>
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
            background: #d32f2f;
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
            background: #d32f2f;
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
        <h2>Ticket de Voyage - Blocage</h2>
    </div>
    <div class="content">
        <p>Bonjour <strong>{{auth()->user()->name}}</strong>,</p>
        <p>Nous vous informons que votre ticket a été bloqué et ne peut plus être utilisé pour le moment.</p>
        <p><strong>Détails du Ticket :</strong></p>
        <ul>
            <li><strong>Numéro du ticket :</strong> {{$ticket->numero_ticket}}</li>
            <li><strong>Départ :</strong> {{$ticket->voyageInstance->villeDepart()->name}}</li>
            <li><strong>Destination :</strong> {{$ticket->voyageInstance->villeArrive()->name}}</li>
            <li><strong>Statut :</strong> <x-ticket.badge-statut :statut="$ticket->statut"></x-ticket.badge-statut></li>
        </ul>
        <p>Pour toute question ou demande de réactivation, veuillez contacter notre support :</p>
        <p><a href="[Lien support]" class="button">Contacter le support</a></p>
        <p>Merci de votre compréhension.</p>
    </div>
    <div class="footer">
        <p>&copy; 2025 Votre Compagnie de Voyage. Tous droits réservés.</p>
    </div>
</div>
</body>
</html>
