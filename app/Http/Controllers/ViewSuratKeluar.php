<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class ViewSuratKeluar extends Controller
{
    public function download($id){
        $suratkeluar = SuratKeluar::where('id', $id)->firstOrFail();
    	$myFile = storage_path('app/suratMasuk/'.$suratkeluar->filename);
        $headers = ['Content-Type: application/pdf'];
    	$newName ='surat_keluar_'.$suratkeluar->id.'.pdf';


    	return response()->download($myFile, $newName, $headers);

    }
}
