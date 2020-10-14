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

            $table -> id();

            $table -> bigInteger('user_id') -> unsigned(); // chiave esterna
            $table -> string('title');
            $table -> text('desc');
            $table -> unsignedTinyInteger('n_rooms');
            $table -> unsignedTinyInteger('n_beds');
            $table -> unsignedTinyInteger('n_baths');
            $table -> float('sqm', 6, 2);
            $table -> decimal('lat', 7, 5);
            $table -> decimal('lon', 8, 5);
            $table -> string('img');
            $table -> boolean('wifi');
            $table -> boolean('parking');
            $table -> boolean('swim');
            $table -> boolean('concierge');
            $table -> boolean('sauna');
            $table -> boolean('sea');
            $table -> boolean('visible');
            $table -> unsignedBigInteger('views');

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
        Schema::dropIfExists('flats');
    }
}
