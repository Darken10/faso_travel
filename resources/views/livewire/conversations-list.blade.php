<div class="flex h-screen">

    <!-- Liste des conversations -->
    <div class="w-1/3 border-r overflow-y-auto">
        <div class="p-4 font-bold text-lg">Mes Conversations</div>

        @foreach($conversations as $conv)
            <div wire:click="selectConversation({{ $conv->id }})"
                 class="p-4 border-b cursor-pointer hover:bg-gray-100 {{ $selectedConversationId === $conv->id ? 'bg-gray-200' : '' }}">
                <div class="font-semibold">
                    {{ $conv->client->id === auth()->id() ? $conv->company->name : $conv->client->name }}
                </div>
                <div class="text-sm text-gray-600">{{ $conv->status }}</div>
            </div>
        @endforeach
    </div>

    <!-- Thread de conversation -->
    <div class="flex-1">
        @if($selectedConversationId)
            @php
                $conversation = \App\Models\Conversation::find($selectedConversationId);
            @endphp
            @if($conversation)
                <livewire:conversation-thread :conversation="$conversation" wire:key="thread-{{ $conversation->id }}" />
            @else
                <div class="p-4">Conversation introuvable.</div>
            @endif
        @else
            <div class="p-4 text-gray-500">Sélectionnez une conversation à droite 👈</div>
        @endif
    </div>

</div>

