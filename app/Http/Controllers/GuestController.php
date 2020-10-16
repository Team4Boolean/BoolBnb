<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
  public function homepage()
  {
      return view('homepage');
  }

  public function index(){
    $flats = Flat::all();

    return view('flats.list', compact('flats'));
  }

  public function show($id){
    $flat = Flat::findOrFail($id);

    return view('flats.show', compact('flat'));
  }

}
