<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DashboardDisposisi extends Controller
{
    public function index(){
        return view('dashboard-disposisi');
    }

    public function list(){
        $disposisis = Disposisi::select(['id','dari', 'tanggal_dibuat','no_surat','isi_surat','no_agenda','tanggal_diterima','kepada','status_id','users_id']);
        return DataTables::of($disposisis)
        ->editColumn('status_id',function($data_disposisi){
            if($data_disposisi->status_id == 1){
                return '<button class="btn btn-success btn-xs">Diterima</button>';
            }elseif($data_disposisi->status_id == 2){
                return '<button class="btn btn-danger btn-xs">Ditolak</button>';
            }
            else{
                return '<button class="btn btn-primary btn-xs">Diproses</button>';
            }
        })->addColumn('action',function($data){

            $url_lihat_file = route('downloadfile', $data->id);
            return view('formdatatable')->with('url_lihat_file', $url_lihat_file)->render();
        })->addColumn('lihatpdf',function($data){

            $url_download_file = route('lihatpdf', $data->id);
            return view('formdatatable-download-disposisi')->with('url_download_file', $url_download_file)->render();
        })
        ->addColumn('edit', function($data){
            $btn =' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="far fa-trash-alt text-white" data-feather="delete">Delete</i></a>';
            return $btn;
        })
        ->rawColumns(['status_id','action','lihatpdf', 'edit'])->make(true);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Disposisi::updateOrCreate($input);

        return response()->json(['success'=>'Product saved successfully.']);
    }

    public function destroy($id)
    {
        Disposisi::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }



}
