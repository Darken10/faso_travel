@extends('layout')

@section('title','choix du moyen user')

@section('content')
    <div class="m-auto w-full max-w-lg bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset($user->profileUrl ?? 'icon/user1.png') }}" alt="Bonnie image"/>
            <h5 class="mb-1 text-xl font-semibold text-gray-900 dark:text-white ">{{ $user->name  }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->sexe  }}</span>
            <div class="flex mt-4 md:mt-6 gap-6">
                <a href="{{ route('ticket.tranferer-ticket-to-other-user',$ticket)  }}" class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Anuller
                </a>
            </div>
        </div>
    </div>

    <div class="m-auto w-full max-w-lg bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-3">
        <form class="p-4 md:p-5" method="POST" action="{{ route('ticket.tranferer-ticket-traitement',$ticket) }}">
            @method('POST')
            @csrf
            <input type="text" name="user_id" value="{{ $user->id }}" hidden readonly>
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot de passe</label>
                    <input  name="password" id="password" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
            </div>

            <div class="flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="accepted" type="checkbox" name="accepted" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required />
                </div>
                <label for="accepted" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">J'accepte les <a href="#" class="text-blue-600 hover:underline dark:text-blue-500"> conditions</a>.</label>
            </div>

            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Valider la transaction
            </button>
        </form>
    </div>



@endsection
