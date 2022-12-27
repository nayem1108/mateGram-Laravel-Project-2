<link rel="stylesheet" href="{{asset('/')}}mategram/website/static/css/style.css">
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <h5 class="text-center font-weight-bold" style="font-weight: bold;font-size:3ch;">mateGram</h5>
            {{-- <p class="text-center"> <span style="border-right: 1em solid black; padding:5px;">Stay connected </span> Stay Happy</p> --}}
            <p><span class="border-right">Stay Happy</span><span class="pl-5">Stay Connected </span></p>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
            <div class="flex mt-4 text-bold justify-center text-primary" style="font-weight: bold;">
                {{__('Or')}}
            </div>
            <div class="flex mt-5 items-center justify-center">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Not Registerd yet?') }}
                </a>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
