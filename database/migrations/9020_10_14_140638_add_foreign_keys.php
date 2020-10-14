<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('flats', function (Blueprint $table) {
        $table -> foreign('user_id', 'flt-usr')
               -> references('id')
               -> on('users')
               -> onDelete('cascade');
      });
      Schema::table('requests', function (Blueprint $table) {
        $table -> foreign('flat_id', 'rqs-flt')
               -> references('id')
               -> on('flats');
      });
      Schema::table('advs', function (Blueprint $table) {
        $table -> foreign('flat_id', 'adv-flt')
               -> references('id')
               -> on('flats');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('flats', function (Blueprint $table) {
        $table -> dropForeign('flt-usr');
      });
      Schema::table('requests', function (Blueprint $table) {
        $table -> dropForeign('rqs-flt');
      });
      Schema::table('advs', function (Blueprint $table) {
        $table -> dropForeign('adv-flt');
      });
    }
}
