<div class="flex flex-col h-full p-4 bg-white shadow rounded-lg max-w-3xl mx-auto">

    <!-- Messages -->
    <div class="flex-1 overflow-y-auto space-y-4 mb-4">
        @foreach($messages as $message)
            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="{{ $message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }} p-3 rounded-lg max-w-sm">
                    {{ $message->message }}
                    <div class="text-xs text-gray-500 mt-1 text-right">
                        {{ $message->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Formulaire de message -->
    <form wire:submit.prevent="sendMessage" class="flex gap-2">
        <textarea wire:model.defer="newMessage" class="flex-1 border border-gray-300 rounded-lg p-2 resize-none" rows="2" placeholder="Écrire un message..."></textarea>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Envoyer</button>
    </form>
</div>
