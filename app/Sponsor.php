<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
  protected $fillable = [
    'title',
    'price',
    'hours'
  ];

  // relazione Many To Many flats <-> sponsors
  public function flats() {
    return $this -> belongsToMany(Flat::class);
  }
}
