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
            'no_surat'=>'required',
            'isi_surat'=>'required',
            'no_agenda'=>'required',
            'tanggal_diterima'=>'required',
            'kepada'=>'required',
            'status_id'=>'required',
            'filename' => 'required|mimes:pdf|max:2048',
            //'users_id'=>'required',
        ]);
        $name = md5($request->filename . microtime()).'.'.$request->filename->extension();

        $request->filename->storeAs('disposisi', $name);

        Disposisi::updateOrCreate(['id' => $request->id], [
            'dari' => $request->dari,
            'tanggal_dibuat' => $request->tanggal_dibuat,
            'no_surat' => $request->no_surat,
            'isi_surat' => $request->isi_surat,
            'no_agenda' => $request->no_agenda,
            'tanggal_diterima' => $request->tanggal_diterima,
            'kepada' => $request->kepada,
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
