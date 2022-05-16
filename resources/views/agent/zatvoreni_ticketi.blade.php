<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <link rel="stylesheet" href="css/form.css">
            {{ __('Zatvoreni ticketi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($tickets as $ticket)
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $ticket->name }}
                        <div style="float:right; vertical-align: top;">
                            <a href="/ticket/{{ $ticket->id }}"><button class="btn btn-success">Prikaži</button></a>

                            <button type="submit" class="btn btn-warning">Uredi </button>
                            <button type="submit" class="btn btn-danger">Obriši </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
