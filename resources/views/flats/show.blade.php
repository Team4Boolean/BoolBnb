@extends('layouts.app')
@section('content')

{{-- SHOW APPARTAMENTO --}}

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                <div class="card-header"  style="background-image:{{$flat -> img}};">
                  <h1>{{ $flat -> title }}</h1>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <p>{{$this -> desc}}</p>
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
                </div>
              </div>
          </div>
      </div>
  </div>

@endsection
