@extends('layouts.app')
@section('content')

{{-- SHOW APPARTAMENTO --}}



  <div id="flatShow" class="container">
      <div class="row justify-content-center">

          <div class="col-md-12">

            <div id="main-card" class="card">

              <div class="card-header">
                <div class="row">
                  <div class="col-sm-12 d-flex justify-content-start">
                    <a id="back-btn" class="my-4 btn " href="{{ url()->previous() }}"> <i class="fas fa-arrow-circle-left"></i> </a>
                    <h1>{{ $flat -> title }}</h1>
                  </div>
                </div>
              </div>

              <div class="card-body">

                {{-- slide show carosello --}}
                <div class="row row-spacer">

                  <div class="col-md-10 offset-md-1">
                    {{-- data-ride: fa partire l'animazione al caricamento della pagina --}}
                    <div id="carouselIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                      {{-- carosello indicatori --}}
                      <ol class="carousel-indicators">
                        @foreach ($flat -> photos as $key => $value)
                          @if ($loop -> first)
                            <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                          @else
                            <li data-target="#carouselIndicators" data-slide-to="@php $key @endphp"></li>
                          @endif
                        @endforeach
                      </ol>
                      {{-- carosello immagini --}}
                      <div class="carousel-inner">
                        @foreach ($flat -> photos as $img)
                          @if ($loop -> first)
                            <div class="carousel-item active">
                              <img class="d-block w-100" src="{{ asset($img -> path) }}" alt="First slide">
                            </div>
                          @else
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{ asset($img -> path) }}" alt="First slide">
                            </div>
                          @endif
                        @endforeach
                      </div>
                      {{-- carosello controlli --}}
                      <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>

                </div>

                {{-- descrizione e caratteristiche --}}
                <div class="row row-spacer">
                  <div class="col">
                    <h3>Descrizione</h3>
                    <p>{{$flat -> desc}}</p>
                    <h3>Indirizzo</h3>
                    <p>{{$flat -> street_name}}, {{$flat -> street_number}}<br>
                      {{$flat -> postal_code}}, {{$flat -> municipality}} ({{$flat -> subdivision}})</p>
                  </div>
                  <div class="col">
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="span-serv">Rooms</span>
                        <h4><span class="badge badge-success">{{$flat -> rooms}}</span></h4>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="span-serv">Beds</span>
                        <h4><span class="badge badge-success">{{$flat -> beds}}</span></h4>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="span-serv">Bathrooms</span>
                        <h4><span class="badge badge-success">{{$flat -> baths}}</span></h4>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="span-serv">Size</span>
                        <h4><span class="badge badge-success">{{$flat -> sqm}}</span></h4>
                      </li>
                    </ul>

                    {{-- servizi --}}
                    <div class="services">
                      @foreach ($flat -> services as $service)
                        <div class="service-item">
                          @if ($service -> name == 'wifi')
                            <i class="fas fa-wifi"></i>
                            <span class="serv-info">
                              Wifi
                            </span>
                          @elseif ($service -> name == 'parking')
                            <i class="fas fa-parking"></i>
                            <span class="serv-info">
                              Posto Macchina
                            </span>
                          @elseif ($service -> name == 'swim')
                            <i class="fas fa-swimming-pool"></i>
                            <span class="serv-info">
                              Piscina
                            </span>
                          @elseif ($service -> name == 'concierge')
                            <i class="fas fa-door-closed"></i>
                            <span class="serv-info">
                              Portineria
                            </span>
                          @elseif ($service -> name == 'sauna')
                            <i id="serv-item" class="fas fa-hot-tub"></i>
                            <span class="serv-info">
                              Sauna
                            </span>
                          @elseif ($service -> name == 'sea')
                            <i class="fas fa-water"></i>
                            <span class="serv-info">
                              Vista Mare
                            </span>
                          @endif
                        </div>
                      @endforeach
                    </div>

                  </div>
                </div>

                {{-- mappa e messaggi --}}
                <div class="row row-spacer">

                  <div class="col-xs-12 col-md-12 col-lg-6">
                    {{-- MAPPA --}}
                    <div id="map" defer>

                    </div>
                    {{-- latitudine --}}
                    <input id="lat" type="text" name="lat" value="{{ $flat -> lat }}" style="display: none;">
                    {{-- longiudine --}}
                    <input id="lon" type="text" name="lon" value="{{ $flat -> lon }}" style="display: none;">
                  </div>

                  {{-- MESSAGGI --}}
                  <div class="col-xs-12 col-md-12 col-lg-6">

                    <form id="messageBox" action="{{ route('messages.store', $flat -> id) }}" method="post">
                      @csrf
                      @method('POST')

                      <div class="card">
                        <div class="card-header">
                          <h3 class="h3">Scrivi al proprietario</h3>
                        </div>

                        <div class="card-body">

                          @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                          @endif

                          <div class="form-group row">
                            <label for="inputEmail3" class="col col-form-label">La tua email</label>
                            <div class="col-sm-12">
                              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail3" placeholder="Email"
                              value = "
                                      @guest
                                        {{ old('email') }}
                                      @endguest

                                      @auth
                                        {{ old('email', $flat -> user -> email) }}
                                      @endauth
                              "
                              required>
                              @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputTextarea" class="col col-form-label">Messaggio</label>
                            <div class="col-sm-12">
                              <textarea class="form-control @error('message') is-invalid @enderror" id="inputTextarea" name="message" rows="8" cols="80" placeholder="Inserisci il testo" required>{{ old('message') }}</textarea>
                              @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <button type="submit" class="btn btn-primary">Invia</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </form>

                  </div>
                  {{-- /MESSAGGI --}}
                </div>
                {{-- /mappa e messaggi --}}

              </div>
              {{-- card-body --}}

            </div>
            {{-- card --}}

          </div>
      </div>
  </div>

@endsection
