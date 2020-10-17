<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
  protected $fillable = [
    'flat_id',
    'advertising_id',
    'expire'
  ];

  // relazione One To One(inversa) flats -> campaigns
  public function flat() {
    return $this -> belongsTo(Flat::class);
  }
  // relazione One To Many(inversa) advertisings -> campaigns
  public function advertising() {
    return $this -> belongsTo(Advertising::class);
  }
}
