<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
                    {{-- <div>
                        <x-jet-application-mark style="width: 50px;" /><h1></h1>
                        <span class="brand-text fw-bold "><h3></h3></span>
                    </div> --}}
                    {{-- <x-jet-application-mark width="36" class="brand-image img-circle elevation-1" style="opacity: .8" /> --}}


                    <h3 class="h3 my-4">
                        Selamat Datang di Aplikasi Agenda Surat dan Kegiatan DISKOMINFO Kabupaten Karanganyar
                    </h3>

                    <div class="text-muted">
                        Aplikasi Agenda Surat dan Kegiatan secara realtime dan terintegrasi sacara online di Diskominfo Kabupaten Karanganyar
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-6 pr-0">
                        <div class="card-body border-right border-bottom p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div>
                                    <i class="fa fa-file-text-o"></i>
                                </div>
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <a href="{{ route('disposisi-dashboard') }}"class="h5 font-weight-bolder text-decoration-none text-dark">SURAT MASUK</a>
                                    </div>
                                    <p class="text-muted">
                                        Atur Surat Masuk, Mengedit dan Menghapus.
                                    </p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card text-center" style="background-color: #0464FC">
                                                    <h5 class="card-header" style="color: white">TOTAL SURAT MASUK</h5>
                                                    <div class="card-body">
                                                        <h2 class="fw-bold value" style="color: white" akhi="{{$countDisposisi}}">0</h2>
                                                      {{-- <a href="#" class="btn btn-primary">lihat Agenda</a> --}}
                                                    </div>
                                                  </div>
                                            </div>
                                            {{-- <div class="col-6">
                                                <div class="card text-center bg-success">
                                                    <h6 class="card-header ">DITERIMA </h6>
                                                    <div class="card-body">
                                                        <h3 class="fw-bold value" akhi="{{$countDiterima}}">0</h3>

                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card text-center bg-primary">
                                                    <h6 class="card-header">DIPROSES </h6>
                                                    <div class="card-body">
                                                        <h3 class="fw-bold value" akhi="{{$countDiproses}}">0</h3>

                                                    </div>
                                                  </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-0">
                        <div class="card-body border-bottom p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div>
                                    <i class="fa fa-file-text-o"></i>
                                </div>
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <a href="{{ url('keluar-dashboard') }}" class="h5 font-weight-bolder text-decoration-none text-dark">SURAT KELUAR</a>
                                    </div>
                                    <p class="text-muted">
                                            Atur Surat Keluar di Diskominfo Karanganyar
                                    </p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card text-center"  style="background-color: #df497d">
                                                    <h5 class="card-header" style="color: white" >TOTAL SURAT KELUAR</h5>
                                                    <div class="card-body">
                                                        <h2 class="fw-bold value" akhi="{{$countSuratKeluar}}" style="color: white">0</h2>
                                                      {{-- <a href="#" class="btn btn-primary">lihat Agenda</a> --}}
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pr-0">
                        <div class="card-body border-right border-bottom p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div>
                                    <i class="fa fa-check-square-o"></i>
                                </div>
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <a href="{{ route('disposisi-dashboard') }}"class="h5 font-weight-bolder text-decoration-none text-dark">DISPOSISI</a>
                                    </div>
                                    <p class="text-muted">
                                        Atur Disposisi, Mengedit dan Menghapus.
                                    </p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card text-center" style="background-color: #0b807e">
                                                    <h5 class="card-header" style="color: white">TOTAL DISPOSISI</h5>
                                                    <div class="card-body">
                                                        <h2 class="fw-bold value" akhi="{{$countDiterima}}" style="color: white">0</h2>
                                                      {{-- <a href="#" class="btn btn-primary">lihat Agenda</a> --}}
                                                    </div>
                                                  </div>
                                            </div>
                                            {{-- <div class="col-6">
                                                <div class="card text-center bg-success">
                                                    <h6 class="card-header ">DITERIMA </h6>
                                                    <div class="card-body">
                                                        <h3 class="fw-bold value" akhi="{{$countDiterima}}">0</h3>

                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card text-center bg-primary">
                                                    <h6 class="card-header">DIPROSES </h6>
                                                    <div class="card-body">
                                                        <h3 class="fw-bold value" akhi="{{$countDiproses}}">0</h3>

                                                    </div>
                                                  </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-0">
                        <div class="card-body border-bottom p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <a href="{{ url('agenda-dashboard') }}" class="h5 font-weight-bolder text-decoration-none text-dark">AGENDA</a>
                                    </div>
                                    <p class="text-muted">
                                            Atur Agenda Kegiatan di Diskominfo Karanganyar
                                    </p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card text-center"  style="background-color: #ffce08">
                                                    <h5 class="card-header" style="color: white">TOTAL AGENDA</h5>
                                                    <div class="card-body">
                                                        <h2 class="fw-bold value" akhi="{{$countAgenda}}" style="color: white">0</h2>
                                                      {{-- <a href="#" class="btn btn-primary">lihat Agenda</a> --}}
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
        </div>
    </div>
<script>
    const counters = document.querySelectorAll('.value');
const speed = 50;

counters.forEach( counter => {
   const animate = () => {
      const value = +counter.getAttribute('akhi');
      const data = +counter.innerText;

      const time = value / speed;
     if(data < value) {
          counter.innerText = Math.ceil(data + time);
          setTimeout(animate, 1);
        }else{
          counter.innerText = value;
        }

   }

   animate();
});
</script>

</x-app-layout>
