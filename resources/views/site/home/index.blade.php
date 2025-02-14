<x-site-layout :title="__('Home')">
    <div class="container py-5">
        @foreach ($sections as $section)
            {!! $section->render() !!}
        @endforeach
    </div>
</x-site-layout>
