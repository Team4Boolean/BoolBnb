<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// richiama l'autentication
use Illuminate\Support\Facades\Auth;
// richiama il flat
use App\Flat;
// richiama Flat Request
use App\Http\Requests\FlatRequest;

class UprController extends Controller {

  protected $rules = [
      'title' => 'bail|required|string|max:255',
      'desc' => 'required|max:500',
      'rooms' => 'required|numeric',
      'beds' => 'required|numeric',
      'baths' => 'required|numeric'
  ];

  protected $errorMessages = [
    'title.required' => 'Il campo titolo è richiesto.',
    'desc.required' => 'Il campo descrizione è richiesto.',
    'rooms.required' => 'Indicare il numero di stanze',
    'rooms.numeric' => 'Inserire solo valori numerici',
    'beds.required' => 'Indicare il numero di letti',
    'beds.numeric' => 'Inserire solo valori numerici',
    'baths.required' => 'Indicare il numero di bagni',
    'baths.numeric' => 'Inserire solo valori numerici'
  ];

  public function __construct() {

    $this->middleware('auth');
  }

  public function flatCreate() {

    return view('flats.create');
  }

  public function flatStore(FlatRequest $request) {

    // VALIDAZIONE: PRIMO MODO
    // validazione tramite regole definite nella protected $rules
    // $this -> validate($request, $this -> rules, $this -> errorMessages);

    // VALIDAZIONE: SECONDO modo
    // richiamo la classe FlatRequest definita in App\Http\Requests\FlatRequest

    // Primo modo
    // $userid = Auth::user() -> id;
    // Secondo modo
    $userid = $request -> user() -> id;

    $data = $request -> all();
    $data['user_id'] = $userid;

    $flat = Flat::create($data);

    return redirect() -> route('home');
  }

}
