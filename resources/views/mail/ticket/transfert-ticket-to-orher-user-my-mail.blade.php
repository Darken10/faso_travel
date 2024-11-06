<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>pdf</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css'])
    </head>
    <body>
        <div>
            <h4>Bonjours {{ $ticket->user->name  }}</h4>
            <p>
                votre transfert de ticket N° {{ $ticket->numero_ticket}} a {{ \App\Models\User::find($ticket->transferer_a_user_id)->name }}
            </p>
        </div>
    </body>
    </html>
