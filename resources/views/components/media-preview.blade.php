@props([
    'media' => null,
    'size' => 16,
    'rounded' => null,
    'showDetails' => false,
    'delete' => false,
    'class' => null,
])
@php
    $iconSize = is_numeric($size) ? $size / 2 : 8;
    $iconClass = "w-$iconSize h-$iconSize";
    $isMediaItem = $media instanceof Spatie\MediaLibrary\MediaCollections\Models\Media;
    $isMediaCollection = $media instanceof Spatie\MediaLibrary\MediaCollections\MediaCollection;
@endphp
@if ($media)
    <div {{ $attributes }} class="relative group rounded overflow-hidden w-full h-full">
        @if ($isMediaItem)
            @switch($media->type)
                @case('image')
                    <img class="{{ css_classes(['w-full h-full', "rounded-$rounded" => $rounded]) }}"
                        src="{{ $media->original_url }}" alt="{{ $media->name }}" />
                @break

                @case('video')
                    <video class="{{ css_classes(['w-full h-full', "rounded-$rounded" => $rounded]) }}" controls>
                        <source src="{{ $media->original_url }}" type="{{ $media->mime_type }}">
                        Your browser does not support the video tag.
                    </video>
                @break

                @default
                    <div class="flex flex-col items-center justify-center space-y-1.5 text-xs text-gray-700 dark:text-white">
                        <div class="text-center"><x-media-icon :media="$media"
                                class="w-16 h-16 text-gray-800 dark:text-white" /></div>
                        <div class="text-center font-semibold">{{ $media->name }}</div>
                        <div class="text-center">{{ $media->file_name }}</div>
                        <div class="text-center">{{ $media->type }}</div>
                        <div class="text-center">{{ $media->humanReadableSize }}</div>
                    </div>
            @endswitch
        @elseif ($isMediaCollection)
            <div class="grid gap-4">
                @foreach ($media as $item)
                    <div class="col w-16 h-16 relative">
                        <x-media-preview :media="$item" class="w-16 h-16" />
                    </div>
                @endforeach
            </div>

        @endif
        @if ($delete && $media instanceof Spatie\MediaLibrary\MediaCollections\Models\Media)
            <a class="btn red sm absolute top-0 start-0 mt-2 ms-2"
                href="{{ route('dashboard.media.delete', $media) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path
                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                </svg>
            </a>
        @endif
    </div>
@endif
