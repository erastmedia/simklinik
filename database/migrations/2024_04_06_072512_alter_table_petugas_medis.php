<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePetugasMedis extends Migration
{
    public function up()
    {
        Schema::table('petugas_medis', function (Blueprint $table) {
            $table->dropUnique('petugas_medis_nik_unique');
            $table->dropUnique('petugas_medis_username_unique');
            $table->dropUnique('petugas_medis_email_unique');
            $table->index('nik');
            $table->index('username');
            $table->index('email');
        });
    }
    
    public function down()
    {
        Schema::table('petugas_medis', function (Blueprint $table) {
            $table->unique('nik');
            $table->unique('username');
            $table->unique('email');
            $table->dropIndex(['nik']);
            $table->dropIndex(['username']);
            $table->dropIndex(['email']);
        });
    }
}
