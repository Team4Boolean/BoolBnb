@extends('layouts.app')
@section('content')

{{-- SHOW APPARTAMENTO --}}


  <div id="flatShow" class="container">
      <div class="row justify-content-center">
          <div class="col-md-10">
            <div id="main-card" class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-12">
                    <h1>{{ $flat -> title }}</h1>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row row-spacer">
                  <div class="col">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        @php
                        $i = 0;
                        @endphp
                        @foreach ($flat -> photos as $indicator)
                          @if ($i == 0)
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>

                          @else
                            <li data-target="#carouselExampleIndicators" data-slide-to="@php $i @endphp"></li>
                          @endif


                          @php
                          $i++
                          @endphp
                        @endforeach


                      </ol>
                      <div class="carousel-inner">
                        @php
                        $bool = true;
                        @endphp
                        @foreach ($flat -> photos as $img)
                          @if ($bool)
                            <div class="carousel-item active">
                              <img class="d-block w-100" src="{{ $img -> url }}" alt="First slide">
                            </div>
                            @php
                            $bool = false;
                            @endphp
                          @else
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{ $img -> url }}" alt="First slide">
                            </div>
                          @endif

                        @endforeach
                      </div>

                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="row row-spacer">
                  <div class="col">
                    <p>{{$flat -> desc}}</p>
                  </div>
                  <div class="col">
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Rooms
                        <span class="badge badge-danger">{{$flat -> rooms}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Beds
                        <span class="badge badge-danger">{{$flat -> beds}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Bathrooms
                        <span class="badge badge-danger">{{$flat -> baths}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Size
                        <span class="badge badge-danger">{{$flat -> sqm}}</span>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row row-spacer">
                  <div class="services col">
                    @foreach ($flat -> services as $service)
                      <div class="service-item">
                        @if ($service -> name == 'WiFi')
                          <i class="fas fa-wifi"></i>
                          <span class="serv-info">
                            Wifi
                          </span>
                        @elseif ($service -> name == 'Posto Macchina')
                          <i class="fas fa-parking"></i>
                          <span class="serv-info">
                            Posto Macchina
                          </span>
                        @elseif ($service -> name == 'Piscina')
                          <i class="fas fa-swimming-pool"></i>
                          <span class="serv-info">
                            Piscina
                          </span>
                        @elseif ($service -> name == 'Portineria')
                          <i class="fas fa-door-closed"></i>
                          <span class="serv-info">
                            Portineria
                          </span>
                        @elseif ($service -> name == 'Sauna')
                          <i id="serv-item" class="fas fa-hot-tub"></i>
                          <span class="serv-info">
                            Sauna
                          </span>
                        @elseif ($service -> name == 'Vista Mare')
                          <i class="fas fa-water"></i>
                          <span class="serv-info">
                            Vista Mare
                          </span>
                        @endif
                      </div>
                    @endforeach
                  </div>
                </div>
                <div class="row row-spacer">
                  <div class="col-6">
                    {{-- MAPPA --}}
                    <div class="">
                      qua c'è la mappaaaaaa
                      {{-- latitudine --}}
                      <input type="text" name="lat" value="{{ $flat -> lat }}" style="display: none;">
                      {{-- longiudine --}}
                      <input type="text" name="lon" value="{{ $flat -> lon }}" style="display: none;">
                    </div>
                  </div>
                  <div class="col-6">
                    {{-- MESSAGGI --}}
                    <form id="messageBox">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="h3">Scrivi al proprietario</h3>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col col-form-label">La tua email</label>
                            <div class="col-sm-12">
                              <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputTextarea" class="col col-form-label">Messaggio</label>
                            <div class="col-sm-12">
                              <textarea class="form-control" id="inputTextarea" name="messaggio" rows="8" cols="80" placeholder="Inserisci il testo"></textarea>
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
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>

@endsection
