@props(['post'])
<div class="flex -space-x-1 overflow-hidden">
    @php
        $i = 0
    @endphp
    @foreach ($post->likes as $like)
        @if ($i < 3)
        <img class="inline-block h-4 w-4 rounded-full ring-2 ring-white" src="{{ asset($like->user->profile_photo_url!='' ? $like->user->profile_photo_url: 'icon/user2.png') }}" alt="">
            @php
                $i++
            @endphp
        @else
            @break
        @endif
    @endforeach


</div>