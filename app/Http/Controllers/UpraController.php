<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// richiama l'autentication
use Illuminate\Support\Facades\Auth;
// richiama i gate
use Illuminate\Support\Facades\Gate;
// richiama il flat model
use App\Flat;
// richiama lo user model
use App\User;
// richiama Upra Flat Request
use App\Http\Requests\UpraFlatRequest;

use Illuminate\Support\Facades\DB;

class UpraController extends Controller {

  public function flatIndex() {

    $id = Auth::user() -> id;
    $firstname = Auth::user() -> firstname;

    $flats = Flat::where('user_id', $id) -> withTrashed() -> get();
    return view('flats.index', compact('firstname','flats'));

    // if (Gate::denies('upra-manage-flats')) {
    //   abort(401, 'Unathorized');
    // }

  }

  public function flatEdit() {

  }

  public function flatDeactivate($id) {

    $flat= Flat::withTrashed() -> find($id);
    $flat -> delete();

    return redirect() -> route('flats.index');

  }

  public function flatActivate($id) {

    $flat= Flat::withTrashed() -> find($id);
    $flat -> restore();

    return redirect() -> route('flats.index');

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

  public function statsShow($id){

    $flat = Flat::findOrFail($id);

    $views = DB::table('Visits')
    ->select('created_at')
    ->where('flat_id', $id)->get();

    return view('flats.chart', compact('flat','views'));

  }
}
