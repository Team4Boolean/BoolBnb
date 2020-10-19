<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{

    public function up()
    {
      Schema::create('sponsors', function (Blueprint $table) {

        $table -> engine = 'InnoDB';

        $table -> id();

        $table -> string('title', 25);
        $table -> float('price', 6, 2);
        $table -> unsignedTinyInteger('hours');

        $table -> timestamps();

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
