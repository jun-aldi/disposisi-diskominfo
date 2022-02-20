<?php

namespace App\Http\Livewire;

use App\Models\Disposisi;
use Livewire\Component;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Livewire\WithFileUploads;


class EditDisposisi extends Component
{
    use WithFileUploads;
    public $disposisi_edit_id, $dari, $tanggal_dibuat, $no_surat, $isi_surat, $no_agenda, $tanggal_diterima, $kepada, $status_id, $status_disposisi, $filename;
    public function render($id)
    {
        return view('livewire.edit');
        $this->edit($id);
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
}

