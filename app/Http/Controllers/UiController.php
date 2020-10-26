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

    if ($lat !== null && $lon !== null) {

      // prendo gli appartamenti a meno di 20KM di distanza dalla località cercata
      $flats = Flat::select(DB::raw('*, ( 6367 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('.$lon.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'))
        ->having('distance', '<', 20)
        ->orderBy('distance')
        ->get();

      return view('flats.search', compact('flats','loc','lat','lon'));
    } else {
      return back() -> with("error", "Inserisci la località.");
    }
  }

  public function flatSearchFilters(Request $request) {

    $data = $request -> all();
    // dd($data);
    $lat = $data['lat'];
    $lon = $data['lon'];
    // $dist = $data['distance'];
    // $rooms = $data['rooms'];
    // $beds = $data['beds'];
    $dist = 1000;
    $rooms = 1;
    $beds = 2;
    if (isset($data['services'])) {
      $services = $data['services'];
    }

    // prendo gli appartamenti in base ai filtri impostati
    $flats = Flat::select(DB::raw('*, ( 6367 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('.$lon.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'))
      ->where([
          ['rooms','=',$rooms],
          ['beds', '=', $beds]
        ])
      ->having('distance', '<', $dist)
      ->orderBy('distance')
      ->get();

      return back();
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

  public function requestCreate() {

  }

  public function requestStore() {
    return view('advertisings.test');
  }


}
