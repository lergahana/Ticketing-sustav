<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         <!--Plus symbol-->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <!--Form style-->
         <link rel="stylesheet" href="css/form.css">
         <!--Drop down search-->
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
         <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
         <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
                  <form name="form" method = "POST" action="/tickets/store" style="margin-bottom:5%;">
                     @csrf
                     <div class="form-group">
                        <label for="naziv">Naziv:</label>
                        <input type="text" id="naziv" name="name" class="form-control" required="">
                     </div>
                     <div class="form-group">
                        <label for="opis">Opis:</label>
                        <textarea name="opis" class="form-control" required=""></textarea>
                     </div>
                     <div class="form-group">
                        <label for="status">Status:</label>
                        </br>
                        <input type="radio" name="status" id="otvoren" value="otvoren">
                        <label for="otvoren" style="font-weight: normal">otvoren</label><br>
                        <input type="radio" name="status" id="zadužen" value="zadužen">
                        <label for="zadužen" style="font-weight: normal">zadužen</label><br>
                        <input type="radio" name="status" id="zatvoren" value="zatvoren">
                        <label for="zatvoren" style="font-weight: normal">zatvoren</label>
                     </div>
                     <div class="form-group" style="margin-top:1%">
                     <!--
                        <div class="row">
                           <div class="col-md-6">
                              <label for="klijent">Izaberi klijenta: </label></br>
                              <select class="itemName1 form-control" style="width:100%" name="itemName1"></select>
                              <script type="text/javascript">
                                 document.getElementsByName('itemName1')[0].innerHTML = "Lista klijenata";
                                 $('.itemName1').select2({
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
                           <div class="col-md-6">    
                              <label for="klijent">ili unesi novog klijenta: </label>
                              <input type="text" id="klijent" name="klijent" placeholder="Ime i prezime" class="form-control" style="height:41px;">
                           </div>
                        </div>
                     </div>-->
                     <label for="klijent">Klijent: </label>
                        <input type="text" id="klijent" name="klijent" placeholder="Ime i prezime" class="form-control" style="height:41px;" require="">
                     <div class="form-group">
                        </br>
                        <label for="tehnicar">Tehničar: </label>
                        </br>
                        <select class="itemName form-control" style="width:100%" name="itemName"></select>
                        <script type="text/javascript">
                           document.getElementsByName('itemName')[0].innerHTML = "Lista tehničara";
                           $('.itemName').select2({
                               placeholder: 'Lista tehničara',
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
                     </div>
                     <button type="submit" class="btn btn-primary" style="float:right;">Kreiraj ticket</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>