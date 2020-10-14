<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    protected $fillable = [
      'flat_id',
      'package',
      'expire'
    ];

    // relazione One To One(inversa) flats -> advs
    public function flat() {
      return $this -> belongsTo(Flat::class);
    }
}
