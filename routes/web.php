<?php

use App\Http\Controllers\AgendaController;
use App\Http\Livewire\AgendaCrud;
use App\Http\Livewire\DisposisiCrud;
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

Route::get('/', function () {
    return view('welcome');

});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('agenda', AgendaCrud::class)->name('agenda');
    // Route::get('agenda', [AgendaCrud::class, 'render'])->name('agenda');
    Route::get('disposisi', DisposisiCrud::class)->name('disposisi');
    // Route::get('agenda', AgendaCrud::class, )->name('agenda');
    Route::post('generate-pdf', [DisposisiCrud::class, 'generatePDF']);
    Route::get('disposisi-list', [DisposisiCrud::class, 'getDisposisi'])->name('disposisi.list');
    Route::get('disposisi-list2', [DisposisiCrud::class, 'index'])->name('disposisi.list2');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
