<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klinik;
use App\Models\TipeKlinik;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use App\Models\RegisterPhoto;
use App\Models\SipaPhoto;
use App\Models\StraPhoto;
use App\Models\LogoPhoto;

class KlinikController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $id = auth()->user()->id_klinik;
        $klinik = Klinik::find($id);
        $provinsi = Provinsi::all()->pluck('prov_name', 'prov_id');
        $tipeklinik = TipeKlinik::all()->pluck('nama_tipe', 'id');
        return view('system.klinik', compact('tipeklinik', 'provinsi', 'klinik'));
    }

    public function getKota($id)
    {
        $kotas = Kota::where('prov_id', $id)->get();
        return response()->json($kotas);
    }

    public function getKecamatan($id)
    {
        $kecamatans = Kecamatan::where('city_id', $id)->get();
        return response()->json($kecamatans);
    }

    public function getKelurahan($id)
    {
        $kelurahans = Kelurahan::where('dis_id', $id)->get();
        return response()->json($kelurahans);
    }

    public function updateKlinik(Request $request)
    {
        try {
            $id = auth()->user()->id_klinik;
            $klinik = Klinik::find($id);
            $klinik->nama_klinik = $request->input('nama_klinik');
            if ($klinik->nama_klinik === null) {
                $klinik->nama_klinik = '';
            }
            $klinik->nama_pemilik = $request->input('nama_pemilik');
            if ($klinik->nama_pemilik === null) {
                $klinik->nama_pemilik = '';
            }
            $klinik->penanggung_jawab = $request->input('penanggung_jawab');
            if ($klinik->penanggung_jawab === null) {
                $klinik->penanggung_jawab = '';
            }
            $klinik->penanggung_jawab_lab = $request->input('penanggung_jawab_lab');
            if ($klinik->penanggung_jawab_lab === null) {
                $klinik->penanggung_jawab_lab = '';
            }
            $klinik->id_tipe = $request->input('id_tipe');
            if ($klinik->id_tipe === null) {
                $klinik->id_tipe = 0;
            }
            $klinik->prov_id = $request->input('prov_id');
            if ($klinik->prov_id === null) {
                $klinik->prov_id = 0;
            }
            $klinik->city_id = $request->input('city_id');
            if ($klinik->city_id === null) {
                $klinik->city_id = 0;
            }
            $klinik->dis_id = $request->input('dis_id');
            if ($klinik->dis_id === null) {
                $klinik->dis_id = 0;
            }
            $klinik->subdis_id = $request->input('subdis_id');
            if ($klinik->subdis_id === null) {
                $klinik->subdis_id = 0;
            }
            $klinik->kode_pos = $request->input('kode_pos');
            if ($klinik->kode_pos === null) {
                $klinik->kode_pos = '';
            }
            $klinik->rt = $request->input('rt');
            if ($klinik->rt === null) {
                $klinik->rt = '';
            }
            $klinik->rw = $request->input('rw');
            if ($klinik->rw === null) {
                $klinik->rw = '';
            }
            $klinik->telepon = $request->input('telepon');
            if ($klinik->telepon === null) {
                $klinik->telepon = '';
            }
            $klinik->email = $request->input('email');
            if ($klinik->email === null) {
                $klinik->email = '';
            }
            $klinik->alamat = $request->input('alamat');
            if ($klinik->alamat === null) {
                $klinik->alamat = '';
            }
            $klinik->latitude = $request->input('latitude');
            if ($klinik->latitude === null) {
                $klinik->latitude = 0;
            }
            $klinik->longitude = $request->input('longitude');
            if ($klinik->longitude === null) {
                $klinik->longitude = 0;
            }
            $klinik->website = $request->input('website');
            if ($klinik->website === null) {
                $klinik->website = '';
            }
            $klinik->npwp = $request->input('npwp');
            if ($klinik->npwp === null) {
                $klinik->npwp = '';
            }
            $klinik->no_register = $request->input('no_register');
            if ($klinik->no_register === null) {
                $klinik->no_register = '';
            }
            $klinik->tgl_berlaku_register = $request->input('tgl_berlaku_register');
            if ($klinik->tgl_berlaku_register === null) {
                $klinik->tgl_berlaku_register = '1900-01-01';
            }
            $klinik->nama_apj = $request->input('nama_apj');
            if ($klinik->nama_apj === null) {
                $klinik->nama_apj = '';
            }
            $klinik->no_stra = $request->input('no_stra');
            if ($klinik->no_stra === null) {
                $klinik->no_stra = '';
            }
            $klinik->tgl_berlaku_stra = $request->input('tgl_berlaku_stra');
            if ($klinik->tgl_berlaku_stra === null) {
                $klinik->tgl_berlaku_stra = '1900-01-01';
            }
            $klinik->no_sipa = $request->input('no_sipa');
            if ($klinik->no_sipa === null) {
                $klinik->no_sipa = '';
            }
            $klinik->tgl_berlaku_sipa = $request->input('tgl_berlaku_sipa');
            if ($klinik->tgl_berlaku_sipa === null) {
                $klinik->tgl_berlaku_sipa = '1900-01-01';
            }
            $klinik->file_logo = $request->input('file_logo');
            if ($klinik->file_logo === null) {
                $klinik->file_logo = 'letter-s.png';
            }

            $klinik->update();

            if($request->has('attachments_logo') && sizeof($request->get('attachments_logo')) > 0) {
                $media = LogoPhoto::where('klinik_id', $klinik->id)->pluck('path')->toArray();
                foreach ($request->input('attachments_logo', []) as $file) {
                    if(count($media)=== 0 || !in_array($file, $media)) {
                        LogoPhoto::create(['klinik_id' => $klinik->id, 'path' => $file]);
                    }
                }
            }

            if($request->has('attachments_register') && sizeof($request->get('attachments_register')) > 0) {
                $media = RegisterPhoto::where('klinik_id', $klinik->id)->pluck('path')->toArray();
                foreach ($request->input('attachments_register', []) as $file) {
                    if(count($media)=== 0 || !in_array($file, $media)) {
                        RegisterPhoto::create(['klinik_id' => $klinik->id, 'path' => $file]);
                    }
                }
            }

            if($request->has('attachments_stra') && sizeof($request->get('attachments_stra')) > 0) {
                $media = StraPhoto::where('klinik_id', $klinik->id)->pluck('path')->toArray();
                foreach ($request->input('attachments_stra', []) as $file) {
                    if(count($media)=== 0 || !in_array($file, $media)) {
                        StraPhoto::create(['klinik_id' => $klinik->id, 'path' => $file]);
                    }
                }
            }

            if($request->has('attachments_sipa') && sizeof($request->get('attachments_sipa')) > 0) {
                $media = SipaPhoto::where('klinik_id', $klinik->id)->pluck('path')->toArray();
                foreach ($request->input('attachments_sipa', []) as $file) {
                    if(count($media)=== 0 || !in_array($file, $media)) {
                        SipaPhoto::create(['klinik_id' => $klinik->id, 'path' => $file]);
                    }
                }
            }

            // if ($request->hasFile('attachments_register')) {
            //     foreach ($request->file('attachments_register') as $attachment) {
            //         $filename = $attachment->getClientOriginalName();
            //         $attachment->move(public_path('img'), $filename);
            //         $klinik->attachments()->create([
            //             'path' => 'img/' . $filename,
            //         ]);
            //     }
            // }

            return response()->json('Data berhasil disimpan', 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);;
        }
        
    }

    public function uploadlogo(Request $request)
    {
        $path = public_path('img/user/logo');
        !file_exists($path) && mkdir($path, 0777, true);
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move($path, $name);
        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function uploadreg(Request $request)
    {
        $path = public_path('img/user/doc-reg');
        !file_exists($path) && mkdir($path, 0777, true);
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move($path, $name);
        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function uploadstra(Request $request)
    {
        $path = public_path('img/user/doc-stra');
        !file_exists($path) && mkdir($path, 0777, true);
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move($path, $name);
        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function uploadsipa(Request $request)
    {
        $path = public_path('img/user/doc-sipa');
        !file_exists($path) && mkdir($path, 0777, true);
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move($path, $name);
        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function fileLogoDestroy(Request $request)
    {
        $path = public_path('img/user/logo') . '/' . $request->filename;
        if (file_exists($path)) {
            LogoPhoto::where('path', $request->filename)->delete();
            unlink($path);
        }
        return $request->filename;
    }

    public function fileRegDestroy(Request $request)
    {
        $path = public_path('img/user/doc-reg') . '/' . $request->filename;
        if (file_exists($path)) {
            RegisterPhoto::where('path', $request->filename)->delete();
            unlink($path);
        }
        return $request->filename;
    }
    
    public function fileStraDestroy(Request $request)
    {
        $path = public_path('img/user/doc-stra') . '/' . $request->filename;
        if (file_exists($path)) {
            StraPhoto::where('path', $request->filename)->delete();
            unlink($path);
        }
        return $request->filename;
    }

    public function fileSipaDestroy(Request $request)
    {
        $path = public_path('img/user/doc-sipa') . '/' . $request->filename;
        if (file_exists($path)) {
            SipaPhoto::where('path', $request->filename)->delete();
            unlink($path);
        }
        return $request->filename;
    }

    public function readLogoFiles($id = "")
    {
        $images = LogoPhoto::where('klinik_id', $id)->get()->toArray();
        $data = [];
        if (isset($images) && !empty($images)) {
            foreach ($images as $image) {
                $tableImages[] = $image['path'];
            }
            $storeFolder = public_path('img/user/logo');
            $file_path = public_path('img/user/logo');
            $files = scandir($storeFolder);
            $data = [];
            foreach ($files as $file) {
                if ($file != '.' && $file != '..' && in_array($file, $tableImages)) {
                    $obj['name'] = $file;
                    $file_path = public_path('img/user/logo') . '/' . $file;
                    $obj['size'] = filesize($file_path);
                    $obj['path'] = asset('img/user/logo') . '/' . $file;
                    $data[] = $obj;
                }

            }
        }
        return response()->json($data);
    }

    public function readRegFiles($id = "")
    {
        $images = RegisterPhoto::where('klinik_id', $id)->get()->toArray();
        $data = [];
        if (isset($images) && !empty($images)) {
            foreach ($images as $image) {
                $tableImages[] = $image['path'];
            }
            $storeFolder = public_path('img/user/doc-reg');
            $file_path = public_path('img/user/doc-reg');
            $files = scandir($storeFolder);
            $data = [];
            foreach ($files as $file) {
                if ($file != '.' && $file != '..' && in_array($file, $tableImages)) {
                    $obj['name'] = $file;
                    $file_path = public_path('img/user/doc-reg') . '/' . $file;
                    $obj['size'] = filesize($file_path);
                    $obj['path'] = asset('img/user/doc-reg') . '/' . $file;
                    $data[] = $obj;
                }

            }
        }
        return response()->json($data);
    }

    public function readStraFiles($id = "")
    {
        $images = StraPhoto::where('klinik_id', $id)->get()->toArray();
        $data = [];
        if (isset($images) && !empty($images)) {
            foreach ($images as $image) {
                $tableImages[] = $image['path'];
            }
            $storeFolder = public_path('img/user/doc-stra');
            $file_path = public_path('img/user/doc-stra');
            $files = scandir($storeFolder);
            $data = [];
            foreach ($files as $file) {
                if ($file != '.' && $file != '..' && in_array($file, $tableImages)) {
                    $obj['name'] = $file;
                    $file_path = public_path('img/user/doc-stra') . '/' . $file;
                    $obj['size'] = filesize($file_path);
                    $obj['path'] = asset('img/user/doc-stra') . '/' . $file;
                    $data[] = $obj;
                }

            }
        }
        return response()->json($data);
    }

    public function readSipaFiles($id = "")
    {
        $images = SipaPhoto::where('klinik_id', $id)->get()->toArray();
        $data = [];
        if (isset($images) && !empty($images)) {
            foreach ($images as $image) {
                $tableImages[] = $image['path'];
            }
            $storeFolder = public_path('img/user/doc-sipa');
            $file_path = public_path('img/user/doc-sipa');
            $files = scandir($storeFolder);
            $data = [];
            foreach ($files as $file) {
                if ($file != '.' && $file != '..' && in_array($file, $tableImages)) {
                    $obj['name'] = $file;
                    $file_path = public_path('img/user/doc-sipa') . '/' . $file;
                    $obj['size'] = filesize($file_path);
                    $obj['path'] = asset('img/user/doc-sipa') . '/' . $file;
                    $data[] = $obj;
                }

            }
        }
        return response()->json($data);
    }
}
