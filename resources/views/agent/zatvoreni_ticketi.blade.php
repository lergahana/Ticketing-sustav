<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="{{ URL::asset('css/buttons.css') }}">
        {{ __('Zatvoreni ticketi') }}
        </h2>
    </x-slot>

    @include('agent.lista_ticketa')
</x-app-layout>
