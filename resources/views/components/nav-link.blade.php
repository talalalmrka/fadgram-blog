@props([
    'id' => uniqid('nav-link-'),
    'type' => 'item',
    'active' => false,
    'label' => null,
    'href' => null,
    'navigate' => true,
    'middleware' => null,
    'items' => [],
])
@switch($type)
    @case('item')
        @if ($middleware)
            @can($middleware)
                <a
                    {{ $attributes->merge([
                        'id' => $id,
                        'href' => $href,
                        'class' => css_classes([
                            'nav-link',
                            'active' => $active,
                            //'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' => $active,
                            //'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out' => !$active,
                        ]),
                    ]) }}>
                    @if (isset($slot) && $slot->isNotEmpty())
                        {!! $slot !!}
                    @else
                        {{ $label }}
                    @endif
                </a>
            @endcan
        @else
            <a
                {{ $attributes->merge([
                    'id' => $id,
                    'href' => $href,
                    'class' => css_classes([
                        'nav-link',
                        'active' => $active,
                        //'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' => $active,
                        //'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out' => !$active,
                    ]),
                ]) }}>
                @if (isset($slot) && $slot->isNotEmpty())
                    {!! $slot !!}
                @else
                    {{ $label }}
                @endif
            </a>
        @endif
    @break

    @case('collapse')
        <div x-data="{ open: @js($active) }" class="dropdown inline-flex" :class="{ 'open': @js($active) }"
            x-on:click.away="open=false">
            <a x-on:click="open = !open" class="nav-link" href="{{ $href }}">{{ $label }}</a>
            <div class="dropdown-menu w-40" :class="{ 'show': open }">
                @foreach ($items as $item)
                    @component('components.nav-link', $item)
                    @endcomponent
                @endforeach
            </div>
        </div>
    @break

    @default
@endswitch
