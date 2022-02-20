<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\ViewDisposisiUser;
use App\Http\Livewire\AgendaCrud;
use App\Http\Livewire\DisposisiCrud;
use App\Http\Livewire\EditDisposisi;
use App\Http\Livewire\FormDisposisi;
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
    // Route::get('/lihatPDF/{id}',[ViewDisposisiUser::class, 'lihatPDF'])->name('lihatPDF');
    Route::post('/download/{id}', [ViewDisposisiUser::class, 'download'])->name('downloadfile');
    Route::post('/lihatPDF/{id}', [ViewDisposisiUser::class, 'lihatPDF'])->name('lihatpdf');
    Route::get('disposisi-users', [ViewDisposisiUser::class, 'index']);
    Route::get('disposisi-users/list', [ViewDisposisiUser::class, 'getDisposisi'])->name('disposisi-users.list');
    Route::post('print',[ViewDisposisiUser::class, 'print'])->name('print');

    Route::get('form-disposisi-masuk', [DisposisiController::class, 'index']);
    Route::post('store-disposisi-user', [DisposisiController::class, 'store']);
    // Route::post('store-disposisi-user', [DisposisiController::class, 'store'])->name('store-disposisi-user');
    // Route::get('form-disposisi-masuk', [DisposisiController::class, 'render'])->name('form-disposisi-masuk');
    Route::get('agenda-lp', [AgendaController::class, 'index'])->name('agenda-lp');
    Route::post('download', [DisposisiCrud::class, 'download']);
    Route::get('form', FormDisposisi::class, 'form')->name('form');
    Route::get('agenda', AgendaCrud::class)->name('agenda');
    Route::post('store', [DisposisiCrud::class, 'store'])->name('store');
    Route::get('disposisi', DisposisiCrud::class)->name('disposisi');   Route::post('generate-pdf', [DisposisiCrud::class, 'generatePDF']);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
