<?php

namespace App\Livewire;

use App\Models\Messages\Conversation;
use Livewire\Component;

class ConversationThread extends Component
{

    public Conversation $conversation;
    public string $newMessage = '';

    protected $rules = [
        'newMessage' => 'required|string|min:1'
    ];

    public function sendMessage()
    {
        $this->validate();

        $this->conversation->messages()->create([
            'sender_id' => Auth::id(),
            'message' => $this->newMessage,
        ]);

        $this->newMessage = '';
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('livewire.conversation-thread',[
            'messages' => $this->conversation->messages()->latest()->get(),
        ]);
    }
}
