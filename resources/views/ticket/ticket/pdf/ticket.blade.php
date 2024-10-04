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
        <h4>Bonjours a vous</h4>
        <h1>{{ $ticket->user->name }}</h1>
        <h3>{{ $ticket->code_ticket }}</h3>
    </div>
    <div>
        <img src="{{ $qrCodePath }}" >
    </div>
</body>
</html>
