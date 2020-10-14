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
            $table -> string('img');
            $table -> boolean('wifi') -> nullable() -> default(0);
            $table -> boolean('parking') -> nullable() -> default(0);
            $table -> boolean('swim') -> nullable() -> default(0);
            $table -> boolean('concierge') -> nullable() -> default(0);
            $table -> boolean('sauna') -> nullable() -> default(0);
            $table -> boolean('sea') -> nullable() -> default(0);
            $table -> boolean('visible') -> default(1);
            $table -> unsignedBigInteger('views') -> default(0);

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
