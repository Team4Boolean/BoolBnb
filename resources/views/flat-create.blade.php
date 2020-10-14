@extends('layouts.app')
@section('content')

{{-- CREAZIONE APPARTAMENTO --}}

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                {{-- Titolo pagina cardheader --}}
                  <div class="card-header">
                    <h1>New Flat:</h1>
                  </div>
                  <div class="card-body">
                    {{-- FORM --}}
                    <form action="{{route('store-flat')}}" method="post">
                      @csrf
                      @method('POST')
                      {{-- Titolo --}}
                      <div class="form-group">
                        <label for="title">Title:</label>
                        <input class="form-control" type="text" name="title" value="">
                      </div>
                      {{-- Descrizione --}}
                      <div class="form-group">
                        <label for="desc">Description:</label><br>
                        <textarea class="form-control" name="desc" rows="8" cols="80">{{ old('desc') }}</textarea>
                      </div>
                      {{-- Indirizzo --}}
                      <?php // DEBUG: Come trasformiamo l'indirizzo in coordinate? ?>
                      {{-- <div class="form-group">
                        <label for="views">Address:</label>
                        <input type="text" name="address" value="">
                      </div> --}}
                      <hr>
                      {{-- n* Stanze --}}
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="rooms">Rooms</label>
                        </div>
                        <select class="custom-select" name="rooms">
                          <option selected>Choose...</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                      {{-- n* letti --}}

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="beds">Beds</label>
                        </div>
                        <select class="custom-select" name="beds">
                          <option selected>Choose...</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="3">4</option>
                          <option value="3">5</option>
                        </select>
                      </div>
                      {{-- n* Bagni --}}
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="baths">Bathrooms</label>
                        </div>
                        <select class="custom-select" name="baths">
                          <option selected>Choose...</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                      </div>
                      {{-- metri quadri --}}
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="sqm">Size</label>
                        </div>
                        <input class="form-control" type="number" name="sqm" value="{{ old('sqm') }}">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="sqm">m²</label>
                        </div>
                      </div>
                      {{-- servizi aggiuntivi --}}
                      <div class="form-group">
                        <label>Additional Services:</label>
                        <ul style="list-style:none;">
                          <li>
                            <div class="checkbox">
                              <label><input type="checkbox" name="wifi" value="{{ old('wifi') }}"> Wifi</label>
                            </div>
                          </li>
                          <li>
                            {{-- parking --}}
                            <div class="checkbox">
                              <label><input type="checkbox" name="parking" value="{{ old('parking') }}"> Parking</label>
                            </div>
                          </li>
                          <li>
                            {{-- swim --}}
                            <div class="checkbox">
                              <label><input type="checkbox" name="swim" value="{{ old('swim') }}"> Swimming Pool</label>
                            </div>
                          </li>
                          <li>
                            {{-- concierge --}}
                            <div class="checkbox">
                              <label><input type="checkbox" name="concierge" value="{{ old('concierge') }}"> Doorkeeper</label>
                            </div>
                          </li>
                          <li>
                            {{-- sauna --}}
                            <div class="checkbox">
                              <label><input type="checkbox" name="sauna" value="{{ old('sauna') }}"> Sauna</label>
                            </div>
                          </li>
                          <li>
                            {{-- sea --}}
                            <div class="checkbox">
                              <label><input type="checkbox" name="sea" value="{{ old('sea') }}"> Sea View</label>
                            </div>
                          </li>

                        </ul>
                      </div>

                      {{-- image+preview --}}

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="img">Upload your flat's image</label>
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="img" id="imgInp" aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="img">Choose file</label>
                        </div>
                        <img id="prev" src="#" class="img-thumbnail">
                      </div>

                      {{-- btn group --}}
                      <button class="btn btn-primary" type="submit">Confirm</button>
                      <a href="{{route('home')}}"><i class="fas fa-arrow-circle-left" style="font-size: 30px;"></i></a>
                    </form>
                  </div>
              </div>
          </div>
      </div>
  </div>






@endsection
