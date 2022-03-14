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
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Disposisi</a>
                        <div class="dropdown-menu">
                            <a href="{{url('form-disposisi-masuk')}}" class="dropdown-item">Buat Surat Masuk</a>

                            <a href="{{url('disposisi-users')}}" class="dropdown-item">Surat Saya</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Agenda</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('agenda-kepala') }}" class="nav-item  dropdown-item">Kepala Diskominfo</a>
                            <a href="{{ route('agenda-sekre') }}" class="nav-item  dropdown-item">Sekretariat Diskominfo</a>
                            <a href="{{ route('agenda-tki') }}" class="nav-item  dropdown-item">Bidang Tata Kelola <br> Informatika Diskominfo</a>
                            <a href="{{ route('agenda-ikp') }}" class="nav-item  dropdown-item">Bidang Informasi dan <br> Komunikasi Publik</a>
                        </div>
                    </div>
                </div>
                @if (Route::has('login'))
                    @auth
                    @if(Auth::check() && Auth::user()->roles == "ADMIN")
                    <a  href="{{ route('dashboard') }}" class="nav-item nav-link active">Dashboard </a>
                    @endif
                        <x-jet-dropdown id="navbarDropdown" class="user-menu">
                            <x-slot name="trigger">
                                    <img class="user-image img-circle elevation-1" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <h6 class="dropdown-header">
                                    {{ __('Manage Account') }}
                                </h6>

                                <x-jet-dropdown-link href="{{ url('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <hr class="dropdown-divider">

                                <!-- Authentication -->
                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                    @csrf
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    @else
                        <button class="btn btn-mulai mx-1 my-1" type="button"><a href="{{ route('login') }}"  style="color: white">Masuk</a></button>

                        @if (Route::has('register'))
                        <button type="button" class="btn btn-mulai mx-1 my-1"><a href="{{ route('register') }}" style="color: white" >Register</a></button>

                        @endif
                    @endif
                @endif

            </div>
                <!-- Authentication Links -->

        </div>
    </div>
</nav>

<script>

</script>



