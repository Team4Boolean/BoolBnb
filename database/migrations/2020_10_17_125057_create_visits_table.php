<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {

          $table -> engine = 'InnoDB';

          $table -> id();

          $table -> bigInteger('flat_id') -> unsigned(); // chiave esterna

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
        Schema::dropIfExists('visits');
    }
}
