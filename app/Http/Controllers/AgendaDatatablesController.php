<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class AgendaDatatablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Agenda::select(['id','disposisi_id', 'jam_agenda','tanggal_agenda','isi','tempat','keterangan']);
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($data){
                $btn =' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteAgenda">Delete</a>';
                $btn .='<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editAgenda">Edit</a>';
                return $btn;
            })
            ->rawColumns(['action'])->make(true);
        }
        return view('agenda-dashboard');
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
            'jam_agenda'=>'required',
            'tanggal_agenda'=>'required',
            'isi'=>'required',
            'tempat'=>'required',
            'keterangan'=>'required',
        ]);



        Agenda::updateOrCreate(['id' => $request->id], [
            'disposisi_id' => $request->disposisi_id,
            'jam_agenda' => $request->jam_agenda,
            'tanggal_agenda' => $request->tanggal_agenda,
            'isi' => $request->isi,
            'tempat' => $request->tempat,
            'keterangan' => $request->keterangan,

        ]);
        // $agenda = Agenda::where('id', $request->id)->first();
        // $agenda->disposisi_id= $request->disposisi_id;
        // $agenda->jam_agenda = $request->jam_agenda;
        // $agenda->tanggal_agenda= $request->tanggal_agenda;
        // $agenda->isi = $request->isi;
        // $agenda->tempat= $request->tempat;
        // $agenda->keterangan = $request->keterangan;

        // $agenda->save();

return response()->json(['success'=>'Agenda berhasil disimpan']);
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
        $agenda = Agenda::find($id);
        return response()->json($agenda);
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
        $agenda = Agenda::where('id', $id)->firstOrFail();
        Agenda::find($id)->delete();

        return response()->json(['success'=>'Agenda berhasil dihapus.']);
    }
}
