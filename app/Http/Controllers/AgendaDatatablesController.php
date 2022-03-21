<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Disposisi;
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
            $data = Agenda::select(['id','disposisis_id','jam_agenda','disposisi','bidangs_id','tanggal_agenda','isi','tempat','keterangan','disposisi'])
            ->with(['disposisis'])
            ->with(['bidang']);
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($data){
                $btn =' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteAgenda mx-1 my-2">Delete</a>';
                $btn .='<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editAgenda mx-1 my-2">Edit</a>';
                return $btn;
            })
            ->filter(function ($instance) use ($request) {
                if ($request->get('bidang_filter') == '1' || $request->get('bidang_filter') == '2' ||$request->get('bidang_filter') == '3' || $request->get('bidang_filter') == '4'){
                    $instance->where('bidangs_id', $request->get('bidang_filter'));
                }
                if (!empty($request->get('search'))) {
                     $instance->where(function($w) use($request){
                        $search = $request->get('search');
                        $w->orWhere('bidangs_id', 'LIKE', "%$search%");

                    });
                }
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
            // 'disposisis_id'=>'required',
            'bidangs_id'=>'required',
            'jam_agenda'=>'required',
            'tanggal_agenda'=>'required',
            'isi'=>'required',
            'tempat'=>'required',
        ]);



        Agenda::updateOrCreate(['id' => $request->id], [
            'disposisis_id' => $request->disposisis_id,
            'jam_agenda' => $request->jam_agenda,
            'tanggal_agenda' => $request->tanggal_agenda,
            'isi' => $request->isi,
            'bidangs_id' => $request->bidangs_id,
            'tempat' => $request->tempat,
            'keterangan' => $request->keterangan,
            'disposisi' => $request->disposisi,
        ]);
        // $agenda = Agenda::where('id', $request->id)->first();
        // $validatedData = $request->validate([
        //     // 'dari'=>'required',
        //     // // 'tanggal_dibuat'=>'required',
        //     // 'no_surat'=>'required',
        //     // 'isi_surat'=>'required',
        //     // // 'no_agenda'=>'required',
        //     // // 'tanggal_diterima'=>'required',
        //     // 'bidangs_id'=>'required',
        //     // // 'status_id'=>'required',
        //     // 'filename' => 'required|mimes:pdf|max:2048',
        //   ]);

        //   $name = md5($request->filename . microtime()).'.'.$request->filename->extension();

        //   $request->filename->storeAs('disposisi');
        //   $status_id = 3;
        //   $emp = new Disposisi();
        //   $today = date('Y-m-d');
        //   $emp->dari = $request->dari;
        //   $emp->tanggal_dibuat = $today;
        //   $emp->no_surat = $request->no_surat;
        //   $emp->isi_surat = $request->isi_surat;
        //   $emp->agendas_id = $request->agendas_id;
        //   $emp->tanggal_diterima = $request->tanggal_diterima;
        //   $emp->bidangs_id = $request->bidangs_id;
        //   $emp->status_id = $status_id;
        //   $emp->users_id = auth()->id();
        //   $emp->filename = $name;

        //   $emp->save();

        // $agenda->save();

        return response()->json(['success'=>'Data berhasil disimpan.']);
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
