<x-app-layout :title="$title">
    <div class="min-h-screen">
        <x-navigation class="sticky top-0 z-full" :items="[
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
        <!-- Page Heading -->
        @if (isset($header))
            <div class="container mt-4">
                <h1 class="text-2xl text-center">{{ $header }}</h1>
                <div class="w-[80px] border-1 border-primary rounded mx-auto"></div>
            </div>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @include('partials.footer')
    </div>
</x-app-layout>
