@props([
    'id' => uniqid('checkbox-group-'),
    'class' => null,
    'label' => null,
    'name' => '',
    'value' => [],
    'options' => [],
])
<x-form.label :id="$id" :label="$label" />
<div class="form-control">
    @foreach ($options as $option)
        <x-form.checkbox :id="$id . '-' . $loop->index" :label="$option['label']" :name="$name" :value="$option['value']" :checked="in_array($option['value'], $value)" />
    @endforeach
</div>
<x-form.error :id="$id" />
