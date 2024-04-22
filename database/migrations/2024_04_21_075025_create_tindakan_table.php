<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTindakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindakan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_klinik')->default(1);
            $table->foreign('id_klinik')->references('id')->on('klinik')->onDelete('cascade');
            $table->string('kode', 11);
            $table->string('nama_en', 255);
            $table->string('nama_id', 255)->nullable();
            $table->integer('status_aktif')->default(1);
            $table->timestamps();
            $table->index('kode');
            $table->index('nama_en');
            $table->index('nama_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tindakan');
    }
}
