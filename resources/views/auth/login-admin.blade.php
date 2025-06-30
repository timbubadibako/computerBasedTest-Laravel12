@extends('layouts.plain')
@section('content')
<div class="w-full max-w-md bg-white rounded-lg shadow-xl">
    <div class="p-6 text-center">
        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full">
            <i data-lucide="shield" class="w-8 h-8 text-blue-600"></i>
        </div>
        <h2 id="loginTitle" class="mb-6 text-2xl font-bold">Admin Login</h2>

        <form method="post" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="role" value="admin">
                <div class="text-left">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>
                <div class="text-left">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
                </div>
                <div class="block mt-4 ml-1">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <x-button>
                    {{ __('Log in') }}
                </x-button>
                <button type="button" onclick="window.location.href='{{ route('welcome') }}'"
                    class="w-full py-3 font-semibold text-gray-700 transition-colors border border-gray-300 rounded-lg hover:bg-gray-50">
                    Back to Role Selection
                </button>
        </form>
        <x-validation-errors class="mb-6 text-center" />
    </div>
</div>
@endsection
