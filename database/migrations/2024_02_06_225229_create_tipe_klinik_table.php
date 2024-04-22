<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTipeKlinikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_klinik', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_tipe');
            $table->timestamps();
        });

        $tipeklinik = [
            ['id' => 1, 'nama_tipe' => 'KLINIK PRATAMA', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_tipe' => 'KLINIK UTAMA', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_tipe' => 'RUMAH SAKIT', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('tipe_klinik')->insert($tipeklinik);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_klinik');
    }
}
