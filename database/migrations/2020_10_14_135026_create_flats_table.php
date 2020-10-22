<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {

            $table -> engine = 'InnoDB';

            $table -> id();

            $table -> bigInteger('user_id') -> unsigned(); // chiave esterna

            $table -> string('title');
            $table -> text('desc');
            $table -> unsignedTinyInteger('rooms');
            $table -> unsignedTinyInteger('beds');
            $table -> unsignedTinyInteger('baths');
            $table -> float('sqm', 6, 2);
            $table -> decimal('lat', 7, 5) -> default(0);
            $table -> decimal('lon', 8, 5) -> default(0);
            $table -> string('street_number', 8);
            $table -> string('street_name', 85);
            $table -> string('municipality', 85);
            $table -> string('subdivision', 50) -> nullable();
            $table -> string('postal_code', 20);

            $table -> timestamps();

            $table -> softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flats');
    }
}
