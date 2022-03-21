<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('header')
</head>
<body>
    @include('navbar-top')
    {{-- <div class="container-fluid fixed-top p-4">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                @if (Route::has('login'))
                    <div class="">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-muted">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-muted">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ms-4 text-muted">Register</a>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div> --}}
    <div class="container-fluid my-2">
        <div class="row">
            <div class="col-xl-12 p-0">
                <div class="jumbotron min-vh-100 m-0 d-flex flex-column justify-content-center">
                    <div class="row d-flex justify-content-center my-auto" >
                        <div class="col-xl-1 my-4"></div>
                        <div class="col-xl-5 col-sm-12 row my-4">
                            <div class="col-12"></div>
                            <div class="container justify-content-center col-12" data-aos="fade-right" data-aos-duration="1000">
                                <h1 class="fw-bolder display-5" style="font-family: 'Poppins';color: #4F9FDB">AGENDA SURAT DAN KEGIATAN DISKOMINFO KABUPATEN KARANGANYAR</h1>
                                <p class="lh-base">Aplikasi Agenda Surat dan Kegiatan di Diskominfo Kabupaten Karanganyar</p>
                                {{-- <a href="{{url('form-disposisi-masuk')}}" class="btn btn-mulai btn-rounded">Mulai</a> --}}
                                <button href="{{url('form-disposisi-masuk')}}" class="btn btn-mulai btn-rounded"> <a style="text-decoration:none; color:white" href="{{url('form-disposisi-masuk')}}">Mulai</a> </button>
                            </div>
                            <div class="col-12"></div>
                        </div>
                        <div class="col-xl-1"></div>
                        <div class="col-xl-5 my-4 col-sm-1" data-aos-duration="1000" data-aos="fade-left">
                            <img src="{{ asset('img/Asset 1.png') }}" alt="landingPage1"  srcset="" class="img-fluid img-landing">
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
