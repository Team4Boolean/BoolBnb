@extends('layouts.app')

@section('jumbo')
  <div class="jumbotron jumbotron-fluid" style="background-image: url('https://a0.muscache.com/pictures/18084f37-67e0-400f-bfd8-55eea0e89508.jpg')">
    <div class="container">
      <div class="row">
        <div class="jumbo-left-side col-xs-12 col-md-6">
          <div class="text">
            <h1>Riscopri l'Italia</h1>
            <p>Scopri alloggi nelle vicinanze tutti da vivere, per lavoro o svago.</p>
            <form method="post">
              <input id="jumbo-search-bar" class="" type="search" name="" value="" placeholder="Inizia la ricerca...">

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
            <a class="btn btn-light" href="#">Esplora i dintorni</a>
          </div>
        </div>
      </div>


    </div>
  </div>
@endsection

@section('content')

  <div class="container">

    <div class="text">
      <h3>Appartamenti in evidenza</h3>
    </div>

    <div class="row homepage">

      @foreach ($sponsored as $flat)

        <flatcomponent
          :title = "'{{ $flat -> title }}'"
          :desc = "'{{ $flat -> desc }}'"
          :img = "'{{ $flat -> photos -> first() -> url }}'"
          :id = "'{{ $flat -> id }}'"
        ></flatcomponent>

        {{-- <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="card">
            <img src="{{ $flat -> photos -> first() -> url }}" class="card-img-top" alt="flat-img">
            <div class="card-body">
              <h5 class="card-title">{{ $flat -> title }}</h5>
              <p class="card-text text-muted">{{ $flat -> desc }}</p>
              <a href="#" class="btn btn-primary">Visualizza</a>
            </div>
          </div>
        </div> --}}

      @endforeach

    </div>

    {{-- {{ $sponsored -> links() }} --}}

  </div>

@endsection
