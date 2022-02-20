<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use DataTables;
use PDF;

class ViewDisposisiUser extends Controller
{
    public function index(Request $request)
    {
        // $filter = auth()->id();
        // $disposisis = Disposisi::all()->where('Disposisi.users_id', 'like', '%'.$filter.'%')->sortByDesc('id');

        // return view('view-disposisi-user')->with('disposisis', $disposisis);

        // $filter = $request->query('filter');
        $filter = $request->query('filter');
        $users = auth()->id();


        if (!empty($filter)) {
            $disposisis = Disposisi::sortable(['id' => 'desc'])
            ->where('disposisi.tanggal_dibuat', 'like', '%'.$filter.'%')
            ->where('disposisi.users_id', 'like', '%'.$users.'%')
            ->paginate(0);
        }else {
            $disposisis = Disposisi::sortable(['id' => 'desc'])
            ->where('disposisi.users_id', 'like', '%'.$users.'%')
            ->paginate(0);

        }



        return view('view-disposisi-user')->with('disposisis', $disposisis)->with('users', $users)->with('filter', $filter);
    }


    public function lihatPDF($id)
    {
        $data = [
            $disposisi = Disposisi::findOrFail($id),
            "id" => $this->id=$disposisi->id,
            "dari" => $this->dari = $disposisi->dari,
            "tanggal_dibuat" => $this->tanggal_dibuat = $disposisi->tanggal_dibuat,
            "no_surat" => $this->no_surat = $disposisi->no_surat,
            "isi_surat" => $this->isi_surat = $disposisi->isi_surat,
            "no_agenda" => $this->no_agenda = $disposisi->no_agenda,
            "tanggal_diterima" => $this->tanggal_diterima = $disposisi->tanggal_diterima,
            "kepada" => $this->kepada = $disposisi->kepada,
            "status_id" => $this->status_id = $disposisi->status_id,
            "users_id" => $this->users_id = $disposisi->users_id,
        ];

        $filename = $data['id'] ." tanggal " . $data['tanggal_dibuat'] . ".pdf";

        $pdfContent = PDF::loadView('printDisposisi',$data)->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
        "$filename"
        );



    }

    public function download($id){
        $disposisi = Disposisi::where('id', $id)->firstOrFail();
    	$myFile = storage_path('app/disposisi/'.$disposisi->filename);
        $headers = ['Content-Type: application/pdf'];
    	$newName ='disposisi_masuk_'.$disposisi->id.'_'.$disposisi->dari.'_'.$disposisi->tanggal_diterima.'.pdf';


    	return response()->download($myFile, $newName, $headers);

    }



    // public function print(Request $request)
    // {
    //     $data = [
    //         $disposisi = Disposisi::findOrFail($request),
    //         "id" => $this->disposisi_id = $disposisi->id,
    //         "dari" => $this->dari = $disposisi->dari,
    //         "tanggal_dibuat" => $this->tanggal_dibuat = $disposisi->tanggal_dibuat,
    //         "no_surat" => $this->no_surat = $disposisi->no_surat,
    //         "isi_surat" => $this->isi_surat = $disposisi->isi_surat,
    //         "no_agenda" => $this->no_agenda = $disposisi->no_agenda,
    //         "tanggal_diterima" => $this->tanggal_diterima = $disposisi->tanggal_diterima,
    //         "kepada" => $this->kepada = $disposisi->kepada,
    //         "status_id" => $this->status_id = $disposisi->status_id,
    //         "users_id" => $this->users_id = $disposisi->users_id,
    //     ];

    //     $filename = $data['id'] ." tanggal " . $data['tanggal_dibuat'] . ".pdf";

    //     $pdfContent = PDF::loadView('livewire.viewpdf',$data)->output();
    //     return response()->streamDownload(
    //     fn () => print($pdfContent),
    //     "$filename"
    //     );

    // }

}
