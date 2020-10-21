@extends('layouts.app')
@section('content')

{{-- SHOW APPARTAMENTO --}}


  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h1>{{ $flat -> title }}</h1>
                  <h1></h1>
                </div>
                <div class="card-body">
                  <div class="row">
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
                      <div>

                      </div>
                      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ $flat -> photos -> first() -> url}}" alt="First slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="..." alt="Second slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="..." alt="Third slide">
                          </div>
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
                </div>
              </div>
          </div>
      </div>
  </div>

@endsection
