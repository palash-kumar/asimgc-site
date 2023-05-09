<!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-default navbar-expand-lg fixed-top border-bottom"> -->
    <nav class="navbar navbar-default navbar-expand-lg fixed-top border-bottom" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="/storage/siteImages/{{Session::get('companySettigs')['logo']}}" alt="{{ config('app.name', 'Laravel') }}">
            </a>

            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            @if (!Auth::guest())
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('settings.index') }}">{{ __('Settings') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services.index') }}">{{ __('Services') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery.index') }}">{{ __('Gallery') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index') }}">{{ __('Clients') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.index') }}">{{ __('Projects') }}</a>
                </li>
            </ul>
            @endif
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>

                @else
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-target="#navbarDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
          </div>
        </div>
    </nav>



@if (!Auth::guest())
<!--<div class="sidenav float-right position-sticky mt-5">
    <a href="#about">About</a>
    <a href="#services">Services</a>
    <a href="#clients">Clients</a>
    <a href="#contact">Contact</a>
</div>-->
@endif
