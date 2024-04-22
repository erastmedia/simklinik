<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateHakAksesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hak_akses', function (Blueprint $table) {
            $table->id();
            $table->string('hak_akses')->unique();
            $table->timestamps();
        });

        $hakakses = [
            ['id' => 1, 'hak_akses' => 'SUPER ADMIN', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'hak_akses' => 'ADMIN', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'hak_akses' => 'DOKTER', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'hak_akses' => 'TENAGA MEDIS', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'hak_akses' => 'KASIR', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('hak_akses')->insert($hakakses);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hak_akses');
    }
}
