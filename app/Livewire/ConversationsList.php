<?php

namespace App\Livewire;

use App\Models\Messages\Conversation;
use Auth;
use Livewire\Component;

class ConversationsList extends Component
{

    public $selectedConversationId = null;

    public function selectConversation($id)
    {
        $this->selectedConversationId = $id;
    }

    public function render()
    {
        $user = Auth::user();

        $conversations = Conversation::query()
            ->where(function ($query) use ($user) {
                $query->where('client_id', $user->id)
                    ->orWhere('compagnie_id', $user->id);
            })
            ->latest()
            ->get();

        return view('livewire.conversations-list', [
            'conversations' => $conversations,
        ]);
    }


}
