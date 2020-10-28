@extends('layouts.app')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header"><h1>Sponsorizza il tuo appartamento</h1></div>
    <div class="card-body">
      <form method="post" id="payment-form" action="{{route('sponsor.checkout')}}">
        @csrf
        <div class="row">
          <div class="col-md-6">
              {{-- <label for="amount">
                <span class="input-label">Seleziona l'offerta:</span>
                <div class="input-wrapper amount-wrapper">
                  <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                </div>
              </label> --}}
            <div class="form-group">
              <label for="input-label amount">Seleziona il metodo di sponsorizzazione:</label>
              <select multiple class="form-control" id="amount" name="amount" type="tel">
                <option value="2.99">Sponsorizza per 24 ore - 2,99€</option>
                <option value="5.99">Sponsorizza per 72 ore - 5,99€</option>
                <option value="9.99">Sponsorizza per 144 ore - 9,99€</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="bt-drop-in-wrapper">
              <div id="bt-dropin"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="btn btn-primary" type="submit"><span>Effettua il pagamento</span></button>
          </div>
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
      </form>
      <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
      <script>
      var form = document.querySelector('#payment-form');
      var client_token = "{{ $token }}";

      braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        paypal: {
          flow: 'vault'
        }
      }, function (createErr, instance) {
        if (createErr) {
          console.log('Create Error', createErr);
          return;
        }
        form.addEventListener('submit', function (event) {
          event.preventDefault();

          instance.requestPaymentMethod(function (err, payload) {
            if (err) {
              console.log('Request Payment Method Error', err);
              return;
            }

            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
          });
        });
      });

      $('.braintree-heading').text('Scegli il metodo di pagamento:');
      </script>
    </div>
  </div>
</div>

@endsection
