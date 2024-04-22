<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBagianSpesialisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bagian_spesialisasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_bagian', 100)->unique();
            $table->unsignedBigInteger('id_klinik')->default(1);
            $table->foreign('id_klinik')->references('id')->on('klinik')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bagian_spesialisasi');
    }
}
