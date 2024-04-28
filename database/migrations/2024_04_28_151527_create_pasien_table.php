<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_jaminan')->default(1);
            $table->foreign('id_jaminan')->references('id')->on('jaminan')->onDelete('cascade');
            $table->string('no_rm', 6);
            $table->string('no_bpjs', 13)->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('nama', 100);
            $table->string('gol_darah', 3)->nullable();
            $table->integer('gender')->default(0);
            $table->date('tgl_lahir')->nullable();
            $table->string('id_satusehat', 10)->nullable();
            $table->unsignedBigInteger('prov_id')->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->unsignedBigInteger('dis_id')->default(0);
            $table->unsignedBigInteger('subdis_id')->default(0);
            $table->string('alamat', 255)->nullable();
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
        Schema::dropIfExists('pasien');
    }
}
