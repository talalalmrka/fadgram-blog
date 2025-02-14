@props([
    'id' => uniqid('editor-'),
    'class' => null,
    'label' => null,
    'value' => '',
    'rows' => 3,
    'height' => 400,
])
@if ($label)
    <label for="{{ $id }}"
        class="{{ css_classes(['form-label', 'error' => $errors->has($id)]) }}">{{ $label }}</label>
@endif
<textarea
    {{ $attributes->merge([
        'id' => $id,
        'rows' => $rows,
        'data-height' => $height,
        'class' => css_classes(['form-control jodit', 'error' => $errors->has($id), $class => $class]),
    ]) }}
    class="form-control">{{ $value }}</textarea>
@error($id)
    <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
@enderror

@pushOnce('styles')
    @vite(['resources/sass/jodit.scss'])
@endpushOnce
@pushOnce('scripts')
    @vite(['resources/js/jodit.js'])
@endpushOnce
