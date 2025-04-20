@props(['comment','reponse'=>false])

<div class="flex items-start gap-2.5">
    <img class="w-8 h-8 rounded-full" src="{{ asset($comment->user->profileUrl) }}" alt="Jese image">
    <div class="flex flex-col w-full max-w-[480px] leading-1.5 p-4 border-gray-200 bg-green-300 rounded-e-xl rounded-es-xl dark:bg-gray-700">
       <div class="flex items-center space-x-2 rtl:space-x-reverse">
          <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
          <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $comment->created_at->format('D d M Y H:i:s') }}</span>
       </div>
       <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{!! nl2br(e( $comment->comment )) !!}</p>


       <div class="mt-2 flex items-center">
        <a class="inline-flex items-center py-2 mr-3" href="{{ route('post.storeLikeComment',$comment) }}">

          {{-- <x-like.logo-love :model="$comment" /> --}}

        </a>
        @if (!$reponse)
          <a  href="{{ route('post.reponse',$comment) }}"
          class=" no-underline text-black flex px-4 py-2 items-center hover:bg-grey-lighterpx-4 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg">

              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-message-circle h-6 w-6 mr-1">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
              </svg>

          repondre
          </a>
        @endif
      </div>


       <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
    </div>
    <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots{{ $comment->id }}" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">
       <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
          <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
       </svg>
    </button>
    <div id="dropdownDots{{ $comment->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600">
       <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reply</a>
          </li>
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Forward</a>
          </li>
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Copy</a>
          </li>
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
          </li>
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
          </li>
       </ul>
    </div>
</div>


