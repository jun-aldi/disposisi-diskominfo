<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        {{-- <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-jet-nav-link> --}}

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ms-auto">
        <!-- Teams Dropdown -->
        {{-- @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <x-jet-dropdown id="teamManagementDropdown">
                <x-slot name="trigger">
                    {{ Auth::user()->currentTeam->name }}

                    <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </x-slot>

                <x-slot name="content">
                    <!-- Team Management -->
                    <h6 class="dropdown-header">
                        {{ __('Manage Team') }}
                    </h6>

                    <!-- Team Settings -->
                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                        {{ __('Team Settings') }}
                    </x-jet-dropdown-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                            {{ __('Create New Team') }}
                        </x-jet-dropdown-link>
                    @endcan

                    <hr class="dropdown-divider">

                    <!-- Team Switcher -->
                    <h6 class="dropdown-header">
                        {{ __('Switch Teams') }}
                    </h6>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" />
                    @endforeach
                </x-slot>
            </x-jet-dropdown>
        @endif --}}


    </ul>
</nav>
