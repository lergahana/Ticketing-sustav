<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <link rel="stylesheet" href="{{ URL::asset('css/table.css') }}" />
        <style>
            .btn-pink {
                background-color: #D77FA1;
                color: white;
                margin-right: 5px;
                margin-bottom: 5px;
            }    
        </style>
        {{ $ticket->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table table-hover">
                    <tr>
                    <th scope="row">ID: </th>
                    <td>{{ $ticket->id }}</td>
                    </tr>
                    <tr>
                    <th scope="row">Naziv: </th>
                    <td>{{ $ticket->name }}</td>
                    </tr>
                    <tr>
                    <th scope="row">Opis: </th>
                    <td>{{ $ticket->description }}</td>
                    </tr>
                    <tr>
                    <th scope="row">Status: </th>
                    <td>{{ $status->status }}</td>
                    </tr>
                    <tr>
                    <th scope="row">Klijent: </th>
                    <td>{{ $client->name }}</td>
                    </tr>
                    
                    @if($num_techs > 0)
                        <tr>
                        <th scope="row">Tehničar: </th>
                        <td>
                            @for ($i = 0; $i < $num_techs; $i++)
                                {{ $technicians[$i][0]->name }}</br>
                            @endfor
                        </td>
                        </tr>
                    @endif
                </table>

                <a href="{{ url()->previous() }}"> <button class="btn btn-pink" style="float:right;">Povratak</button></a>
            </div>
        </div>
    </div>
</x-app-layout>

