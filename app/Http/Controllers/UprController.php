<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// richiama l'autentication
use Illuminate\Support\Facades\Auth;
// richiama il flat
use App\Flat;

class UprController extends Controller {

  public function __construct() {

    $this->middleware('auth');
  }

  public function flatCreate() {
    
    return view('flats.create');
  }

  public function flatStore(Request $request) {

    $usrid = Auth::user() -> id;

    $data = $request -> all();
    $data['user_id'] = $usrid;

    $flat = Flat::create($data);

    return redirect() -> route('home');
  }

}
