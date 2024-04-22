<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSpesialisasiDoktersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesialisasi_dokter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_spesialisasi', 100)->unique();
            // $table->unsignedBigInteger('id_klinik')->default(1);
            // $table->foreign('id_klinik')->references('id')->on('klinik')->onDelete('cascade');
            $table->timestamps();
        });

        $spesialisasi = [
            ['id' => 1, 'nama_spesialisasi' => 'Sp. Kandungan & Kebidanan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_spesialisasi' => 'Sp. Kulit & Kelamin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_spesialisasi' => 'Sp. THT', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_spesialisasi' => 'Sp. Jiwa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nama_spesialisasi' => 'Sp. Penyakit Dalam', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nama_spesialisasi' => 'Sp. Anak', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'nama_spesialisasi' => 'Sp. Mata', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'nama_spesialisasi' => 'Dokter Gigi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'nama_spesialisasi' => 'Dokter Umum', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'nama_spesialisasi' => 'Psikolog Klinis', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'nama_spesialisasi' => 'Sp. Saraf', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'nama_spesialisasi' => 'Sp. Paru', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'nama_spesialisasi' => 'Sp. Urologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'nama_spesialisasi' => 'Sp. Orthopaedi & Traumatologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'nama_spesialisasi' => 'Sp. Jantung & Pembuluh Darah', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'nama_spesialisasi' => 'Sp. PD Gastroenterologi - Hepatologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'nama_spesialisasi' => 'Sp. Bedah Umum', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'nama_spesialisasi' => 'Sp. Gizi Klinik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'nama_spesialisasi' => 'Sp. PD Endokrin - Metabolik - Diabetes', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'nama_spesialisasi' => 'Sp. Andrologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'nama_spesialisasi' => 'Sp. Konservasi Gigi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'nama_spesialisasi' => 'Dokter Bedah', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'nama_spesialisasi' => 'Sp. PD Ginjal - Hipertensi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 24, 'nama_spesialisasi' => 'Sp. Gigi Anak', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 25, 'nama_spesialisasi' => 'Sp. Bedah Onkologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 26, 'nama_spesialisasi' => 'Sp. PD Reumatologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 27, 'nama_spesialisasi' => 'Sp. PD Hematologi & Onkologi Medik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 28, 'nama_spesialisasi' => 'Sp. Bedah Mulut & Maksilofasial', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 29, 'nama_spesialisasi' => 'Sp. Bedah Saraf', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 30, 'nama_spesialisasi' => 'Sp. Rehabilitasi Medik & Kedokteran Fisik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 31, 'nama_spesialisasi' => 'Sp. Ortodonsia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 32, 'nama_spesialisasi' => 'Sp. Periodonsia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 33, 'nama_spesialisasi' => 'Sp. Kedokteran Olahraga', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 34, 'nama_spesialisasi' => 'Psikolog Klinis Anak & Remaja', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 35, 'nama_spesialisasi' => 'Sp. PD Kardiovaskular', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 36, 'nama_spesialisasi' => 'Sp. Bedah Digestif', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 37, 'nama_spesialisasi' => 'Akupuntur', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 38, 'nama_spesialisasi' => 'Sp. Bedah Plastik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 39, 'nama_spesialisasi' => 'Sp. Bedah Toraks Kardiovaskular', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 40, 'nama_spesialisasi' => 'Sp. Bedah Anak', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 41, 'nama_spesialisasi' => 'Fisioterapis', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 42, 'nama_spesialisasi' => 'Sp. Prostodonsia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 43, 'nama_spesialisasi' => 'Sp. Bedah Vaskuler & Endovaskuler', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 44, 'nama_spesialisasi' => 'Sp. Penyakit Mulut', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 45, 'nama_spesialisasi' => 'Sp. PD Alergi - Imunologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 46, 'nama_spesialisasi' => 'Sp. PD Tropik - Infeksi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 47, 'nama_spesialisasi' => 'Konselor Laktasi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 48, 'nama_spesialisasi' => 'Sp. Bedah Spine', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 49, 'nama_spesialisasi' => 'Psikolog Klinis Dewasa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 50, 'nama_spesialisasi' => 'Sp. Mikrobiologi Klinik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 51, 'nama_spesialisasi' => 'Psikologi Industri dan Organisasi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 52, 'nama_spesialisasi' => 'Sp. Bedah Panggul & Lutut', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 53, 'nama_spesialisasi' => 'Dokter Kecantikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 54, 'nama_spesialisasi' => 'Sp. Radiologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 55, 'nama_spesialisasi' => 'Sp. Anestesiologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 56, 'nama_spesialisasi' => 'Sp. Okupasi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 57, 'nama_spesialisasi' => 'Sp. Onkologi Radiasi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 58, 'nama_spesialisasi' => 'Sp. Patologi Anatomi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 59, 'nama_spesialisasi' => 'Sp. Patologi Klinik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 60, 'nama_spesialisasi' => 'Bidan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 61, 'nama_spesialisasi' => 'Apoteker', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 62, 'nama_spesialisasi' => 'Dokter Forensik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 63, 'nama_spesialisasi' => 'Hipnoterapis', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 64, 'nama_spesialisasi' => 'Sp. Anak (Onkologi)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 65, 'nama_spesialisasi' => 'Sp. Farmakologi Klinik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 66, 'nama_spesialisasi' => 'Sp. Intervensi dan Kegawatdaruratan Napas', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 67, 'nama_spesialisasi' => 'Sp. Jiwa (Anak dan Remaja)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 68, 'nama_spesialisasi' => 'Sp. Kedokteran Nuklir', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 69, 'nama_spesialisasi' => 'Sp. Nutrisi pada Kelainan Metabolisme', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 70, 'nama_spesialisasi' => 'Dokter Gigi Spesialis Radiologi - Subspesialis Radiodiagnosis Imaging', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 71, 'nama_spesialisasi' => 'Insurance', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 72, 'nama_spesialisasi' => 'Sp. Anak (Alergi-Imunologi Anak)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 73, 'nama_spesialisasi' => 'Ahli Gizi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 74, 'nama_spesialisasi' => 'Dokter Emergensi Medik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 75, 'nama_spesialisasi' => 'Dokter Gigi Kosmetik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 76, 'nama_spesialisasi' => 'Dokter Gigi Sp. Radiologi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 77, 'nama_spesialisasi' => 'Dokter Hewan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 78, 'nama_spesialisasi' => 'Haloskin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 79, 'nama_spesialisasi' => 'Ilmu Biomedik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 80, 'nama_spesialisasi' => 'Konselor', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 81, 'nama_spesialisasi' => 'Konsultasi Medis', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 82, 'nama_spesialisasi' => 'Lainnya', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 83, 'nama_spesialisasi' => 'Psikolog Non Klinis', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 84, 'nama_spesialisasi' => 'Sp. Anak (Gastroenterologi-Hepatologi)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 85, 'nama_spesialisasi' => 'Sp. Anak (Nefrologi)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 86, 'nama_spesialisasi' => 'Sp. Anak (Neonatologi)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 87, 'nama_spesialisasi' => 'Sp. Anak (Neurologi)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 88, 'nama_spesialisasi' => 'Sp. Anak (Nutrisi & Penyakit Metabolik)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 89, 'nama_spesialisasi' => 'Sp. Anak (Penyakit Tropik-Infeksi)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 90, 'nama_spesialisasi' => 'Sp. Anak (Tumbuh Kembang)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 91, 'nama_spesialisasi' => 'Sp. Fetomaternal', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 92, 'nama_spesialisasi' => 'Sp. Gizi Klink (Konsultan Endokrin Metabolik)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 93, 'nama_spesialisasi' => 'Sp. Jantung (Kardiologi Intervensi)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 94, 'nama_spesialisasi' => 'Sp. Kedokteran Kelautan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 95, 'nama_spesialisasi' => 'Sp. Kedokteran Keluarga Layanan Primer', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 96, 'nama_spesialisasi' => 'Sp. Kedokteran Penerbangan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 97, 'nama_spesialisasi' => 'Sp. Kulit & Kelamin (Alergi-Imunologi)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 98, 'nama_spesialisasi' => 'Sp. PD Geriatri', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 99, 'nama_spesialisasi' => 'Sp. PD Psikosomatik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 100, 'nama_spesialisasi' => 'Sp. Saraf (Neuro-onkologi)', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 101, 'nama_spesialisasi' => 'Sp. THT (Bronko-Esofagologi)', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('spesialisasi_dokter')->insert($spesialisasi);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spesialisasi_dokter');
    }
}
