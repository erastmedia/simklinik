<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableBagianSpesialisasi extends Migration
{
    public function up()
    {
        Schema::table('bagian_spesialisasi', function (Blueprint $table) {
            $table->dropUnique('bagian_spesialisasi_nama_bagian_unique');
            $table->index('nama_bagian');
        });
    }

    public function down()
    {
        Schema::table('bagian_spesialisasi', function (Blueprint $table) {
            $table->unique('nama_bagian');
            $table->dropIndex(['nama_bagian']);
        });
    }
}
