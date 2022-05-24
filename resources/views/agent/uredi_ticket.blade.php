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

        <!--Alert for technicians-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .swal2-popup {
               font-size: 10px !important;
               width: 20%;
               margin-top: 10%;
            }
        </style>

        <!--Plus and minus symbol-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <input type="radio" name="status" id="otvoren" value="otvoren" onclick="radio_btn_control()" {{ ($status->status == "otvoren")? "checked": "" }}>
                        <label for="otvoren" style="font-weight: normal">otvoren</label><br>
                        <input type="radio" name="status" id="zadužen" value="zadužen" onclick="radio_btn_control()" {{ ($status->status == "zadužen")? "checked": "" }}>
                        <label for="zadužen" style="font-weight: normal">zadužen</label><br>
                        <input type="radio" name="status" id="zatvoren" value="zatvoren" onclick="radio_btn_control()" {{ ($status->status == "zatvoren")? "checked": "" }}>
                        <label for="zatvoren" style="font-weight: normal">zatvoren</label>
                    </td>
                    </tr>
                    <tr>
                    <th scope="row"><label for="klijent">Klijent: </label></th>
                    <td>
                        <select id="search_client" name="klijent" style="width:80%; border-color:#D3D3D3; border-radius: 5px;" required>
                            <option value="{{ $client->id }}" disabled selected>{{ $client->name }}</option>
                            <option value="" disabled>─────────────────────────</option> 
                            @foreach ($all_clients as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select> 
                    </td>
                    </tr>
                    @if ($status->status == 'zadužen')
                        <tr id="tr_tech" style="display:table-row">
                    @else
                        <tr id="tr_tech" style="display:none">
                    @endif
                        <th scope="row">Tehničar: </br>
                        <a href="javascript:void(0);" onclick="control_tech()" style="color: #D77FA1; margin-left:-25px;">Uredi</a>
                        </th>
                        @if($num_techs > 0)
                        <td>
                            @for ($i = 0; $i < $num_techs; $i++)
                                {{ $technicians[$i][0]->name }}</br>
                            @endfor
                        
                        @else
                        <td>  
                        @endif
                        </td>
                    </tr>
                    <tr id="novi_tech" style="display:none;">
                        <th>Tehničar: </th>
                        <td>
                        <div id="tehnicar">
                           <div>
                              <select id="search_tech" name="tech[]" style="width:80%; border-color:#D3D3D3; border-radius: 5px;">
                                 <option value="" disabled selected>Izaberi tehničara</option>
                                 @foreach ($all_techs as $tech)
                                 <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div style="float:right; margin-top:-5%; margin-right:15%">
                            <button type="button" class="btn" style="font-size:1.1vw; display: inline-block;" onclick="add_technician()"><i class="fa fa-plus-circle" style="font-size:1.3vw; color:#D77FA1;"></i></button>
                        </div>
                        <div style="float:right; margin-top:-5%; margin-right:12%">
                            <button type="button" class="btn" style="font-size:1.1vw; display: inline-block;" onclick="rem_technician()"><i class="fa fa-minus-circle" style="font-size:1.3vw; color:#BAABDA;"></i></button>
                        </div>
                        <div id="more_technicians"></div>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-pink" style="float:right;">Spremi promjene</button></form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function radio_btn_control(){
      const tr = document.getElementById('tr_tech');
      const tr2 = document.getElementById('novi_tech');
      
      if(document.getElementById('zadužen').checked) {
         tr.style.display = 'table-row';
         Swal.fire("Ako tehničar nije izabran status će biti otvoren!");
      }
      if(document.getElementById('otvoren').checked) {
         tr.style.display = 'none';
         tr2.style.display = 'none';
      }
    }

    function control_tech(){
        const tr1 = document.getElementById('tr_tech');
        const tr2 = document.getElementById('novi_tech');

        tr1.style.display = 'none';
        tr2.style.display = 'table-row';

    }

    function add_technician(){
      const original = document.getElementById("tehnicar");
      const clone = original.cloneNode(true);
      clone.removeAttribute("id");
      document.getElementById("more_technicians").appendChild(clone);
   }

   function rem_technician(){
      let original = document.getElementById("more_technicians");
      original.removeChild(original.firstChild);
   }

</script>