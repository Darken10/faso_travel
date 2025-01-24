@extends('layout')

@section('title','Publication des Articles')


@section('content')
    <div>
        @forelse($posts as $post)
            <x-post.post-item :$post />
        @empty
              <div>
                  <x-shared.empty>Aucune Article</x-shared.empty>
              </div>
        @endforelse
    </div>
    <div class="pb-8">
        {{ $posts->links() }}
    </div>
@endsection

