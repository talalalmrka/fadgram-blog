<x-dashboard-layout>
    <x-slot name="header">{{ __('Users') }}</x-slot>
    <div class="container py-5">
        <x-status />
        <div class="card" x-data="{ selectAll: false, selectedItems: [], actionsEnabled() { return this.selectedItems.length } }">
            <form method="post" action="{{ route('dashboard.users.action') }}">
                @csrf
                <div class="flex-space-2 mb-3 p-2">
                    <a class="btn sm green gradient" href="{{ route('dashboard.users.create') }}">{{ __('Create') }}</a>
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
                                        x-on:change="selectedItems = selectAll ? {{ $users->pluck('id') }} : []">
                                </td>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Name') }}</td>
                                <td>{{ __('Email') }}</td>
                                <td>{{ __('Roles') }}</td>
                                <td>{{ __('Actions') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="items[]" value="{{ $user->id }}"
                                            x-model="selectedItems">
                                    </td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->rolesLabel() }}</td>
                                    <td>
                                        <div class="flex-space-2 justify-center">
                                            <a href="{{ route('dashboard.users.edit', $user) }}"
                                                class="btn sm green gradient">{{ __('Edit') }}</a>
                                            <a href="{{ route('dashboard.users.login', $user) }}"
                                                class="btn sm blue gradient">{{ __('Login') }}</a>
                                            <a href="{{ route('dashboard.users.delete', $user) }}"
                                                class="btn sm red gradient">{{ __('Delete') }}</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
            @if ($users->isNotEmpty())
                <div class="p-3">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

    </div>
</x-dashboard-layout>
