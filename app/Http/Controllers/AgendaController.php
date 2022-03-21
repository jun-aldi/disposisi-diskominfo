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

    //index for kepala kominfo
    public function indexKepala(Request $request)
    {
        //$this->disposisi =  Disposisi::all();
        // $disposisis = Disposisi::sortable()->paginate(5);
        // return view('livewire.disposisi-crud')->with('disposisis', $disposisis);

        // return view('livewire.disposisi-crud')
        // ->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
        $date_now = date("Y-m-d");
        $hari_sekarang = date('d');
        $week_now = date('w');
        $week_start = date('m-d-Y', strtotime('-'.$hari_sekarang.' days'));
        $week_end = date('m-d-Y', strtotime('+'.(6-$hari_sekarang).' days'));
        $hari_sekarang = date('d');

        $month_now = date('m');
        $filter = $request->query('filter');
        $filter2 = $request->query('filter2');
        $bidang = 1;
        $header_bidang= "Kepala Diskominfo";

        $date_now_filter = $date_now;
        $week_now_filter = $week_now;



        if (!empty($filter)&&empty($filter2)) {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
                // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
                // ->where('agendas.tanggal_agenda', '>=', $date_now2)
                ->where('agendas.tanggal_agenda', 'like','%'. $filter)
                ->where('agendas.bidangs_id', 'like','%'. $bidang)
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($filter));
            $haeder2 =0;
            $hari2=0;
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
        }
        elseif (!empty($filter)&&!empty($filter2)) {
            $agendas = Agenda::sortable(['tanggal_agenda' => 'asc'])
                // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
                // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
                ->where('agendas.tanggal_agenda', '>=', $filter)
                ->where('agendas.tanggal_agenda', '<=', $filter2)
                ->where('agendas.bidangs_id', 'like','%'. $bidang)
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($filter));
            $haeder2 = date("d-m-Y", strtotime($filter2));
            $day1 = date('D', strtotime($filter));
            $day2 = date('D', strtotime($filter2));
            $dayList = array(
                'Sun' => 'Minggu',
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu'
            );
            $hari = $dayList[$day1];
            $hari2 = $dayList[$day2];
        }
        elseif(!empty('date_now_filter')){
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
            // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
            // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
            // ->where('agendas.tanggal_agenda', '>=', $date_now2)
            ->where('agendas.tanggal_agenda', 'like','%'. $date_now)
            ->where('agendas.bidangs_id', 'like','%'. $bidang)
            ->paginate(10);
        $haeder = date("d-m-Y", strtotime($date_now));
        $haeder2 =0;
        $day = date('D', strtotime($date_now));
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
        $hari2=0;
        }
        else {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                ->where('agendas.tanggal_agenda', 'like', '%'.date('Y-m-d').'%')
                ->where('agendas.bidangs_id', 'like','%'. $bidang)
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($date_now));
            $haeder2 =0;
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
            $hari2=0;

        }


        return view('agendas')
        ->with('agendas', $agendas)
        ->with('filter', $filter)
        ->with('week_now_filter', $week_now_filter)
        ->with('date_now_filter', $date_now_filter)
        ->with('filter2', $filter2)
        ->with('bidang', $bidang)
        ->with('header', $haeder)
        ->with('header2', $haeder2)
        ->with('hari', $hari)
        ->with('header_bidang', $header_bidang)
        ->with('hari2', $hari2);
    }

    //index for sekretariat
    public function indexSekretariat(Request $request)
    {
        //$this->disposisi =  Disposisi::all();
        // $disposisis = Disposisi::sortable()->paginate(5);
        // return view('livewire.disposisi-crud')->with('disposisis', $disposisis);

        // return view('livewire.disposisi-crud')
        // ->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
        $date_now = date("Y-m-d");
        $hari_sekarang = date('d');
        $week_now = date('w');
        $week_start = date('m-d-Y', strtotime('-'.$hari_sekarang.' days'));
        $week_end = date('m-d-Y', strtotime('+'.(6-$hari_sekarang).' days'));
        $hari_sekarang = date('d');

        $month_now = date('m');
        $filter = $request->query('filter');
        $filter2 = $request->query('filter2');
        $bidang = 2;
        $header_bidang= "Sekretariat Diskominfo";

        $date_now_filter = $date_now;
        $week_now_filter = $week_now;


        if (!empty($filter)&&empty($filter2)) {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
                // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
                // ->where('agendas.tanggal_agenda', '>=', $date_now2)
                ->where('agendas.tanggal_agenda', 'like','%'. $filter)
                ->where('agendas.bidangs_id', 'like', '%'.$bidang.'%')
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($filter));
            $haeder2 =0;
            $hari2=0;
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
        }
        elseif (!empty($filter)&&!empty($filter2)) {
            $agendas = Agenda::sortable(['tanggal_agenda' => 'desc'])
                // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
                // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
                ->where('agendas.tanggal_agenda', '>=', $filter)
                ->where('agendas.tanggal_agenda', '<=', $filter2)
                ->where('agendas.bidangs_id', 'like', '%'.$bidang.'%')
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($filter));
            $haeder2 = date("d-m-Y", strtotime($filter2));
            $day1 = date('D', strtotime($filter));
            $day2 = date('D', strtotime($filter2));
            $dayList = array(
                'Sun' => 'Minggu',
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu'
            );
            $hari = $dayList[$day1];
            $hari2 = $dayList[$day2];
        }
        elseif(!empty('date_now_filter')){
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
            // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
            // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
            // ->where('agendas.tanggal_agenda', '>=', $date_now2)
            ->where('agendas.tanggal_agenda', 'like','%'. $date_now)
            ->where('agendas.bidangs_id', 'like', '%'.$bidang.'%')
            ->paginate(10);
        $haeder = date("d-m-Y", strtotime($date_now));
        $haeder2 =0;
        $day = date('D', strtotime($date_now));
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
        $hari2=0;
        }
        else {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                ->where('agendas.tanggal_agenda', 'like', '%'.date('Y-m-d').'%')
                ->where('agendas.bidangs_id', 'like', '%'.$bidang.'%')
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($date_now));
            $haeder2 =0;
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
            $hari2=0;

        }


        return view('agendas')
        ->with('agendas', $agendas)
        ->with('filter', $filter)
        ->with('week_now_filter', $week_now_filter)
        ->with('date_now_filter', $date_now_filter)
        ->with('filter2', $filter2)
        ->with('bidang', $bidang)
        ->with('header', $haeder)
        ->with('header2', $haeder2)
        ->with('hari', $hari)
        ->with('header_bidang', $header_bidang)
        ->with('hari2', $hari2);
    }

        //index for tki
    public function indexTki(Request $request)
    {
        //$this->disposisi =  Disposisi::all();
        // $disposisis = Disposisi::sortable()->paginate(5);
        // return view('livewire.disposisi-crud')->with('disposisis', $disposisis);

        // return view('livewire.disposisi-crud')
        // ->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
        $date_now = date("Y-m-d");
        $hari_sekarang = date('d');
        $week_now = date('w');
        $week_start = date('m-d-Y', strtotime('-'.$hari_sekarang.' days'));
        $week_end = date('m-d-Y', strtotime('+'.(6-$hari_sekarang).' days'));
        $hari_sekarang = date('d');

        $month_now = date('m');
        $filter = $request->query('filter');
        $filter2 = $request->query('filter2');
        $bidang = 3;
        $header_bidang= "Bidang Tata Kelola Informatika ";

        $date_now_filter = $date_now;
        $week_now_filter = $week_now;


        if (!empty($filter)&&empty($filter2)) {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
                // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
                // ->where('agendas.tanggal_agenda', '>=', $date_now2)
                ->where('agendas.tanggal_agenda', 'like','%'. $filter)
                ->where('agendas.bidangs_id', 'like','%'. $bidang)
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($filter));
            $haeder2 =0;
            $hari2=0;
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
        }
        elseif (!empty($filter)&&!empty($filter2)) {
            $agendas = Agenda::sortable(['tanggal_agenda' => 'desc'])
                // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
                // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
                ->where('agendas.tanggal_agenda', '>=', $filter)
                ->where('agendas.tanggal_agenda', '<=', $filter2)
                ->where('agendas.bidangs_id', 'like','%'. $bidang)
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($filter));
            $haeder2 = date("d-m-Y", strtotime($filter2));
            $day1 = date('D', strtotime($filter));
            $day2 = date('D', strtotime($filter2));
            $dayList = array(
                'Sun' => 'Minggu',
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu'
            );
            $hari = $dayList[$day1];
            $hari2 = $dayList[$day2];
        }
        elseif(!empty('date_now_filter')){
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
            // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
            // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
            // ->where('agendas.tanggal_agenda', '>=', $date_now2)
            ->where('agendas.tanggal_agenda', 'like','%'. $date_now)
            ->where('agendas.bidangs_id', 'like','%'. $bidang)
            ->paginate(10);
        $haeder = date("d-m-Y", strtotime($date_now));
        $haeder2 =0;
        $day = date('D', strtotime($date_now));
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
        $hari2=0;
        }
        else {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                ->where('agendas.tanggal_agenda', 'like', '%'.date('Y-m-d').'%')
                ->where('agendas.bidangs_id', 'like','%'. $bidang)
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($date_now));
            $haeder2 =0;
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
            $hari2=0;

        }


        return view('agendas')
        ->with('agendas', $agendas)
        ->with('filter', $filter)
        ->with('week_now_filter', $week_now_filter)
        ->with('date_now_filter', $date_now_filter)
        ->with('filter2', $filter2)
        ->with('bidang', $bidang)
        ->with('header', $haeder)
        ->with('header2', $haeder2)
        ->with('hari', $hari)
        ->with('header_bidang', $header_bidang)
        ->with('hari2', $hari2);
    }

    public function indexIkp(Request $request)
    {
        //$this->disposisi =  Disposisi::all();
        // $disposisis = Disposisi::sortable()->paginate(5);
        // return view('livewire.disposisi-crud')->with('disposisis', $disposisis);

        // return view('livewire.disposisi-crud')
        // ->layout('layouts.app', ['header' => 'Lembar Disposisi Diskominfo Karanganyar']);
        $date_now = date("Y-m-d");
        $hari_sekarang = date('d');
        $week_now = date('w');
        $week_start = date('m-d-Y', strtotime('-'.$hari_sekarang.' days'));
        $week_end = date('m-d-Y', strtotime('+'.(6-$hari_sekarang).' days'));
        $hari_sekarang = date('d');

        $month_now = date('m');
        $filter = $request->query('filter');
        $filter2 = $request->query('filter2');
        $bidang = 4;
        $header_bidang= "Bidang Informasi dan Komunikasi Publik";

        $date_now_filter = $date_now;
        $week_now_filter = $week_now;


        if (!empty($filter)&&empty($filter2)) {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
                // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
                // ->where('agendas.tanggal_agenda', '>=', $date_now2)
                ->where('agendas.tanggal_agenda', 'like','%'. $filter)
                ->where('agendas.bidangs_id', 'like','%'. $bidang)
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($filter));
            $haeder2 =0;
            $hari2=0;
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
        }
        elseif (!empty($filter)&&!empty($filter2)) {
            $agendas = Agenda::sortable(['tanggal_agenda' => 'desc'])
                // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
                // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
                ->where('agendas.tanggal_agenda', '>=', $filter)
                ->where('agendas.tanggal_agenda', '<=', $filter2)
                ->where('agendas.bidangs_id', 'like','%'. $bidang)
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($filter));
            $haeder2 = date("d-m-Y", strtotime($filter2));
            $day1 = date('D', strtotime($filter));
            $day2 = date('D', strtotime($filter2));
            $dayList = array(
                'Sun' => 'Minggu',
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu'
            );
            $hari = $dayList[$day1];
            $hari2 = $dayList[$day2];
        }
        elseif(!empty('date_now_filter')){
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
            // ->where('agendas.tanggal_agenda', 'like', '%'.$filter.'%')
            // ->whereBetween('agendas.tanggal_agenda', [$filter, $date_now2])
            // ->where('agendas.tanggal_agenda', '>=', $date_now2)
            ->where('agendas.tanggal_agenda', 'like','%'. $date_now)
            ->where('agendas.bidangs_id', 'like','%'. $bidang)
            ->paginate(10);
        $haeder = date("d-m-Y", strtotime($date_now));
        $haeder2 =0;
        $day = date('D', strtotime($date_now));
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
        $hari2=0;
        }
        else {
            $agendas = Agenda::sortable(['jam_agenda' => 'asc'])
                ->where('agendas.tanggal_agenda', 'like', '%'.date('Y-m-d').'%')
                ->where('agendas.bidangs_id', 'like','%'. $bidang)
                ->paginate(10);
            $haeder = date("d-m-Y", strtotime($date_now));
            $haeder2 =0;
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
            $hari2=0;

        }

        //return view with filter
        return view('agendas')
        ->with('agendas', $agendas)
        ->with('filter', $filter)
        ->with('week_now_filter', $week_now_filter)
        ->with('date_now_filter', $date_now_filter)
        ->with('filter2', $filter2)
        ->with('bidang', $bidang)
        ->with('header_bidang', $header_bidang)
        ->with('header', $haeder)
        ->with('header2', $haeder2)
        ->with('hari', $hari)
        ->with('hari2', $hari2);
    }



}
