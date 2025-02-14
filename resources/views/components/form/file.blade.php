@props([
    'id' => uniqid('file-'),
    'type' => 'file',
    'class' => null,
    'label' => null,
    'value' => null,
    'multiple' => false,
])
@if ($label)
    <label for="{{ $id }}"
        class="{{ css_classes(['form-label', 'error' => $errors->has($id)]) }}">{{ $label }}</label>
@endif
<label for="{{ $id }}" class="relative cursor-pointer overflow-hidden h-auto min-h-40 form-drop-zone">
    @if ($value)
        <x-media-preview :media="$value" :delete="true" />
    @else
        <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-1 text-muted text-xs">
            {{ __('Click or drag file') }}
        </span>
    @endif
</label>
<input
    {{ $attributes->merge([
        'id' => $id,
        'type' => $type,
        'class' => css_classes(['form-control hidden', 'error' => $errors->has($id), $class => $class]),
        'value' => $value,
    ]) }}
    class="form-control">
@error($id)
    <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
@enderror
