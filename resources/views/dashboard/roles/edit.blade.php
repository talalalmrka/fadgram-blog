<x-dashboard-layout>
    <x-slot name="header">
        {{ !empty($role->id)
            ? __('Edit role ":name"', [
                'name' => $role->name,
            ])
            : __('Create role') }}
    </x-slot>
    <div class="container py-5">
        <div class="flex-space-2 mb-3">
            <a class="btn sm blue gradient" href="{{ route('dashboard.roles') }}">{{ __('View all') }}</a>
            @if (!empty($role->id))
                <a class="btn sm green gradient" href="{{ route('dashboard.roles.create') }}">{{ __('Create') }}</a>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <x-status />
                <form
                    action="{{ !empty($role->id) ? route('dashboard.roles.update', $role) : route('dashboard.roles.store') }}"
                    method="post">
                    @csrf
                    <div class="grid grid-cols-1 gap-3">
                        <div class="col">
                            <x-form.input id="name" name="name" :label="__('Name')" :value="old('name', $role->name)" />
                        </div>
                        <div class="col">
                            <x-form.select id="guard_name" name="guard_name" :label="__('Guard name')" :value="old('guard_name', $role->guard_name)"
                                :options="guard_name_options()" />
                        </div>
                        <div class="col">
                            <x-form.checkbox-group id="permissions" name="permissions[]" :label="__('Permissions')"
                                :value="old('permissions', $role->getPermissionNames()->toArray())" :options="permission_options()" />
                        </div>
                        <div class="col md:colspan-2">
                            <button type="submit" name="save" class="btn primary gradient">
                                {{ !empty($role->id) ? __('Update') : __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-dashboard-layout>
