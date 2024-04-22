<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTipeLokasiPoli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipe_lokasi_poli', function (Blueprint $table) {
            $table->unsignedBigInteger('id_klinik')->default(1)->change();
            $table->dropUnique('tipe_lokasi_poli_nama_tipe_unique');
            $table->index('nama_tipe');
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
            $table->unsignedBigInteger('id_klinik')->default(5)->change();
            $table->unique('nama_tipe');
            $table->dropIndex(['nama_tipe']);
        });
    }
}
