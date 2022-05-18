<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @foreach ($tickets as $ticket)
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $ticket->name }}
                    <div style="float:right; vertical-align: top;">
                        <a href="/prikazi_ticket/{{ $ticket->id }}"><button class="btn btn-pink">Prikaži</button></a>
                        <a href="/uredi_ticket/{{ $ticket->id }}"><button type="submit" class="btn btn-pink">Uredi </button></a>
                        <a href="/obrisi_ticket/{{ $ticket->id }}"><button type="submit" class="btn btn-pink" onclick = "return confirm('Jeste li sigurni da želite izbrisati ovaj ticket?')">Obriši </button></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>