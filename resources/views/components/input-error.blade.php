@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'mt-1 text-sm text-danger-600 dark:text-danger-400']) }}>{{ $message }}</p>
@enderror
