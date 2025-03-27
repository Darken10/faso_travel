<div class="relative">
    <input
        type="text"
        wire:model="query"
        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        placeholder="Rechercher..."
    />

    @if (!empty($options) && $query !== '')
        <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg">
            @foreach ($options as $key => $option)
                <li
                    wire:click="selectOption('{{ $key }}')"
                    class="px-3 py-2 hover:bg-indigo-500 hover:text-white cursor-pointer"
                >
                    {{ $option }}
                </li>
            @endforeach
        </ul>
    @endif

    @if ($selectedOption)
        <p class="mt-2 text-green-600">Option sélectionnée : {{ $options[$selectedOption] ?? '' }}</p>
    @endif
</div>
