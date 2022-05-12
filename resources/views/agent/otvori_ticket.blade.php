<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novi ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <button class="btn" id="ticket_btn" style="font-size:1.1vw;"><i class="fa fa-plus-circle"></i>&nbsp&nbsp Otvori ticket</button>
                    <script src="js/new_ticket_form.js"></script>

                    <div class="card-body" id="form" style="display:none">
                            <form name="form" method="post">
                            @csrf
                                <div class="form-group">
                                    <label for="naziv">Naziv:</label>
                                    <input type="text" id="naziv" name="naziv" class="form-control" required="">
                                </div>
                                
                                <div class="form-group">
                                    <label for="opis">Opis:</label>
                                    <textarea name="opis" class="form-control" required=""></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    </br>
                                    <input type="radio" id="otvoren" value="otvoren">
                                    <label for="otvoren" style="font-weight: normal">otvoren</label><br>
                                    <input type="radio" id="zaduzen" value="zaduzen">
                                    <label for="zaduzen" style="font-weight: normal">zadužen</label><br>
                                    <input type="radio" id="zatvoren" value="zatvoren">
                                    <label for="zatvoren" style="font-weight: normal">zatvoren</label>
                                </div>

                                <div class="form-group" style="margin-top:1%">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="klijent">Izaberi klijenta: </label>
                                            </br>
                                            <select class="itemName form-control" style="width:90%" name="itemName"></select>
                                            
                                            <script type="text/javascript">
                                                document.getElementsByName('itemName')[0].innerHTML = "Lista klijenata";
                                                $('.itemName').select2({
                                                    placeholder: 'Lista klijenata',
                                                    ajax: {
                                                    url: '/search_clients_ajax',
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
                                        </div>
                                            
                                        <div class="col-md-5">
                                        <label for="klijent_novi">ili unesi novog klijenta: </label>
                                            <form id="klijent_novi" style="display:flex; justify-content: space-between">
                                                <input type="text" id="klijent_novi" name="klijent_novi" placeholder="Ime i prezime" class="form-control" style="height:30px" required="">
                                            </form>
                                        </div>

                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary" style="height:30px; bottom:0px;">Dodaj klijenta</button>
                                        </div>
                                    </table>
                                </div>

                                <div class="form-group">
                                    </br>
                                    <label for="tehnicar">Tehničar</label>
                                    <input type="text" id="tehnicar" name="tehnicar" class="form-control" required="">
                                </div>

                                <p style="margin-top:2%; float: right;">
                                    <button type="submit" class="btn btn-primary">Otvori</button>
                                </p>
                            </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
