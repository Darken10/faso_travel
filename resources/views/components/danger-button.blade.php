<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-danger-500 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-danger-600 active:bg-danger-700 focus:outline-none focus:ring-2 focus:ring-danger-300 focus:ring-offset-2 dark:focus:ring-offset-surface-900 disabled:opacity-50 transition-all duration-200']) }}>
    {{ $slot }}
</button>
