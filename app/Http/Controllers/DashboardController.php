<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Disposisi;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function render(Request $request){
        $countAgenda = Agenda::all()->count();
        $countDisposisi = Disposisi::all()->count();
        $countSuratKeluar = SuratKeluar::all()->count();

        $countDiterima = Disposisi::where('status_id',1)->count();
        $countDiproses = Disposisi::where('status_id',3)->count();
        $countDitolak = Disposisi::where('status_id',2)->count();

        return view('dashboard')
        ->with('countAgenda', $countAgenda)
        ->with('countDisposisi', $countDisposisi)
        ->with('countSuratKeluar', $countSuratKeluar)
        ->with('countDiterima', $countDiterima)
        ->with('countDiproses', $countDiproses)
        ->with('countDitolak', $countDitolak);
    }
}
