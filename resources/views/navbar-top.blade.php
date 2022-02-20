<nav class="navbar fixed-top navbar-expand-lg bg-light navbar-light ">
    <div class="container-fluid">
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/kra.png') }}" alt="" width="30" height="30" style="color: #173D7A" class="fw-bolder d-inline-block align-text-top">
                DISKOMINFO PEMKAB KARANGANYAR
            </a>
            <div class="navbar-nav ms-auto">
                <div class="navbar-nav">
                    <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Disposisi</a>
                        <div class="dropdown-menu">
                            <a href="{{url('form-disposisi-masuk')}}" class="dropdown-item">Buat Surat Masuk</a>
                            <a href="#" class="dropdown-item">Buat Surat Keluar</a>
                            <a href="{{url('disposisi-users')}}" class="dropdown-item">Surat Saya</a>
                        </div>
                    </div>
                    <a href="{{ route('agenda-lp') }}" class="nav-item nav-link active">Agenda</a>
                </div>
                @if (Route::has('login'))
                    @auth

                        <a  href="{{ url('/dashboard') }}" class="nav-item nav-link">Dashboard</a>
                    @else
                        <button class="btn btn-mulai mx-1" type="button"><a href="{{ route('login') }}"  style="color: white">Masuk</a></button>

                        @if (Route::has('register'))
                        <button type="button" class="btn btn-mulai mx-1"><a href="{{ route('register') }}" style="color: white" >Register</a></button>

                        @endif
                    @endif
                @endif

            </div>
        </div>
    </div>
</nav>

