@extends('layout')

@section('content')
<div class="pb-5">
    <x-post.post-item :$post />
   {{--  <div class="pt-2">
        @forelse ($post->comments as $comment)
            <div class="max-w-screen-md  flex m-auto bg-white">
                <div class=" p-4   ">
                
                    <x-shared.chat-bulle :$comment /> --}}

                    {{-- <x-comment-item:$comment/> --}}
         {{--        </div>
            </div>
        @empty
            <div class="text-center uppercase text-4xl text-gray-500">
                Aucun Commentaire
            </div>
        @endforelse
    </div> --}}
    
</div>
{{-- <form action="{{ route('post.storeComment',$post) }}" method="post">
    @csrf

    <x-input-comment name="comment" />
</form> --}}
@endsection
   
