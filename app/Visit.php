<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
  protected $fillable = [
    'flat_id'
  ];

  // relazione One To Many(inversa) flats -> views
  public function flat() {
    return $this -> belongsTo(Flat::class);
  }
}
