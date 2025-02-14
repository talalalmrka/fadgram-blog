<x-cover-layout :title="$post->name" :image="$post->getThumbnailUrl('lg')" :subtitle="$post->author_name" :text="$post->date">
    <div class="container py-5">
        @if ($post->hasMedia('pdf'))
            <iframe src="{{ route('pdf_viewer', ['url' => $post->getFirstMediaUrl('pdf')]) }}" frameborder="0"
                width="100%" height="500" allowfullscreen></iframe>
        @endif
        {!! $post->content !!}
    </div>
    @auth
        <a class="fixed bottom-5 start-5 btn primary gradient" target="_blank"
            href="{{ route('dashboard.posts.edit', $post) }}">
            {{ __('Edit') }}
        </a>
    @endauth
</x-cover-layout>
