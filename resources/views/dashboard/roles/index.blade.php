<x-dashboard-layout>
    <x-slot name="header">{{ __('Roles') }}</x-slot>
    <div class="container py-5">
        <x-status />
        <div class="card" x-data="{ selectAll: false, selectedItems: [], actionsEnabled() { return this.selectedItems.length } }">
            <form method="post" action="{{ route('dashboard.roles.action') }}">
                @csrf
                <div class="flex-space-2 mb-3 p-2">
                    <a class="btn sm green gradient"
                        href="{{ route('dashboard.roles.create') }}">{{ __('Create') }}</a>
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
                                        x-on:change="selectedItems = selectAll ? {{ $roles->pluck('id') }} : []">
                                </td>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('name') }}</td>
                                <td>{{ __('') }}</td>
                                <td>{{ __('Creation date') }}</td>
                                <td>{{ __('Actions') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="items[]" value="{{ $role->id }}"
                                            x-model="selectedItems">
                                    </td>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->guard_name }}</td>
                                    <td>{{ $role->created_at->format('M, d Y') }}</td>
                                    <td>
                                        <div class="flex-space-2 justify-center">
                                            <a href="{{ route('dashboard.roles.edit', $role) }}"
                                                class="btn sm primary gradient">{{ __('Edit') }}</a>
                                            <a href="{{ route('dashboard.roles.delete', $role) }}"
                                                class="btn sm red gradient">{{ __('Delete') }}</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
            @if ($roles->isNotEmpty())
                <div class="p-3">
                    {{ $roles->links() }}
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
