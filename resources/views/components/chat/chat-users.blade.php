@props(['users','unreadCount'=>null])

<ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
    
   @forelse ($users as $u)
      <li class="pb-3 sm:pb-4">
            <a href="{{ route('chat.show',$u) }}">
               <div class="flex items-center space-x-4 rtl:space-x-reverse">
                  <div class="flex-shrink-0">
                     <img class="w-8 h-8 rounded-full" src="{{ asset($u->profileUrl) }}" alt="Neil image">
                  </div>
                  <div class="flex-1 min-w-0">
                     <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                        {{ $u->name }}
                     </p>
                     <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                        {{ $u->email }}
                     </p>
                  </div>
                  <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                     @if(isset($unreadCount[$u->id]))
                        <span class="badge ml-4">{{ $unreadCount[$u->id] }}  </span>
                     @endif

                  </div>
               </div>
            </a>
      </li>
                    
   @empty
      <div>Aucun Utilisateur</div>
   @endforelse

 </ul>

 