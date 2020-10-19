<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
      'flat_id',
      'url'
    ];

    // relazione One To Many(inversa) flats <-> photos
    public function flat() {
      return $this -> belongsTo(Flat::class);
    }
}
