<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdTipeLokasiPoliIntoPoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poli', function (Blueprint $table) {
            $table->string('nama_poli', 30)->after('id')->unique();
            $table->string('deskripsi', 100)->after('nama_poli')->default('');
            $table->unsignedBigInteger('id_tipe_lokasi_poli')->after('deskripsi')->default(1);
            $table->foreign('id_tipe_lokasi_poli')->references('id')->on('tipe_lokasi_poli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poli', function (Blueprint $table) {
            $table->dropColumn('nama_poli');
            $table->dropColumn('deskripsi');
            $table->dropForeign(['id_tipe_lokasi_poli']);
            $table->dropColumn('id_tipe_lokasi_poli');
        });
    }
}
