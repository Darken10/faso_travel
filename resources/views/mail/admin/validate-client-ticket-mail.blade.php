<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!-- Scripts -->
    @vite(['resources/css/app.css'])

    <title>Mail de Validation</title>
</head>
<body >

     <div class=" flex justify-center items-center mt-4">
         <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
             <a href="#">
                 <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Bonjours a M {{ $ticket->user->name }}</h5>
             </a>
             <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                 Nous vous notifions que M Y a valider votre ticket de voyage du {{$ticket->date->format(' d M Y')}} <br>
                 ----
                 <br>
                 Merci d'utiliser notre service. Nous comptons sur votre bonne volonté pour vous comptez parmi nos fidel client
                 <br>
                 <br>
                 Bon voyage. Prenez soin de vous
             </p>
             <a href="{{ route('ticket.show-ticket',$ticket) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                 Voir le Ticket
                 <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                 </svg>
             </a>
         </div>
     </div>
</body>
</html>
