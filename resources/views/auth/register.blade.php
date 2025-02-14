<x-site-layout>
    <x-slot name="header">{{ __('Register') }}</x-slot>
    <div class="container py-5">
    <div class="flex-space-2 mb-3">   
           <x-status />
            <div class="card">
                <div class="card-body p-4 md:p-10">
                    <div class="text-center mb-8">
                    <x-status />
                        <h2 class="text-3xl font-bold text-primary">
                            {{ __('Create Your Account') }}
                        </h2>
                        <p class="mt-2 text-sm text-primary-60">
                            {{ __('Start your journey with us') }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="col">
                            <x-form.input name="name" type="text" id="name" :label="__('Full Name')" required
                                
                                class="focus:border-primary-500 focus:ring-primary-500 dark:bg-dark-600 dark:border-dark-500" />
                       </div>
                            <x-form.input name="email" type="email" id="email" :label="__('Email Address')" required
                                class="focus:border-primary-500 focus:ring-primary-500 dark:bg-dark-600 dark:border-dark-500" />

                            <x-form.input name="password" type="password" id="password" :label="__('Password')" required
                                class="focus:border-primary-500" />

                            <x-form.input name="password_confirmation" type="password" id="password_confirmation"
                                :label="__('Confirm Password')" required
                                class="focus:border-primary-500 focus:ring-primary-500 dark:bg-dark-600 dark:border-dark-500" />
                        </div>

                        <div class="col flex items-center">
                            <input id="terms" name="terms" type="checkbox"
                                class="h-4 w-4 text-primary-600"
                                required>
                            <label for="terms" class="ml-2 block text-sm text-gray-700">
                                {{ __('I agree to the') }}
                                <a href="#"
                                    class="text-primary-600 hover:text-primary-500">
                                    {{ __('terms and conditions') }}
                                </a>
                            </label>
                        
                        <button type="submit"
                            class="  bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2">
                            {{ __('Create Account') }}
                        </button>
                    </form>
            

                
                    <p class="text-center text-sm text-gray-600 ">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}"
                            class="font-medium text-primary-600 hover:text-primary-500">
                            {{ __('Sign in here') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-site-layout>
