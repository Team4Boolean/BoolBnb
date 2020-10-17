<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [
    'flat_id',
    'email',
    'message'
  ];

  // relazione One To Many(inversa) flats -> requests
  public function flat() {
    return $this -> belongsTo(Flat::class);
  }
}
