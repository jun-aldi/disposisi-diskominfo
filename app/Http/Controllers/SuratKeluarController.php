<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class SuratKeluarController extends Controller
{
    use WithFileUploads;
    public function index(){
        $jenis_surats = Surat::all();
        return view('surat-masuk-form-user',compact('jenis_surats'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'surats_id'=>'required',
            'tanggal_surat'=>'required',
            'no_surat'=>'required',
            'isi'=>'required',
            'kepada'=>'required',
            'sifat'=>'required',
            'bidangs_id'=>'required',
            'filename' => 'required|mimes:pdf|max:2048',
          ]);

          $name = md5($request->filename . microtime()).'.'.$request->filename->extension();

          $request->filename->storeAs('suratMasuk', $name);

          $emp = new SuratKeluar();
          $emp->surats_id = $request->surats_id;
          $emp->tanggal_surat = $request->tanggal_surat;
          $emp->sifat = $request->sifat;
          $emp->no_surat = $request->no_surat;
          $emp->kepada = $request->kepada;
          $emp->isi = $request->isi;
          $emp->bidangs_id = $request->bidangs_id;
          $emp->users_id = auth()->id();
          $emp->filename = $name;

          $emp->save();

        session()->flash('message', $request->id ? 'Data updated successfully.' : 'Data added successfully.');
        return redirect('form-surat-keluar')->with('status', 'Form Berhasil Diinputkan...');

    }
}

