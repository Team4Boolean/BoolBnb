@extends('layouts.app')

@section('content')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">

            <h1 class="mt-3">Benvenuto, {{ $firstname }}</h1>
            <div class="mb-3">
              <a href="{{ route('flats.create') }}">Affitta un appartamento</a>
            </div>


            @isset($flats)

              {{-- <h2>Appartamenti in affitto</h2> --}}

              <ul class="list-unstyled">
                @foreach ($flats as $flat)
                  <li class="media my-4">
                    <div style="width:200px" class="mr-3">
                      <img src="{{ $flat -> photos -> first() -> url }}" class="rounded img-thumbnail img-fluid" alt="Flat Image">
                    </div>
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">{{ $flat -> title }}</h5>
                      {{ $flat -> desc }}
                      <div class="">
                        <a href="{{ route('flats.show', $flat -> id) }}" class="btn btn-primary">Visualizza</a>
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
