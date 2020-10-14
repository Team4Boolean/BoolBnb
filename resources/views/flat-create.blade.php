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
                        <input type="text" name="title" value="">
                      </div>
                      {{-- Descrizione --}}
                      <div class="form-group">
                        <label for="desc">Description:</label><br>
                        <textarea name="desc" rows="8" cols="80">{{ old('desc') }}</textarea>
                      </div>
                      {{-- Indirizzo --}}
                      <?php // DEBUG: Come trasformiamo l'indirizzo in coordinate? ?>
                      {{-- <div class="form-group">
                        <label for="views">Address:</label>
                        <input type="text" name="address" value="">
                      </div> --}}
                      <hr>
                      {{-- n* Stanze --}}
                      <div class="form-group">
                        <label for="rooms">Rooms:</label>
                        <input type="number" name="rooms" value="{{ old('n_rooms') }}">
                      </div>
                      {{-- n* letti --}}
                      <div class="form-group">
                        <label for="beds">Beds:</label>
                        <input type="number" name="beds" value="{{ old('n_beds') }}">
                      </div>
                      {{-- n* Bagni --}}
                      <div class="form-group">
                        <label for="bathrooms">Bathrooms:</label>
                        <input type="number" name="bathrooms" value="{{ old('n_bathrooms') }}">
                      </div>
                      {{-- metri quadri --}}
                      <div class="form-group">
                        <label for="sqm">Size:</label>
                        <input type="number" name="sqm" value="{{ old('sqm') }}"><span> m²</span>
                      </div>
                      {{-- servizi aggiuntivi --}}
                      <div class="form-group">
                        <label>Additional Services:</label>
                        <ul>
                          <li>
                            {{-- wifi --}}
                            <label for="wifi">Wifi:</label>
                            <input type="checkbox" name="wifi" value="{{ old('wifi') }}">
                          </li>
                          <li>
                            {{-- parking --}}
                            <label for="parking">Parking:</label>
                            <input type="checkbox" name="parking" value="{{ old('parking') }}">
                          </li>
                          <li>
                            {{-- swim --}}
                            <label for="swim">Swimming Pool:</label>
                            <input type="checkbox" name="swim" value="{{ old('swim') }}">
                          </li>
                          <li>
                            {{-- concierge --}}
                            <label for="concierge">Concierge:</label>
                            <input type="checkbox" name="concierge" value="{{ old('concierge') }}">
                          </li>
                          <li>
                            {{-- sauna --}}
                            <label for="sauna">Sauna:</label>
                            <input type="checkbox" name="sauna" value="{{ old('sauna') }}">
                          </li>
                          <li>
                            {{-- sea --}}
                            <label for="sea">Sea View:</label>
                            <input type="checkbox" name="sea" value="{{ old('sea') }}">
                          </li>
                        </ul>
                      </div>

                      {{-- image+preview --}}
                      <div class="form-group" runat="server">
                        <label for="image">Upload your flat's image:</label> <br><br>
                        <input type='file' name="image" id="imgInp" /> <br> <br>
                        <img id="prev" src="#" alt="your image" />
                      </div>

                      <button class="btn btn-primary" type="submit">Confirm</button>
                    </form>
                  </div>
              </div>
          </div>
      </div>
  </div>






@endsection
