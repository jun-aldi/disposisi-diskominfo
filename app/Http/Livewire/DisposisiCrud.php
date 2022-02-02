<?php

namespace App\Http\Livewire;

use App\Models\Disposisi;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;


class DisposisiCrud extends Component
{
    public $disposisi_edit_id, $dari, $tanggal_dibuat, $no_surat, $isi_surat, $no_agenda, $tanggal_diterima, $kepada, $status_id, $status_disposisi;
    public $isModalOpen = 0;
    public $isModalOpenEdit = 0;
    //public $users_id = Auth::id();
    public function render()
    {
        $this->disposisi =  Disposisi::all();
        return view('livewire.disposisi-crud')
        ->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }
    public function openModalEdit()
    {
        $this->isModalOpenEdit = true;
    }

    public function closeModalEdit()
    {
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
        $this->openModalEdit();


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
    }

    public function delete($id)
    {
        Disposisi::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
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
        return response()->streamDownload(
        fn () => print($pdfContent),
        "$filename"
        );
    }
}
