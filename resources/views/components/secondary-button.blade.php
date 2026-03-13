<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-surface-300 rounded-xl font-semibold text-sm text-surface-700 hover:bg-surface-50 hover:border-surface-400 focus:outline-none focus:ring-2 focus:ring-surface-200 focus:ring-offset-2 dark:bg-surface-800 dark:border-surface-600 dark:text-surface-300 dark:hover:bg-surface-700 dark:focus:ring-surface-700 dark:focus:ring-offset-surface-900 disabled:opacity-50 transition-all duration-200']) }}>
    {{ $slot }}
</button>
