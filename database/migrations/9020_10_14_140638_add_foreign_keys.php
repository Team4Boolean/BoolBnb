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
      Schema::table('messages', function (Blueprint $table) {
        $table -> foreign('flat_id', 'msg-flt')
               -> references('id')
               -> on('flats');
      });
      Schema::table('visits', function (Blueprint $table) {
        $table -> foreign('flat_id', 'vst-flt')
               -> references('id')
               -> on('flats');
      });
      Schema::table('flat_service', function (Blueprint $table) {
        $table -> foreign('flat_id', 'srv-flt')
               -> references('id')
               -> on('flats')
               -> onDelete('cascade');
        $table -> foreign('service_id', 'flt-srv')
               -> references('id')
               -> on('services');
      });
      Schema::table('sponsors', function (Blueprint $table) {
        $table -> foreign('flat_id', 'spr-flt')
               -> references('id')
               -> on('flats');
        $table -> foreign('advertising_id', 'spr-adv')
               -> references('id')
               -> on('advertisings');
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
      Schema::table('messages', function (Blueprint $table) {
        $table -> dropForeign('msg-flt');
      });
      Schema::table('visits', function (Blueprint $table) {
        $table -> dropForeign('vst-flt');
      });
      Schema::table('flat_service', function (Blueprint $table) {
        $table -> dropForeign('srv-flt');
        $table -> dropForeign('flt-srv');
      });
      Schema::table('sponsors', function (Blueprint $table) {
        $table -> dropForeign('spr-flt');
        $table -> dropForeign('spr-adv');
      });
    }
}
