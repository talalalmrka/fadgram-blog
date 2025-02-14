<x-dashboard-layout :title="__('General settings')">
    <x-slot name="header">
        {{ __('General settings') }}
    </x-slot>
    <div class="container py-5">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-primary">
                            {{ __('Site information') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('settings.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-3">
                                <div class="col">
                                    <x-form.input id="name" name="name" :label="__('Site name')" :value="old('name', $settings->name)" />
                                </div>
                                <div class="col">
                                    <x-form.textarea id="description" name="description" :label="__('Site description')"
                                        :value="old('description', $settings->description)" />
                                </div>
                                <div class="col">
                                    <x-form.checkbox id="active" name="active" :label="__('Site active')"
                                        :checked="$settings->active" />
                                </div>
                                <div class="col flex-space-2 justify-between">
                                    <button type="submit" name="save" class="btn sm primary gradient pill">
                                        {{ __('Save') }}
                                    </button>
                                    <x-status class="mb-0 p-0" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">

            </div>
        </div>
    </div>
</x-dashboard-layout>
