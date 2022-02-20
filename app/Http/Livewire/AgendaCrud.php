<?php


namespace App\Http\Livewire;

use App\Models\Agenda;
use App\Models\Disposisi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Http\Request;
use Datatables;


class AgendaCrud extends Component
{
    public $disposisi_id, $jam_agenda, $tanggal_agenda, $isi, $tempat, $keterangan;
    public $isModalOpen = 1;
    public $isModalOpenEdit = 1;
    //public $users_id = Auth::id();
    public function render(Request $request)
    {
        //$this->disposisi =  Disposisi::all();
        // $disposisis = Disposisi::sortable()->paginate(5);
        // return view('livewire.disposisi-crud')->with('disposisis', $disposisis);

        // return view('livewire.disposisi-crud')
        // ->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $agendas = Agenda::sortable()
            ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
            ->paginate(20);
        }else {
            $agendas = Agenda::sortable(['tanggal_agenda' => 'desc', 'id' => 'desc'])
                ->paginate(20);
        }

        return view('livewire.agenda-crud')->with('agendas', $agendas)->with('filter', $filter)->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
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
        return redirect(request()->header('Referer'));
        $this->isModalOpenEdit = true;

    }

    public function closeModalEdit()
    {
        return redirect(request()->header('Referer'));
        $this->isModalOpenEdit = false;
    }

    private function resetCreateForm(){
        $this->disposisi_id = '';
        $this->jam_agenda = '';
        $this->tanggal_agenda = '';
        $this->isi = '';
        $this->tempat= '';
        $this->keterangan = '';
    }

    public function store(Request $req)
    {
        $this->validate([
            'disposisi_id'=>'required',
            'jam_agenda'=>'required',
            'tanggal_agenda'=>'required',
            'isi'=>'required',
            'tempat'=>'required',
            'keterangan'=>'required',
        ]);



        Agenda::updateOrCreate(['id' => $this->id], [
            'disposisi_id' => $this->disposisi_id,
            'jam_agenda' => $this->jam_agenda,
            'tanggal_agenda' => $this->tanggal_agenda,
            'isi' => $this->isi,
            'tempat' => $this->tempat,
            'keterangan' => $this->keterangan,

        ]);
        $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            ]);
            $fileModel = new Disposisi();
            if($req->file()) {
                $fileName = time().'_'.$req->file->getClientOriginalName();
                $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
                $fileModel->name = time().'_'.$req->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();
                return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
            }
        session()->flash('message', $this->id ? 'Data updated successfully.' : 'Data added successfully.');

        $this->closeModal();
        $this->resetCreateForm();

    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $this->agenda_id = $id;
        $this->disposisi_id = $agenda->disposisi_id;
        $this->jam_agenda = $agenda->jam_agenda;
        $this->tanggal_agenda= $agenda->tanggal_agenda;
        $this->isi = $agenda->isi;
        $this->tempat = $agenda->tempat;
        $this->keterangan = $agenda->keterangan;
    }

    public function editEvent()
    {

        $this->validate([
            'disposisi_id'=>'required',
            'jam_agenda'=>'required',
            'tanggal_agenda'=>'required',
            'isi'=>'required',
            'tempat'=>'required',
            'keterangan'=>'required',
        ]);

                $agenda = Agenda::where('id', $this->agenda_id)->first();
                $agenda->disposisi_id = $this->disposisi_id;
                $agenda->jam_agenda = $this->jam_agenda;
                $agenda->tanggal_agenda = $this->tanggal_agenda;
                $agenda->isi = $this->isi;
                $agenda->tempat = $this->tempat;
                $agenda->keterangan = $this->keterangan;


                $agenda->save();

                session()->flash('message', 'Data has been updated successfully');
                $this->closeModal();
    }

    public function delete($id)
    {
        Agenda::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
        redirect(request()->header('Referer'));
    }
}






