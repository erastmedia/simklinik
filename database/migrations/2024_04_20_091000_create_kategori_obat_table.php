<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_obat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_klinik')->default(1);
            $table->foreign('id_klinik')->references('id')->on('klinik')->onDelete('cascade');
            $table->string('nama', 100);
            $table->string('keterangan', 255)->nullable();
            $table->integer('status_aktif')->default(1);
            $table->timestamps();
            $table->index('nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_obat');
    }
}
