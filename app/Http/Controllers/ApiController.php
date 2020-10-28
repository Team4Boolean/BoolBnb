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
      $loc = $data['loc'];
      $lat = $data['lat'];
      $lon = $data['lon'];

      if (is_numeric($data['distance'])) {
        $dist = $data['distance'];
      } else {
        $dist = 20;
      }

      if (is_numeric($data['rooms'])) {
        $rooms = $data['rooms'];
      } else {
        $rooms = 0;
      }

      if (is_numeric($data['beds'])) {
        $beds = $data['beds'];
      } else {
        $beds = 0;
      }

      if (isset($data['services'])) {
        $services = $data['services'];
      } else {
        $services = null;
      }
      // dd($services);

      // prendo gli appartamenti in base ai filtri impostati
      $distance = '( 6367 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('.$lon.') ) + sin( radians('.$lat.') ) * sin( radians( lat ) ) ) )  AS distance';

      $flats = Flat::select(DB::raw('flats.*,'.$distance.''))
        -> join('flat_service', 'flat_service.flat_id', '=', 'flats.id')
        -> join('services', 'services.id', '=', 'flat_service.service_id')
        -> where([
            ['flats.rooms','>=',$rooms],
            ['flats.beds', '>=', $beds]
          ])
        -> whereIn('flat_service.service_id',$services)
        -> having('distance', '<', $dist)
        -> orderBy('distance')
        -> groupBy('flats.id')
        -> get();

      // dd($flats);

      return response() -> json($flats);
    }

}
