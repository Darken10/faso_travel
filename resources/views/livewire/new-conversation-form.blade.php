<div class="max-w-xl mx-auto p-6 bg-white rounded shadow">

    <h2 class="text-lg font-bold mb-4">Nouvelle conversation</h2>

    <form wire:submit.prevent="create" class="space-y-4">

        <div>
            <label class="block text-sm font-medium mb-1">Choisir une compagnie</label>
            <select wire:model="companyId" class="w-full border border-gray-300 rounded p-2">
                <option value="">-- Sélectionner --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
            @error('companyId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Message</label>
            <textarea wire:model="message" rows="4" class="w-full border border-gray-300 rounded p-2"></textarea>
            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Démarrer la conversation
        </button>

    </form>
</div>
