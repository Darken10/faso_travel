{{--
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>billet </title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        /* Conteneur principal du billet */
        .ticket {
            width: 100%;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }

        /* En-tête (bande bleue) */
        .ticket-header {
            background-color: #1b9ef2;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }
        .ticket-header .logo {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 1.2em;
        }
        .ticket-header .logo span {
            margin-left: 8px;
        }
        .ticket-header .ticket-class {
            font-weight: bold;
            font-size: 1em;
        }
        .ticket-header .ticket-type {
            font-weight: bold;
            font-size: 1em;
        }

        /* Partie principale du billet */
        .ticket-body {
            display: flex;
            padding: 20px;
            border-bottom: 2px dashed #ccc;
        }

        /* Colonne gauche avec les informations principales */
        .ticket-info {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .ticket-info h2 {
            font-size: 1.1em;
            margin-bottom: 5px;
        }
        .ticket-info p {
            font-size: 0.95em;
            line-height: 1.4em;
        }

        /* Colonne droite avec le code QR et quelques infos */
        .ticket-extra {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Apparence du "code QR" fictif (vous pouvez y mettre une vraie image) */
        .qr-code {
            width: 120px;
            background-color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Pied de page du billet */
        .ticket-footer {
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
        }
        .ticket-footer .code {
            font-size: 0.9em;
            font-weight: bold;
            color: #555;
        }
        .ticket-footer .company {
            font-size: 0.9em;
            font-weight: bold;
            color: #1b9ef2;
        }
    </style>
</head>
<body>
<div class="ticket">
    <!-- En-tête du billet -->
    <div class="ticket-header">
        <div class="logo">
            <!-- Icône d'avion (Unicode) -->
            <span style="font-size: 1.4em;">&#9992;</span>
            <span>{{strtoupper($ticket->compagnie()->name)}}</span>
        </div>
        <div class="ticket-class">{{ strtoupper($ticket->classe()->name) }}</div>
        <div class="ticket-type">CARTE D'EMBARQUEMENT</div>
    </div>

    <!-- Corps du billet -->
    <div class="ticket-body">
        <!-- Informations principales -->
        <div class="ticket-info">
            <h2>NOM DU PASSAGER :
                @if($ticket->is_my_ticket)
                    {{ $ticket->user->name }}
                @elseif($ticket->autre_personne_id !== null)
                    {{ $ticket->autre_personne->name }}
                @elseif($ticket->transferer_a_user_id !== null)
                    {{ \App\Models\User::find($ticket->transferer_a_user_id)->name }}
                @else
                    {{ $ticket->user->name }}
                @endif
            </h2>
            <p><strong>Voyage :</strong> 14LD23</p>
            <p><strong>Date :</strong> {{$ticket->voyageInstance->date->format("d m M Y")}}</p>
            <p><strong>Heure :</strong> {{$ticket->voyageInstance->heure->format("H\h i")}}</p>
            <p><strong>Embarquement :</strong> {{$ticket->heureRdv()->format("H\h i")}} à {{$ticket->voyageInstance->heure->format("H\h i")}}</p>
            <p><strong>De :</strong> {{$ticket->voyageInstance->villeDepart()->name}}</p>
            <p><strong>À :</strong> {{$ticket->voyageInstance->villeArrive()->name}}</p>
            <p><strong>Siège :</strong> {{$ticket->numero_chaise}} &nbsp;&nbsp;|&nbsp;&nbsp; <strong>Classe :</strong> {{$ticket->voyageInstance->classe()->name}}</p>
        </div>

        <!-- QR code et texte associé -->
        <div class="ticket-extra">
            <div class="qr-code">
                <img src="{{ $qrCodePath }}" alt="QR-CODE">
            </div>
            <p style="font-size: 0.85em; text-align: center;">
                Faire Scannez pour embarquer
            </p>
        </div>
    </div>

    <!-- Pied de page du billet -->
    <div class="ticket-footer">
        <div class="code">{{$ticket->numero_ticket}}</div>
        <div class="company">{{strtoupper($ticket->compagnie()->name)}}</div>
    </div>
</div>
</body>
</html>
--}}



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Billet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #ffffff;
            padding: 20px;
        }

        .ticket {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }

        .ticket-header {
            background-color: #1b9ef2;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 1.2em;
        }

        .ticket-body {
            display: table;
            width: 100%;
        }

        .ticket-info, .ticket-extra {
            display: table-cell;
            vertical-align: top;
            padding: 10px;
        }

        .ticket-info p {
            margin-bottom: 5px;
        }

        .qr-code img {
            width: 200px;
            height: 200px;
        }

        .ticket-footer {
            background-color: #f9f9f9;
            text-align: center;
            padding: 10px;
            font-size: 0.9em;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="ticket">
    <div class="ticket-header">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 181.81"><path d="M399.47 126.45c15.29 0 27.68 12.39 27.68 27.68s-12.39 27.68-27.68 27.68-27.68-12.39-27.68-27.68 12.39-27.68 27.68-27.68zM.43 132.48c-.75-25.42-.53-47.41.76-65.69 1.3-18.5 3.7-33.32 7.25-44.18 3.19-9.76 7.29-15.4 12.95-18.67C26.98.72 33.78 0 42.57 0h378.46c7.77 0 15.07.11 22.23 1.17 7.27 1.08 14.31 3.13 21.38 7.02 4.38 2.41 7.98 5.65 10.97 9.48 2.02 2.56 3.75 5.39 5.25 8.38 1.24-.52 2.56-.95 3.91-1.3 12.21-3.71 27.25-2.16 27.23 10.68l-.05 24.44c-.01 2.91-2.39 5.29-5.3 5.29H504c-1.46 0-2.65-1.19-2.65-2.64V38.84c0-2.6-1.31-4.83-4.24-5.62-3.12-.64-6.77-.52-10.09.33-1.04.27-2.04.62-2.99 1.04 2.76 9.93 5.38 19.9 7.68 29.99 2.6 11.46 4.77 22.98 6.21 34.58l.02.32v35.1l-.03.36c-.6 10.59-5.11 16.7-11.84 20.22-6.41 3.35-14.71 4.14-23.44 4.26l-27.42.01c-1.46 0-2.65-1.19-2.65-2.66l.02-.33c.04-.74.07-1.5.07-2.3 0-8.68-3.35-16.65-8.86-22.6-5.52-5.95-13.21-9.89-21.88-10.51a33.12 33.12 0 0 0-4.88 0c-8.67.62-16.36 4.56-21.88 10.51a33.202 33.202 0 0 0-8.86 22.6c0 .85.03 1.67.08 2.45.11 1.46-1 2.73-2.46 2.83l-188.53.01c-1.47 0-2.66-1.19-2.66-2.66l.02-.33a33.164 33.164 0 0 0-8.79-24.9c-5.51-5.95-13.21-9.89-21.88-10.51-1.6-.12-3.27-.12-4.88 0-8.67.62-16.36 4.56-21.87 10.51a33.164 33.164 0 0 0-8.87 22.6c0 .85.03 1.67.09 2.45.1 1.46-1 2.73-2.46 2.83l-74.37.01-.35-.02c-7.93-.65-14.5-2.99-19.44-7.3-5-4.37-8.25-10.66-9.46-19.17l-.03-.46zm349.6-32.32v53.95h10.95c0-10.04 3.89-19.28 10.29-26.18 6.4-6.9 15.32-11.47 25.39-12.19 1.89-.14 3.73-.14 5.62 0 10.07.72 18.99 5.29 25.39 12.19 6.4 6.9 10.29 16.14 10.3 26.18h3.97v-53.95h-91.91zm-3.32 53.95v-53.95h-76.7v53.95h76.7zm-80.02 0v-53.95h-76.7v53.95h76.7zm-80.02 0v-53.95H39.56v53.95h61.58a38.493 38.493 0 0 1 10.29-26.18c6.4-6.9 15.33-11.47 25.39-12.19 1.89-.14 3.74-.14 5.63 0 10.06.72 18.98 5.29 25.39 12.19 6.4 6.9 10.28 16.14 10.29 26.18h8.54zm-150.43 0V98.5c0-.92.74-1.66 1.66-1.66h405.7c.92 0 1.66.74 1.66 1.66v55.61h17.34c8.01-.09 15.55-.78 21.02-3.64 5.1-2.67 8.52-7.44 9-15.84v-35c-1.42-11.45-3.54-22.72-6.08-33.89-2.55-11.2-5.54-22.38-8.69-33.56-1.74-4.12-3.83-7.96-6.41-11.25-2.56-3.27-5.63-6.04-9.35-8.09-6.45-3.55-12.91-5.43-19.6-6.42-6.77-1-13.88-1.11-21.46-1.11H42.57c-7.95 0-13.99.59-18.54 3.22-4.47 2.57-7.8 7.32-10.55 15.72-3.41 10.45-5.72 24.84-6.99 42.89-.15 2.13-.29 4.31-.41 6.55h2.16c1.61 0 2.93 1.31 2.93 2.92v23.23c0 1.95-1.6 3.55-3.56 3.55H5.3c-.02 9.07.12 18.71.42 28.9 1.04 7.14 3.67 12.33 7.68 15.83 4.03 3.52 9.57 5.44 16.38 5.99h6.46zM443.38 15.76c33.42 5.01 29.92 47.91 35.84 83.04h-21.61c-7.12 0-12.83-5.83-12.96-12.95l-1.27-70.09zm-389.06.06h9.58c0 .15.01.3.04.46l9.58 54.41H48.81c-12.05 0-21.93-9.87-21.93-21.93v-5.51c0-15.08 12.35-27.43 27.44-27.43zm14.93 0h56c0 .15.01.3.03.46l9.58 54.41H78.87c0-.15-.02-.3-.04-.46l-9.58-54.41zm61.34 0h56c0 .15.01.3.04.46l9.57 54.41h-55.99c0-.15-.01-.3-.04-.46l-9.58-54.41zm61.35 0h55.99c0 .15.02.3.04.46l9.58 54.41h-56c0-.15-.01-.3-.04-.46l-9.57-54.41zm61.34 0h56c0 .15.01.3.04.46l9.57 54.41H262.9c0-.15-.01-.3-.04-.46l-9.58-54.41zm61.35 0h55.99c0 .15.01.3.04.46l9.58 54.41h-56c0-.15-.01-.3-.04-.46l-9.57-54.41zm61.34 0h59.77v54.87h-50.15c0-.15-.02-.3-.04-.46l-9.58-54.41zM314.4 141.14v1.96c0 .66-.53 1.19-1.19 1.19h-9.45c-.79 0-1.44-.65-1.44-1.44v-1.71h12.08zm-80.02 0v1.96c0 .66-.53 1.19-1.19 1.19h-9.45c-.79 0-1.44-.65-1.44-1.44v-1.71h12.08zm-94.75-14.69c15.29 0 27.69 12.39 27.69 27.68s-12.4 27.68-27.69 27.68c-15.28 0-27.68-12.39-27.68-27.68s12.4-27.68 27.68-27.68zm.01 22.02c3.12 0 5.65 2.53 5.65 5.66 0 3.12-2.53 5.66-5.65 5.66a5.661 5.661 0 0 1 0-11.32zm0-9.52c8.38 0 15.17 6.8 15.17 15.18 0 8.38-6.79 15.18-15.17 15.18-8.39 0-15.18-6.8-15.18-15.18 0-8.38 6.79-15.18 15.18-15.18zm259.83 9.52a5.661 5.661 0 0 1 0 11.32c-3.12 0-5.66-2.54-5.66-5.66 0-3.13 2.54-5.66 5.66-5.66zm0-9.52c8.38 0 15.18 6.8 15.18 15.18 0 8.38-6.8 15.18-15.18 15.18-8.38 0-15.18-6.8-15.18-15.18 0-8.38 6.8-15.18 15.18-15.18z"/></svg>
        </span>
        {{ strtoupper($ticket->compagnie()->name) }} - {{ strtoupper($ticket->classe()->name) }} - CARTE D'EMBARQUEMENT
    </div>

    <div class="ticket-body">
        <div class="ticket-info">
            <p style="font-size: 32px;font-weight: bold">
                @if($ticket->is_my_ticket)
                    {{ $ticket->user->name }}
                @elseif($ticket->autre_personne_id !== null)
                    {{ $ticket->autre_personne->name }}
                @elseif($ticket->transferer_a_user_id !== null)
                    {{ \App\Models\User::find($ticket->transferer_a_user_id)->name }}
                @else
                    {{ $ticket->user->name }}
                @endif
            </p>
            <p><strong>Voyage :</strong> 14LD23</p>
            <p><strong>Date :</strong> {{$ticket->voyageInstance->date->format("d M Y")}}</p>
            <p><strong>Heure :</strong> {{$ticket->voyageInstance->heure->format("H\h i")}}</p>
            <p><strong>Embarquement :</strong> {{$ticket->heureRdv()->format("H\h i")}} à {{$ticket->voyageInstance->heure->format("H\h i")}}</p>
            <p><strong>Départ :</strong> {{$ticket->voyageInstance->villeDepart()->name}}</p>
            <p><strong>Arrivée :</strong> {{$ticket->voyageInstance->villeArrive()->name}}</p>
            <p><strong>Siège :</strong> {{$ticket->numero_chaise}}</p>
            <p><strong>Classe :</strong> {{$ticket->voyageInstance->classe()->name}}</p>
            <p><strong>Prix :</strong> {{$ticket->prix()}} XOF</p>
            <p><strong>Car :</strong> {{$ticket->voyageInstance->care->immatrculation ?? "Non Défini"}} </p>

        </div>

        <div class="ticket-extra">
            <div class="qr-code">
                <img src="{{ $qrCodePath }}" alt="QR-CODE">
            </div>
            <p>Scannez pour embarquer</p>
        </div>
    </div>

    <div class="ticket-footer">
        {{$ticket->numero_ticket}} - <span class="company">{{strtoupper($ticket->compagnie()->name)}}</span>
    </div>
</div>
</body>
</html>
