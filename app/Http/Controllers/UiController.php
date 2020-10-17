<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UiController extends Controller
{

  public function home() {

      return view('homepage');
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
