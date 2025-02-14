<x-dashboard-layout :title="$title">
    <x-slot name="header">{{ $title }}</x-slot>
    <div class="container py-5">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-primary">{{ __('Profile image') }}</h5>
                    </div>
                    <div class="card-body">
                        <livewire:components.user-avatar :user="$user" />
                    </div>
                </div>
            </div>
            <div class="col md:col-span-2">
                <form method="post" action="{{ route('profile.account.update') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-primary">{{ __('Account details') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-1 gap-3">
                                <div class="col">
                                    <x-form.input id="name" name="name" :label="__('Username')" :value="old('name', $user->name)" />
                                </div>
                                <div class="col">
                                    <x-form.input id="email" name="email" :label="__('Email')" :value="old('email', $user->email)" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer flex-space-2 justify-between">
                            <button type="submit" class="btn primary sm">{{ __('Save') }}</button>
                            <x-status id="account" class="mb-0 p-0" />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <div class="col">
                <form method="post" action="{{ route('profile.personal.update') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-primary">{{ __('Personal data') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-1 gap-3">
                                <div class="col">
                                    <x-form.input id="first_name" name="first_name" :label="__('First name')"
                                        :value="old('first_name', $user->getMeta('first_name', ''))" />
                                </div>
                                <div class="col">
                                    <x-form.input id="last_name" name="last_name" :label="__('Last name')" :value="old('last_name', $user->getMeta('last_name', ''))" />
                                </div>
                                <div class="col">
                                    <x-form.input id="display_name" name="display_name" :label="__('Display name')"
                                        :value="old('display_name', $user->getMeta('display_name', ''))" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer flex-space-2 justify-between">
                            <button type="submit" class="btn primary sm">{{ __('Save') }}</button>
                            <x-status id="personal" class="mb-0 p-0" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <form method="post" action="{{ route('profile.contact.update') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-primary">{{ __('Contact info') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-1 gap-3">
                                <div class="col">
                                    <x-form.input type="tel" id="phone" name="phone" :label="__('Phone number')"
                                        :value="old('phone', $user->getMeta('phone', ''))" />
                                </div>
                                <div class="col">
                                    <x-form.input id="website" name="website" :label="__('Website url')" :value="old('website', $user->getMeta('website', ''))" />
                                </div>
                                <div class="col">
                                    <x-form.input type="tel" id="whatsapp" name="whatsapp" :label="__('Whatsapp')"
                                        :value="old('whatsapp', $user->getMeta('whatsapp', ''))" />
                                </div>
                                <div class="col">
                                    <x-form.input id="facebook" name="facebook" :label="__('Facebook')"
                                        :value="old('facebook', $user->getMeta('facebook', ''))" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer flex-space-2 justify-between">
                            <button type="submit" class="btn primary sm">{{ __('Save') }}</button>
                            <x-status id="contact" class="mb-0 p-0" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
