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

Route::get('/dashboard', 'App\Http\Controllers\HomeController@home')->name('dashboard');

Route::get('/home', 'App\Http\Controllers\HomeController@home')->name('home');

Route::group(['middleware' => 'agent'], function () {
    Route::middleware(['auth:sanctum', 'verified'])->get('/send_email', 'App\Http\Controllers\EmailController@send')->name('send_email');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/novi_ticket', 'App\Http\Controllers\TicketsController@forma_novi')->name('novi_ticket');

    Route::middleware(['auth:sanctum', 'verified'])->get('/otvoreni_ticketi', 'App\Http\Controllers\TicketsController@otvoreni_index')->name('otvoreni_ticketi');
    Route::middleware(['auth:sanctum', 'verified'])->get('/zaduzeni_ticketi', 'App\Http\Controllers\TicketsController@zaduzeni_index')->name('zaduzeni_ticketi');
    Route::middleware(['auth:sanctum', 'verified'])->get('/zaduzeni_ticketi_sort', 'App\Http\Controllers\TicketsController@zaduzeni_index_sort')->name('zaduzeni_ticketi_sort');
    Route::middleware(['auth:sanctum', 'verified'])->get('/zatvoreni_ticketi', 'App\Http\Controllers\TicketsController@zatvoreni_index')->name('zatvoreni_ticketi');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/prikazi_ticket/{id}', 'App\Http\Controllers\TicketsController@show');
    Route::middleware(['auth:sanctum', 'verified'])->get('/uredi_ticket/{id}', 'App\Http\Controllers\TicketsController@edit');
    Route::middleware(['auth:sanctum', 'verified'])->put('/azuriraj_ticket/{id}', 'App\Http\Controllers\TicketsController@update');
    Route::middleware(['auth:sanctum', 'verified'])->get('/obrisi_ticket/{id}', 'App\Http\Controllers\TicketsController@destroy');
    
    Route::middleware(['auth:sanctum', 'verified'])->post('/tickets/store', 'App\Http\Controllers\TicketsController@store');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/novi_klijent', 'App\Http\Controllers\ClientsController@forma_novi')->name('novi_klijent');;
    Route::middleware(['auth:sanctum', 'verified'])->post('/clients/store', 'App\Http\Controllers\ClientsController@store');
});

Route::group(['middleware' => 'technician'], function () {
    Route::middleware(['auth:sanctum', 'verified'])->get('/lista_ticketa', 'App\Http\Controllers\TechniciansController@index_tickets')->name('lista_ticketa');
    Route::middleware(['auth:sanctum', 'verified'])->get('tech/prikazi_ticket/{id}', 'App\Http\Controllers\TechniciansController@show_tickets');
    Route::middleware(['auth:sanctum', 'verified'])->get('tech/zatvori_ticket/{id}', 'App\Http\Controllers\TechniciansController@solve');
});


require __DIR__.'/auth.php';