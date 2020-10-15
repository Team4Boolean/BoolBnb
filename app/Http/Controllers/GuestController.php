<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
  public function homepage()
  {
      return view('homepage');
  }

  public function index()
  {
      return view('home');
  }

}
