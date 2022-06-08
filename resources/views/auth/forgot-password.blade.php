<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('images/logo2.png') }}" class="img-fluid" alt="Ticketing sustav" style="height:25px;">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Zaboravili ste lozinku? Nema problema. Upišite adresu svoje e-pošte i poslati ćemo vam vezu za poništavanje lozinke koja će vam omogućiti da odaberete novu.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3" style="background-color:#D77FA1 ;">
                    {{ __('Pošalji') }}
                </x-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
