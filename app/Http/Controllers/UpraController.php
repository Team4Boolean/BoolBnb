<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// richiama l'autentication
use Illuminate\Support\Facades\Auth;
// richiama i gate
use Illuminate\Support\Facades\Gate;
// richiama il flat
use App\Flat;

class UpraController extends Controller
{
  public function index() {
    if (Gate::denies('upra-user')) {
      // $welcome = "Utente non autorizzato";
      abort(401, 'Unathorized');
    } else {
      $welcome = "Benvenuto utente UPRA!";
      return view('upra', compact('welcome'));
    }
  }
}
