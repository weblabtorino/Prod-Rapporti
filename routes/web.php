<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterventoController;
use App\Http\Controllers\SottoInterventoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

//Route::post('/register', [AuthController::class, 'register']);


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/', [DashboardController::class, 'index'])->name('home');

// Mostra una lista di clienti
    Route::get('/clienti', [ClienteController::class, 'index'])->name('clienti.index');

// Mostra un modulo per creare un nuovo cliente
    Route::get('/clienti/create', [ClienteController::class, 'create'])->name('clienti.create');

// Salva un nuovo cliente nel database
    Route::post('/clienti', [ClienteController::class, 'store'])->name('clienti.store');

// Mostra i dettagli di un cliente specifico
    Route::get('/clienti/{cliente}', [ClienteController::class, 'show'])->name('clienti.show');

// Mostra un modulo per modificare un cliente esistente
    Route::get('/clienti/{cliente}/edit', [ClienteController::class, 'edit'])->name('clienti.edit');

// Aggiorna un cliente nel database
    Route::put('/clienti/{cliente}', [ClienteController::class, 'update'])->name('clienti.update');

// Rimuove un cliente dal database
    Route::delete('/clienti/{cliente}', [ClienteController::class, 'destroy'])->name('clienti.destroy');

// Mostra una lista di interventi
    Route::get('/interventi', [InterventoController::class, 'index'])->name('interventi.index');

// Mostra un modulo per creare un nuovo intervento
    Route::get('/interventi/create', [InterventoController::class, 'create'])->name('interventi.create');

// Salva un nuovo intervento nel database
    Route::post('/interventi', [InterventoController::class, 'store'])->name('interventi.store');

// Mostra i dettagli di un intervento specifico
    Route::get('/interventi/{intervento}', [InterventoController::class, 'show'])->name('interventi.show');

// Mostra un modulo per modificare un intervento esistente
    Route::get('/interventi/{intervento}/edit', [InterventoController::class, 'edit'])->name('interventi.edit');

// Aggiorna un intervento nel database
    Route::put('/interventi/{intervento}', [InterventoController::class, 'update'])->name('interventi.update');

// Rimuove un intervento dal database
    Route::delete('/interventi/{intervento}', [InterventoController::class, 'destroy'])->name('interventi.destroy');

    Route::get('/interventi/{intervento}', [InterventoController::class, 'show'])->name('interventi.show');

    Route::get('/sottoInterventi/create/{intervento}', [SottoInterventoController::class, 'create'])->name('sottoInterventi.create');
    Route::post('/sottoInterventi/{intervento}', [SottoInterventoController::class, 'store'])->name('sottoInterventi.store');


    Route::post('/delete/costo', [InterventoController::class, 'deleteCostiAgg']);
    Route::post('/interventi/costi/{id}/update', [InterventoController::class, 'updateCost']);
    Route::post('/addCostiAgg', [InterventoController::class, 'addCostiAgg']);

    Route::get('interventi/{id}/pdf', [InterventoController::class, 'generatePDF'])->name('interventi.pdf');

    Route::get('/interventi-calendar', [InterventoController::class, 'calendarData']);

    Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');



//// Mostra la lista di tutte le fatture
//Route::get('/fatture', [FatturaController::class, 'index'])->name('fatture.index');
//
//// Mostra il modulo per creare una nuova fattura
//Route::get('/fatture/create', [FatturaController::class, 'create'])->name('fatture.create');
//
//// Salva una nuova fattura nel database
//Route::post('/fatture', [FatturaController::class, 'store'])->name('fatture.store');
//
//// Mostra il modulo per modificare una fattura esistente
//Route::get('/fatture/{fattura}/edit', [FatturaController::class, 'edit'])->name('fatture.edit');
//
//// Aggiorna una fattura esistente nel database
//Route::put('/fatture/{fattura}', [FatturaController::class, 'update'])->name('fatture.update');
//
//// Cancella una fattura
//Route::delete('/fatture/{fattura}', [FatturaController::class, 'destroy'])->name('fatture.destroy');
//
//// Mostra i dettagli di una singola fattura
//Route::get('/fatture/{fattura}', [FatturaController::class, 'show'])->name('fatture.show');
});

Auth::routes(['register' => false]);
