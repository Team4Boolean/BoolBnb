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
    // dd($data);

    $data['lon'] = 1;
    $data['lat'] = 1;

    $flat = Flat::create($data);

    if ($request -> hasFile('img')) {

      $file = $request -> file('img');
      $filename = $flat -> id.'.'.$file -> extension();

      $photo['url'] = $file -> storeAs(env('PHOTOS_DIR'), $filename);
      $photo['flat_id'] = $flat -> id;

      $photo = Photo::create($photo);
      // $flat -> photos() -> url = $filename;

    }

    // $services = Flat::class -> services() ->

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
