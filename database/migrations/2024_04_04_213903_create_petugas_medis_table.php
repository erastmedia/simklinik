<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetugasMedisTable extends Migration
{

    public function up()
    {
        Schema::create('petugas_medis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik', 16)->unique();
            $table->string('id_satu_sehat', 100)->nullable();
            $table->string('nama', 100);
            $table->unsignedBigInteger('id_bagian')->default(1);
            $table->foreign('id_bagian')->references('id')->on('bagian_spesialisasi')->onDelete('cascade');
            $table->string('alamat', 255)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('username', 20)->unique();
            $table->date('tgl_masuk')->nullable();
            $table->string('path_foto', 255)->default('no-photo.png');
            $table->integer('status_aktif')->default(1);
            $table->string('email', 100)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('petugas_medis');
    }
}
