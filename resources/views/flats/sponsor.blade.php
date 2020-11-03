@extends('layouts.app')
@section('content')

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-xs-12 col-md-8">

        <div class="card">

          <div class="card-header">
            <a class="float-left" href="{{ url()->previous() }}"><i class="fas fa-arrow-circle-left" style="font-size:40px"></i></a>
            <h1>Sponsorizza "{{ $flat -> title }}"</h1>
          </div>

          <div class="card-body">

            <form method="get" id="payment-form" action="">
              @csrf
              @method('GET')

              <div class="form-row">

                <div class="form-group col-12">
                  <label for="input-label amount"><h4>Scegli la modalità di sponsorizzazione</h4></label>
                  <select class="form-control" id="sponsor" name="sponsor">
                    <option @if (old('sponsor')==1) selected @endif value="1">Sponsorizza per 24 ore - 2,99€</option>
                    <option @if (old('sponsor')==2) selected @endif value="2">Sponsorizza per 72 ore - 5,99€</option>
                    <option @if (old('sponsor')==3) selected @endif value="3">Sponsorizza per 144 ore - 9,99€</option>
                  </select>
                </div>

                <div class="form-group col-12 mt-4">
                  <h4>Metodo di pagamento</h4>
                  <div id="dropin-container"></div>
                </div>

                <div class="alert" hidden>
                </div>

                @if (session('success_message'))
                  <div class="alert alert-success">
                    {{session('success_message')}}
                  </div>
                @endif
                @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button id="submit-transition" class="btn btn-primary" type="submit">Effettua il pagamento</button>

              </div>
            </form>

          </div>
          {{-- /card-body --}}
        </div>
        {{-- /card --}}

      </div>
    </div>

  </div>
  {{-- /container --}}

  <script>

    var button = $('#submit-transition');

    braintree.dropin.create({
        authorization: '{{ $token }}',
        container: '#dropin-container'
    }, function (createErr, instance) {
      button.on('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type: "POST",
              url: "{{route('flats.sponsor.make', $flat -> id )}}",
              data: {
                nonce : payload.nonce
              },
              success: function (data) {
                  console.log('success',payload.nonce)
              },
              error: function (data) {
                  console.log('error',payload.nonce)
              }
          });

        });
      });
    });
  </script>

  {{-- <script>

    var button = $('#submit-transition');

    braintree.dropin.create({
      authorization: "{{ $token }}",
      container: '#dropin-container'
      }, function (createErr, instance) {
        button.on('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.get("{{ route('flats.sponsor.make', $flat -> id ) }}", {payload}, function (response) {
            if (response.success) {
              console.log('success');
              alert('Payment Successful!');
            } else {
              console.log('ERROR');
              alert('Payment failed');
            }
          }, 'json');
        });
      });
    });

  </script> --}}

@endsection
