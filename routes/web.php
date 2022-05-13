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
    return redirect('/otvoreni_ticketi');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', function () {
    return redirect('/otvoreni_ticketi');
})->middleware(['auth'])->name('home');

Route::get('/zaduzeni_ticketi', function () {
    return view('agent.zaduzeni_ticketi');
})->middleware(['auth'])->name('zaduzeni_ticketi');

Route::get('/zatvoreni_ticketi', function () {
    return view('agent.zatvoreni_ticketi');
})->middleware(['auth'])->name('zatvoreni_ticketi');

Route::get('/otvoreni_ticketi', function () {
    return view('agent.otvoreni_ticketi');
})->middleware(['auth'])->name('otvoreni_ticketi');

Route::get('/novi_ticket', function () {
    return view('agent.novi_ticket');
})->middleware(['auth'])->name('novi_ticket');


Route::get('search_clients_ajax', 'App\Http\Controllers\SearchClientsController@dataAjax');

Route::get('search_technicians_ajax', 'App\Http\Controllers\SearchTechniciansController@dataAjax');

Route::middleware(['auth:sanctum', 'verified'])->post('/tickets/store', 'App\Http\Controllers\TicketsController@store');
Route::middleware(['auth:sanctum', 'verified'])->post('/novi_klijent', 'App\Http\Controllers\ClientsController@store');

require __DIR__.'/auth.php';
