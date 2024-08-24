<?php

namespace App\Livewire\Post;

use App\Models\Post\Post;
use Livewire\Component;

class PostLikeCommentSharedButton extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post.post-like-comment-shared-button',[
            'post' => $this->post,
        ]);
    }
}
