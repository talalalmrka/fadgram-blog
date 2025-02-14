<x-dashboard-layout :title="$title">
    <x-slot name="header">{{ $title }}</x-slot>
    <div class="container py-5">
        <div x-data="{ open: false }" class="mb-4">
            <button type="button" class="btn sm green mb-3" x-on:click="open = !open">{{ __('Upload') }}</button>
            <form x-collapse x-show="open" method="POST" action="{{ route('dashboard.media.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <x-form.file id="files" name="files[]" :multiple="true" :label="__('Upload files')" />
                        <button type="submit" class="btn sm primary  w-full mt-3">
                            {{ __('Upload') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <x-status />
        <div class="card" x-data="{ selectAll: false, selectedItems: [], actionsEnabled() { return this.selectedItems.length } }">
            <form method="post" action="{{ route('dashboard.media.action') }}">
                @csrf
                <div class="flex-space-2 mb-3 p-2">
                    <button name="action" value="delete" class="btn sm red gradient"
                        x-bind:disabled="!actionsEnabled()">{{ __('Delete') }}
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>
                                    <input type="checkbox" x-model="selectAll"
                                        x-on:change="selectedItems = selectAll ? {{ $items->pluck('id') }} : []">
                                </td>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Preview') }}</td>
                                <td>{{ __('Details') }}</td>
                                <td>{{ __('Uploaded to') }}</td>
                                <td>{{ __('Creation date') }}</td>
                                <td>{{ __('Actions') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($items->isNotEmpty())
                                @foreach ($items as $media)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="items[]" value="{{ $media->id }}"
                                                x-model="selectedItems">
                                        </td>
                                        <td>{{ $media->id }}</td>
                                        <td><x-media-preview :media="$media" /></td>
                                        <td><x-media-details :media="$media" /></td>
                                        <td><x-media-uploaded-to :media="$media" /></td>
                                        <td>{{ $media->created_at->format('M, d Y') }}</td>
                                        <td>
                                            <div class="flex-space-2 justify-center">
                                                <a href="{{ $media->full_url }}" target="_blank"
                                                    class="btn sm green gradient"
                                                    target="_blank">{{ __('Show') }}</a>

                                                <a href="{{ route('dashboard.media.delete', $media) }}"
                                                    class="btn sm red gradient">{{ __('Delete') }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        <div class="text-center">{{ __('No Media found') }}</div>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <input type="checkbox" x-model="selectAll"
                                        x-on:change="selectedItems = selectAll ? {{ $items->pluck('id') }} : []">
                                </td>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Preview') }}</td>
                                <td>{{ __('Details') }}</td>
                                <td>{{ __('Uploaded to') }}</td>
                                <td>{{ __('Creation date') }}</td>
                                <td>{{ __('Actions') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </form>
            @if ($items->isNotEmpty())
                <div class="p-3">
                    {{ $items->links() }}
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
