<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    protected $fillable = [
      'title',
      'price',
      'hours'
    ];

    // relazione One To Many advertisings -> campaigns
    public function campaigns() {
      return $this -> hasMany(Campaign::class);
    }
}
