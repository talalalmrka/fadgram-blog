<x-app-layout :title="$title">
    <div class="min-h-screen">
        <x-navigation class="fixed top-0 start-0 end-0 z-full dark" bg="transparent" bg_dark="transparent"
            :items="[
                [
                    'label' => __('Home'),
                    'href' => route('site.home'),
                    'active' => request()->routeIs('site.home'),
                ],
                [
                    'label' => __('Blog'),
                    'href' => route('site.posts'),
                    'active' => request()->routeIs(['site.posts', 'site.post']),
                ],
            ]" />
        <div class="h-96 relative overflow-hidden">
            <div class="absolute inset-0 bg-{{ $color }}/50 bg-gradient z-1"></div>
            @if ($image)
                <img class="absolute inset-0 w-full h-full object-cover opacity-90 z-2" src="{{ $image }}"></img>
            @endif
            <div class="absolute inset-0 flex items-center justify-center bg-black/50 text-white">
                <div class="text-center">
                    @if ($title)
                        <h1 class="text-3xl">{{ $title }}</h1>
                    @endif
                    @if ($subtitle)
                        <div class="text-lg">{{ $subtitle }}</div>
                    @endif
                    @if ($text)
                        <div class="text-sm">{{ $text }}</div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @include('partials.footer')
    </div>
</x-app-layout>
