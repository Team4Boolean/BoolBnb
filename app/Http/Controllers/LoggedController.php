<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;

use App\Flat;

class LoggedController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index() {
      if (Gate::denies('upra-user')) {
        // $welcome = "Utente non autorizzato";
        abort(401, 'Unathorized');
      } else {
        $welcome = "Benvenuto utente UPRA!";
        return view('upra', compact('welcome'));
      }

    }

    public function create() {
      return view('flat-create');
    }

    public function store(Request $request) {

      $usrid = Auth::user() -> id;

      $data = $request -> all();
      $data['user_id'] = $usrid;
      
      $flat = Flat::create($data);

      return redirect() -> route('home');
    }
}
