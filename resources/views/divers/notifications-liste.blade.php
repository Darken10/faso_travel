@extends('layout')

@section('title','Notifications')

@section('content')
    <div class="max-w-3xl mx-auto">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-surface-900 dark:text-white">Notifications</h1>
            <p class="text-surface-500 dark:text-surface-400 mt-1">Restez informé de vos voyages et transactions</p>
        </div>

        {{-- Notifications List --}}
        <div class="space-y-3">
            @forelse($notifications as $notification)
                <a href="{{ route('user.notifications.show',$notification) }}"
                   class="card group flex items-start gap-4 hover:shadow-elevated hover:-translate-y-0.5 transition-all duration-300 {{ $notification->read_at ? 'opacity-75' : '' }}">
                    <div class="w-10 h-10 rounded-xl {{ $notification->read_at ? 'bg-surface-100 dark:bg-surface-800' : 'bg-primary-100 dark:bg-primary-900/30' }} flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5 {{ $notification->read_at ? 'text-surface-400' : 'text-primary-600 dark:text-primary-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-surface-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors mb-1">
                            {{ $notification->data['title'] ?? 'Notification' }}
                        </h3>
                        <p class="text-sm text-surface-600 dark:text-surface-300 line-clamp-2">{{ $notification->data['message'] }}</p>
                        <p class="text-xs text-surface-400 dark:text-surface-500 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex items-center flex-shrink-0">
                        @if(!$notification->read_at)
                            <span class="w-2.5 h-2.5 rounded-full bg-primary-500 mr-2"></span>
                        @endif
                        <svg class="w-5 h-5 text-surface-300 dark:text-surface-600 group-hover:text-primary-500 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                    </div>
                </a>
            @empty
                <div class="card text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-surface-100 dark:bg-surface-800 flex items-center justify-center">
                        <svg class="w-10 h-10 text-surface-400 dark:text-surface-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-surface-900 dark:text-white mb-2">Aucune notification</h3>
                    <p class="text-surface-500 dark:text-surface-400">Vous n'avez aucune notification pour le moment</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
