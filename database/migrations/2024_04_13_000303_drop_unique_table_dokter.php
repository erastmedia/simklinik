<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUniqueTableDokter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->dropUnique('dokter_nik_unique');
            // $table->dropUnique('dokter_username_unique');
            // $table->dropUnique('dokter_email_unique');
            $table->index('nik');
            // $table->index('username');
            // $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->unique('nik');
            // $table->unique('username');
            // $table->unique('email');
            $table->dropIndex(['nik']);
            // $table->dropIndex(['username']);
            // $table->dropIndex(['email']);
        });
    }
}
