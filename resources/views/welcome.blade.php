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
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 p-0">
                <div class="jumbotron min-vh-100 m-0 d-flex flex-column justify-content-center">
                    <div class="row d-flex justify-content-center my-auto" >
                        <div class="col-xl-6 col-sm-12">
                            <div class="container justify-content-center" data-aos="fade-right" data-aos-duration="1000">
                                <h1 class="fw-bolder" style="color: #173D7A">SURAT MASUK DAN AGENDA DISKOMINFO KABUPATEN KARANGANYAR</h1>
                                <p class="lh-base">Aplikasi Lembar Surat Masuk Elektronik dan Agenda secara realtime Diskominfo Kabupaten Karanganyar</p>
                                <button class="btn btn-mulai btn-rounded">Mulai</button>
                            </div>

                        </div>
                        <div class="col-xl-5 col-sm-2" data-aos-duration="1000" data-aos="fade-left">
                            <img src="{{ asset('img/LP-1.png') }}" alt="landingPage1"  srcset="" class="img-fluid img-landing">
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
