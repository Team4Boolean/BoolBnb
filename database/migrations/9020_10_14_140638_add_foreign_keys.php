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
      Schema::table('views', function (Blueprint $table) {
        $table -> foreign('flat_id', 'vws-flt')
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
      Schema::table('campaigns', function (Blueprint $table) {
        $table -> foreign('flat_id', 'cmp-flt')
               -> references('id')
               -> on('flats');
        $table -> foreign('advertising_id', 'cmp-adv')
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
      Schema::table('requests', function (Blueprint $table) {
        $table -> dropForeign('rqs-flt');
      });
      Schema::table('views', function (Blueprint $table) {
        $table -> dropForeign('vws-flt');
      });
      Schema::table('flat_service', function (Blueprint $table) {
        $table -> dropForeign('srv-flt');
        $table -> dropForeign('flt-srv');
      });
      Schema::table('campaigns', function (Blueprint $table) {
        $table -> dropForeign('cmp-flt');
        $table -> dropForeign('cmp-adv');
      });
    }
}
