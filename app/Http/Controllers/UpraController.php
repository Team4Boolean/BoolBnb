<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// richiama l'autentication
use Illuminate\Support\Facades\Auth;
// richiama i gate
use Illuminate\Support\Facades\Gate;
// richiama il flat
use App\Flat;
// richiama Upra Flat Request
use App\Http\Requests\UpraFlatRequest;

class UpraController extends Controller {

  public function flatIndex() {

    if (Gate::denies('upra-manage-flats')) {
      abort(401, 'Unathorized');
    } else {
      $message = "Benvenuto nella dashboard!";
      return view('flats.index', compact('message'));
    }

  }

  public function flatEdit() {

  }

  public function index() {

    $id = 1;
    $flat= Flat::find($id);

    // primo modo
    // if ($flat -> user -> id !== Auth::user() -> id) {
    //   abort(401, 'Unathorized');
    // } else {
    //   $welcome = "Benvenuto utente UPRA!";
    //   return view('flats.create', compact('welcome'));
    // }

    // secondo modo con i Gate
    if (Gate::denies('upra-manage-flats', $flat)) {
      // $welcome = "Utente non autorizzato";
      abort(401, 'Unathorized');
    } else {
      $welcome = "Benvenuto utente UPRA!";
      return view('flats.create', compact('welcome'));
    }

  }
}
