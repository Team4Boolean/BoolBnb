@extends('layouts.app')

@section('content')

  <div id="index-container" class="container">

    <div class="row justify-content-center">
      <div class="col-md-12">
        <h1 class="mt-3 mb-3">Benvenuto, {{ $firstname }}</h1>
        <div class="mb-5 float-left">
          <a href="{{ route('flats.create') }}" class="btn btn-primary">Affitta un nuovo appartamento</a>
        </div>
      </div>
    </div>

    {{-- Appartamenti in affitto --}}
    @isset($flats)
      <ul class="list-unstyled">
        @foreach ($flats as $flat)

          @if ($loop -> first)
              <h2>Appartamenti in affitto</h2>
          @endif

        <li class="media mb-5 ">
          <div class="row justify-content-center">

            <div class="col-xs-12 col-md-3 col-lg-4">
              <img src="{{ asset($flat -> photos() -> first() -> path) }}" class="rounded img-thumbnail img-fluid" alt="Flat Image">
            </div>

            <div class="col-xs-12 col-md-9 col-lg-8">
              <div class="">
                <h5 class="mt-0 mb-1">{{ $flat -> title }}</h5>
                <p>{{ $flat -> desc }}</p>
              </div>
              <div class="">
                  <a href="{{ route('flats.show', $flat -> id) }}" class="btn btn-primary">Visualizza</a>
                  <a href="{{ route('flats.edit', $flat -> id) }}" class="btn btn-warning">Modifica</a>
                  <a href="{{ route('flats.statistics', $flat -> id) }}" class="btn btn-info">Statistiche</a>
                  <a href="{{ route('flats.sponsor.create', $flat -> id) }}" class="btn btn-secondary">Sponsorizza</a>
                  <a href="{{ route('flats.deactivate', $flat -> id) }}" class="btn btn-danger float-right">Disattiva</a>
                </div>
              </div>
            </div>
          </li>
            @endforeach
        </ul>
      @endisset

      {{-- Appartamenti disattivati --}}
      @isset($flatsTrashed)
        <ul class="list-unstyled">

          @foreach ($flatsTrashed as $flat)

            @if ($loop -> first)
                <h2>Appartamenti disattivati</h2>
            @endif

            <li class="media mb-5 ">
              <div class="row justify-content-center">

                <div class="col-xs-12 col-md-3 col-lg-4 opacity">
                  <img src="{{ asset($flat -> photos() -> first() -> path) }}" class="rounded img-thumbnail img-fluid" alt="Flat Image">
                </div>

                <div class="col-xs-12 col-md-9 col-lg-8">
                  <div class="opacity">
                    <h5 class="mt-0 mb-1">{{ $flat -> title }}</h5>
                    <p>{{ $flat -> desc }}</p>
                  </div>
                  <div class="">
                    <span class="text-danger float-right"><strong>Questo appartamento è disattivato</strong></span>
                    <a href="{{ route('flats.activate', $flat -> id) }}" class="btn btn-primary">Attiva</a>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        @endisset

    </div>

@endsection
