<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-theme="pastel">
            @forelse ($tickets as $ticket)
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $ticket->name }}
                        <div style="float:right; vertical-align: top;">
                        <a href="/prikazi_ticket/{{ $ticket->id }}"><button class="btn btn-pink-primary">Prikaži</button></a>
                        <a href="/uredi_ticket/{{ $ticket->id }}"><button type="submit" class="btn btn-pink-secondary">Uredi </button></a>
                        <a href="/obrisi_ticket/{{ $ticket->id }}"><button type="submit" class="btn btn-pink-danger" onclick = "return confirm('Jeste li sigurni da želite izbrisati ovaj ticket?')">Obriši </button></a>
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