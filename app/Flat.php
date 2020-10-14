<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    protected $fillable = [
      'user_id',
      'title',
      'desc',
      'n_rooms',
      'n_beds',
      'n_baths',
      'sqm',
      'lat',
      'lon',
      'img',
      'wifi',
      'parking',
      'swim',
      'concierge',
      'sauna',
      'sea',
      'visible',
      'views'
    ];

    // relazione One To Many(inversa) flats -> users
    public function user() {
      return $this -> belongsTo(User::class);
    }
    // relazione One To Many flats -> requests
    public function requests() {
      return $this -> hasMany(Request::class);
    }
    // relazione One To one flats <-> advs
    public function adv() {
      return $this -> hasOne(Adv::class);
    }

}
