<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    protected $fillable = [
      'user_id',
      'title',
      'desc',
      'rooms',
      'beds',
      'baths',
      'sqm',
      'lat',
      'lon',
      'street_number',
      'street_name',
      'municipality',
      'subdivision',
      'postal_code',
      'img',
      'visible'
    ];

    // relazione One To Many(inversa) flats -> users
    public function user() {
      return $this -> belongsTo(User::class);
    }
    // relazione One To Many flats -> requests
    public function requests() {
      return $this -> hasMany(Request::class);
    }
    // relazione One To One flats <-> campaigns
    public function campaign() {
      return $this -> hasOne(Campaign::class);
    }
    // relazione One To Many flats -> views
    public function views() {
      return $this -> hasMany(View::class);
    }
    // relazione Many To Many flats <-> services
    public function services() {
      return $this -> belongsToMany(Service::class);
    }

}
