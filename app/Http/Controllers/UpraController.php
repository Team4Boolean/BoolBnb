<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// richiama l'autentication
use Illuminate\Support\Facades\Auth;
// richiama i gate
use Illuminate\Support\Facades\Gate;

use App\Flat;
use App\User;
use App\Service;
use App\Photo;

// richiama Upra Flat Request
use App\Http\Requests\UpraFlatRequest;

class UpraController extends Controller {

  public function flatIndex() {

    $id = Auth::user() -> id;
    $firstname = Auth::user() -> firstname;

    $flats = Flat::where('user_id', $id)
            -> orderBy('created_at','desc')
            -> get();
    $flatsTrashed = Flat::where('user_id', $id)
                  -> onlyTrashed()
                  -> orderBy('deleted_at','desc')
                  -> get();
    // dd($flats);
    return view('flats.index', compact('firstname','flats', 'flatsTrashed'));

    // if (Gate::denies('upra-manage-flats')) {
    //   abort(401, 'Unathorized');
    // }

  }

  public function flatEdit($id) {

    $flat = Flat::findOrFail($id);
    return view('flats.edit',compact('flat'));
  }

  public function flatUpdate(UpraFlatRequest $request, $flat_id) {

    $userid = $request -> user() -> id;

    $data = $request -> all();
    // dd($data);
    $data['user_id'] = $userid;

    $flat = Flat::findOrFail($flat_id);
    $flat -> update($data);

    // se sono presenti servizi associati all'apaprtamento li inserisco nella tabella ponte flat_service
    if (!empty($data['services'])) {

      $services = $data['services'];
      // il metodo sync aggiorna le associazioni molti a molti cancellando le vecchie associazioni
      $flat -> services() -> sync($services);
    }

    if ($request -> hasFile('img')) {

      // predno il file contenuto in 'img' all'interno della request
      $file = $request -> file('img');
      $filename = $flat_id.'.'.$file -> extension();

      // memorizzo la foto nella directory /photos e prendo l'url generato
      $photo['url'] = $file -> storeAs(env('PHOTOS_DIR'), $filename);
      $photo['flat_id'] = $flat_id;
      
      $photos_old = Photo::where('flat_id', $flat_id) -> delete();

      $photo = Photo::create($photo);
    }

    return redirect() -> route('flats.index');
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
}
