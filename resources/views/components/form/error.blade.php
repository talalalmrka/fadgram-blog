@props([
    'id' => '',
])
@error($id)
    <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
@enderror
