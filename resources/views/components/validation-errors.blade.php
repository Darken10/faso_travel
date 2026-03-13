@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'p-4 rounded-xl bg-danger-50 border border-danger-200 dark:bg-danger-500/10 dark:border-danger-500/20']) }}>
        <div class="flex items-center gap-2 font-medium text-sm text-danger-700 dark:text-danger-400">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
            </svg>
            Une erreur est survenue
        </div>
        <ul class="mt-2 space-y-1 list-disc list-inside text-sm text-danger-600 dark:text-danger-400">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
