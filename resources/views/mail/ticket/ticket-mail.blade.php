<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Bonjours a vous</h1>
    <p>
        vous venez de payer le ticket N° {{ $ticket->numero_ticket }}
        le code de validation du ticket est {{ $ticket->code_sms }}
    </p>

    <div class=" flex justify-center my-4">
        <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($ticket->code_qr_uri))  }}"   alt="Le code QR">
    </div>
</body>
</html>
