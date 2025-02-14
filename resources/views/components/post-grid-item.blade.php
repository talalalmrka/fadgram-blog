@props([
    'id' => uniqid('post-grid-item-'),
    'post',
    'class' => null,
])
@if (isset($post) && $post)
    <div {{ $attributes->merge([
        'class' => css_classes(['post-card', $class => $class]),
    ]) }}>
        <div class="relative aspect-video bg-gray-200 flex items-center justify-center overflow-hidden">
            <a href="{{ $post->permalink }}" title="{{ $post->name }}"
                class="leading-none w-full h-full overflow-hidden">
                <img class="w-full h-full object-cover" src="{{ $post->getThumbnailUrl('sm') }}" alt="{{ $post->name }}">
            </a>
        </div>
        <div class="card-body">
            <h5 class="card-title text-center truncate text-sm">
                <a class="text-inherit" href="{{ $post->permalink }}" title="{{ $post->name }}">{{ $post->name }}</a>
            </h5>
        </div>
    </div>
@endif
