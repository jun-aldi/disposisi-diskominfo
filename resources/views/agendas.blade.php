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
                                        <div class="col-12 text-center mx-auto">
                                            <h1 style="color: #173D7A" class="fw-bolder">Agenda Tanggal : {{$hari}} {{$header}}</h1>
                                        </div>
                                        <div class="col-12 mt-3 ">
                                            <form class="form-inline" method="GET">
                                                <div class="form-group ms-auto">
                                                  <label for="filter" class="form-label mx-2">Tanggal Agenda</label>
                                                  <input type="date" class="form-control" id="filter" name="filter" placeholder="Tanggal" value="{{$filter}}">
                                                </div>
                                                <button type="submit" class="btn btn-default mb-2 fw-bolder">Filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table py-auto px-auto mx-auto my-auto mt-4"  data-aos="fade-up" data-aos-duration="1000">
                                    <div class="container-fluid">
                                        <table class="table table-bordered" >
                                            <thead class="thead">
                                                <tr class="bg-gray-100">
                                                    {{-- <th width="80px">@sortablelink('id')</th> --}}
                                                    {{-- <th class="px-4 py-2">@sortablelink('disposisi_id')</th> --}}
                                                    <th class="px-4 py-2">Jam Agenda</th>
                                                    {{-- <th class="px-4 py-2">@sortablelink('tanggal_agenda')</th> --}}
                                                    <th class="px-4 py-2">Isi</th>
                                                    <th class="px-4 py-2">Tempat</th>
                                                    <th class="px-4 py-2">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($agendas->count())
                                                @foreach($agendas as $agenda)
                                                <tr>
                                                    {{-- <td class="border px-4 py-2">{{ $agenda->id }}</td> --}}
                                                    {{-- <td class="border px-4 py-2">{{ $agenda->disposisi_id }}</td> --}}
                                                    <td class="border px-4 py-2">{{ $agenda->jam_agenda }}</td>
                                                    {{-- <td class="border px-4 py-2">{{ $agenda->tanggal_agenda}}</td> --}}
                                                    <td class="border px-4 py-2">{{ $agenda->isi }}</td>
                                                    <td class="border px-4 py-2">{{ $agenda->tempat }}</td>
                                                    <td class="border px-4 py-2">{{ $agenda->keterangan }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
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
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')
</body>
@include('script-foot')
</html>
