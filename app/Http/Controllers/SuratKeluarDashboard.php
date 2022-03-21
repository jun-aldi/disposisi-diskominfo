<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class SuratKeluarDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SuratKeluar::select(['id','bidangs_id','tanggal_surat', 'isi', 'surats_id', 'sifat','no_surat','kepada','no_surat','kepada','users_id'])
            ->with(['users'])->with(['bidang'])->with(['surat'])
            ;


            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($data){

                $url_lihat_file = route('downloadsuratkeluar', $data->id);
                return view('formdatatable')->with('url_lihat_file', $url_lihat_file)->render();
            })
            ->addColumn('delete', function($data){
                $btn =' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDisposisi">Delete</a>';
                return $btn;
            })
            ->addColumn('edit', function($data){
                $btn ='<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editDisposisi">Edit</a>';
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
            ->rawColumns(['action', 'delete','edit'])->make(true);
        }
        return view('dashboard-keluar');
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

                $disposisi = SuratKeluar::where('id', $request->id)->first();
                $disposisi->bidangs_id = $request->bidangs_id;
                $disposisi->tanggal_surat = $request->tanggal_surat;
                $disposisi->isi = $request->isi;
                $disposisi->sifat = $request->sifat;
                $disposisi->surats_id = $request->surats_id;
                $disposisi->no_surat = $request->no_surat;
                $disposisi->kepada = $request->kepada;
               $disposisi->save();



        return response()->json(['success'=>'Disposisi berhasil disimpan']);
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
        $suratkeluar = SuratKeluar::find($id);
        return response()->json($suratkeluar);
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
        $suratkeluar = SuratKeluar::where('id', $id)->firstOrFail();
        Storage::delete('suratMasuk/'.$suratkeluar->filename);
       SuratKeluar::find($id)->delete();

        return response()->json(['success'=>'Disposisi berhasil dihapus.']);
    }
}
