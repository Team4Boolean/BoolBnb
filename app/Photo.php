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

    // controllo se le immagini siano prese internet o dal disco locale
    public function getPathAttribute() {
      $url = $this -> url;
      if (stristr($this -> url, 'http') === false) {
        $url = 'storage/'.$this -> url;
      }
      return $url;
    }
}
