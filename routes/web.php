<?php

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
    Route::get('disposisi', DisposisiCrud::class)->name('disposisi');
    Route::get('generate-pdf', [DisposisiCrud::class, 'generatePDF']);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
