<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post\Post;
use App\Models\Post\Like as PostLike;
use Illuminate\Support\Facades\Auth;

class Like extends Component
{
    public Post $post;

    function mount(Post $post){
        $this->post = $post;

    }


    function storeLikePost()
    {

        $data['user_id'] = Auth::user()->id;
        $data['post_id'] = $this->post->id;
        $like =  PostLike::where('user_id', $data['user_id'])
            ->Where('post_id', $data['post_id'])
            ->get();

        if (!$like->isEmpty()) {
            $like[0]->delete();
        } else {
            if (!PostLike::create($data)) {
                return back()->with('error', 'Nous n\'avons pas put enregistre votre like');
            }
        }

        return back();
    }

    public function render()
    {
        return view('livewire.post.like',[
            'post'=>$this->post,

        ]);
    }
}
