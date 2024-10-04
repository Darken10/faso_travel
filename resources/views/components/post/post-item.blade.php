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
        <img class="object-cover w-full rounded-lg" src="{{ asset($post->getImageUrl()) }}" alt="image">

        @livewire('post.post-like-comment-shared-button',['post' => $post], key($post->id))
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


    @endif

    <div class="">
      <a href="{{ route($admin ? 'admin.likeListPost' : 'post.likeList',$post) }} ">
        <x-shared.avatars-list :post="$post" />
      </a>
    </div>

  </div>
  </div>
</div>

