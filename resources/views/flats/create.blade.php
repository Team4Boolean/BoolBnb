@extends('layouts.app')
@section('content')

{{-- CREAZIONE APPARTAMENTO --}}

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                {{-- Titolo pagina cardheader --}}
                  <div class="card-header">
                    <h1>Pubblica il tuo appartamento:</h1>
                  </div>
                  <div class="card-body">

                    @include('partials.input-errors')

                    {{-- FORM --}}
                    <form class="flat-create" action="{{ route('flats.store') }}" method="post">
                      @csrf
                      @method('POST')

                      {{-- INPUT DI TESTO --}}

                      <section class="textInput">
                        {{-- Titolo --}}
                        <div class="form-group">
                          <label class="label-title" for="title">Title:</label>
                          <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
                          @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        {{-- Descrizione --}}
                        <div class="form-group">
                          <label class="label-title" for="desc">Descrizione:</label><br>
                          <textarea class="form-control" name="desc" rows="8" cols="80">{{ old('desc') }}</textarea>
                        </div>
                      </section>
                        <hr>
                        {{-- ADDRESS --}}
                      <section class="addressInput">
                        <label class="label-title">Indirizzo:</label>
                        <div class="adrInpList">
                          {{-- street name --}}
                          <div class="input-group input-group-sm mb-3 long-address">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="street_name">Via</label>
                            </div>
                            <input type="text" id="street_name" class="form-control add_input" name="street_name" value="{{old('street_name')}}">
                          </div>
                          {{-- street number --}}
                          <div class="input-group input-group-sm mb-3 short-address">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="street_number">N°</label>
                            </div>
                            <input type="text" id="street_number" class="form-control add_input" name="street_number" value="{{old('street_number')}}">
                          </div>
                          {{-- province --}}
                          <div class="input-group input-group-sm mb-3 long-address">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="subdivision">Provincia</label>
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
                          {{-- municipality --}}
                          <div class="input-group input-group-sm mb-3 short-address">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="municipality">Città</label>
                            </div>
                            <input type="text" id="municipality" class="form-control add_input" name="municipality" value="{{old('municipality')}}">
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
                            <label class="input-group-text" for="rooms">Stanze</label>
                          </div>
                          <select class="custom-select" name="rooms">
                            <option selected>Scegli...</option>
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
                            <label class="input-group-text" for="beds">Letti</label>
                          </div>
                          <select class="custom-select" name="beds">
                            <option selected>Scegli...</option>
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
                            <label class="input-group-text" for="baths">Bagni</label>
                          </div>
                          <select class="custom-select" name="baths">
                            <option selected>Scegli...</option>
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
                            <label class="input-group-text radius" for="sqm">m²</label>
                          </div>
                        </div>
                      </section>

                      {{-- INPUT SERVIZI (checkbox) --}}

                      <section class="checkInput">
                        <div class="form-group">
                          <label class="label-title">Servizi Aggiuntivi:</label>
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
                                <label><input type="checkbox" name="parking" value="{{ old('parking') }}"> Parcheggio</label>
                              </div>
                            </li>
                            <li>
                              {{-- swim --}}
                              <div class="checkbox">
                                <label><input type="checkbox" name="swim" value="{{ old('swim') }}"> Piscina</label>
                              </div>
                            </li>
                            <li>
                              {{-- concierge --}}
                              <div class="checkbox">
                                <label><input type="checkbox" name="concierge" value="{{ old('concierge') }}"> Portinaio</label>
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
                                <label><input type="checkbox" name="sea" value="{{ old('sea') }}"> Vista Mare</label>
                              </div>
                            </li>

                          </ul>
                        </div>
                      </section>

                      {{-- INPUT IMMAGINE --}}


                      {{-- <section class="imgInput">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="img">Carica la tua immagine</label>
                          </div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="imgInp" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="img">Scegli file</label>
                          </div>
                        </div>
                        <div id="prevContainer" class="img-container">
                          <img id="prev" src="#" class="img-thumbnail">
                        </div>
                      </section> --}}
                      {{-- btn group --}}

                      <section class="btnInput">
                        <a href="{{ route('home') }}"><i class="fas fa-arrow-circle-left"></i></a>
                        <button class="btn btn-primary" type="submit">Conferma</button>
                      </section>
                    </form>
                    <section id="ImgInput" style="padding-top:90px;">
                      {{-- <div class="container"> --}}
                        <div class="row">
                          <div class="col-md-12">
                            <form method="POST" action="{{route('dropzone.store')}}" accept-charset="UTF-8" enctype="multipart/form-data" class="dropzone dz-clickable" id="image-upload">
                              @csrf
                              <div>
                                <h3>Carica le immagini del tuo appartamento</h3>
                              </div>
                              <div class="dz-default dz-message">
                                <span>
                                  Trascina le immagini qui per caricarle
                                </span>
                              </div>
                            </form>
                          </div>
                        </div>
                      {{-- </div> --}}
                    </section>

                    <script>
                      Dropzone.options.imageUpload = {
                        maxFilesize: 10000,
                        acceptedFiles:".jpeg,.jpg,.png,.gif"
                      };
                    </script>
                  </div>
              </div>
          </div>
      </div>
  </div>






@endsection
