<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_sponsor', function (Blueprint $table) {

          $table -> engine = 'InnoDB';

          $table -> id();

          $table -> bigInteger('flat_id') -> unsigned(); // chiave esterna
          $table -> bigInteger('sponsor_id') -> unsigned(); // chiave esterna

          $table -> timestamps();

          $table -> expires();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flat_sponsor');
    }
}
