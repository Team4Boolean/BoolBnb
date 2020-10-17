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
    // relazione One To Many flats -> messages
    public function messages() {
      return $this -> hasMany(Message::class);
    }
    // relazione One To One flats <-> campaigns
    public function sponsor() {
      return $this -> hasOne(Sponsor::class);
    }
    // relazione One To Many flats -> views
    public function visits() {
      return $this -> hasMany(Visit::class);
    }
    // relazione Many To Many flats <-> services
    public function services() {
      return $this -> belongsToMany(Service::class);
    }

}
