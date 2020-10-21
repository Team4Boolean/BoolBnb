<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Flat;
use App\Sponsor;
use App\Message;

class UiController extends Controller
{

  public function home() {

      $sponsored = Flat::has('sponsors')
                -> paginate(6);
                // -> inRandomOrder()
                // -> take(6)
                // -> get();

      return view('homepage', compact('sponsored'));
  }

  public function flatShow($id) {

    $flat = Flat::findOrFail($id);

    return view('flats.show', compact('flat'));
  }

  public function requestCreate() {

  }

  public function requestStore() {

  }


}
