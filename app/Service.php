<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
      'name'
    ];

    // relazione Many To Many services <-> flats
    public function flats() {
      return $this -> belongsToMany(Flat::class);
    }
}
