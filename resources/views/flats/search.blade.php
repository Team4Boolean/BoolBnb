@extends('layouts.app')
@section('content')


  <div id="flatSearch" class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        {{-- <a id="back-btn" class="btn btn-primary" href="{{route('flats.index')}}">Indietro</a> --}}
        <div class="card">
          <div class="card-header">
            <h1>Città Alta, Bergamo: alloggi</h1>
            <form class="flat-search" action="index.html" method="post">

              <section class="numInput d-flex justify-content-center">
                <div class="input-group mb-3 col-4">
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
                <div class="input-group mb-3 col-2">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="rooms">Stanze</label>
                  </div>
                  <select class="custom-select" name="rooms">
                    <option selected>Scegli...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
                {{-- n* letti --}}
                <div class="input-group mb-3 col-2">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="beds">Letti</label>
                  </div>
                  <select class="custom-select" name="beds">
                    <option selected>Scegli...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="3">4</option>
                    <option value="3">5</option>
                  </select>
                </div>
              </section>

              <section class="checkInput ">
                <div class="form-group ">
                  <ul class="d-flex justify-content-center list-unstyled">
                    <li class="pr-4">
                      {{-- wifi --}}
                      <div class="checkbox">
                        <label><input type="checkbox" name="wifi" value="{{ old('wifi') }}"> Wifi</label>
                      </div>
                    </li>
                    <li class="pr-4">
                      {{-- parking --}}
                      <div class="checkbox">
                        <label><input type="checkbox" name="parking" value="{{ old('parking') }}"> Parcheggio</label>
                      </div>
                    </li>
                    <li class="pr-4">
                      {{-- swim --}}
                      <div class="checkbox">
                        <label><input type="checkbox" name="swim" value="{{ old('swim') }}"> Piscina</label>
                      </div>
                    </li>
                    <li class="pr-4">
                      {{-- concierge --}}
                      <div class="checkbox">
                        <label><input type="checkbox" name="concierge" value="{{ old('concierge') }}"> Portinaio</label>
                      </div>
                    </li>
                    <li class="pr-4">
                      {{-- sauna --}}
                      <div class="checkbox">
                        <label><input type="checkbox" name="sauna" value="{{ old('sauna') }}"> Sauna</label>
                      </div>
                    </li>
                    <li class="pr-4">
                      {{-- sea --}}
                      <div class="checkbox">
                        <label><input type="checkbox" name="sea" value="{{ old('sea') }}"> Vista Mare</label>
                      </div>
                    </li>

                  </ul>
                </div>
              </section>
            </div>
            </form>

          <div class="card-body">
            <div class="container">

              <div class="text">
                <h3>RISULTATI</h3>
              </div>

              <div class="row">
{{--
                @foreach ($flats as $flat)

                  <flatcomponent
                    :title = "'{{ $flat -> title }}'"
                    :desc = "'{{ $flat -> desc }}'"
                    :img = "'{{ $flat -> photos -> first() -> url }}'"
                    :id = "'{{ $flat -> id }}'"
                  ></flatcomponent>



                @endforeach --}}

              </div>

          </div>
        </div>
      </div>
    </div>
  </div>





@endsection
