@props(['likes'])

<ul role="list" class="mx-4 divide-y divide-gray-100">
    @forelse ($likes as $like)
        <li class="flex justify-between gap-x-6 py-2">
            <div class="flex min-w-0 gap-x-4">
            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ asset($like->user->profileUrl) }}" alt="">
            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold leading-6 text-gray-900">{{ $like->user->name }}</p>
                <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $like->user->email }}</p>
            </div>
            </div>
            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
            <p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
            {{--<div class="mt-1 flex items-center gap-x-1.5">
                <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                </div>
                 <p class="text-xs leading-5 text-gray-500">Online</p> 
                
            </div>
            </div>--}}
         </li>
    @empty
        <x-shared.empty>
            Aucun J'aime
        </x-shared.empty>
    @endforelse
    
    <div>
        {{ $likes->links() }}
    </div>
    
</ul>
  