<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css'])
</head>
<body>
<h1>Bonjours a vous</h1>
<p>
    {{ $ticket->user->name }} vient de vous envoyer un ticket de voyage de
    <b>{{ $ticket->villeDepart()->name  }} => {{ $ticket->villeArriver()->name  }}</b>  dans la compagnie
    <b>{{ $ticket->compagnie()->name }}</b> à <b>{{ $ticket->heureDepart() }}</b> <br>
    le numero du ticket est  {{ $ticket->numero_ticket }} <br>
    le code de validation du ticket est {{ $ticket->code_sms }}
</p>

<div class=" flex justify-center my-4">
    <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($ticket->code_qr_uri))  }}"   alt="Le code QR">
</div>
</body>
</html>
