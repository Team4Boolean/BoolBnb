<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Flat;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function flatSearch(Request $request) {

      $data = $request -> all();
      // dd($data);
      $lat = $data['lat'];
      $lon = $data['lon'];
      // $dist = $data['distance'];
      // $rooms = $data['rooms'];
      // $beds = $data['beds'];
      $dist = 1000;
      $rooms = 1;
      $beds = 2;
      if (isset($data['services'])) {
        $services = $data['services'];
      }

      // prendo gli appartamenti in base ai filtri impostati
      $flats = Flat::select(DB::raw('*, ( 6367 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('.$lon.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) ) AS distance'))
        ->where([
            ['rooms','=',$rooms],
            ['beds', '=', $beds]
          ])
        ->having('distance', '<', $dist)
        ->orderBy('distance')
        ->get();

      return response() -> json($flats);
    }

}
