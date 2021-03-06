<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         <link rel="stylesheet" href="css/form.css">
         <link rel="stylesheet" href="{{ URL::asset('css/buttons.css') }}">

         {{ __('Novi klijent') }}
      </h2>
   </x-slot>
   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200" data-theme="pastel">

               <div class="card-body col-md-12" id="form">
                  <form name="form" method = "POST" action="/clients/store" style="margin-bottom:5%;">
                  @csrf
                     <div class="form-group">
                        <label for="naziv">Ime i prezime:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                     </div>
                     
                     <button type="submit" class="btn btn-primary" style="float:right; background-color: #D77FA1; border-color: #D77FA1; margin-top:1%;">Spremi klijenta</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>