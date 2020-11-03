@extends('layouts.app')
@section('content')

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-xs-12 col-md-10">

        <div class="card">

          <div class="card-header">
            <a class="float-left" href="{{ route('flats.index') }}"><i class="fas fa-arrow-circle-left" style="font-size:40px"></i></a>
            <h1>Sponsorizza "{{ $flat -> title }}"</h1>
          </div>

          <div class="card-body">

            <form method="post" id="payment-form" action="{{route('api.flats.sponsor.make', $flat -> id )}}">
              @csrf
              @method('POST')

              <div class="form-row">

                <section id="sponsor" class="form-group col-6">
                  <label for="input-label amount"><h4>Scegli la modalità di sponsorizzazione</h4></label>
                  <select class="form-control" id="sponsor" name="sponsor">
                    <option>Scegli...</option>
                    <option @if (old('sponsor')==1) selected @endif value="1">Sponsorizza per 24 ore - 2,99€</option>
                    <option @if (old('sponsor')==2) selected @endif value="2">Sponsorizza per 72 ore - 5,99€</option>
                    <option @if (old('sponsor')==3) selected @endif value="3">Sponsorizza per 144 ore - 9,99€</option>
                  </select>
                </section>

                <section id="payment" class="form-group col-12 mt-4" hidden>
                  <h4>Metodo di pagamento</h4>
                  <div id="dropin-container"></div>
                </section>

                <div class="alert col-12" hidden>
                </div>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button id="submit-transition" class="btn btn-primary" type="submit" hidden>Effettua il pagamento</button>

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



    function addSponsorListener() {

      $("select#sponsor").change(getSponsor);
    }

    function getSponsor() {
      $('#dropin-container').html('');
      var sponsor = $(this).val();
      getPayment(sponsor);
    }

    function getPayment(sponsor) {

      $('section#payment').removeAttr('hidden');
      $('#submit-transition').removeAttr('hidden');

      var sponsor = sponsor;
      var flatId = {{ $flat -> id }}
      var button = $('#submit-transition');
      var form = $('#payment-form');

      braintree.dropin.create({
          authorization: '{{ $token }}',
          container: '#dropin-container',
          locale: 'it_IT'
      }, (err, dropinInstance) => {

        if (err) console.error('dropinInstance',err);

        button.on('click', event => {
          event.preventDefault();

          dropinInstance.requestPaymentMethod((err, payload) => {

            if (err) console.log('ErrorRequestPaymentMethod',err);

            $.ajax({
                type: "POST",
                url: "{{route('api.flats.sponsor.make', $flat -> id )}}",
                data: {
                  nonce: payload.nonce,
                  sponsor: sponsor,
                },
                success: function (data) {
                  console.log('success',payload.nonce)

                  if (data == '200') {
                    $('section#sponsor').attr('hidden',true);
                    $('section#payment').attr('hidden',true);
                    $('#submit-transition').attr('hidden',true);

                    var target = $('.alert');
                    target.removeAttr('hidden');
                    target.removeClass('alert-danger');
                    target.addClass('alert-success');
                    target.text("Il pagamento è andato a buon fine, l'appartamento è stato sponsorizzato.");
                  }

                },
                error: function (data) {
                  console.log('error',payload.nonce)

                  if (data == '400') {
                    var target = $('.alert');
                    target.removeAttr('hidden');
                    target.removeClass('alert-success');
                    target.addClass('alert-danger');
                    target.text("Errore, il pagamento non è andato a buon fine");
                  }
                }
            });
            // /Ajax
          });
        });
      });
      // /braintree.dropin.create
    }

    function init() {
      // protezione CSRF per la chiamata Ajax allo store del messaggio
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      addSponsorListener();
    }

    $(document).ready(init);

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
