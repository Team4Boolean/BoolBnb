<nav class="navbar navbar-expand-lg navbar-white bg-white">
  <div class="row">
    {{-- Brand --}}
    <div class="d-md-block col-md-1 col-lg-4">
      <a id="link-logo" class="navbar-brand" href="{{ url('/') }}">
        <img id="img-logo" src="{{asset('imgs/airbnb.svg')}}" width="30px" height="auto" alt="logo">
        <span id="span-logo">airbnb</span>
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
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Diventa un host</a>
        </li>
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
          </li>
        @endguest
      </ul>
    </div>

  </div>

{{--
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> --}}

  {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div> --}}



</nav>
