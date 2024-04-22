<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoktersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik', 16)->unique();
            $table->string('id_satu_sehat', 100)->default('');
            $table->string('nama', 100);
            $table->unsignedBigInteger('id_spesialis')->default(1);
            $table->foreign('id_spesialis')->references('id')->on('spesialisasi_dokter')->onDelete('cascade');
            $table->unsignedBigInteger('id_klinik')->default(1);
            $table->foreign('id_klinik')->references('id')->on('klinik')->onDelete('cascade');
            $table->string('alamat', 255)->default('');
            $table->string('kota', 100)->default('');
            $table->string('telepon', 20)->default('');
            $table->string('no_str', 100)->default('');
            $table->string('username', 20)->unique();
            $table->date('tgl_masuk')->default('1900-01-01');
            $table->integer('status_aktif')->default(1);
            $table->string('email', 100)->unique();
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
        Schema::dropIfExists('dokter');
    }
}
