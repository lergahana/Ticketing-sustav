<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" data-theme="pastel" id="here">

            @php
                if ($num_tickets > 5){
                    $display = "";
                } else {
                    $display = "none";
                }
                if ($sort != '' && $sort != 'da'){
                    $tickets = $sort;
                }
            @endphp

            <div class="p-6 bg-white border-b border-gray-200" style="display:{{$display}};">
                {{ $tickets->links() }}
            </div>

            @forelse ($tickets as $ticket)
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(in_array($ticket->id, $solved))
                        &#128995
                    @endif
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

            <div class="bg-white border-b border-gray-200" style="display:{{$display}};">
                @if($sort != '')
                <div style="float:left; margin-left:20px; padding-top: 10px; padding-bottom: 10px;"> Prioritet: 
                    <a href="{{ url('zaduzeni_ticketi_sort') }}">na čekanju</a>
                </div>
                @endif
                <div style="align:middle; float:right; margin-right: 22px; padding-top: 10px; padding-bottom: 10px;">
                    Sortiranje:&nbsp
                    <th>@sortablelink('name', 'Naziv') / </th>
                    <th>@sortablelink('created_at', 'Vrijeme')</th>
                </div>
            </div>
        </div>
    </div>
</div>