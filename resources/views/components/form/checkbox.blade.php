@props([
    'id' => uniqid('input-'),
    'name' => '',
    'class' => null,
    'label' => null,
    'value' => 1,
    'checked' => false,
    'atts' => [],
])
<div class="form-checkbox flex-space-2">
    <input type="hidden" name="{{ $name }}" value="0">
    <input
        {{ $attributes->merge(
            array_merge(
                [
                    'id' => $id,
                    'type' => 'checkbox',
                    'class' => css_classes(['error' => $errors->has($id), $class => $class]),
                    'value' => $value,
                ],
                $atts,
            ),
        ) }}
        @if ($checked) checked @endif>
    <x-form.label :id="$id" :label="$label" class="grow mb-0" />
</div>
<x-form.error :id="$id" />
