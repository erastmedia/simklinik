<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDokter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->string('id_satu_sehat', 100)->nullable()->change();
            $table->string('alamat', 255)->nullable()->change();
            $table->string('kota', 100)->nullable()->change();
            $table->string('telepon', 20)->nullable()->change();
            $table->date('tgl_masuk')->nullable()->change();
            $table->string('no_str', 100)->nullable()->change();
            $table->string('path_foto', 255)->after('email')->default('no-photo.png');
            $table->string('path_tdt', 255)->after('path_foto')->default('no-photo.png');
            $table->string('path_stamp', 255)->after('path_tdt')->default('no-photo.png');
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
            $table->string('id_satu_sehat', 100)->default('')->change();
            $table->string('alamat', 255)->default('')->change();
            $table->string('kota', 100)->default('')->change();
            $table->string('telepon', 20)->default('')->change();
            $table->date('tgl_masuk')->default('1900-01-01')->change();
            $table->string('no_str', 100)->default('')->change();
            $table->dropColumn('path_foto');
            $table->dropColumn('path_tdt');
            $table->dropColumn('path_stamp');
        });
    }
}
