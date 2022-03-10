<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class DisposisiController extends Controller
{
    use WithFileUploads;
    public $disposisi_edit_id, $dari, $tanggal_dibuat, $no_surat, $isi_surat, $no_agenda, $tanggal_diterima, $kepada, $status_id, $status_disposisi, $filename;
    public function index(){
        return view('disposisi-form-user');
    }

    public function index2(){
        return view('dashboard-disposisi');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dari'=>'required',
            'tanggal_dibuat'=>'required',
            'no_surat'=>'required',
            'isi_surat'=>'required',
            // 'no_agenda'=>'required',
            'tanggal_diterima'=>'required',
            'kepada'=>'required',
            // 'status_id'=>'required',
            'filename' => 'required|mimes:pdf|max:2048',
          ]);

          $name = md5($request->filename . microtime()).'.'.$request->filename->extension();

          $request->filename->storeAs('disposisi', $name);
          $status_id = 3;
          $emp = new Disposisi;

          $emp->dari = $request->dari;
          $emp->tanggal_dibuat = $request->tanggal_dibuat;
          $emp->no_surat = $request->no_surat;
          $emp->isi_surat = $request->isi_surat;
          $emp->no_agenda = $request->no_agenda;
          $emp->tanggal_diterima = $request->tanggal_diterima;
          $emp->kepada = $request->kepada;
          $emp->status_id = $status_id;
          $emp->users_id = auth()->id();
          $emp->filename = $name;

          $emp->save();

        session()->flash('message', $request->id ? 'Data updated successfully.' : 'Data added successfully.');
        return redirect('form-disposisi-masuk')->with('status', 'Form Data Has Been validated and insert');

    }

    public function store2(Request $request)
    {
        $validatedData = $request->validate([
            'dari'=>'required',
            'tanggal_dibuat'=>'required',
            'no_surat'=>'required',
            'isi_surat'=>'required',
            // 'no_agenda'=>'required',
            'tanggal_diterima'=>'required',
            'kepada'=>'required',
            // 'status_id'=>'required',
            'filename' => 'required|mimes:pdf|max:2048',
          ]);

          $name = md5($request->filename . microtime()).'.'.$request->filename->extension();

          $request->filename->storeAs('disposisi', $name);
          $status_id = 3;
          $emp = new Disposisi;

          $emp->dari = $request->dari;
          $emp->tanggal_dibuat = $request->tanggal_dibuat;
          $emp->no_surat = $request->no_surat;
          $emp->isi_surat = $request->isi_surat;
          $emp->no_agenda = $request->no_agenda;
          $emp->tanggal_diterima = $request->tanggal_diterima;
          $emp->kepada = $request->kepada;
          $emp->status_id = $status_id;
          $emp->users_id = auth()->id();
          $emp->filename = $name;

          $emp->save();

        session()->flash('message', $request->id ? 'Data updated successfully.' : 'Data added successfully.');
        return redirect('form-disposisi-masuk2')->with('status', 'Form Data Has Been validated and insert');

    }
}

