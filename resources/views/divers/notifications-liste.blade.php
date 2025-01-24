@extends('layout')

@section('title','Notifications')

@section('content')
    <div class="flex justify-center items-center ">
            <h5 class="mb-2 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white text-start">La liste des notifications</h5>
    </div>
        <hr class=" border border-gray-200 w-full">
    <div class="flex justify-center items-center mb-16">
        <div class="justify-center gap-4">
            @forelse($notifications as $notification)

                <a href="{{ route('user.notifications.show',$notification) }}" class=" mt-4 block max-w-3xl min-w-3xl p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $notification->data['title'] ?? "pas de titre" }}</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{ $notification->data["message"] }}
                    </p>
                    <div class=" flex justify-between items-center">
                        <span class="font-normal text-sm italic  text-gray-500 dark:text-gray-300 flex justify-end text-end items-center mt-3">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                            <span class="font-normal text-blue-700 dark:text-blue-900 flex justify-end text-end items-center mt-3">
                            Marker Vue
                             <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </span>
                    </div>
                </a>
            @empty
                <div class=" font-extrabold flex justify-center uppercase text-3xl text-gray-400 my-8">Aucune Notification disponible</div>
            @endforelse
        </div>
    </div>
@endsection
