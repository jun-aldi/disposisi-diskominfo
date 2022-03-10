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
                        Selamat Datang di Aplikasi Agenda dan Disposisi Online DISKOMINFO Kabupaten Karanganyar
                    </h3>

                    <div class="text-muted">
                        Aplikasi Lembar Surat Masuk Elektronik dan Agenda secara realtime dan terintegrasi sacara online Diskominfo Kabupaten Karanganyar
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-6 pr-0">
                        <div class="card-body border-right border-bottom p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div>
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <a href="{{ route('disposisi-dashboard') }}"class="h5 font-weight-bolder text-decoration-none text-dark">DISPOSISI</a>
                                    </div>
                                    <p class="text-muted">
                                        Atur Surat Masuk, Mengedit dan Menghapus.
                                    </p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card text-center bg-warning">
                                                    <h5 class="card-header">TOTAL DISPOSISI</h5>
                                                    <div class="card-body">
                                                        <h2 class="fw-bold value" akhi="{{$countDisposisi}}">0</h2>
                                                      {{-- <a href="#" class="btn btn-primary">lihat Agenda</a> --}}
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="card text-center bg-success">
                                                    <h6 class="card-header ">DITERIMA </h6>
                                                    <div class="card-body">
                                                        <h3 class="fw-bold value" akhi="{{$countDiterima}}">0</h3>
                                                      {{-- <a href="#" class="btn btn-primary">lihat Agenda</a> --}}
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="card text-center bg-primary">
                                                    <h6 class="card-header">DIPROSES </h6>
                                                    <div class="card-body">
                                                        <h3 class="fw-bold value" akhi="{{$countDiproses}}">0</h3>
                                                      {{-- <a href="#" class="btn btn-primary">lihat Agenda</a> --}}
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="card text-center bg-danger">
                                                    <h6 class="card-header">DITOLAK </h6>
                                                    <div class="card-body">
                                                        <h3 class="fw-bold value" akhi="{{$countDitolak}}">0</h3>
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

                    <div class="col-md-6 pl-0">
                        <div class="card-body border-bottom p-3 h-100">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div>
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div class="pl-3">
                                    <div class="mb-2">
                                        <a href="{{ url('agenda-dashboard') }}" class="h5 font-weight-bolder text-decoration-none text-dark">AGENDA</a>
                                    </div>
                                    <p class="text-muted">
                                            Atur Agenda Untuk Hari ini atau Besok
                                    </p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card text-center bg-warning">
                                                    <h5 class="card-header">TOTAL AGENDA</h5>
                                                    <div class="card-body">
                                                        <h2 class="fw-bold value" akhi="{{$countAgenda}}">0</h2>
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
