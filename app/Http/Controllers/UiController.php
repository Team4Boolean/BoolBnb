<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// richiama Ui Message Request
use App\Http\Requests\UiMessageRequest;

use Illuminate\Support\Facades\DB;

use App\Flat;
use App\Sponsor;
use App\Message;
use App\Visit;

class UiController extends Controller
{

  public function home() {

      $sponsored = Flat::has('sponsors')
                  -> inRandomOrder()
                  -> take(8)
                  -> get();
                // -> paginate(6);

      return view('homepage', compact('sponsored'));
  }

  public function flatSearch(Request $request) {

    $data = $request -> validate([
      'loc' => 'required|max:255',
      'lat' => 'required',
      'lon' => 'required'
    ]);
    // dd($data);
    $loc = $data['loc'];
    $lat = $data['lat'];
    $lon = $data['lon'];

    $dist = 20;
    $rooms = 0;
    $beds = 0;

    if ($lat !== null && $lon !== null) {

      // prendo gli appartamenti a meno di 20KM di distanza dalla località cercata
      $distance = "( 6367 * acos( cos( radians(".$lat.") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(".$lon.") ) + sin( radians(".$lat.") ) * sin( radians( lat ) ) ) )  AS distance";

      $flats = Flat::select("flats.*",
                        DB::raw($distance),
                        DB::raw("(select flat_sponsor.sponsor_id from flat_sponsor where flat_sponsor.flat_id=flats.id LIMIT 1) AS sponsored")
                        )
        -> leftJoin('flat_sponsor', 'flat_sponsor.flat_id', '=', 'flats.id')
        -> having('distance', '<', $dist)
        -> orderBy('sponsored','DESC')
        -> orderBy('distance','ASC')
        -> get();

      return view('flats.search', compact('flats','loc','lat','lon','dist','rooms','beds'));
      } else {
        return back() -> with("error", "Inserisci la località.");
      }
  }

  public function flatSearchFilters(Request $request) {

    $data = $request -> all();
    // dd($data);
    $loc = $data['loc'];
    $lat = $data['lat'];
    $lon = $data['lon'];

    if (is_numeric($data['distance'])) {
      $dist = $data['distance'];
    } else {
      $dist = 20;
    }

    if (is_numeric($data['rooms'])) {
      $rooms = $data['rooms'];
    } else {
      $rooms = 0;
    }

    if (is_numeric($data['beds'])) {
      $beds = $data['beds'];
    } else {
      $beds = 0;
    }

    if (isset($data['services'])) {
      $services = $data['services'];
    }
    else {
      for ($i=1; $i < 7; $i++) {
        $services[] = $i;
      }
    }
    // dd($services);

    // prendo gli appartamenti in base ai filtri impostati
    $distance = "( 6367 * acos( cos( radians(".$lat.") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(".$lon.") ) + sin( radians(".$lat.") ) * sin( radians( lat ) ) ) )  AS distance";

    $flats = Flat::select("flats.*",
                      DB::raw($distance),
                      DB::raw("(select photos.url from photos where photos.flat_id=flats.id LIMIT 1) AS url"),
                      DB::raw("(select flat_sponsor.sponsor_id from flat_sponsor where flat_sponsor.flat_id=flats.id LIMIT 1) AS sponsored")
                      )
      -> join('flat_service', 'flat_service.flat_id', '=', 'flats.id')
      -> join('services', 'services.id', '=', 'flat_service.service_id')
      -> join('photos', 'photos.flat_id', '=', 'flats.id')
      -> leftJoin('flat_sponsor', 'flat_sponsor.flat_id', '=', 'flats.id')
      -> where([
          ['flats.rooms','>=',$rooms],
          ['flats.beds', '>=', $beds]
        ])
      -> whereIn('flat_service.service_id',$services)
      -> having('distance', '<', $dist)
      -> orderBy('sponsored','DESC')
      -> orderBy('distance','ASC')
      -> groupBy('flats.id')
      -> get();
      // -> toSql();

    // dd($flats);

    return view('flats.search', compact('flats','loc','lat','lon','dist','rooms','beds','services'));
  }

  public function flatShow($id) {

    // incremento il contatore delle visite per l'uppartamento visualizzato
    $flat = Flat::findOrFail($id);
    $flatVisited['flat_id'] = $flat -> id;
    $visit = Visit::create($flatVisited);

    return view('flats.show', compact('flat'));
  }

  public function messageStore(UiMessageRequest $request, $id) {

    // valido i dati attraberso l'UiMessageRequest e salvo i messaggi nel DB
    $validatedData = $request -> all();
    $validatedData['flat_id'] = $id;
    $mex = Message::create($validatedData);

    $flat = Flat::findOrFail($id);
    // return view('flats.show', compact('flat'));
    return back() -> with("status", "Il suo messaggio è stato ricevuto, la contattremo a breve.");
  }

  public function requestView() {

      $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
      ]);

      $token = $gateway->ClientToken()->generate();

      return view('test', compact('token'));
  }

  public function requestStore (Request $request) {

    $gateway = new Braintree\Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
      'amount' => $amount,
      'paymentMethodNonce' => $nonce,
      'options' => [
          'submitForSettlement' => true
      ]
    ]);

    if ($result->success) {
      $transaction = $result->transaction;
      // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
      $data = back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->$id);
    } else {
      $errorString = "";

      foreach ($result->errors->deepAll() as $error) {
          $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
      }
      $data = back()->withErrors('An error occurred with the message:' . $result->message);
    }

    return view('test', compact('data'));
  }

}
