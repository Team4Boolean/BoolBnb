@extends('layouts.app')

@section('content')

  <div id="index-container" class="container mt-3">

    <div class="row ">
      <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1 class="pt-4">Benvenuto, {{ $firstname }}</h1>
        <div class=" ">
          <a href="{{ route('flats.create') }}" class="btn btn-primary">Affitta un nuovo appartamento</a>
        </div>
      </div>
    </div>
    <hr>
    {{-- Appartamenti in affitto --}}
    @isset($flats)
      <ul class="list-unstyled">
        @foreach ($flats as $flat)

          @if ($loop -> first)
              <h2>APPARTAMENTI IN AFFITTO</h2>
          @endif

        <li class="list-index media mb-5 ">
          <div class="row">

            <div class="index-img col-xs-12 col-md-12 col-lg-5 col-xl-4">
              <img src="{{ asset($flat -> photos() -> first() -> path) }}" class="rounded img-fluid" alt="Flat Image">
            </div>

            <div class="col-xs-12 col-md-12 col-lg-7 col-xl-8">
              <div class="title-text">
                <h3 class="mt-0 mb-1">{{ $flat -> title }}</h3>
                <p>{{ $flat -> desc }}</p>
              </div>
              <div class="index-button">
                  <a href="{{ route('flats.show', $flat -> id) }}" class="btn btn-primary"> Visualizza</a>
                  <a href="{{ route('flats.edit', $flat -> id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                  <a href="{{ route('flats.stats', $flat -> id) }}" class="btn btn-primary"><i class="fas fa-chart-line"></i></a>
                  <a href="{{ route('flats.sponsor.create', $flat -> id) }}" class="btn btn-primary">Sponsorizza</a>
                  <a href="{{ route('flats.deactivate', $flat -> id) }}" class="btn btn-danger float-right">Disattiva</a>
                </div>
              </div>
            </div>
          </li>
            @endforeach
        </ul>
      @endisset
      <hr>
      {{-- Appartamenti disattivati --}}
      @isset($flatsTrashed)
        <ul class="list-unstyled">

          @foreach ($flatsTrashed as $flat)

            @if ($loop -> first)
                <h2>APPARTAMENTI DISATTIVATI</h2>
            @endif

            <li class="list-index media mb-5 ">
              <div class="row">

                <div class="index-img col-xs-12 col-md-3 col-xl-4 opacity">
                  <img src="{{ asset($flat -> photos() -> first() -> path) }}" class="rounded img-fluid" alt="Flat Image">
                </div>

                <div class="col-xs-12 col-md-9 col-xl-8 d-flex flex-column justify-content-center">
                  <div class="opacity">
                    <h3 class="mt-0 mb-1">{{ $flat -> title }}</h3>
                    <p>{{ $flat -> desc }}</p>
                  </div>
                  <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('flats.activate', $flat -> id) }}" class="btn btn-primary">Attiva</a>
                    <span class="text-danger"><strong>Questo appartamento è disattivato</strong></span>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        @endisset

    </div>

@endsection
