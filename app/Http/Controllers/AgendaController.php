<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Disposisi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AgendaController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->disposisi =  Disposisi::all();
        // $disposisis = Disposisi::sortable()->paginate(5);
        // return view('livewire.disposisi-crud')->with('disposisis', $disposisis);

        // return view('livewire.disposisi-crud')
        // ->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
        $filter = $request->query('filter');
        $date_now = date('Y-m-d');

        if (!empty($filter)) {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($filter));
            $day = date('D', strtotime($filter));
            $dayList = array(
                'Sun' => 'Minggu',
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu'
            );
            $hari = $dayList[$day];
        }else {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                ->where('agendas.tanggal_agenda', 'like', '%'.$date_now.'%')
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($date_now));
            $day = date('D');
            $dayList = array(
                'Sun' => 'Minggu',
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu'
            );
            $hari = $dayList[$day];

        }

        return view('agendas')->with('agendas', $agendas)->with('filter', $filter)->with('header', $haeder)->with('hari', $hari);
    }
}
