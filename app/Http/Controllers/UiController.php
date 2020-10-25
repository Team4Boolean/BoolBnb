<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// richiama Ui Message Request
use App\Http\Requests\UiMessageRequest;

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

  public function flatSearch() {
    return view('flats.search');
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
