<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
</head>
<body>

@include('navbar-top')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 p-0">
            <div class="jumbotron min-vh-100 m-0 d-flex flex-column justify-content-center">
                <div class="row d-flex justify-content-center my-auto" >
                    <div class="Container-fluid my-4">
                        <div class="mx-auto">
                            <div class="bg-white overflow-hidden shadow-xl px-4 py-4">
                                @if (session()->has('message'))
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                                    role="alert">
                                    <div class="flex">
                                        <div>
                                            <p class="text-sm">{{ session('message') }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="container" data-aos="fade-up" data-aos-duration="800">
                                    <div class="row">
                                        <div class="col-12 text-center mx-auto my-4">
                                            @if (!empty($filter)&&!empty($filter2))
                                            <h1 style="color: #173D7A" class="fw-bolder">AGENDA TANGGAL : {{$hari}} {{$header}}  - {{$hari2}} {{$header2}} </h1>
                                            @else
                                            <h1 style="color: #173D7A" class="fw-bolder">AGENDA TANGGAL : {{$hari}} {{$header}}  </h1>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                <div class="table py-auto px-auto mx-auto my-auto mt-4"  data-aos="fade-up" data-aos-duration="1000">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 my-1">
                                                <form class="form-inline" method="GET">
                                                    <div class="form-group mx-2">
                                                      <label for="filter" class="form-label">Dari Tanggal / Pilih Hari :</label>
                                                      <input type="date" class="form-control" id="filter" name="filter" placeholder="Tanggal" value="{{$filter}}">
                                                    </div>
                                                    <div class="form-group mx-2">
                                                        <label for="filter" class="form-label">Sampai Tanggal :</label>
                                                        <input type="date" class="form-control" id="filter2" name="filter2" placeholder="Tanggal" value="{{$filter2}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-default mb-2 fw-bolder">Filter</button>
                                                </form>
                                            </div>
                                            <div class="col-12">
                                                <div class="row row-cols-auto">
                                                    <div class="col-xl-1 my-2">
                                                        <form method="get">
                                                            <button class="btn btn-mulai" name="date_now_filter" id="date_now_filter" type="submit" value="{{$date_now_filter}}">Hari ini</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-xl-2 my-2">
                                                        @if(Auth::check() && Auth::user()->roles == "ADMIN")
                                                        <a class="btn btn-primary" href="javascript:void(0)" id="createNewAgenda">Buat Baru</a>
                                                        @endif
                                                    </div>
                                                  </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div id="tableAgenda" class="table-responsive">
                                            <table class="table table-bordered" >
                                                <thead class="thead">
                                                    <tr class="bg-gray-100">
                                                        {{-- <th width="80px">@sortablelink('id')</th> --}}
                                                        <th class="px-4 py-2">Hari / Tanggal</th>
                                                        <th class="px-4 py-2">Jam Agenda</th>

                                                        <th class="px-4 py-2">Isi</th>
                                                        <th class="px-4 py-2">Tempat</th>
                                                        <th class="px-4 py-2">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($agendas->count())
                                                    @foreach($agendas as $agenda)
                                                    <tr>
                                                        @php
                                                                $hari_hari = $agenda->tanggal_agenda;
                                                                $day =  date('D', strtotime($hari_hari));
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

                                                        @endphp
                                                        <td class="border px-4 py-2">{{$hari}} / {{$agenda->tanggal_agenda}}</td>
                                                        {{-- <td class="border px-4 py-2">{{ $agenda->id }}</td> --}}
                                                        {{-- <td class="border px-4 py-2">{{ $agenda->disposisi_id }}</td> --}}
                                                        <td class="border px-4 py-2">{{ $agenda->jam_agenda }}</td>

                                                        <td class="border px-4 py-2">{{ $agenda->isi }}</td>
                                                        <td class="border px-4 py-2">{{ $agenda->tempat }}</td>
                                                        <td class="border px-4 py-2">{{ $agenda->keterangan }}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="mt-3">
                                        {!! $agendas->appends(Request::except('page'))->render() !!}
                                        <div class="mt-3">
                                            <p class="display-footer-count mt-3">
                                                Displaying {{$agendas->count()}} of {{ $agendas->total() }} Agenda.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Create New --}}
                    <div class="modal fade" id="ajaxCreate" aria-hidden="true" >
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('store-disposisi-user2')}}" id="agendaCreateForm" name="agendaCreateForm" class="form-horizontal" enctype="multipart/form-data" method="post" >
                                        @csrf
                                        {{-- <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Disposisi id</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="disposisi_id" name="disposisi_id" placeholder="Masukan ID Disposisi" value="" maxlength="50" required="">
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="jam_agenda" class="col-sm-2 control-label">Jam Agenda</label>
                                            <div class="col-sm-12">
                                                <input type="time" class="form-control" id="jam_agenda" name="jam_agenda" placeholder="Jam Agenda" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_agenda" class="col-sm-2 control-label">Tanggal Agenda</label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control" id="tanggal_agenda" name="tanggal_agenda" placeholder="Tanggal Agenda" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="isi" class="col-sm-2 control-label">Isi</label>
                                            <div class="col-sm-12">
                                                <textarea name="isi" id="isi" placeholder="Isi Agenda" class="col-sm-12"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Tempat</label>
                                            <div class="col-sm-12">
                                                <input type="dtext" class="form-control" id="tempat" name="tempat" placeholder="Tempat Agenda" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Agenda" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-10"><p id="saveError"></p></div>
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary" id="saveBtnCreate" value="create">Simpan</button>
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')
</body>

<script>

        $('#createNewAgenda').click(function () {
            $('#saveBtnCreate').val("create-agenda");
            $('#id').val('');
            $('#agendaCreateForm').trigger("reset");
            $('#modelHeading').html("Buat Disposisi");
            $('#ajaxCreate').modal('show');
        });


        $('#saveBtnCreate').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#agendaCreateForm').serialize(),
                url: "{{ route('agenda-dashboard.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#agendaCreateForm').trigger("reset");
                    $('#ajaxCreate').modal('hide');
                    $("#tableAgenda").load(" #tableAgenda > *");
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveError').html('Error', error);
                    $('#saveBtnCreate').html('Save Changes');
                }
            });
        });
</script>


@include('script-foot')
</html>
