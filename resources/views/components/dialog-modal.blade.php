@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-5">
        <div class="text-lg font-semibold text-surface-900 dark:text-surface-100">
            {{ $title }}
        </div>

        <div class="mt-3 text-sm text-surface-600 dark:text-surface-400">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end gap-3 px-6 py-4 bg-surface-50 dark:bg-surface-800/50 border-t border-surface-200 dark:border-surface-700 text-end">
        {{ $footer }}
    </div>
</x-modal>
