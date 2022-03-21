<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
class DisposisiDashboardController2 extends Controller
{

    use WithFileUploads;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'dari'=>'required',
            'tanggal_dibuat'=>'required',
            'no_agenda'=>'required',
            'no_surat'=>'required',
            'isi_surat'=>'required',
            'tanggal_diterima'=>'required',
            'surats_id'=>'required',
            'bidangs_id'=>'required',
            'status_id'=>'required',
            'filename' => 'required|mimes:pdf|max:2048',
            //'users_id'=>'required',
        ]);
        $name = md5($request->filename . microtime()).'.'.$request->filename->extension();

        $request->filename->storeAs('disposisi', $name);

        Disposisi::updateOrCreate(['id' => $request->id], [
            'dari' => $request->dari,
            'tanggal_dibuat' => $request->tanggal_dibuat,
            'no_agenda' => $request->no_agenda,
            'no_surat' => $request->no_surat,
            'sifat' => $request->sifat,
            'isi_surat' => $request->isi_surat,
            'tanggal_diterima' => $request->tanggal_diterima,
            'surats_id' => $request->bidangs_id,
            'bidangs_id' => $request->bidangs_id,
            'status_id' => $request->status_id,
            'users_id' => auth()->id(),
            'filename' => $name,
        ]);

        return response()->json(['success'=>'Product saved successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
