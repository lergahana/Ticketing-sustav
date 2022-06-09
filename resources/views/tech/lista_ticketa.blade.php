<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/buttons.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{ __('Ticketi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-theme="pastel">
                @php
                    if ($num_tickets > 6){
                        $display = "";
                    } else {
                        $display = "none";
                    }
                @endphp
                <div class="p-6 bg-white border-b border-gray-200" style="display:{{$display}};">
                    {{ $tickets->links() }}
                </div>

                @forelse ($tickets as $ticket)
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if(in_array($ticket->id, $solved))
                            <s>
                            {{ $ticket->name }}
                            <div style="float:right; vertical-align: top;">
                                <a href="/tech/prikazi_ticket/{{ $ticket->id }}"><button class="btn btn-pink-primary">Prikaži</button></a>
                                <a href="/tech/zatvori_ticket/{{ $ticket->id }}"><button type="submit" class="btn btn-pink-secondary" disabled>Zatvori ticket</button></a>
                            </div>
                            </s>
                        @else
                            {{ $ticket->name }}
                            <div style="float:right; vertical-align: top;">
                                <a href="/tech/prikazi_ticket/{{ $ticket->id }}"><button class="btn btn-pink-primary">Prikaži</button></a>
                                <form action="{{ route('tech/zatvori_ticket', $ticket->id) }}" method=POST>@csrf @method('POST')<button type="submit" class="btn btn-pink-secondary" onclick = "return confirm('Jeste li sigurni da želite zatvoriti ovaj ticket?')">Zatvori ticket</button></form>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="p-6 bg-white border-b border-gray-200">
                        Trenutno nema ticketa.
                    </div>
                @endforelse

                <div class="bg-white border-b border-gray-200" style="display:{{$display}};">
                    <div style="align:middle; float:right; margin-right: 15px; padding-top: 10px; padding-bottom: 10px;">
                        Sortiranje:&nbsp
                        <th>@sortablelink('name', 'Naziv') / </th>
                        <th>@sortablelink('created_at', 'Vrijeme')</th>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    form {
        display:inline;
    }
</style>