@props([
    'id' => uniqid('input-'),
    'label' => null,
    'class' => null,
])

@if ($label)
    <label
        {{ $attributes->merge([
            'for' => $id,
            'class' => css_classes(['form-label', 'error' => $errors->has($id), $class => $class]),
        ]) }}>{{ $label }}</label>
@endif
