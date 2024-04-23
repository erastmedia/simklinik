<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBridgingSatuSehatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bridging_satu_sehat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_klinik')->default(1);
            $table->foreign('id_klinik')->references('id')->on('klinik')->onDelete('cascade');
            $table->string('organization_id', 255)->nullable();
            $table->string('client_key', 255)->nullable();
            $table->string('secret_key', 255)->nullable();
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
        Schema::dropIfExists('bridging_satu_sehat');
    }
}
