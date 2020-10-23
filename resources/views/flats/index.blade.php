@extends('layouts.app')

@section('content')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">

            <h1 class="mt-3">Benvenuto, {{ $firstname }}</h1>
            <div class="mb-3">
              <a href="{{ route('flats.create') }}"><strong><h4>Affitta un appartamento</h4></strong></a>
            </div>

            @isset($flats)

              <ul class="list-unstyled">
                @foreach ($flats as $flat)

                  {{-- @if ($loop->first && !$flat -> deleted_at)
                      <h2>Appartamenti in affitto</h2>
                  @endif

                  @if ($flat -> deleted_at)
                    <h2>Appartamenti disattivati</h2>
                  @endif --}}

                  <li class="media my-4">
                    <div style="width:200px" class="mr-3
                    @if ($flat -> trashed())
                      opacity
                    @endif
                    ">
                      <img src="{{ $flat -> photos -> first() -> url }}" class="rounded img-thumbnail img-fluid" alt="Flat Image">
                    </div>
                    <div class="media-body">
                      <div class="
                      @if ($flat -> trashed())
                        opacity
                      @endif
                      ">
                        <h5 class="mt-0 mb-1">{{ $flat -> title }}</h5>
                        <p>{{ $flat -> desc }}</p>
                      </div>
                      <div class="">
                        @if ($flat -> trashed())

                            <span class="text-danger float-right"><strong>Questo appartamento è disattivato</strong></span>
                            <a href="{{ route('flats.activate', $flat -> id) }}" class="btn btn-primary">Attiva</a>

                        @else
                          <a href="{{ route('flats.show', $flat -> id) }}" class="btn btn-primary">Visualizza</a>
                          <a href="{{ route('flats.deactivate', $flat -> id) }}" class="btn btn-danger float-right">Disattiva</a>
                        @endif
                      </div>
                    </div>
                  </li>

                @endforeach
              </ul>

            @endisset

          </div>
        </div>
      </div>

@endsection
