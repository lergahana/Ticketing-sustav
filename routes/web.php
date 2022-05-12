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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/zaduzeni_ticketi', function () {
    return view('agent.zaduzeni_ticketi');
})->middleware(['auth'])->name('zaduzeni_ticketi');

Route::get('/zatvoreni_ticketi', function () {
    return view('agent.zatvoreni_ticketi');
})->middleware(['auth'])->name('zatvoreni_ticketi');

Route::get('/otvori_ticket', function () {
    return view('agent.otvori_ticket');
})->middleware(['auth'])->name('otvori_ticket');


Route::get('search_clients', 'App\Http\Controllers\SearchClientsController@layout');
Route::get('search_clients_ajax', 'App\Http\Controllers\SearchClientsController@dataAjax');

require __DIR__.'/auth.php';
