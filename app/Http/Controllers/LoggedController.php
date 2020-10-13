<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;

class LoggedController extends Controller
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
