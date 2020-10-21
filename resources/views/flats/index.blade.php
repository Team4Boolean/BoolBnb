@extends('layouts.app')

@section('content')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-10">

            <h1>{{ $message }}</h1>
            <a href="{{ route('flats.create') }}">Affitta un appartamento</a>

            @isset($flats)

              <h2>Appartamenti in affitto</h2>

              <ul class="list-unstyled">
                @foreach ($flats as $flat)
                  <li class="media my-4">
                    <img src="{{ $flat -> photos -> first() -> url }}" class="mr-3 rounded img-thumbnail img-fluid" alt="Flat Image">
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">{{ $flat -> title }}</h5>
                      {{ $flat -> desc }}
                    </div>
                    <div class="media-footer">
                      <a href="{{ route('flats.show', $flat -> id) }}" class="btn btn-primary">Visualizza</a>
                    </div>
                  </li>
                @endforeach
              </ul>

            @endisset

          </div>
        </div>
      </div>

@endsection
