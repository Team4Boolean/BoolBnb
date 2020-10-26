@extends('layouts.search-app')
@section('jumbo')


<div class="flatsearch" style="background-image: url('https://a0.muscache.com/pictures/18084f37-67e0-400f-bfd8-55eea0e89508.jpg')">
  <div class="jumbo-navbar">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img id="jumbo-img-logo" src="{{asset('imgs/airbnb.svg')}}" width="40px" height="auto" alt="logo">
      <span class="jumbo-span-logo">Boolbnb</span>
    </a>
    <div class="col-xs-12 col-md-6 col-lg-4 ">
      <ul>
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('flats.create') }}">Affitta un appartamento</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('flats.index') }}">Area personale</a>
          </li>
        @endguest

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
              <a class="dropdown-item" href="{{ route('register') }}">{{ __('Registrati') }}</a>
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

            {{-- <div class="dropdown-divider"></div> --}}

            {{-- Other links --}}
            {{-- <a class="dropdown-item" href="{{ route('flats.create') }}">Affitta un appartamento</a> --}}
            {{-- <a class="dropdown-item" href="#">Proponi un'esperienza</a>
            <a class="dropdown-item" href="#">Assistenza</a> --}}
          </div>
        </li>
      </ul>
    </div>
  </div>



<div class="container" >
  <div class="wrapper">
    <div class="row ">
      <div class="col-md-6 col-lg-5 col-xl-4 left-side">
      <h1>{{ $loc }}:</h1>

        <form stmethod="post">
          <input id="jumbo-search-bar" class="jumbo-search-bar" type="search" name="" value="" placeholder="Cambia la meta..">

          <div class="form-group" style="display:none">
              <label for="lon">LONGITUDINE</label>
              <br>
              <input id="jumbo-search-lon" type="text" name="lon" value="">
          </div>
          <div class="form-group" style="display:none">
              <label for="lat">LATITUDINE</label>
              <br>
              <input id="jumbo-search-lat" type="text" name="lat" value="">
          </div>
        </form>
        <hr>
        <form class="flat-search" action="" method="post">
          <section class="numInput ">
            <div class="input-group mb-3">
              <div class="input-group-prepend ">
                <label for="selectDistance" class="input-group-text ">Scegli la distanza</label>
              </div>
              <select class="selectDistance custom-select" name="selectDistance">
                <option value="5">Entro 5 Km</option>
                <option value="10">Entro 10 Km</option>
                <option value="25">Entro 25 Km</option>
                <option value="100">Entro 50 Km</option>
              </select>
            </div>
            {{-- n* Stanze --}}
            <div class="d-flex justify-content-between mb-3 flex-wrap">
              <div class="input-group col-6">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="rooms">Stanze</label>
                </div>
                <select class="custom-select" name="rooms">
                  <option selected="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              {{-- n* letti --}}
              <div class="input-group col-6">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="beds">Letti</label>
                </div>
                <select class="custom-select" name="beds">

                  <option selected="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="3">4</option>
                  <option value="3">5</option>
                </select>
              </div>
            </div>
          </section>
          <hr>
          <section class="checkInput ">
            <div class="form-group ">
              <ul class=" list-unstyled">
              <div class="row ">
                <li class="col-6">
                {{-- wifi --}}
                    <label><input type="checkbox" name="wifi" value="{{ old('wifi') }}"> Wifi</label>
                </li>
                <li class="col-6 ">
                {{-- parking --}}
                    <label><input type="checkbox" name="parking" value="{{ old('parking') }}"> Parcheggio</label>
                </li>
              </div>
              <div class="row ">
                <li class="col-6">
                {{-- swim --}}

                    <label><input type="checkbox" name="swim" value="{{ old('swim') }}"> Piscina</label>

                </li>
                <li class="col-6 " >
                {{-- concierge --}}

                    <label><input type="checkbox" name="concierge" value="{{ old('concierge') }}"> Portinaio</label>

                </li>

              </div>
              <div class="row ">
                <li class="col-6">
                {{-- sauna --}}

                    <label><input type="checkbox" name="sauna" value="{{ old('sauna') }}"> Sauna</label>

                </li>
                  <li class="col-6">
                  {{-- sea --}}

                      <label><input type="checkbox" name="sea" value="{{ old('sea') }}"> Vista Mare</label>

                  </li>
              </div>

              </ul>
            </div>
          </section>
          <a class="btn" href="#">Cerca</a>
        </form>
      </div>

      <div class="col-md-6 col-lg-7 col-xl-8">
        <div class="container">

          <script type="text/javascript">

            function initVue() {
              const search = new Vue({
                el: '#search',
              });
            }

            function init() {
              initVue();
            }

            $(document).ready(init);

          </script>

          <div id="search">

            <div class="">
              <h2>RISULTATI</h2>
            </div>

            <div class="row">

              @isset($flats)
                @foreach ($flats as $flat)

                <flatcomponent
                :title = "'{{ $flat -> title }}'"
                :desc = "'{{ $flat -> desc }}'"
                :img = "'{{ asset($flat -> photos() -> first() -> path) }}'"
                :id = "'{{ $flat -> id }}'"
                ></flatcomponent>

                @endforeach
              @endisset

            </div>

          </div>
          {{-- /div id=search --}}

        </div>
        {{-- /container --}}

      </div>
      {{-- <a id="back-btn" class="btn btn-primary" href="{{route('flats.index')}}">Indietro</a> --}}
    </div>
  </div>

</div>

</div>
@endsection
