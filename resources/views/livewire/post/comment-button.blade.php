<div>
   <div class="flex flex-row items-start">
       <a class="text-gray-900" style="text-decoration: none" wire:click="toggleComments">
           <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
               <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
               <span class="ml-1">{{ count($commentable->comments)  }}</span>
           </button>
       </a>
       <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
           <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
           <span class="ml-1">340</span>
       </button>
   </div>


    <div class="bg-gray-50">
        @if($showComments)
            <div class="comments-section">
                @forelse($comments as $comment)
                    <!-- message -->
                    <div class="w-full  flex flex-col justify-between">
                        <div class="flex flex-col mt-5">

                            <div class="flex justify-start mb-4">
                                <img
                                    src="@if($comment->user->profile_photo_path != null)
                                            {{ storage_path($comment->user->profile_photo_path)  }}
                                        @else
                                            {{ asset('icon/user1.png')  }}
                                        @endif"
                                    class="object-cover h-8 w-8 rounded-full"
                                    alt=""
                                />

                                <div>

                                    <div
                                        class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white"
                                    >
                                        <span class="font-bold mt-3">{{ $comment->user->name  }}</span> <br>

                                        {{ $comment->message }}
                                        <small class="block mt-3 italic">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end message -->
                @empty
                        <div class="flex justify-content-center text-3xl font-bold capitalize text-slate-500">Aucun Commentaire</div>
                @endforelse

                <form  wire:submit.prevent="addComment">
                        <label for="chat"  class="sr-only">Votre message</label>
                        <div class="flex items-center py-2 px-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                            <textarea  wire:model="newComment" id="chat" rows="1" class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
                            <div class="block">
                                @error('newComment') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                            </button>
                        </div>
                    </form>

            </div>
        @endif
    </div>
{{-- iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii --}}


</div>
