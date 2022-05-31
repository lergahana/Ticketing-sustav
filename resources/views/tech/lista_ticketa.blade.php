<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/buttons.css') }}">
        {{ __('Ticketi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-theme="pastel">
                @forelse ($tickets as $ticket)
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $ticket->name }}
                        <div style="float:right; vertical-align: top;">
                            <a href="/tech/prikazi_ticket/{{ $ticket->id }}"><button class="btn btn-pink-primary">Prikaži</button></a>
                        </div>
                    </div>
                @empty
                    <div class="p-6 bg-white border-b border-gray-200">
                        Trenutno nema ticketa.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>