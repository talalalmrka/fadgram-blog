@props([
    'id' => uniqid('post-grid-'),
    'posts',
    'title' => null,
    'class' => null,
    'itemClass' => null,
    'paginate' => true,
])
<div>
    <x-section-title :title="$title" />
    @if ($posts->isNotEmpty())
        <div {{ $attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6']) }}>
            @foreach ($posts as $post)
                @component('components.post-grid-item', [
                    'id' => "post-$post->id",
                    'post' => $post,
                    'class' => $itemClass,
                ])
                @endcomponent
            @endforeach
        </div>
        @if ($paginate)
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
    @endif
</div>
