<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         <!--Plus and minus symbol-->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <!--Form style-->
         <link rel="stylesheet" href="css/form.css">
         <!--Drop down search-->
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
         <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
         <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

         <!--Alert for technicians-->
         <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
         <style>
            .swal2-popup {
               font-size: 10px !important;
               width: 20%;
               margin-top: 10%;
            }
         </style>
         {{ __('Novi ticket') }}
      </h2>
   </x-slot>
   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200" data-theme="retro">

               <button class="btn" id="ticket_btn" style="font-size:1.1vw;"><i class="fa fa-plus-circle" style="font-size:1.3vw; color:#D77FA1;"></i>&nbsp&nbsp Otvori ticket</button>
               
               <div class="card-body col-md-12" id="form" style="display:none;">
                  <form name="form" method = "POST" action="/tickets/store" style="margin-bottom:5%;">
                     @csrf
                     <div class="form-group">
                        <label for="naziv">Naziv:</label>
                        <input type="text" id="naziv" name="name" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="opis">Opis:</label>
                        <textarea name="opis" class="form-control" required></textarea>
                     </div>
                     <div class="form-group">
                        <label for="status">Status:</label>
                        </br>
                        <input type="radio" name="status" id="otvoren" value="otvoren" onclick="radio_btn_control()" required="required">
                        <label for="otvoren" style="font-weight: normal">otvoren</label><br>
                        <input type="radio" name="status" id="zadužen" value="zadužen" onclick="radio_btn_control()">
                        <label for="zadužen" style="font-weight: normal">zadužen</label><br>
                        <!--<input type="radio" name="status" id="zatvoren" value="zatvoren">
                        <label for="zatvoren" style="font-weight: normal">zatvoren</label>-->
                     </div>
                     <div class="form-group">
                        <label for="klijent">Klijent: </label></br>
                        <select id="search_client" onclick="client_size();" name="klijent" style="width:80%; border-color:#D3D3D3; border-radius: 5px;" required>
                           <option value="" disabled selected>Izaberi klijenta: </option>
                           @foreach ($clients as $c)
                              <option value="{{ $c->id }}">{{ $c->name }}</option>
                           @endforeach
                        </select>
                     </div>

                     <div id="sve_tech" style="display:none;">
                        <label for="tehnicar" id="label_tech">Tehničar: </label>

                        <div class="form-group" id="tehnicar">
                           <div>
                              <select id="search_tech" name="tech[]" style="width:80%; border-color:#D3D3D3; border-radius: 5px;">
                                 <option value="" disabled selected>Izaberi tehničara</option>
                                 @foreach ($technicians as $tech)
                                 <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>

                        <div style="float:right; margin-top:-5%; margin-right:15%">
                           <button type="button" class="btn" style="font-size:1.1vw; display: inline-block;" onclick="add_technician()"><i class="fa fa-plus-circle" style="font-size:1.3vw; color:#D77FA1;"></i></button>
                        </div>
                        <div style="float:right; margin-top:-5%; margin-right:12%">
                           <button type="button" class="btn" style="font-size:1.1vw; display: inline-block;" onclick="rem_technician()"><i class="fa fa-minus-circle" style="font-size:1.3vw; color:#7a5db7;"></i></button>
                        </div>
                        
                        <div id="more_technicians"></div>
                     </div>

                     <button type="submit" class="btn btn-primary" style="float:right; background-color: #D77FA1; border-color: #D77FA1; margin-top:1%;">Kreiraj ticket</button>
                     <!--<input class="btn btn-primary" type="reset" style="float:left; background-color: #D77FA1; border-color: #D77FA1; margin-top:1%;" value="Reset">-->
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>

<script>
   /*HIDE\SHOW TICKET FORM*/
   const btn = document.getElementById('ticket_btn');

   btn.addEventListener('click', () => {
   const form = document.getElementById('form');

   if (form.style.display === 'none') {
      form.style.display = 'block';
      btn.style.display = 'none';
   } else {
      form.style.display = 'none';
      btn.style.display = 'block';
   }
   });

   /*DROP DOWN SEARCH FOR TECHNICIANS*/
   function radio_btn_control(){
      const sve = document.getElementById('sve_tech');
      
      if(document.getElementById('zadužen').checked) {
         sve.style.display = 'block';
         Swal.fire("Ako tehničar nije izabran status će biti otvoren!")
      }
      if(document.getElementById('otvoren').checked) {
         sve.style.display = 'none';
      }
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