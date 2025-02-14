@props([
    'id' => uniqid('input-'),
    'type' => 'text',
    'class' => null,
    'label' => null,
    'value' => '',
])
@if ($label)
    <label for="{{ $id }}"
        class="{{ css_classes(['form-label', 'error' => $errors->has($id)]) }}">{{ $label }}</label>
@endif
<input
    {{ $attributes->merge([
        'id' => $id,
        'type' => $type,
        'class' => css_classes(['form-control', 'error' => $errors->has($id), $class => $class]),
        'value' => $value,
    ]) }}
    class="form-control">
<x-form.error :id="$id" />
@if ($type == 'tel' || $attributes->get('type') == 'tel')
    @pushOnce('styles')
        @vite(['resources/sass/intl-tel-input.scss'])
    @endPushOnce
    @pushOnce('scripts')
        @vite(['resources/js/intl-tel-input.js'])
    @endPushOnce
@endif
