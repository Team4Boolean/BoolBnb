@extends('layouts.app')
@section('content')

{{-- CREAZIONE APPARTAMENTO --}}

  <div class="container">

      <div class="row justify-content-center">
          <div class="col-md-10">

              <div class="card">
                {{-- Titolo pagina cardheader --}}
                  <div class="card-header">
                    <h1>Pubblica il tuo appartamento:</h1>
                  </div>

                  {{-- card body --}}
                  <div class="card-body">

                    {{-- @include('partials.input-errors') --}}

                    {{-- FORM --}}
                    <form class="flat-create" action="{{ route('flats.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      @method('POST')

                      <div class="form-row">

                        {{-- INPUT DI TESTO --}}
                        <section class="textInput col-lg-7 col-md-6">
                          {{-- Titolo --}}
                          <div id="input-title" class="input-group mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="title"><h6>Titolo</h6></label>
                            </div>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
                            @error('title')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          {{-- Descrizione --}}
                          <div id="input-desc" class="form-group">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="desc"><h6>Descrizione</h6></label>
                            </div>
                            <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" rows="8" cols="80">{{ old('desc') }}</textarea>
                            @error('desc')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </section>

                        {{-- INPUT NUMERICI --}}
                        <section class="numInput  offset-md-1 col-lg-4 col-md-5 pt-4">
                          {{-- n* Stanze --}}
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="rooms">Stanze</label>
                            </div>
                            <select class="custom-select @error('rooms') is-invalid @enderror" name="rooms">
                              <option selected>Scegli...</option>
                              <option @if (old('rooms')==1) selected @endif value="1">1</option>
                              <option @if (old('rooms')==2) selected @endif value="2">2</option>
                              <option @if (old('rooms')==3) selected @endif value="3">3</option>
                              <option @if (old('rooms')==4) selected @endif value="4">4</option>
                              <option @if (old('rooms')==5) selected @endif value="5">5</option>
                            </select>
                            @error('rooms')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          {{-- n* letti --}}
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="beds">Letti</label>
                            </div>
                            <select class="custom-select @error('beds') is-invalid @enderror" name="beds">
                              <option selected>Scegli...</option>
                              <option @if (old('beds')==1) selected @endif value="1">1</option>
                              <option @if (old('beds')==2) selected @endif value="2">2</option>
                              <option @if (old('beds')==3) selected @endif value="3">3</option>
                              <option @if (old('beds')==4) selected @endif value="4">4</option>
                              <option @if (old('beds')==5) selected @endif value="5">5</option>
                            </select>
                            @error('beds')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          {{-- n* Bagni --}}
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="baths">Bagni</label>
                            </div>
                            <select class="custom-select @error('baths') is-invalid @enderror" name="baths">
                              <option selected>Scegli...</option>
                              <option @if (old('baths')==1) selected @endif value="1">1</option>
                              <option @if (old('baths')==2) selected @endif value="2">2</option>
                              <option @if (old('baths')==3) selected @endif value="3">3</option>
                            </select>
                            @error('baths')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          {{-- metri quadri --}}
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="sqm">Size</label>
                            </div>
                            <input class="form-control @error('sqm') is-invalid @enderror" type="number" name="sqm" value="{{ old('sqm') }}">
                            <div class="input-group-prepend">
                              <label class="input-group-text radius" for="sqm">m²</label>
                            </div>
                            @error('sqm')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </section>

                      </div>
                      {{-- /form-row --}}

                      {{-- ADDRESS --}}
                      <section class="addressInput">
                        <div class="sec-title mx-auto m-3">
                          <h5>Indirizzo</h5>
                        </div>
                        <div class="adrInpList">
                          <div class="form-row mb-4">
                            {{-- street name --}}
                            <div class="input-group input-group-md col-md-8">
                              <input type="text" id="street_name" class="form-control get-coord @error('street_name') is-invalid @enderror" name="street_name" value="{{old('street_name')}}" placeholder="Via ...">
                                @error('street_name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>

                            {{-- street number --}}
                            <div class="input-group input-group-md col-md-4">
                              <input type="text" id="street_number" class="form-control get-coord @error('street_number') is-invalid @enderror" name="street_number" value="{{old('street_number')}}" placeholder="n°">
                                @error('street_number')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                          </div>

                          <div class="form-row  mb-4">
                            {{-- province --}}
                            <div class="input-group input-group-md col-md-5">
                              <input type="text" id="subdivision" class="form-control get-coord @error('subdivision') is-invalid @enderror" name="subdivision" value="{{old('subdivision')}}" placeholder="Provincia">
                                @error('subdivision')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>

                            {{-- municipality --}}
                            <div class="input-group input-group-md col-md-5 mb-3">
                              <input type="text" id="municipality" class="form-control get-coord @error('municipality') is-invalid @enderror" name="municipality" value="{{old('municipality')}}" placeholder="Città">
                                @error('municipality')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>

                            {{-- cap --}}
                            <div class="input-group input-group-md col-md-2">
                              <input type="text" id="postal_code" class="form-control get-coord @error('postal_code') is-invalid @enderror" name="postal_code" value="{{old('postal_code')}}" placeholder="cap">
                                @error('postal_code')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
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
                      {{-- /address --}}


                      {{-- INPUT SERVIZI (checkbox) --}}
                      <section class="checkInput">
                        <div class="form-group">
                          <div class="sec-title mx-auto m-3">
                            <h5>Servizi</h5>
                          </div>
                          <div class="form-row m-4">
                            <div class="serv-list col">
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="1" class="custom-control-input" id="defaultInline1" {{ (is_array(old('services')) and in_array(1, old('services'))) ? ' checked' : '' }}>
                                <label class="custom-control-label" for="defaultInline1">
                                Wifi
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="2" class="custom-control-input" id="defaultInline2" {{ (is_array(old('services')) and in_array(2, old('services'))) ? ' checked' : '' }}>
                                <label class="custom-control-label" for="defaultInline2">Parcheggio</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="3" class="custom-control-input" id="defaultInline3" {{ (is_array(old('services')) and in_array(3, old('services'))) ? ' checked' : '' }}>
                                <label class="custom-control-label" for="defaultInline3">Piscina</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="4" class="custom-control-input" id="defaultInline4" {{ (is_array(old('services')) and in_array(4, old('services'))) ? ' checked' : '' }}>
                                <label class="custom-control-label" for="defaultInline4">Portinaio</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="5" class="custom-control-input" id="defaultInline5" {{ (is_array(old('services')) and in_array(5, old('services'))) ? ' checked' : '' }}>
                                <label class="custom-control-label" for="defaultInline5">Sauna</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="6" class="custom-control-input" id="defaultInline6" {{ (is_array(old('services')) and in_array(6, old('services'))) ? ' checked' : '' }}>
                                <label class="custom-control-label" for="defaultInline6">Vista Mare</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>

                      {{-- INPUT IMMAGINE --}}
                      <section class="imgInput">

                        <div class="input-group mb-3">

                          <div class="input-group-prepend">
                            <label class="input-group-text" for="imgInp">Immagine dell'appartamento</label>
                          </div>

                          <div class="custom-file">
                            <input type="file" class="custom-file-input @error('img') is-invalid @enderror" name="img" id="imgInp" aria-describedby="inputGroupFileAddon01" multiple>
                            <label class="custom-file-label" for="img" >Scegli la foto da caricare</label>
                          </div>

                        </div>

                          @error('img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror


                        <div id="prevContainer" class="img-container" style="text-align:center; display:none;" >
                          <img id="prev" src="#" class="img-thumbnail">
                        </div>

                      </section>
                      {{-- /INPUT IMMAGINE --}}

                      {{-- btn group --}}

                      <section class="btnInput">
                        <a href="{{ url()->previous() }}"><i class="fas fa-arrow-circle-left"></i></a>
                        <button class=" btn-primary" type="submit">Conferma</button>
                      </section>

                    </form>
                    {{-- /FORM principale --}}

                    {{-- <section id="ImgInput" style="padding-top:90px; text-align:center;">
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
                          <div class='content'>
                            <!-- Dropzone -->
                            <form action="{{route('dropzone.store')}}" class='dropzone' id="dropzone" >

                            </form>
                          </div>
                          <vue-dropzone
                            ref="myVueDropzone" id="dropzone" :
                            options="dropzoneOptions">
                          </vue-dropzone>
                        </div>
                      </div>
                    </section> --}}

                  </div>
                  {{-- /card-body--}}

              </div>
              {{-- /card --}}

          </div>
      </div>

  </div>

@endsection
