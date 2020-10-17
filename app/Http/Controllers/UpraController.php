<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// richiama l'autentication
use Illuminate\Support\Facades\Auth;
// richiama i gate
use Illuminate\Support\Facades\Gate;
// richiama il flat
use App\Flat;

class UpraController extends Controller {

  public function flatIndex() {

  }

  public function flatEdit() {

  }

  public function index() {

    $id = 1;
    $flat= Flat::find($id);

    if (Gate::denies('upra-manage-flats', $flat)) {
      // $welcome = "Utente non autorizzato";
      abort(401, 'Unathorized');
    } else {
      $welcome = "Benvenuto utente UPRA!";
      return view('flats.create', compact('welcome'));
    }

  }
}
