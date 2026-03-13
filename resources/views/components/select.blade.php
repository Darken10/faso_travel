@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full rounded-xl border border-surface-300 bg-white px-4 py-2.5 text-sm text-surface-900 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors duration-200 dark:bg-surface-800 dark:border-surface-600 dark:text-surface-200 dark:focus:border-primary-400 dark:focus:ring-primary-400/20 disabled:bg-surface-100 disabled:cursor-not-allowed dark:disabled:bg-surface-700']) !!}>
    {{ $slot }}
</select>
