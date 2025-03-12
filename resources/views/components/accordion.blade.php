@props(['conforts' => []])
<!-- Par exemple, avec CDN Flowbite -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

<div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
    @foreach ($conforts as $index => $confort)
        <h2 id="accordion-flush-heading-{{ $index }}">
            <button type="button"
                    class="flex items-center justify-between w-full py-5 font-medium text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
                    data-accordion-target="#accordion-flush-body-{{ $index }}"
                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                    aria-controls="accordion-flush-body-{{ $index }}">
                <span class="font-bold">{{ $confort->title }}</span>
                <svg data-accordion-icon class="w-3 h-3 shrink-0 transition-transform duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-flush-body-{{ $index }}" class="{{ $index === 0 ? '' : 'hidden' }}" aria-labelledby="accordion-flush-heading-{{ $index }}">
            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                <p class="text-gray-500 dark:text-gray-400">{{ $confort->description }}</p>
            </div>
        </div>
    @endforeach
</div>
