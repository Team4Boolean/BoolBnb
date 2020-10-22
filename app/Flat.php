<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flat extends Model
{
    use SoftDeletes;

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
      'visible'
    ];

    // relazione One To Many(inversa) flats -> users
    public function user() {
      return $this -> belongsTo(User::class);
    }
    // relazione One To Many flats -> photos
    public function photos() {
      return $this -> hasMany(Photo::class);
    }
    // relazione Many To Many flats <-> services
    public function services() {
      return $this -> belongsToMany(Service::class) -> withTimestamps();
    }
    // relazione One To Many flats -> views
    public function visits() {
      return $this -> hasMany(Visit::class);
    }
    // relazione One To Many flats -> messages
    public function messages() {
      return $this -> hasMany(Message::class);
    }
    // relazione Many To Many flats <-> sponsors
    public function sponsors() {
      return $this -> belongsToMany(Sponsor::class) -> withTimestamps();
    }

}
