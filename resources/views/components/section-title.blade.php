@props([
    'title' => null,
])
@if ($title)
    <h5 class="text-lg">{!! $title !!}</h5>
    <div class="flex mb-4">
        <div class="w-16 border-b border-2 border-primary"></div>
        <div class="grow border-b"></div>
    </div>
@endif
