<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advs', function (Blueprint $table) {

          $table -> engine = 'InnoDB';

          $table -> id();

          $table -> bigInteger('flat_id') -> unsigned(); // chiave esterna

          $table -> unsignedTinyInteger('package');
          $table -> dateTime('expire');

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
        Schema::dropIfExists('advs');
    }
}
