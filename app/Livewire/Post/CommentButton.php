<?php

namespace App\Livewire\Post;

use App\Models\Post\Post;
use Livewire\Component;

class CommentButton extends Component
{
    public $commentable; // Peut être un Post ou une Video
    public $comments;
    public $newComment;
    public $showComments = false;

    protected $rules = [
        'newComment' => 'required|min:3'
    ];

    public function mount($commentable)
    {
        $this->commentable = $commentable;
        $this->comments = $this->commentable->comments()->latest()->limit(10)->get();
    }

    public function toggleComments()
    {
        $this->showComments = !$this->showComments;
        if ($this->showComments) {
            $this->comments = $this->commentable->comments()->latest()->get();
        }
    }

    public function addComment()
    {
        $this->validate();

        $this->commentable->comments()->create([
            'message' => $this->newComment,
        ]);

        $this->comments = $this->commentable->comments()->latest()->get();
        $this->newComment = '';
        $this->showComments = false;
    }

    public function render()
    {
        return view('livewire.post.comment-button',[
            'showComments'=>$this->showComments,
        ]);
    }

}
