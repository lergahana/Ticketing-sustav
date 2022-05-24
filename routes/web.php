<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'App\Http\Controllers\FactsController@data');

Route::get('/dashboard', function () {
    return redirect('/novi_ticket');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', function () {
    return redirect('/novi_ticket');
})->middleware(['auth'])->name('home');



/*RUTA ZA DROPDOWN KLIJENATA
Route::get('search_clients_ajax', 'App\Http\Controllers\SearchClientsController@dataAjax');*/

Route::middleware(['auth:sanctum', 'verified'])->get('/novi_ticket', 'App\Http\Controllers\TicketsController@forma_novi')->name('novi_ticket');

/*UREDITI RUTE DA USMJERAVAJU NA LISTU TICKETA I JEDNU FUNKCIJU*/
Route::middleware(['auth:sanctum', 'verified'])->get('/otvoreni_ticketi', 'App\Http\Controllers\TicketsController@otvoreni_index')->name('otvoreni_ticketi');
Route::middleware(['auth:sanctum', 'verified'])->get('/zaduzeni_ticketi', 'App\Http\Controllers\TicketsController@zaduzeni_index')->name('zaduzeni_ticketi');
Route::middleware(['auth:sanctum', 'verified'])->get('/zatvoreni_ticketi', 'App\Http\Controllers\TicketsController@zatvoreni_index')->name('zatvoreni_ticketi');

Route::middleware(['auth:sanctum', 'verified'])->get('/prikazi_ticket/{id}', 'App\Http\Controllers\TicketsController@show');
Route::middleware(['auth:sanctum', 'verified'])->get('/uredi_ticket/{id}', 'App\Http\Controllers\TicketsController@edit');
Route::middleware(['auth:sanctum', 'verified'])->put('/azuriraj_ticket/{id}', 'App\Http\Controllers\TicketsController@update');
Route::middleware(['auth:sanctum', 'verified'])->get('/obrisi_ticket/{id}', 'App\Http\Controllers\TicketsController@destroy');

Route::middleware(['auth:sanctum', 'verified'])->post('/tickets/store', 'App\Http\Controllers\TicketsController@store');

Route::middleware(['auth:sanctum', 'verified'])->get('/novi_klijent', 'App\Http\Controllers\ClientsController@forma_novi')->name('novi_klijent');;
Route::middleware(['auth:sanctum', 'verified'])->post('/clients/store', 'App\Http\Controllers\ClientsController@store');

require __DIR__.'/auth.php';
