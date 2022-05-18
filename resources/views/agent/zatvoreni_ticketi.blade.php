<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <link rel="stylesheet" href="css/form.css">
        <style>
            .btn-pink {
                background-color: #D77FA1;
                color: white;
            }    
        </style>
        {{ __('Zatvoreni ticketi') }}
        </h2>
    </x-slot>

    @include('agent.lista_ticketa')
</x-app-layout>
