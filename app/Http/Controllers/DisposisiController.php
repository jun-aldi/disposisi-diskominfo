<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class DisposisiController extends Controller
{
    use WithFileUploads;
    public $disposisi_edit_id, $dari, $tanggal_dibuat, $no_surat, $isi_surat, $tanggal_diterima, $bidangs_id, $status_id, $status_disposisi, $filename;
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
            // 'tanggal_dibuat'=>'required',
            // 'no_surat'=>'required',
            'isi_surat'=>'required',
            // 'no_agenda'=>'required',
            // 'tanggal_diterima'=>'required',
            'surats_id'=>'required',
            'bidangs_id'=>'required',
            // 'status_id'=>'required',
            'filename' => 'required|mimes:pdf|max:2048',
          ]);

          $name = md5($request->filename . microtime()).'.'.$request->filename->extension();



          $request->filename->storeAs('disposisi', $name);
          $status_id = 3;

          $getSurat=$request->surats_id;

          $emp = new Disposisi;
          $today = date('Y-m-d');
          $emp->dari = $request->dari;
          $emp->tanggal_dibuat = $today;
          $emp->no_surat = 0;
          $emp->surats_id = $request->surats_id;
          $emp->isi_surat = $request->isi_surat;
        //   $emp->tanggal_diterima = $request->tanggal_diterima;
          $emp->bidangs_id = $request->bidangs_id;
          $emp->status_id = $status_id;
          $emp->users_id = auth()->id();
          $emp->filename = $name;

          $emp->save();

          $getID = $emp->id;

          $getNoSurat= $getID.'/'.$getSurat.'/'.date('Y');

          $disposisi = Disposisi::where('id', $getID)->first();

          $disposisi->no_surat = $getNoSurat;


          $disposisi->save();

        session()->flash('message', $request->id ? 'Data updated successfully.' : 'Data added successfully.');
        return redirect('form-disposisi-masuk')->with('status', 'Form Data Has Been validated and insert');

    }

    public function store2(Request $request)
    {
        $validatedData = $request->validate([
            'dari'=>'required',
            'tanggal_dibuat'=>'required',
            // 'no_surat'=>'required',
            'isi_surat'=>'required',
            // 'no_agenda'=>'required',
            // 'tanggal_diterima'=>'required',
            'bidangs_id'=>'required',
            // 'status_id'=>'required',
            'filename' => 'required|mimes:pdf|max:2048',
          ]);

          $name = md5($request->filename . microtime()).'.'.$request->filename->extension();

          $getSurat=$request->surats_id;

          $request->filename->storeAs('disposisi', $name);
          $status_id = 3;
          $emp = new Disposisi;
          $today = date('Y-m-d');
          $emp->dari = $request->dari;
          $emp->tanggal_dibuat = $today;
          $emp->no_surat = 0;
          $emp->isi_surat = $request->isi_surat;
        //   $emp->tanggal_diterima = $request->tanggal_diterima;
          $emp->bidangs_id = $request->bidangs_id;
          $emp->status_id = $status_id;
          $emp->users_id = auth()->id();
          $emp->filename = $name;

          $emp->save();

          $getID = $emp->id;

          $getNoSurat= $getID.'/'.$getSurat.'/'.date('Y');

          $disposisi = Disposisi::where('id', $getID)->first();

          $disposisi->no_surat = $getNoSurat;


          $disposisi->save();

        session()->flash('message', $request->id ? 'Data updated successfully.' : 'Data added successfully.');
        return redirect('form-disposisi-masuk2')->with('status', 'Data berhasil tervalidasi dan berhasil disimpan');

    }
}

