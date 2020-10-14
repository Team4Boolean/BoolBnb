<nav class="navbar navbar-expand-lg navbar-white bg-white">
  <div class="row">

    {{-- Brand --}}
    <div class="d-md-block col-md-1 col-lg-4">
      <a id="link-logo" class="navbar-brand" href="{{ url('/') }}">
        <img id="img-logo" src="{{asset('imgs/airbnb.svg')}}" width="30px" height="auto" alt="logo">
        <span id="span-logo">boolbnb</span>
      </a>
    </div>

    {{-- Search bar --}}
    <div class="col-xs-12 col-md-5 col-lg-4">
      <form method="post">
        <input id="search-bar" class="" type="search" name="" value="">
        <button id="search-button" class="rounded-circle" type="button" name="button" title="Search">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>

    <!-- Right Side Of Navbar -->
    <div class="col-xs-12 col-md-6 col-lg-4">
      <ul>
        <li class="nav-item">
          <a class="nav-link" href="#">Diventa un host</a>
        </li>

        {{-- Dropdown --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bars"></i>
            {{-- If the user is logged shows his firstname --}}
            @guest
              <i class="fas fa-user"></i>
            @else
              <span>{{ Auth::user()->firstname }}</span>
            @endguest
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            {{-- If the user is a guest, he can login/register --}}
            @guest
              <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
              <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
            {{-- If he is already logged he can logout --}}
            @else
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            @endguest

            <div class="dropdown-divider"></div>

            {{-- Other links --}}
            <a class="dropdown-item" href="#">Diventa un host</a>
            <a class="dropdown-item" href="#">Proponi un'esperienza</a>
            <a class="dropdown-item" href="#">Assistenza</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

{{-- Navbar bottom page --}}
<div id="bottom-nav" class="navbar navbar-white bg-white">
  <div class="login">
    <a href="{{ route('login') }}">
      <i class="fas fa-sign-in-alt"></i>
      Login
    </a>
  </div>
  <div class="register">
    <a href="{{ route('register') }}">
      <i class="fas fa-plus"></i>
      Register
    </a>
  </div>
</div>
