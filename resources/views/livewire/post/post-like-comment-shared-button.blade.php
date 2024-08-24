
<div class="py-2 flex flex-row items-start">

    @livewire('post.like', ['post' => $post], key($post->id))

    @livewire('post.comment-button',['commentable' => $post], key($post->id))


</div>
