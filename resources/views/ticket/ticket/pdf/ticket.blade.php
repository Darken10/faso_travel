<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
</head>
<body>
    <div>
        <h4 >Bonjours a vous</h4>
        @if($ticket->is_my_ticket)
            <h1>{{ $ticket->user->name }}</h1>
        @elseif($ticket->autre_personne_id !== null)
            <h1>{{ $ticket->autre_personne->name }}</h1>
        @elseif($ticket->transferer_a_user_id !== null)
            <h1>{{ \App\Models\User::find($ticket->transferer_a_user_id)->name }}</h1>
        @else
            <h1>{{ $ticket->user->name }}</h1>
        @endif
        <h3>{{ $ticket->code_ticket }}</h3>
    </div>
    <div>
        <img src="{{ $qrCodePath }}"  alt="code QR">
    </div>
</body>
</html>
