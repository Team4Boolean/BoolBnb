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
use App\Visit;
use App\Message;

// richiama Upra Flat Request
use App\Http\Requests\UpraFlatRequest;

use Illuminate\Support\Facades\DB;

class UpraController extends Controller {

  public function flatIndex() {

    $id = Auth::user() -> id;
    $firstname = Auth::user() -> firstname;

    // appartamenti in affitto non sponsorizzati
    $flats = Flat::where('user_id', $id)
            -> doesntHave('sponsors')
            -> orderBy('created_at','desc')
            -> get();
    // appartamenti in affitto disattivati
    $flatsTrashed = Flat::where('user_id', $id)
                  -> onlyTrashed()
                  -> orderBy('deleted_at','desc')
                  -> get();
    // appartamenti in affitto sponsorizzati
    $flatsSponsored = Flat::where('user_id', $id)
                    -> has('sponsors')
                    -> orderBy('created_at','desc')
                    -> get();
    // dd($flatsSponsored);
    // dd($flats);
    return view('flats.index', compact('firstname','flats', 'flatsTrashed','flatsSponsored'));

    // if (Gate::denies('upra-manage-flats')) {
    //   abort(401, 'Unathorized');
    // }

  }

  public function flatEdit($id) {

    $flat = Flat::findOrFail($id);
    return view('flats.edit',compact('flat'));
  }

  public function flatUpdate(UpraFlatRequest $request, $id) {

    $userid = $request -> user() -> id;

    $flat = Flat::findOrFail($id);

    $data = $request -> all();
    // dd($data);
    $data['user_id'] = $userid;

    if ($data['lat'] === null && $data['lon'] === null) {
      $data['lat'] = $flat -> lat;
      $data['lon'] = $flat -> lon;
    }

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
      $filename = $id.'.'.$file -> extension();

      // memorizzo la foto nella directory /photos e prendo l'url generato
      $photo['url'] = $file -> storeAs(env('PHOTOS_DIR'), $filename);
      $photo['flat_id'] = $id;

      $photos_old = Photo::where('flat_id', $id) -> delete();

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

  public function flatStats($id){

    $flat = Flat::findOrFail($id);
    $visits = DB::table('visits')
              -> select(DB::raw('DATE(created_at) AS x, count(flat_id) as y'))
              -> where('flat_id', '=', $id)
              -> groupBy('x')
              -> get();
    $messages = DB::table('messages')
              -> select(DB::raw('DATE(created_at) AS x, count(flat_id) as y'))
              -> where('flat_id', '=', $id)
              -> groupBy('x')
              -> get();

    // $views = DB::table('Visits')
    // ->select('created_at')
    // ->where('flat_id', $id)->get();
    // dd($views);

    // return view('flats.chart', compact('views'));
    return view('flats.statistics', compact('visits','messages','flat'));
  }

  public function flatMessages($id){

    $messages = Message::where('flat_id','=',$id) -> get();
    // dd($messages);
    return view('flats.messages', compact('messages'));
  }

  public function flatSponsorCreate($id) {

    $flat = Flat::findOrFail($id);
    return view('flats/sponsor', compact('flat'));
  }

  public function flatSponsorStore($id) {

  }

}
