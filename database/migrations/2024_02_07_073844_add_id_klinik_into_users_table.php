<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdKlinikIntoUsersTable extends Migration
{
    
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_klinik')->default(1);
            $table->foreign('id_klinik')->references('id')->on('klinik')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_klinik']);
            $table->dropColumn('id_klinik');
        });
    }
}
