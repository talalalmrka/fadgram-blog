<x-app-layout :title="$title">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <x-navigation :items="[
            [
                'label' => __('Dashboard'),
                'href' => route('dashboard'),
                'active' => request()->routeIs('dashboard'),
            ],
            [
                'label' => __('Users'),
                'href' => route('dashboard.users'),
                'active' => request()->routeIs(['dashboard.users', 'dashboard.users.*']),
                'middleware' => 'manage users',
            ],
            [
                'label' => __('Roles'),
                'href' => route('dashboard.roles'),
                'active' => request()->routeIs(['dashboard.roles', 'dashboard.roles.*']),
                'middleware' => 'manage roles',
            ],
            [
                'label' => __('Permissions'),
                'href' => route('dashboard.permissions'),
                'active' => request()->routeIs(['dashboard.permissions', 'dashboard.permissions.*']),
                'middleware' => 'manage permissions',
            ],
            [
                'label' => __('Posts'),
                'href' => route('dashboard.posts'),
                'active' => request()->routeIs(['dashboard.posts', 'dashboard.posts.*']),
                'middleware' => 'manage posts',
            ],
            [
                'label' => __('Media'),
                'href' => route('dashboard.media'),
                'active' => request()->routeIs(['dashboard.media', 'dashboard.media.*']),
                'middleware' => 'manage media',
            ],
            [
                'type' => 'collapse',
                'label' => __('Settings'),
                'href' => '#',
                'active' => request()->routeIs(['dashboard.settings', 'dashboard.settings.*']),
                'middleware' => 'manage settings',
                'items' => [
                    [
                        'label' => __('General settings'),
                        'href' => route('settings.general'),
                        'active' => request()->routeIs(['dashboard.settings.general', 'dashboard.settings.general.*']),
                        'middleware' => 'manage settings',
                    ],
                ],
            ],
        ]" />
        <!-- Page Heading -->
        @if (isset($header) || isset($actions))
            <div class="container pt-5 md:flex-space-2 md:justify-between">
                @if (isset($header))
                    <h1 class="text-2xl grow">{{ $header }}</h1>
                @endif
                @if (isset($actions))
                    <div class="flex-space-2">{{ $actions }}</div>
                @endif

            </div>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @include('partials.footer')
    </div>
</x-app-layout>
