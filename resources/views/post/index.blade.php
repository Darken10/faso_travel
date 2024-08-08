@extends('layout')
   
@section('title','Publication des Articles')


@section('content')
    <div>
        @foreach ($posts as $post)
            <x-post.post-item :$post />
        @endforeach
    </div>
    <div class="pb-8">
        {{ $posts->links() }}
    </div>
@endsection

