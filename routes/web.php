<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KlinikController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\TipeLokasiPoliController;
use App\Http\Controllers\SpesialisasiDokterController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\BagianSpesialisasiController;
use App\Http\Controllers\PetugasMedisController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PabrikController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\GolonganObatController;
use App\Http\Controllers\KategoriObatController;
use App\Http\Controllers\LokasiObatController;
use App\Http\Controllers\SatuanObatController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\JaminanController;
use App\Http\Controllers\MailNotifController;
use App\Mail;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('dashboard');
// });

Auth::routes();
Auth::routes(['verify' => true]);

// Route::get('/{username}', [MemberController::class, 'index'])->name('memberarea');
// Route::get('/{username}', 'MemberController@index');

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Route::get('/searchcity', [CityController::class, 'searchData'])->name('searchcity');



//ROUTES UNTUK DATA KLINIK
Route::get('dashboard/system/profil-klinik', [KlinikController::class, 'index'])->name('profil-klinik');
Route::get('/kota/{id}', [KlinikController::class, 'getKota']);
Route::get('/kecamatan/{id}', [KlinikController::class, 'getKecamatan']);
Route::get('/kelurahan/{id}', [KlinikController::class, 'getKelurahan']);
Route::post('/update-profil', [KlinikController::class, 'updateKlinik'])->name('klinik.update');
Route::post('/upload-logo', [KlinikController::class,'uploadlogo'])->name('upload-logo');
Route::post('/upload-reg', [KlinikController::class,'uploadreg'])->name('upload-reg');
Route::post('/upload-stra', [KlinikController::class,'uploadstra'])->name('upload-stra');
Route::post('/upload-sipa', [KlinikController::class,'uploadsipa'])->name('upload-sipa');
Route::post('image/delete-logo',[KlinikController::class,'fileLogoDestroy']);
Route::post('image/delete-reg',[KlinikController::class,'fileRegDestroy']);
Route::post('image/delete-stra',[KlinikController::class,'fileStraDestroy']);
Route::post('image/delete-sipa',[KlinikController::class,'fileSipaDestroy']);
Route::get('readLogoFiles/{id?}', [KlinikController::class, 'readLogoFiles'])->name('readLogoFiles');
Route::get('readRegFiles/{id?}', [KlinikController::class, 'readRegFiles'])->name('readRegFiles');
Route::get('readStraFiles/{id?}', [KlinikController::class, 'readStraFiles'])->name('readStraFiles');
Route::get('readSipaFiles/{id?}', [KlinikController::class, 'readSipaFiles'])->name('readSipaFiles');

