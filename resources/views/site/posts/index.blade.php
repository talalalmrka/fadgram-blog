<x-site-layout :title="__('Blog')">
    <x-slot name="header">{{ __('Blog') }}</x-slot>
    <div class="container py-5">
        <x-post-grid :posts="$posts" />
    </div>
</x-site-layout>
