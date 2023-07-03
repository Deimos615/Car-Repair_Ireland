<nav class="navbar navbar-expand-lg navbar-dark bg-white header">
    <div class="container">
        <!-- <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Autoguru') }}
        </a> -->
        <a class="navbar-brand" href="{{ url('/') }}"><img class="logo-img" src="{{ asset('images/small/Landing/logo.png') }}" alt="logo image"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item px-2">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/repair">Maintenance & Repair</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/transport">Transport</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/sell">Sell My Car</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/purchase">Pre Purchase</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/contact">Contact us</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <div class="dropdown nav-item px-2">
                <button type="button" class="account-btn btn dropdown-toggle" data-bs-toggle="dropdown">
                    @guest    
                        My account
                    @else
                        {{ Auth::user()->name }}
                    @endguest
                </button>
                <ul class="account-ul dropdown-menu">
                    @guest
                        @if (Route::has('login'))
                            <li>
                                <a class="account-li nav-link dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li>
                                <a class="account-li nav-link dropdown-item" href="{{ route('register') }}">{{ __('Register as Client') }}</a>
                            </li>
                        @endif

                        @if (Route::has('garageRegister'))
                            <li>
                                <a class="account-li nav-link dropdown-item" href="{{ route('garageRegister') }}">{{ __('Register as Garage') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            @if(auth()->user()->type == 'user')
                                <a id="navbarDropdown" class="nav-link" href="/dashboard">
                                    Dashboard
                                </a>
                            @elseif(auth()->user()->type == 'admin')
                                <a id="navbarDropdown" class="nav-link" href="/admin/adminDashboard">
                                    Dashboard
                                </a>
                            @elseif(auth()->user()->type == 'manager')
                                <a id="navbarDropdown" class="nav-link" href="/manager/managerDashboard">
                                    Dashboard
                                </a>
                            @endif
                            
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>