//ROUTES UNTUK MASTER
    //ROUTES UNTUK DATA POLI
    Route::get('dashboard/master/poli/data', [PoliController::class, 'data'])->name('poli.data');
    Route::get('dashboard/master/poli', [PoliController::class, 'index'])->name('poli.index');
    Route::post('dashboard/master/poli/store', [PoliController::class, 'store'])->name('poli.store');
    Route::get('dashboard/master/poli/{id}/edit', [PoliController::class, 'edit'])->name('poli.edit');
    Route::put('dashboard/master/poli/{id}', [PoliController::class, 'update'])->name('poli.update');
    Route::get('dashboard/master/poli/{id}', [PoliController::class, 'show'])->name('poli.show');
    Route::delete('dashboard/master/poli/{id}', [PoliController::class, 'destroy'])->name('poli.destroy');

    //ROUTES UNTUK DATA TIPE LOKASI POLI
    Route::get('dashboard/master/tipelokasipoli/data', [TipeLokasiPoliController::class, 'data'])->name('tipelokasipoli.data');
    Route::get('dashboard/master/tipelokasipoli', [TipeLokasiPoliController::class, 'index'])->name('tipelokasipoli.index');
    Route::post('dashboard/master/tipelokasipoli/store', [TipeLokasiPoliController::class, 'store'])->name('tipelokasipoli.store');
    Route::get('dashboard/master/tipelokasipoli/{id}/edit', [TipeLokasiPoliController::class, 'edit'])->name('tipelokasipoli.edit');
    Route::put('dashboard/master/tipelokasipoli/{id}', [TipeLokasiPoliController::class, 'update'])->name('tipelokasipoli.update');
    Route::get('dashboard/master/tipelokasipoli/{id}', [TipeLokasiPoliController::class, 'show'])->name('tipelokasipoli.show');
    Route::delete('dashboard/master/tipelokasipoli/{id}', [TipeLokasiPoliController::class, 'destroy'])->name('tipelokasipoli.destroy');
    Route::post('dashboard/master/tipelokasipoli/copy-preset', [TipeLokasiPoliController::class, 'copyPreset'])->name('tipelokasipoli.copypreset');
    Route::get('dashboard/master/get-tipe-poli', [TipeLokasiPoliController::class, 'getTipePoli']);


    //ROUTES UNTUK DATA DOKTER
    Route::get('dashboard/master/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('dashboard/master/dokter/data', [DokterController::class, 'data'])->name('dokter.data');
    Route::post('dashboard/master/dokter/store', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('dashboard/master/dokter/{id}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::put('dashboard/master/dokter/{id}', [DokterController::class, 'update'])->name('dokter.update');
    Route::get('dashboard/master/dokter/{id}', [DokterController::class, 'show'])->name('dokter.show');
    Route::delete('dashboard/master/dokter/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');
    //TEST FRAMING FOTO CONTENT
    Route::get('/foto-content', [DokterController::class, 'getFotoContent'])->name('dokter.getFotoContent');

    //ROUTES UNTUK DATA SPESIALISASI DOKTER
    Route::get('dashboard/master/spesialisasidokter/data', [SpesialisasiDokterController::class, 'data'])->name('spesialisasidokter.data');
    Route::get('dashboard/master/spesialisasidokter', [SpesialisasiDokterController::class, 'index'])->name('spesialisasidokter.index');
    Route::post('dashboard/master/spesialisasidokter/store', [SpesialisasiDokterController::class, 'store'])->name('spesialisasidokter.store');
    Route::get('dashboard/master/spesialisasidokter/{id}/edit', [SpesialisasiDokterController::class, 'edit'])->name('spesialisasidokter.edit');
    Route::put('dashboard/master/spesialisasidokter/{id}', [SpesialisasiDokterController::class, 'update'])->name('spesialisasidokter.update');
    Route::get('dashboard/master/spesialisasidokter/{id}', [SpesialisasiDokterController::class, 'show'])->name('spesialisasidokter.show');
    Route::delete('dashboard/master/spesialisasidokter/{id}', [SpesialisasiDokterController::class, 'destroy'])->name('spesialisasidokter.destroy');

    //ROUTES UNTUK DATA PETUGAS
    Route::get('dashboard/master/petugas', [PetugasMedisController::class, 'index'])->name('petugas.index');
    Route::get('dashboard/master/petugas/data', [PetugasMedisController::class, 'data'])->name('petugas.data');
    Route::post('dashboard/master/petugas/store', [PetugasMedisController::class, 'store'])->name('petugas.store');
    Route::get('dashboard/master/petugas/{id}/edit', [PetugasMedisController::class, 'edit'])->name('petugas.edit');
    Route::put('dashboard/master/petugas/{id}', [PetugasMedisController::class, 'update'])->name('petugas.update');
    Route::get('dashboard/master/petugas/{id}', [PetugasMedisController::class, 'show'])->name('petugas.show');
    Route::delete('dashboard/master/petugas/{id}', [PetugasMedisController::class, 'destroy'])->name('petugas.destroy');
    
    //ROUTES UNTUK DATA BAGIAN / SPESIALISASI PETUGAS
    Route::get('dashboard/master/bagianspesialisasi/data', [BagianSpesialisasiController::class, 'data'])->name('bagianspesialisasi.data');
    Route::get('dashboard/master/bagianspesialisasi', [BagianSpesialisasiController::class, 'index'])->name('bagianspesialisasi.index');
    Route::post('dashboard/master/bagianspesialisasi/store', [BagianSpesialisasiController::class, 'store'])->name('bagianspesialisasi.store');
    Route::get('dashboard/master/bagianspesialisasi/{id}/edit', [BagianSpesialisasiController::class, 'edit'])->name('bagianspesialisasi.edit');
    Route::put('dashboard/master/bagianspesialisasi/{id}', [BagianSpesialisasiController::class, 'update'])->name('bagianspesialisasi.update');
    Route::get('dashboard/master/bagianspesialisasi/{id}', [BagianSpesialisasiController::class, 'show'])->name('bagianspesialisasi.show');
    Route::delete('dashboard/master/bagianspesialisasi/{id}', [BagianSpesialisasiController::class, 'destroy'])->name('bagianspesialisasi.destroy');
    Route::get('dashboard/master/bagian', [BagianSpesialisasiController::class, 'getBagian']);

    //ROUTES UNTUK DATA SUPPLIER
    Route::get('dashboard/master/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('dashboard/master/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
    Route::post('dashboard/master/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('dashboard/master/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('dashboard/master/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('dashboard/master/supplier/{id}', [SupplierController::class, 'show'])->name('supplier.show');
    Route::delete('dashboard/master/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    //ROUTES UNTUK DATA PABRIK
    Route::get('dashboard/master/pabrik', [PabrikController::class, 'index'])->name('pabrik.index');
    Route::get('dashboard/master/pabrik/data', [PabrikController::class, 'data'])->name('pabrik.data');
    Route::post('dashboard/master/pabrik/store', [PabrikController::class, 'store'])->name('pabrik.store');
    Route::get('dashboard/master/pabrik/{id}/edit', [PabrikController::class, 'edit'])->name('pabrik.edit');
    Route::put('dashboard/master/pabrik/{id}', [PabrikController::class, 'update'])->name('pabrik.update');
    Route::get('dashboard/master/pabrik/{id}', [PabrikController::class, 'show'])->name('pabrik.show');
    Route::delete('dashboard/master/pabrik/{id}', [PabrikController::class, 'destroy'])->name('pabrik.destroy');
    Route::post('dashboard/master/pabrik/copy-preset', [PabrikController::class, 'copyPreset'])->name('pabrik.copypreset');

    //ROUTES UNTUK DATA GUDANG
    Route::get('dashboard/master/gudang', [GudangController::class, 'index'])->name('gudang.index');
    Route::get('dashboard/master/gudang/data', [GudangController::class, 'data'])->name('gudang.data');
    Route::post('dashboard/master/gudang/store', [GudangController::class, 'store'])->name('gudang.store');
    Route::get('dashboard/master/gudang/{id}/edit', [GudangController::class, 'edit'])->name('gudang.edit');
    Route::put('dashboard/master/gudang/{id}', [GudangController::class, 'update'])->name('gudang.update');
    Route::get('dashboard/master/gudang/{id}', [GudangController::class, 'show'])->name('gudang.show');
    Route::delete('dashboard/master/gudang/{id}', [GudangController::class, 'destroy'])->name('gudang.destroy');
    Route::put('dashboard/master/gudang-setdefault/{id}', [GudangController::class, 'setAsDefault'])->name('gudang.setdefault');

    //ROUTES UNTUK DATA GOLONGAN OBAT
    Route::get('dashboard/master/golobat', [GolonganObatController::class, 'index'])->name('golobat.index');
    Route::get('dashboard/master/golobat/data', [GolonganObatController::class, 'data'])->name('golobat.data');
    Route::post('dashboard/master/golobat/store', [GolonganObatController::class, 'store'])->name('golobat.store');
    Route::get('dashboard/master/golobat/{id}/edit', [GolonganObatController::class, 'edit'])->name('golobat.edit');
    Route::put('dashboard/master/golobat/{id}', [GolonganObatController::class, 'update'])->name('golobat.update');
    Route::get('dashboard/master/golobat/{id}', [GolonganObatController::class, 'show'])->name('golobat.show');
    Route::delete('dashboard/master/golobat/{id}', [GolonganObatController::class, 'destroy'])->name('golobat.destroy');
    Route::post('dashboard/master/golobat/copy-preset', [GolonganObatController::class, 'copyPreset'])->name('golobat.copypreset');
    
    //ROUTES UNTUK DATA KATEGORI OBAT
    Route::get('dashboard/master/kategori-obat', [KategoriObatController::class, 'index'])->name('kategoriobat.index');
    Route::get('dashboard/master/kategori-obat/data', [KategoriObatController::class, 'data'])->name('kategoriobat.data');
    Route::post('dashboard/master/kategori-obat/store', [KategoriObatController::class, 'store'])->name('kategoriobat.store');
    Route::get('dashboard/master/kategori-obat/{id}/edit', [KategoriObatController::class, 'edit'])->name('kategoriobat.edit');
    Route::put('dashboard/master/kategori-obat/{id}', [KategoriObatController::class, 'update'])->name('kategoriobat.update');
    Route::get('dashboard/master/kategori-obat/{id}', [KategoriObatController::class, 'show'])->name('kategoriobat.show');
    Route::delete('dashboard/master/kategori-obat/{id}', [KategoriObatController::class, 'destroy'])->name('kategoriobat.destroy');
    Route::post('dashboard/master/kategori-obat/copy-preset', [KategoriObatController::class, 'copyPreset'])->name('kategoriobat.copypreset');

    //ROUTES UNTUK DATA LOKASI OBAT
    Route::get('dashboard/master/lokasi-obat', [LokasiObatController::class, 'index'])->name('lokasiobat.index');
    Route::get('dashboard/master/lokasi-obat/data', [LokasiObatController::class, 'data'])->name('lokasiobat.data');
    Route::post('dashboard/master/lokasi-obat/store', [LokasiObatController::class, 'store'])->name('lokasiobat.store');
    Route::get('dashboard/master/lokasi-obat/{id}/edit', [LokasiObatController::class, 'edit'])->name('lokasiobat.edit');
    Route::put('dashboard/master/lokasi-obat/{id}', [LokasiObatController::class, 'update'])->name('lokasiobat.update');
    Route::get('dashboard/master/lokasi-obat/{id}', [LokasiObatController::class, 'show'])->name('lokasiobat.show');
    Route::delete('dashboard/master/lokasi-obat/{id}', [LokasiObatController::class, 'destroy'])->name('lokasiobat.destroy');

    //ROUTES UNTUK DATA SATUAN OBAT
    Route::get('dashboard/master/satuan-obat', [SatuanObatController::class, 'index'])->name('satuanobat.index');
    Route::get('dashboard/master/satuan-obat/data', [SatuanObatController::class, 'data'])->name('satuanobat.data');
    Route::post('dashboard/master/satuan-obat/store', [SatuanObatController::class, 'store'])->name('satuanobat.store');
    Route::get('dashboard/master/satuan-obat/{id}/edit', [SatuanObatController::class, 'edit'])->name('satuanobat.edit');
    Route::put('dashboard/master/satuan-obat/{id}', [SatuanObatController::class, 'update'])->name('satuanobat.update');
    Route::get('dashboard/master/satuan-obat/{id}', [SatuanObatController::class, 'show'])->name('satuanobat.show');
    Route::delete('dashboard/master/satuan-obat/{id}', [SatuanObatController::class, 'destroy'])->name('satuanobat.destroy');
    Route::post('dashboard/master/satuan-obat/copy-preset', [SatuanObatController::class, 'copyPreset'])->name('satuanobat.copypreset');

//ROUTES UNTUK PENDAFTARAM KLINIK
    //ROUTES UNTUK DATA JAMINAN
    Route::get('dashboard/pendaftaran-klinik/jaminan', [JaminanController::class, 'index'])->name('jaminan.index');
    Route::get('dashboard/pendaftaran-klinik/jaminan/data', [JaminanController::class, 'data'])->name('jaminan.data');
    Route::get('dashboard/pendaftaran-klinik/jaminan/detail', [JaminanController::class, 'detail'])->name('jaminan.detail');
    Route::post('dashboard/pendaftaran-klinik/jaminan/store', [JaminanController::class, 'store'])->name('jaminan.store');
    Route::get('dashboard/pendaftaran-klinik/jaminan/{id}/edit', [JaminanController::class, 'edit'])->name('jaminan.edit');
    Route::put('dashboard/pendaftaran-klinik/jaminan/{id}', [JaminanController::class, 'update'])->name('jaminan.update');
    Route::get('dashboard/pendaftaran-klinik/jaminan/{id}', [JaminanController::class, 'show'])->name('jaminan.show');
    Route::delete('dashboard/pendaftaran-klinik/jaminan/{id}', [JaminanController::class, 'destroy'])->name('jaminan.destroy');
    Route::post('dashboard/pendaftaran-klinik/jaminan/copy-preset', [JaminanController::class, 'copyPreset'])->name('jaminan.copypreset');

//ROUTES UNTUK PELAYANAN KLINIK
    //ROUTES UNTUK DATA DIAGNOSA
    Route::get('dashboard/pelayanan-klinik/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa.index');
    Route::get('dashboard/pelayanan-klinik/diagnosa/data', [DiagnosaController::class, 'data'])->name('diagnosa.data');
    Route::get('dashboard/pelayanan-klinik/diagnosa/detail', [DiagnosaController::class, 'detail'])->name('diagnosa.detail');
    Route::post('dashboard/pelayanan-klinik/diagnosa/store', [DiagnosaController::class, 'store'])->name('diagnosa.store');
    Route::get('dashboard/pelayanan-klinik/diagnosa/{id}/edit', [DiagnosaController::class, 'edit'])->name('diagnosa.edit');
    Route::put('dashboard/pelayanan-klinik/diagnosa/{id}', [DiagnosaController::class, 'update'])->name('diagnosa.update');
    Route::get('dashboard/pelayanan-klinik/diagnosa/{id}', [DiagnosaController::class, 'show'])->name('diagnosa.show');
    Route::delete('dashboard/pelayanan-klinik/diagnosa/{id}', [DiagnosaController::class, 'destroy'])->name('diagnosa.destroy');
    Route::post('dashboard/pelayanan-klinik/diagnosa/copy-preset', [DiagnosaController::class, 'copyPreset'])->name('diagnosa.copypreset');

    //ROUTES UNTUK DATA TINDAKAN
    Route::get('dashboard/pelayanan-klinik/tindakan', [TindakanController::class, 'index'])->name('tindakan.index');
    Route::get('dashboard/pelayanan-klinik/tindakan/data', [TindakanController::class, 'data'])->name('tindakan.data');
    Route::post('dashboard/pelayanan-klinik/tindakan/store', [TindakanController::class, 'store'])->name('tindakan.store');
    Route::get('dashboard/pelayanan-klinik/tindakan/{id}/edit', [TindakanController::class, 'edit'])->name('tindakan.edit');
    Route::put('dashboard/pelayanan-klinik/tindakan/{id}', [TindakanController::class, 'update'])->name('tindakan.update');
    Route::get('dashboard/pelayanan-klinik/tindakan/{id}', [TindakanController::class, 'show'])->name('tindakan.show');
    Route::delete('dashboard/pelayanan-klinik/tindakan/{id}', [TindakanController::class, 'destroy'])->name('tindakan.destroy');
    Route::post('dashboard/pelayanan-klinik/tindakan/copy-preset', [TindakanController::class, 'copyPreset'])->name('tindakan.copypreset');

    //ROUTES UNTUK NOTIFIKASI EMAIL
    //TEST
    Route::get('send-mail', function () {
        $details = [
            'title' => 'Success',
            'content' => 'This is an email testing using Laravel-Brevo',
        ];
       
        \Mail::to('erastmedia@gmail.com')->send(new \App\Mail\TestMail($details));
       
        return 'Email sent at ' . now();
    });
    //VIEW TEMPLATE EMAIL
    Route::get('/viewmail', [MailNotifController::class, 'mailview'])->name('mail.view');
    Route::get('/sendemail', [MailNotifController::class, 'sendEmail'])->name('mail.send');

