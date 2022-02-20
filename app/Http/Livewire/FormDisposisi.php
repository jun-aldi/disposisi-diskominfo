<?php

namespace App\Http\Livewire;

use App\Models\Disposisi;
use Livewire\Component;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Livewire\WithFileUploads;


class FormDisposisi extends Component
{
    use WithFileUploads;
    public $disposisi_edit_id, $dari, $tanggal_dibuat, $no_surat, $isi_surat, $no_agenda, $tanggal_diterima, $kepada, $status_id, $status_disposisi, $filename;
    public $isModalOpen = 1;
    public function render()
    {
        return view('livewire.create');
    }

    public function store(Request $request)
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
            'filename' => 'required|mimes:pdf|max:2048',
            //'users_id'=>'required',
        ]);
        $name = md5($this->filename . microtime()).'.'.$this->filename->extension();

        $this->filename->storeAs('disposisi', $name);

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
            'filename' => $name,
        ]);

        session()->flash('message', $this->id ? 'Data updated successfully.' : 'Data added successfully.');
        return redirect('disposisi');
}
}
