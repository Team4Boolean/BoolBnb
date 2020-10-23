<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// richiama l'autentication
use Illuminate\Support\Facades\Auth;
// richiama il flat
use App\Flat;
// richiama Upr Flat Request
use App\Http\Requests\UprFlatRequest;
// richiama Photo
use App\Photo;
// richiama Service
use App\Service;

class UprController extends Controller {

  public function flatCreate() {

    return view('flats.create');
  }

  public function flatStore(UprFlatRequest $request) {

    // VALIDAZIONE: PRIMO MODO
    // validazione tramite regole definite nella protected $rules
    // $this -> validate($request, $this -> rules, $this -> errorMessages);

    // VALIDAZIONE: SECONDO modo
    // richiamo la classe UprFlatRequest definita in App\Http\Requests\FlatRequest

    $userid = $request -> user() -> id;

    $data = $request -> all();

    $data['user_id'] = $userid;

    $flat = Flat::create($data);

    // se sono presenti servizi associati all'apaprtamento li inserisco nella tabella ponte flat_service
    if (!empty($data['services'])) {

      $services = $data['services'];

      foreach ($services as $service) {
        $service_entity = Service::where('name',$service) -> get();
        $flat -> services() -> attach($service_entity);
      }

    }

    if ($request -> hasFile('img')) {

      // predno il file contenuto in 'img' all'interno della request
      $file = $request -> file('img');
      $filename = $flat -> id.'.'.$file -> extension();

      // memorizzo la foto nella directory /photos e prendo l'url generato
      $photo['url'] = $file -> storeAs(env('PHOTOS_DIR'), $filename);
      $photo['flat_id'] = $flat -> id;

      $photo = Photo::create($photo);

    }

    return redirect() -> route('flats.index');
  }

  // public function dropzone(){
  //   return view('advertisings.test');
  // }

  public function dropzoneStore(Request $request){

    $image = $request->file('file');
    $imageName = time().'.'.$image->extension();
    $image->move(public_path('flathost'), $imageName);

    return response()->json(['success'=>$imageName]);
  }

}
