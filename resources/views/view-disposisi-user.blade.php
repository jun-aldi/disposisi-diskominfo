<!DOCTYPE html>
<html lang="en">
<head>
    @include('header')
    <style>
        .btn-download{
            background-color: #eed4e3; color: #ff0289
        }
        .btn-lihat{
            background-color: #E6F5FF; color: #5793CE
        }
    </style>
</head>
<body>
    @include('navbar-top')

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 p-0">
                <div class="jumbotron min-vh-100 m-0 d-flex flex-column justify-content-center">
                    <div class="row d-flex justify-content-center my-auto mx-auto" >
                        <div class="container mt-5">
                            <h1 class="mb-4 text-center fw-bold">STATUS SURAT</h1>
                            <form class="form-inline" method="GET">
                                <div class="form-group ms-auto">
                                  <label for="filter" class="form-label mx-2">Tanggal Surat</label>
                                  <input type="date" class="form-control" id="filter" name="filter" placeholder="Tanggal" value="{{$filter}}">
                                </div>
                                <button type="submit" class="btn btn-default mb-2 fw-bolder">Filter</button>
                            </form>
                            @foreach ($disposisis as $disposisi )
                            <div class="row">
                                <div class="col-12">
                                    <div class="card my-4 w-100 shadow rounded" data-aos="fade-up" data-aos-duration="700">
                                          @if ($disposisi->status_id ==1)
                                            <div class="card-header bg-success text-white fw-bold">
                                                <h5>Diterima</h5>
                                            </div>
                                            @elseif ($disposisi->status_id ==2)
                                            <div class="card-header bg-danger text-white fw-bold">
                                                <h5>Ditolak</h5>
                                            </div>
                                            @else
                                            <div class="card-header bg-primary text-white fw-bold">
                                                <h5>Diproses</h5>
                                            </div>
                                          @endif
                                        <div class="card-body">
                                            <div class="container mb-4 card-img rounded" >
                                                <div class="row">
                                                    <div class="d-flex flex-row-reverse">
                                                        <div class="p-2">Dari : {{$disposisi->dari}}</div>
                                                    </div>
                                                    <div class="col-xl-12"><br></div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="p-2 fw-medium">No Surat : {{$disposisi->no_surat}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 class="card-title fw-bold">Kepada : {{$disposisi->kepada}}</h5>
                                            <p>Isi Surat :</p>
                                          <p class="card-text text-justify">{{$disposisi->isi_surat}}</p>
                                          <p class="fw-lighter" style="color: grey">{{ date('d/m/Y',strtotime($disposisi->tanggal_dibuat)) }}</p>
                                          <div class="d-flex flex-row-reverse">
                                              @if ($disposisi->status_id == 1)
                                              <form method="post" action="{{route('lihatpdf', $disposisi->id) }}">
                                                @csrf
                                                <button class="btn btn-lihat mx-2">Download Diposisi</button>
                                              </form>
                                              @endif
                                              <form method="post" action="{{route('downloadfile', $disposisi->id) }}">
                                                @csrf
                                                <button class="btn btn-download mx-2">Lihat File</button>
                                              </form>
                                            {{-- <a href="{{route('download',$disposisi->id) }}" class="btn btn-download mx-2" style="">Download Disposisi</a> --}}
                                        </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            @endforeach
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
