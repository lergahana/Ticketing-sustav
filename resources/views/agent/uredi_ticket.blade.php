<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <link rel="stylesheet" href="{{ URL::asset('css/table.css') }}" />
        {{ $ticket->name }}
        <!--Drop down search-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <style>
            .btn-pink {
                background-color: #D77FA1;
                color: white;
                margin-right: 5px;
            }    
        </style>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form name="form" method = "POST" action="/azuriraj_ticket/{{ $ticket->id }}" style="margin-bottom:5%;">
                @csrf
                @method('PUT')
                <table class="table table-hover">
                    <tr>
                    <th scope="row">ID: </th>
                    <td>{{ $ticket->id }}</td>
                    </tr>
                    <tr>
                    <th scope="row"><label for="naziv">Naziv: </label></th>
                    <td><input type="text" id="naziv" name="name" class="form-control" value="{{ $ticket->name }}"></td>
                    </tr>
                    <tr>
                    <th scope="row"><label for="opis">Opis: </label></th>
                    <td><textarea name="opis" class="form-control">{{ $ticket->description }}</textarea></td>
                    </tr>
                    <tr>
                    <th scope="row"><label for="status">Status: </label></th>
                    <td>
                        <input type="radio" name="status" id="otvoren" value="otvoren" {{ ($status->status == "otvoren")? "checked": "" }}>
                        <label for="otvoren" style="font-weight: normal">otvoren</label><br>
                        <input type="radio" name="status" id="zadužen" value="zadužen" {{ ($status->status == "zadužen")? "checked": "" }}>
                        <label for="zadužen" style="font-weight: normal">zadužen</label><br>
                        <input type="radio" name="status" id="zatvoren" value="zatvoren" {{ ($status->status == "zatvoren")? "checked": "" }}>
                        <label for="zatvoren" style="font-weight: normal">zatvoren</label>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row"><label for="klijent">Klijent: </label></th>
                    <td><input type="text" id="klijent" name="klijent" class="form-control" style="height:41px;" value="{{ $client->name }}"></td>
                    </tr>
                    <tr>
                    <th scope="row"><label for="tehnicar">Tehničar: </label></th>
                    <td>
                        <select class="itemName form-control" style="width:50%" name="itemName"></select>
                        <script type="text/javascript">
                           document.getElementsByName('itemName')[0].innerHTML = "{{ $technician->name }}";
                           $('.itemName').select2({
                               placeholder: '{{ $technician->name }}',
                               ajax: {
                               url: '/search_technicians_ajax',
                               dataType: 'json',
                               delay: 250,
                               processResults: function (data) {
                                   return {
                                   results:  $.map(data, function (item) {
                                           return {
                                               text: item.name,
                                               id: item.id
                                           }
                                       })
                                   };
                               },
                               cache: true
                               }
                           });
                        </script>
                    </td>
                    </tr>
                </table>

                <button type="submit" class="btn btn-pink" style="float:right;">Spremi promjene</button></form>
            </div>
        </div>
    </div>
</x-app-layout>

