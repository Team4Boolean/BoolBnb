<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// richiama l'autentication
use Illuminate\Support\Facades\Auth;
// richiama il flat
use App\Flat;
// richiama Upr Flat Request
use App\Http\Requests\UprFlatRequest;

class UprController extends Controller {

  public function flatCreate() {

    return view('flats.create');
  }

  public function flatStore(UprFlatRequest $request) {

    // VALIDAZIONE: PRIMO MODO
    // validazione tramite regole definite nella protected $rules
    // $this -> validate($request, $this -> rules, $this -> errorMessages);

    // VALIDAZIONE: SECONDO modo
    // richiamo la classe FlatRequest definita in App\Http\Requests\FlatRequest

    $userid = $request -> user() -> id;

    $data = $request -> all();
    $data['user_id'] = $userid;

    $flat = Flat::create($data);

    return redirect() -> route('home');
  }

  public function dropzone(){
    return view('advertisings.test');
  }

  public function dropzoneStore(Request $request){

    $image = $request->file('file');
    $imageName = time().'.'.$image->extension();
    $image->move(public_path('storage'), $imageName);

    return response()->json(['success'=>$imageName]);
  }

}
