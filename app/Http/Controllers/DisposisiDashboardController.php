<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class DisposisiDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Disposisi::select(['id','dari','surats_id', 'tanggal_dibuat','no_surat','isi_surat','tanggal_diterima','bidangs_id','status_id','users_id'])
            ->with(['users'])->with(['bidang'])->with(['surat']);

            // if(!empty($request->from_date))
            // {
            //  $data = DB::table('tbl_order')
            //    ->whereBetween('order_date', array($request->from_date, $request->to_date))
            //    ->get();
            // }
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('status_id',function($data_disposisi){
                if($data_disposisi->status_id == 1){
                    return '<button class="btn btn-success btn-xs">Diterima</button>';
                }elseif($data_disposisi->status_id == 2){
                    return '<button class="btn btn-danger btn-xs">Ditolak</button>';
                }
                else{
                    return '<button class="btn btn-primary btn-xs">Diproses</button>';
                }
            })
            ->addColumn('action',function($data){

                $url_lihat_file = route('downloadfile', $data->id);
                return view('formdatatable')->with('url_lihat_file', $url_lihat_file)->render();
            })->addColumn('lihatpdf',function($data){

                $url_download_file = route('lihatpdf', $data->id);
                return view('formdatatable-download-disposisi')->with('url_download_file', $url_download_file)->render();
            })
            ->addColumn('delete', function($data){
                $btn =' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDisposisi">Delete</a>';
                return $btn;
            })
            ->addColumn('edit', function($data){
                $btn ='<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editDisposisi">Edit</a>';
                return $btn;
            })
            ->addColumn('createAgenda',function($data){
                $btn ='<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Create" class="btn btn-primary btn-sm createNewAgenda">Buat Agenda</a>';
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
            ->rawColumns(['status_id','action','lihatpdf', 'delete','edit', 'createAgenda'])->make(true);
        }
        return view('dashboard-disposisi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
            'tanggal_diterima'=>'required',

        ]);

                $disposisi = Disposisi::where('id', $request->id)->first();
                $disposisi->dari = $request->dari;
                $disposisi->tanggal_dibuat = $request->tanggal_dibuat;
                $disposisi->no_surat = $request->no_surat;
                $disposisi->isi_surat = $request->isi_surat;
                $disposisi->tanggal_diterima = $request->tanggal_diterima;
                $disposisi->surats_id = $request->surats_id;
                $disposisi->bidangs_id = $request->bidangs_id;
                $disposisi->status_id = $request->status_id;

                $getSurat = $request->surats_id;

                $disposisi->save();


                $getID = $disposisi->id;

                $getNoSurat= $getID.'/'.$getSurat.'/'.date('Y');

                $disposisi = Disposisi::where('id', $getID)->first();

                $disposisi->no_surat = $getNoSurat;


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
        $disposisi = Disposisi::find($id);
        return response()->json($disposisi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disposisi = Disposisi::where('id', $id)->firstOrFail();
        Storage::delete('disposisi/'.$disposisi->filename);
       Disposisi::find($id)->delete();

        return response()->json(['success'=>'Disposisi berhasil dihapus.']);
    }
}
