<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdKlinikToTipeLokasiPoli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipe_lokasi_poli', function (Blueprint $table) {
            $table->unsignedBigInteger('id_klinik')->after('id')->default(5);
            $table->foreign('id_klinik')->references('id')->on('klinik')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipe_lokasi_poli', function (Blueprint $table) {
            $table->dropForeign(['id_klinik']);
            $table->dropColumn('id_klinik');
        });
    }
}
