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
                    <form class="flat-create" action="{{route('store-flat')}}" method="post">
                      @csrf
                      @method('POST')

                      {{-- INPUT DI TESTO --}}

                      <section class="textInput">
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
                      </section>
                        <hr>
                        {{-- ADDRESS --}}
                      <section class="addressInput">
                        <label>Address:</label>
                        <div class="adrInpList">
                          {{-- street name --}}
                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="street_name">Street Name</label>
                            </div>
                            <input type="text" id="street_name" class="form-control add_input" name="street_name" value="{{old('street_name')}}">
                          </div>
                          {{-- street number --}}
                          <div class="input-group input-group-sm mb-3 short-address">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="street_number">Street Number</label>
                            </div>
                            <input type="text" id="street_number" class="form-control add_input" name="street_number" value="{{old('street_number')}}">
                          </div>
                          {{-- municipality --}}
                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="municipality">Municipality</label>
                            </div>
                            <input type="text" id="municipality" class="form-control add_input" name="municipality" value="{{old('municipality')}}">
                          </div>
                          {{-- province --}}
                          <div class="input-group input-group-sm mb-3 short-address">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="subdivision">Province</label>
                            </div>
                            <input type="text" id="subdivision" class="form-control add_input" name="subdivision" value="{{old('subdivision')}}">
                          </div>
                          {{-- cap --}}
                          <div class="input-group input-group-sm mb-3 short-address">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="postal_code">CAP</label>
                            </div>
                            <input type="text" id="postal_code" class="form-control add_input" name="postal_code" value="{{old('postal_code')}}">
                          </div>

                          {{-- latitudine/longitudine nascosti --}}
                          <div class="form-group" style="display:none">
                              <label for="lon">LONGITUDINE</label>
                              <br>
                              <input id="lon" type="text" name="lon" value="">
                          </div>
                          <div class="form-group" style="display:none">
                              <label for="lat">LATITUDINE</label>
                              <br>
                              <input id="lat" type="text" name="lat" value="">
                          </div>
                        </div>
                      </section>

                      <hr>
                      {{-- INPUT NUMERICI --}}

                      <section class="numInput">
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
                      </section>

                      {{-- INPUT SERVIZI (checkbox) --}}

                      <section class="checkInput">
                        <div class="form-group">
                          <label>Additional Services:</label>
                          <ul>
                            <li>
                              {{-- wifi --}}
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
                      </section>

                      {{-- INPUT IMMAGINE --}}

                      <section class="imgInput">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="img">Upload your flat's image</label>
                          </div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="imgInp" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="img">Choose file</label>
                          </div>
                        </div>
                        <div id="prevContainer" class="img-container">
                          <img id="prev" src="#" class="img-thumbnail">
                        </div>
                      </section>


                      {{-- btn group --}}
                      <section class="btnInput">
                        <a href="{{route('home')}}"><i class="fas fa-arrow-circle-left"></i></a>
                        <button class="btn btn-primary" type="submit">Confirm</button>
                      </section>
                    </form>
                  </div>
              </div>
          </div>
      </div>
  </div>






@endsection
