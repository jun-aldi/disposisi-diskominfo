<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AgendaDatatablesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardDisposisi;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\DisposisiDashboardController;
use App\Http\Controllers\DisposisiDashboardController2;
use App\Http\Controllers\ProfileShow;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratKeluarDashboard;
use App\Http\Controllers\SuratMasukDashboard;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewDisposisiUser;
use App\Http\Controllers\ViewSuratKeluar;
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

//welcome route
Route::get('/', function () {
    return view('welcome');
});

//route by bidang
Route::get('agenda-kepala', [AgendaController::class, 'indexKepala'])->name('agenda-kepala');
Route::get('agenda-sekre', [AgendaController::class, 'indexSekretariat'])->name('agenda-sekre');
Route::get('agenda-tki', [AgendaController::class, 'indexTki'])->name('agenda-tki');
Route::get('agenda-ikp', [AgendaController::class, 'indexIkp'])->name('agenda-ikp');







//admin route
Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
    Route::post('/download-keluar/{id}', [ViewSuratKeluar::class, 'download'])->name('downloadsuratkeluar');

    Route::get('form-surat-keluar', [SuratKeluarController::class, 'index']);
    Route::post('store-surat-keluar-user', [SuratKeluarController::class, 'store']);

    Route::get('/profile.show', [ProfileShow::class, 'index'])->name('profile.show');

    Route::get('/dashboard',[DashboardController::class, 'render'])->name('dashboard');

    Route::resource('users-dashboard', UserController::class);

    Route::resource('agenda-dashboard', AgendaDatatablesController::class);

    Route::resource('disposisis2', DisposisiDashboardController2::class);

    Route::resource('keluar-dashboard', SuratKeluarDashboard::class);

    Route::post('/disposisis/{id}', [DisposisiDashboardController::class, 'buat'])->name('disposisibuat');
    Route::resource('disposisis', DisposisiDashboardController::class);


    Route::get('/download-disposisi-dashboard/{id}', [DashboardDisposisi::class, 'download'])->name('downloadFileDashboard');
    Route::get('/disposisi-dashboard/list',[DashboardDisposisi::class,'list']);
    Route::get('disposisi-dashboard',[DashboardDisposisi::class,'index'])->name('disposisi-dashboard');

    Route::get('/lihatPDF/{id}',[ViewDisposisiUser::class, 'lihatPDF'])->name('lihatPDF');
    Route::post('/download/{id}', [ViewDisposisiUser::class, 'download'])->name('downloadfile');
    Route::post('/lihatPDF/{id}', [ViewDisposisiUser::class, 'lihatPDF'])->name('lihatpdf');

    Route::get('disposisi-users', [ViewDisposisiUser::class, 'index']);
    // Route::get('disposisi-users/list', [ViewDisposisiUser::class, 'getDisposisi'])->name('disposisi-users.list');
    Route::post('print',[ViewDisposisiUser::class, 'print'])->name('print');


    Route::get('/form-disposisi-masuk2', [DisposisiController::class, 'index2']);
    Route::get('form-disposisi-masuk', [DisposisiController::class, 'index']);
    Route::post('store-disposisi-user2', [DisposisiController::class, 'store2']);
    Route::post('store-disposisi-user', [DisposisiController::class, 'store']);
    // Route::post('store-disposisi-user', [DisposisiController::class, 'store'])->name('store-disposisi-user');
    // Route::get('form-disposisi-masuk', [DisposisiController::class, 'render'])->name('form-disposisi-masuk');

    // // Route::post('download', [DisposisiCrud::class, 'download']);
    // // Route::get('form', FormDisposisi::class, 'form')->name('form');
    // // Route::get('agenda', AgendaCrud::class)->name('agenda');
    // // Route::post('store', [DisposisiCrud::class, 'store'])->name('store');
    // Route::get('disposisi', DisposisiCrud::class)->name('disposisi');

});
Route::middleware(['auth:sanctum', 'verified',])->group(function () {


    Route::get('/profile.show', [ProfileShow::class, 'index'])->name('profile.show');

    // Route::resource('agenda-dashboard', AgendaDatatablesController::class);

    // Route::resource('disposisis2', DisposisiDashboardController2::class);

    // Route::post('/disposisis/{id}', [DisposisiDashboardController::class, 'buat'])->name('disposisibuat');
    // Route::resource('disposisis', DisposisiDashboardController::class);


    // Route::get('/download-disposisi-dashboard/{id}', [DashboardDisposisi::class, 'download'])->name('downloadFileDashboard');
    // Route::get('/disposisi-dashboard/list',[DashboardDisposisi::class,'list']);
    // Route::get('disposisi-dashboard',[DashboardDisposisi::class,'index'])->name('disposisi-dashboard');

    Route::get('/lihatPDF/{id}',[ViewDisposisiUser::class, 'lihatPDF'])->name('lihatPDF');
    Route::post('/download/{id}', [ViewDisposisiUser::class, 'download'])->name('downloadfile');
    Route::post('/lihatPDF/{id}', [ViewDisposisiUser::class, 'lihatPDF'])->name('lihatpdf');
    Route::get('disposisi-users', [ViewDisposisiUser::class, 'index']);
    // Route::get('disposisi-users/list', [ViewDisposisiUser::class, 'getDisposisi'])->name('disposisi-users.list');
    Route::post('print',[ViewDisposisiUser::class, 'print'])->name('print');


    // Route::get('form-disposisi-masuk2', [DisposisiController::class, 'index2']);
    Route::get('form-disposisi-masuk', [DisposisiController::class, 'index']);
    // Route::post('store-disposisi-user2', [DisposisiController::class, 'store2']);
    Route::post('store-disposisi-user', [DisposisiController::class, 'store']);
    // Route::post('store-disposisi-user', [DisposisiController::class, 'store'])->name('store-disposisi-user');
    // Route::get('form-disposisi-masuk', [DisposisiController::class, 'render'])->name('form-disposisi-masuk');

    // // // Route::post('download', [DisposisiCrud::class, 'download']);
    // // // Route::get('form', FormDisposisi::class, 'form')->name('form');
    // // // Route::get('agenda', AgendaCrud::class)->name('agenda');
    // // // Route::post('store', [DisposisiCrud::class, 'store'])->name('store');
    // // Route::get('disposisi', DisposisiCrud::class)->name('disposisi');
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

