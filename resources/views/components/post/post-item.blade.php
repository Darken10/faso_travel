@props(['post','admin'=>false,'show'=>false])


<div class="grid grid-cols-1 gap-6 my-6 px-4 md:px-6 lg:px-8">
  <div class=" w-full max-w-xl mx-auto px-4 py-4 bg-white shadow-md rounded-lg">
  <div class="py-2 flex flex-row items-center justify-between">
    <div class="flex flex-row items-center">
      <a href="#{{-- {{ $post->user->compagnie ? route('post.filterByCompagnie',$post->user->compagnie) : '#' }} --}}" class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
        <img class="rounded-full h-8 w-8 object-cover" src=" @if($post->user->profile_photo_path != null) {{ storage_path($post->user->profile_photo_path)  }}  @else {{ asset('icon/user1.png')  }} @endif" alt="">
        <p class="ml-2 text-base font-bold">{{ $post->user->name }}</p>
        <p class="ml-2 text-base text-gray-500">{{ $post->user->compagnie ? $post->user->compagnie?->sigle : '' }}</p>
      </a>
    </div>
    <div class="flex flex-row items-center">
      <p class="text-xs font-semibold text-gray-500 ">{{ $post->updated_at->diffForHumans() }}</p>
    </div>
  </div>

  @if ($post->images_uri!=null)
    <div class="mt-2">
      @foreach ($post->images_uri as $image)
        <img class="object-cover w-full rounded-lg" src="{{ asset($image['url']) }}" alt="image">
      @endforeach

        <div class="py-2 flex flex-row items-center">
          <a href="#{{-- {{ route('post.storeLikePost',$post) }} --}}" class="no-underline">
            <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
              <x-post.like.logo-love :model="$post" />
            </button>
          </a>
          <a class="text-gray-900" style="text-decoration: none" href="#{{-- {{ route($admin ? 'admin.comment.index' : 'post.show',$post) }} --}}">
            <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
              <span class="ml-1">00</span>
            </button>
          </a>
          <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
            <span class="ml-1">340</span>
          </button>
        </div>
    </div>
  @endif

  <div class="py-2">
    <div class=" inline" >
      @foreach ($post->tags as $tag)
          <a href="{{ route('post.filterByTag',$tag) }}">
            <span class=" text-gray-100 bg-purple-800 text-xs m-1 rounded-lg px-2 font-medium text-center capitalize">
              {{ $tag->name }}
            </span>
          </a>
      @endforeach
    </div>
    <a href=" {{  route('post.show',$post) }}" class=" no-underline ">
      <div class="py-2 text-2xl font-semibold">
        {{ $post->title }}
        {{-- {{ $show ? $post->title : $post->titleExtrait() }} --}}
      </div>
    </a>

    <p class="leading-snug">
      {!!  nl2br(e($post->content))  !!}
      {{-- {!! $show ? nl2br(e($post->content())) : nl2br(e($post->contentExtrait())) !!} --}}
    </p>

    @if ($post->images_uri==null)

          @livewire('post.post-like-comment-shared-button',['post' => $post], key($post->id))

    @endif

    <div class="">
      <a href="{{ route($admin ? 'admin.likeListPost' : 'post.likeList',$post) }} ">
        <x-shared.avatars-list :post="$post" />
      </a>
    </div>

  </div>
  </div>
</div>

