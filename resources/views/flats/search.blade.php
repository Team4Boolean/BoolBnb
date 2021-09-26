@extends('layouts.search-app')
@section('jumbo')

  @include('components.fsc')

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

{{-- ------SEARCH CONTAINER---- --}}

<div class="container" >
  <div class="wrapper">
    <div class="row ">
      {{-- LEFT-SIDE --}}
      <div class="col-lg-6 col-xl-4 left-side mb-3">
      <h1>Filtri:</h1>

      <form action="{{ route('flats.search.filters') }}" method="get">
        @csrf
        @method('GET')

        <input id="jumbo-search-bar" class="jumbo-search-bar" type="search" name="loc" value="{{old('loc', $loc)}}" placeholder="Cambia la meta..">
          <div class="form-group" style="display:none">
              <label for="lon">LONGITUDINE</label>
              <br>
              <input id="jumbo-search-lon" type="text" name="lon" value="{{old('lon', $lon)}}">
          </div>
          <div class="form-group" style="display:none">
              <label for="lat">LATITUDINE</label>
              <br>
              <input id="jumbo-search-lat" type="text" name="lat" value="{{old('lat', $lat)}}">
          </div>
          <button type="submit" class="btn">Cambia destinazione</button>
        <hr>

          <section class="numInput ">
            <div class="input-group mb-3">
              <div class="input-group-prepend ">
                <label for="rangeDistance" class="input-group-text ">Scegli la istanza</label>
              </div>
              <div class="slidecontainer mt-2">
                <input type="range" name="distance" min="1" max="100" value=@if ($dist==20) "20" @else "{{old('distance', $dist)}}" @endif class="slider" id="rangeDistance">
                <div>
                  <span class="distance">@if ($dist==20) 20 @else {{old('distance', $dist)}} @endif </span> KM
                </div>
              </div>

              {{-- <select class="selectDistance custom-select" name="distance">
                <option @if ($dist==0) selected @endif>Scegli...</option>
                <option value="5" @if ($dist==5) selected @endif>Entro 5 Km</option>
                <option value="10" @if ($dist==10) selected @endif>Entro 10 Km</option>
                <option value="20" @if ($dist==20) selected @endif>Entro 20 Km</option>
                <option value="50" @if ($dist==50) selected @endif>Entro 50 Km</option>
                <option value="100" @if ($dist==100) selected @endif>Entro 100 Km</option>
              </select> --}}
            </div>
            <div class="d-flex justify-content-between mb-3 flex-wrap">
              <div class="input-group col-6">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="rooms">Stanze</label>
                </div>
                <select class="custom-select" name="rooms">
                  <option @if ($rooms==0) selected @endif>Scegli...</option>
                  <option value="1" @if ($rooms==1) selected @endif>1</option>
                  <option value="2" @if ($rooms==2) selected @endif>2</option>
                  <option value="3" @if ($rooms==3) selected @endif>3</option>
                  <option value="4" @if ($rooms==4) selected @endif>4</option>
                  <option value="5" @if ($rooms==5) selected @endif>5</option>
                </select>
              </div>
              <div class="input-group col-6">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="beds">Letti</label>
                </div>
                <select class="custom-select" name="beds">
                  <option @if ($beds==0) selected @endif>Scegli...</option>
                  <option value="1" @if ($beds==1) selected @endif>1</option>
                  <option value="2" @if ($beds==2) selected @endif>2</option>
                  <option value="3" @if ($beds==3) selected @endif>3</option>
                  <option value="4" @if ($beds==4) selected @endif>4</option>
                  <option value="5" @if ($beds==5) selected @endif>5</option>
                </select>
              </div>
            </div>
          </section>
          <hr>
          <section class="checkInput ">
            <div class="form-group">
              <ul class=" list-unstyled">
                <div class="row ">
                  <li class="col-6">
                    <label><input type="checkbox" name="services[]" value="1"
                      {{ (is_array(old('services')) and in_array(1, old('services'))) ? 'checked' : '' }}
                      @isset($services)
                        @foreach ($services as $service)
                          @if ($service == 1)
                            {{ 'checked' }}
                          @endif
                        @endforeach
                      @endisset
                      > Wifi</label>
                  </li>
                  <li class="col-6 ">
                    <label><input type="checkbox" name="services[]" value="2"
                      {{ (is_array(old('services')) and in_array(2, old('services'))) ? 'checked' : '' }}
                      @isset($services)
                        @foreach ($services as $service)
                          @if ($service == 2)
                            {{ 'checked' }}
                          @endif
                        @endforeach
                      @endisset
                      > Parcheggio</label>
                  </li>
                </div>
                <div class="row ">
                  <li class="col-6">
                    <label><input type="checkbox" name="services[]" value="3"
                      {{ (is_array(old('services')) and in_array(3, old('services'))) ? 'checked' : '' }}
                      @isset($services)
                        @foreach ($services as $service)
                          @if ($service == 3)
                            {{ 'checked' }}
                          @endif
                        @endforeach
                      @endisset
                      > Piscina</label>
                  </li>
                  <li class="col-6 " >
                    <label><input type="checkbox" name="services[]" value="4"
                      {{ (is_array(old('services')) and in_array(4, old('services'))) ? 'checked' : '' }}
                      @isset($services)
                        @foreach ($services as $service)
                          @if ($service == 4)
                            {{ 'checked' }}
                          @endif
                        @endforeach
                      @endisset
                      > Portineria</label>
                  </li>
                </div>
                <div class="row ">
                  <li class="col-6">
                    <label><input type="checkbox" name="services[]" value="5"
                      {{ (is_array(old('services')) and in_array(5, old('services'))) ? 'checked' : '' }}
                      @isset($services)
                        @foreach ($services as $service)
                          @if ($service == 5)
                            {{ 'checked' }}
                          @endif
                        @endforeach
                      @endisset
                      > Sauna</label>
                  </li>
                    <li class="col-6">
                      <label><input type="checkbox" name="services[]" value="6"
                        {{ (is_array(old('services')) and in_array(6, old('services'))) ? 'checked' : '' }}
                        @isset($services)
                          @foreach ($services as $service)
                            @if ($service == 6)
                              {{ 'checked' }}
                            @endif
                          @endforeach
                        @endisset
                        > Vista Mare</label>
                    </li>
                </div>
              </ul>
            </div>
          </section>

        </form>
      </div>
      {{-- RIGHT SIDE --}}
      <div class="col-lg-6 col-xl-8 right-side">

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

          <div id="search" class="container">

            <div class="d-flex flex-column align-items-start">
              <h2>{{ old('loc', $loc) }}:</h2>
              <div id="search-result">
                {{ count($flats) }} risultati
              </div>
            </div>

            <hr>

            <div class="container" id="results">

              @if($flats && count($flats)!=0)
                @foreach ($flats as $flat)

                {{-- <flatcomponent
                :title = "'{{ $flat -> title }}'"
                :desc = "'{{ $flat -> desc }}'"
                :img = "'{{ asset($flat -> photos() -> first() -> path) }}'"
                :sponsored = "'{{ $flat -> sponsored }}'"
                :id = "'{{ $flat -> id }}'"
                ></flatcomponent> --}}

                <fsc
                :title = "'{{ $flat -> title }}'"
                :desc = "'{{ trim(preg_replace('/\s\s+/', ' ', $flat -> desc)) }}'"
                :img = "'{{ asset($flat -> photos() -> first() -> path) }}'"
                :sponsored = "'{{ $flat -> sponsored }}'"
                :id = "'{{ $flat -> id }}'"
                ></fsc>

                @endforeach
              @else
                <h3>Nessun appartamento trovato</h3>
              @endif

            </div>

          </div>
          {{-- /div id=search --}}


        {{-- /container --}}

      </div>
      {{-- <a id="back-btn" class="btn btn-primary" href="{{route('flats.index')}}">Indietro</a> --}}
    </div>
  </div>

</div>

</div>
@endsection
