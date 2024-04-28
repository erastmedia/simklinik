<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlinikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klinik', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_klinik', 100)->default('');
            $table->string('nama_pemilik', 100)->default('');
            $table->string('penanggung_jawab', 100)->default('');
            $table->string('penanggung_jawab_lab', 100)->default('');
            $table->unsignedBigInteger('id_tipe')->default(0);
            $table->unsignedBigInteger('prov_id')->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->unsignedBigInteger('dis_id')->default(0);
            $table->unsignedBigInteger('subdis_id')->default(0);
            $table->string('kode_pos', 6)->default('');
            $table->string('rt', 3)->default('');
            $table->string('rw', 3)->default('');
            $table->string('telepon', 20)->default('');
            $table->string('email', 100)->default('');
            $table->string('alamat', 255)->default('');
            $table->string('latitude', 255)->default('');
            $table->string('longitude', 255)->default('');
            $table->string('website', 100)->default('');
            $table->string('npwp', 30)->default('');
            $table->string('no_register', 100)->default('');
            $table->string('tgl_berlaku_register')->default('1900-01-01');
            $table->string('nama_apj', 100)->default('');
            $table->string('no_stra', 100)->default('');
            $table->string('tgl_berlaku_stra')->default('1900-01-01');
            $table->string('no_sipa', 100)->default('');
            $table->string('tgl_berlaku_sipa')->default('1900-01-01');
            $table->string('file_logo', 255)->default('');
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
        Schema::dropIfExists('klinik');
    }
}
