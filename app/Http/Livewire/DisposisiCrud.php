<?php

namespace App\Http\Livewire;

use App\Models\Disposisi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Http\Request;
use Datatables;


class DisposisiCrud extends Component
{
    public $disposisi_edit_id, $dari, $tanggal_dibuat, $no_surat, $isi_surat, $no_agenda, $tanggal_diterima, $kepada, $status_id, $status_disposisi;
    public $isModalOpen = 1;
    public $isModalOpenEdit = 1;
    //public $users_id = Auth::id();
    public function render(Request $request, Request $request2)
    {
        //$this->disposisi =  Disposisi::all();
        // $disposisis = Disposisi::sortable()->paginate(5);
        // return view('livewire.disposisi-crud')->with('disposisis', $disposisis);

        // return view('livewire.disposisi-crud')
        // ->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
        $filter = $request->query('filter');
        $filter2 = $request2->query('filter2');

        if (!empty($filter)&&empty($filter2)) {
            $disposisis = Disposisi::sortable()
            ->where('Disposisi.tanggal_dibuat', 'like', '%'.$filter.'%')
            ->paginate(10);
        }
        else if (!empty($filter2)&&empty($filter)) {
            $disposisis = Disposisi::sortable()
            ->where('Disposisi.dari', 'like', '%'.$filter2.'%')
            ->paginate(10);
        }
        else if (!empty($filter)&&!empty($filter2)) {
            $disposisis = Disposisi::sortable()
                ->where('Disposisi.dari', 'like', '%'.$filter2.'%')
                ->where('Disposisi.tanggal_dibuat', 'like', '%'.$filter.'%')
                ->paginate(10);
        }else {
            $disposisis = Disposisi::sortable(['tanggal_dibuat' => 'desc', 'id' => 'desc'])
                ->paginate(10);
        }

        return view('livewire.disposisi-crud')->with('disposisis', $disposisis)->with('filter', $filter)->with('filter2', $filter2)->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }


    public function openModal()
    {
        //return redirect(request()->header('Referer'));
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        return redirect(request()->header('Referer'));
        $this->isModalOpen = false;
    }
    public function openModalEdit()
    {
        //return redirect(request()->header('Referer'));
        $this->isModalOpenEdit = true;

    }

    public function closeModalEdit()
    {
        return redirect(request()->header('Referer'));
        $this->isModalOpenEdit = false;
    }

    private function resetCreateForm(){
        $this->dari = '';
        $this->tanggal_dibuat = '';
        $this->no_surat = '';
        $this->isi_surat = '';
        $this->no_agenda = '';
        $this->tanggal_diterima = '';
        $this->kepada = '';
        $this->status_id = '';
        $this->users_id = '';
    }

    public function store()
    {
        $this->validate([
            'dari'=>'required',
            'tanggal_dibuat'=>'required',
            'no_surat'=>'required',
            'isi_surat'=>'required',
            'no_agenda'=>'required',
            'tanggal_diterima'=>'required',
            'kepada'=>'required',
            'status_id'=>'required',
            //'users_id'=>'required',
        ]);



        Disposisi::updateOrCreate(['id' => $this->id], [
            'dari' => $this->dari,
            'tanggal_dibuat' => $this->tanggal_dibuat,
            'no_surat' => $this->no_surat,
            'isi_surat' => $this->isi_surat,
            'no_agenda' => $this->no_agenda,
            'tanggal_diterima' => $this->tanggal_diterima,
            'kepada' => $this->kepada,
            'status_id' => $this->status_id,
            'users_id' => auth()->id(),
        ]);

        session()->flash('message', $this->id ? 'Data updated successfully.' : 'Data added successfully.');

        $this->closeModal();
        $this->resetCreateForm();

    }

    public function edit($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $this->disposisi_id = $id;
        $this->dari = $disposisi->dari;
        $this->tanggal_dibuat = $disposisi->tanggal_dibuat;
        $this->no_surat = $disposisi->no_surat;
        $this->isi_surat = $disposisi->isi_surat;
        $this->no_agenda = $disposisi->no_agenda;
        $this->tanggal_diterima = $disposisi->tanggal_diterima;
        $this->kepada = $disposisi->kepada;
        $this->status_id = $disposisi->status_id;
        $this->users_id = $disposisi->users_id;


    }

    public function editEvent()
    {

                $this->validate([
                    'dari'=>'required',
                    'tanggal_dibuat'=>'required',
                    'no_surat'=>'required',
                    'isi_surat'=>'required',
                    'no_agenda'=>'required',
                    'tanggal_diterima'=>'required',
                    'kepada'=>'required',
                    'status_id'=>'required',
                    //'users_id'=>'required',
                ]);

                $disposisi = Disposisi::where('id', $this->disposisi_id)->first();
                $disposisi->dari = $this->dari;
                $disposisi->tanggal_dibuat = $this->tanggal_dibuat;
                $disposisi->no_surat = $this->no_surat;
                $disposisi->isi_surat = $this->isi_surat;
                $disposisi->no_agenda = $this->no_agenda;
                $disposisi->tanggal_diterima = $this->tanggal_diterima;
                $disposisi->kepada = $this->kepada;
                $disposisi->status_id = $this->status_id;
                //$disposisi->users_id = $this->users_id;

                $disposisi->save();

                session()->flash('message', 'Data has been updated successfully');
                $this->closeModal();
    }

    public function delete($id)
    {
        Disposisi::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
        redirect(request()->header('Referer'));
    }
    public function generatePDF($id)
    {
        $data = [
            $disposisi = Disposisi::findOrFail($id),
            "id" => $this->disposisi_id = $id,
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

        $pdfContent = PDF::loadView('livewire.viewpdf',$data)->output();
        redirect(request()->header('Referer'));
        return response()->streamDownload(
        fn () => print($pdfContent),
        "$filename"
        );
        return redirect(request()->header('Referer'));

    }
}




