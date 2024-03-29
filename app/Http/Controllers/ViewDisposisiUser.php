<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Disposisi;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Files\Disk;
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
            ->where('disposisis.tanggal_dibuat', 'like', '%'.$filter.'%')
            ->where('disposisis.users_id', 'like', '%'.$users.'%')
            ->paginate(0);
        }else {
            $disposisis = Disposisi::sortable(['id' => 'desc'])
            ->where('disposisis.users_id', 'like', '%'.$users.'%')
            ->paginate(0);

        }



        return view('view-disposisi-user')->with('disposisis', $disposisis)->with('users', $users)->with('filter', $filter);
    }


    public function lihatPDF($id)
    {
        $agendas = Agenda::where('disposisis_id', $id)->first();


        $data = [
            $disposisi = Disposisi::findOrFail($id),
            "id" => $this->id=$disposisi->id,
            "dari" => $this->dari = $disposisi->dari,
            "tanggal_dibuat" => $this->tanggal_dibuat = $disposisi->tanggal_dibuat,
            "no_agenda" => $this->no_agenda = $disposisi->no_agenda,
            "no_surat" => $this->no_surat = $disposisi->no_surat,
            "sifat" => $this->sifat = $disposisi->sifat,
            "isi_surat" => $this->isi_surat = $disposisi->isi_surat,
            "tanggal_diterima" => $this->tanggal_diterima = $disposisi->tanggal_diterima,
            "bidangs_id" => $this->bidangs_id = $disposisi->bidangs_id,
            "status_id" => $this->status_id = $disposisi->status_id,
            "users_id" => $this->users_id = $disposisi->users_id,
            "disposisi_kepala" => $this->disposisi_kepala = $disposisi->disposisi_kepala,
            "disposisi_sekretaris" => $this->disposisi_sekretaris = $disposisi->disposisi_sekretaris,


        ];


            // $disposisis_id=$id;

            // $no_agenda = $agenda->$id;



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
