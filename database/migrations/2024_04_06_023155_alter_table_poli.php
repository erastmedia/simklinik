<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePoli extends Migration
{
    
    public function up()
    {
        Schema::table('poli', function (Blueprint $table) {
            $table->dropUnique('poli_nama_poli_unique');
            $table->index('nama_poli');
        });
    }

    public function down()
    {
        Schema::table('poli', function (Blueprint $table) {
            $table->unique('nama_poli');
            $table->dropIndex(['nama_poli']);
        });
    }
}
