<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/buttons.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-theme="pastel">
                
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('profile.update-profile-information-form', ['role' => $role, 'user' => $user, 'no' => $no])
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    @include('profile.update-password-form', ['role' => $role, 'user' => $user, 'no' => $no])
                </div>
            
            </div>
        </div>
    </div>
</x-app-layout>
