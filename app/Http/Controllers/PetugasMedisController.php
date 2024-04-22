<?php

namespace App\Http\Controllers;
use App\Models\PetugasMedis;
use App\Models\BagianSpesialisasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;

class PetugasMedisController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        $bagianspesialisasi = BagianSpesialisasi::where('id_klinik', $idklinik)->pluck('nama_bagian', 'id');
        return view('master.petugas.index', compact('bagianspesialisasi'));
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $bagianspesialisasi = BagianSpesialisasi::all()->pluck('nama_bagian', 'id');
        $petugas = PetugasMedis::join('bagian_spesialisasi', 'bagian_spesialisasi.id', '=', 'petugas_medis.id_bagian')
                    ->select('petugas_medis.*', 'bagian_spesialisasi.nama_bagian')
                    ->where('bagian_spesialisasi.id_klinik', $idklinik)
                    ->orderBy('petugas_medis.id', 'desc')->get();

        return Datatables::of($petugas)
            ->addIndexColumn()
            ->addColumn('action', function($petugas){
                return '
                <div class="action-buttons">
                    <center>
                        <button onClick="editFormPetugas(`'. route('petugas.update', $petugas->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                        <button onClick="deleteDataPetugas(`'. route('petugas.update', $petugas->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    </center>
                </div>
                ';
            })
            ->rawColumns(['status_aktif', 'action'])
            ->make(true);

        return view('master.petugas.index', compact('bagianspesialisasi'));
    }

    public function store(Request $request)
    {
        $idklinik = auth()->user()->id_klinik;
        $nik = $request->nik;
        $email = $request->email;
        $username = $request->username;
        $validator = Validator::make($request->all(), [
            'nik' => [
                'required',
                'max:16',
                Rule::unique('petugas_medis')->where(function ($query) use ($idklinik, $nik) {
                    return $query->join('bagian_spesialisasi as b', function($join) use ($idklinik) {
                                    $join->on('b.id', '=', 'petugas_medis.id_bagian')
                                         ->where('b.id_klinik', $idklinik);
                                 })
                                 ->where('petugas_medis.nik', $nik);
                }),
            ],
            'nama' => 'required',
            'id_satu_sehat' => 'nullable',
            'id_bagian' => 'required',
            'email' => [
                'required',
                Rule::unique('petugas_medis')->where(function ($query) use ($idklinik, $email) {
                    return $query->join('bagian_spesialisasi as b', function($join) use ($idklinik) {
                                    $join->on('b.id', '=', 'petugas_medis.id_bagian')
                                         ->where('b.id_klinik', $idklinik);
                                 })
                                 ->where('petugas_medis.email', $email);
                }),
            ],
            'alamat' => 'nullable|max:255',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'tgl_masuk' => 'nullable',
            'username' => [
                'required',
                'max:20',
                Rule::unique('petugas_medis')->where(function ($query) use ($idklinik, $username) {
                    return $query->join('bagian_spesialisasi as b', function($join) use ($idklinik) {
                                    $join->on('b.id', '=', 'petugas_medis.id_bagian')
                                         ->where('b.id_klinik', $idklinik);
                                 })
                                 ->where('petugas_medis.username', $username);
                }),
            ],
        ], 
        [
            'nik.required' => 'NIK harus diisi.',
            'nik.unique' => 'NIK sudah digunakan.',
            'nik.max' => 'Maksimal jumlah karakter untuk NIK adalah 16 digit.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
            'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
            'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'username.max' => 'Maksimal jumlah karakter untuk Nomor Username adalah 20 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $tglmasuk = Carbon::createFromFormat('d F Y', $request->tgl_masuk)->format('Y-m-d');
            $petugas = new PetugasMedis();
            $petugas->nik = $request->nik;
            $petugas->nama = $request->nama;
            $petugas->id_satu_sehat = $request->id_satu_sehat;
            $petugas->id_bagian = $request->id_bagian;
            $petugas->email = $request->email;
            $petugas->alamat = $request->alamat;
            $petugas->kota = $request->kota;
            $petugas->telepon = $request->telepon;
            $petugas->tgl_masuk = $tglmasuk;
            $petugas->username = $request->username;
            $petugas->status_aktif = $request->status_aktif;

            if ($request->hasFile('path_foto')){
                $nm_foto = $request->path_foto;
                $namaFile_foto = time().rand(100, 999).".".$nm_foto->getClientOriginalExtension();
                $petugas->path_foto = $namaFile_foto;
                $nm_foto->move(public_path('img/user/petugas/foto/'), $namaFile_foto);
            }

            $petugas->save();

            return response()->json(['success' => 'Data baru berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] // Menampilkan pesan error asli dari Exception
            ], 500);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $petugas = PetugasMedis::findOrFail($id);

    //     $nikLama = $petugas->nik;
    //     $namaLama = $petugas->nama;
    //     $idSatuSehatLama = $petugas->id_satu_sehat;
    //     $idBagianLama = $petugas->id_bagian;
    //     $emailLama = $petugas->email;
    //     $alamatLama = $petugas->alamat;
    //     $kotaLama = $petugas->kota;
    //     $teleponLama = $petugas->telepon;
    //     $tglMasukLama = $petugas->tgl_masuk;
    //     $usernameLama = $petugas->username;
    //     $statusAktifLama = $petugas->status_aktif;

    //     $nikBaru = $request->input('nik');
    //     $namaBaru = $request->input('nama');
    //     $idSatuSehatBaru = $request->input('id_satu_sehat');
    //     $idBagianBaru = $request->input('id_bagian');
    //     $emailBaru = $request->input('email');
    //     $alamatBaru = $request->input('alamat');
    //     $kotaBaru = $request->input('kota');
    //     $teleponBaru = $request->input('telepon');
    //     $tglMasukBaru = Carbon::createFromFormat('d F Y', $request->tgl_masuk)->format('Y-m-d');
    //     $usernameBaru = $request->input('username');
    //     $statusAktifBaru = $request->input('status_aktif');

    //     $isChanged = false;
        
    //     if ($nikLama !== $nikBaru){
    //         $isChanged = true;
    //     }
    //     if ($namaLama !== $namaBaru){
    //         $isChanged = true;
    //     }
    //     if ($idSatuSehatLama !== $idSatuSehatBaru){
    //         $isChanged = true;
    //     }
    //     if ($idBagianLama !== $idBagianBaru){
    //         $isChanged = true;
    //     }
    //     if ($emailLama !== $emailBaru){
    //         $isChanged = true;
    //     }
    //     if ($alamatLama !== $alamatBaru){
    //         $isChanged = true;
    //     }
    //     if ($kotaLama !== $kotaBaru){
    //         $isChanged = true;
    //     }
    //     if ($teleponLama !== $teleponBaru){
    //         $isChanged = true;
    //     }
    //     if ($tglMasukLama !== $tglMasukBaru){
    //         $isChanged = true;
    //     }
    //     if ($usernameLama !== $usernameBaru){
    //         $isChanged = true;
    //     }
    //     if ($statusAktifLama !== $statusAktifBaru){
    //         $isChanged = true;
    //     }

    //     if (!$isChanged) {
    //         return response()->json(['success' => 'Tidak ada perubahan yang perlu disimpan']);
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'nik' => [
    //             'required',
    //             'max:16',
    //             Rule::unique('petugas_medis')->where(function ($query) use ($idBagianBaru, $nikBaru) {
    //                 return $query->where('id_bagian', $idBagianBaru)
    //                             ->where('nik', $nikBaru);
    //             }),
    //         ],
    //         'nama' => 'required',
    //         'id_satu_sehat' => 'nullable',
    //         'id_bagian' => 'required',
    //         'email' => [
    //             'required',
    //             Rule::unique('petugas_medis')->where(function ($query) use ($idBagianBaru, $emailBaru) {
    //                 return $query->where('id_bagian', $idBagianBaru)
    //                             ->where('email', $emailBaru);
    //             }),
    //         ],
    //         'alamat' => 'nullable|max:255',
    //         'kota' => 'nullable|max:100',
    //         'telepon' => 'nullable|max:20',
    //         'tgl_masuk' => 'nullable',
    //         'username' => [
    //             'required',
    //             'max:20',
    //             Rule::unique('petugas_medis')->where(function ($query) use ($idBagianBaru, $usernameBaru) {
    //                 return $query->where('id_bagian', $idBagianBaru)
    //                             ->where('username', $usernameBaru);
    //             }),
    //         ],
    //     ], 
    //     [
    //         'nik.required' => 'NIK harus diisi.',
    //         'nik.unique' => 'NIK sudah digunakan.',
    //         'nik.max' => 'Maksimal jumlah karakter untuk NIK adalah 16 digit.',
    //         'email.required' => 'Email harus diisi.',
    //         'email.unique' => 'Email sudah digunakan.',
    //         'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
    //         'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
    //         'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
    //         'username.unique' => 'Username sudah digunakan.',
    //         'username.max' => 'Maksimal jumlah karakter untuk Nomor Username adalah 20 karakter.',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => $validator->errors()->all()
    //         ], 422);
    //     }

    //     try {
    //         $ubah = PetugasMedis::findorfail($id);
    //         $awal_foto = $ubah->path_foto;
    //         $tglmasuk = Carbon::createFromFormat('d F Y', $request->tgl_masuk)->format('Y-m-d');
    //         $dt = [
    //             'nik' => $nikBaru,
    //             'nama' => $namaBaru,
    //             'id_satu_sehat' => $idSatuSehatBaru,
    //             'id_bagian' => $idBagianBaru,
    //             'email' => $emailBaru,
    //             'alamat' => $alamatBaru,
    //             'kota' => $kotaBaru,
    //             'telepon' => $teleponBaru,
    //             'tgl_masuk' => $tglMasukBaru,
    //             'username' => $usernameBaru,
    //             'status_aktif' => $statusAktifBaru,
    //         ];

    //         $hiddenFoto =  $request->hidden_foto;
    //         if($hiddenFoto == 'reset'){
    //             $dt['path_foto'] = 'no-photo.png';
    //             if ($awal_foto != 'no-photo.png' && file_exists(public_path('img/user/petugas/foto') . '/' . $awal_foto)) {
    //                 unlink(public_path('img/user/petugas/foto') . '/' . $awal_foto);
    //             }
    //         }

    //         if ($request->hasFile('path_foto')){
    //             $nm_foto = $request->path_foto;
    //             $namaFile_foto = time() . rand(100, 999) . "." . $nm_foto->getClientOriginalExtension();
    //             $request->path_foto->move(public_path('img/user/petugas/foto/'), $namaFile_foto);
    //             $dt['path_foto'] = $namaFile_foto;
    //             if ($awal_foto != 'no-photo.png' && file_exists(public_path('img/user/petugas/foto') . '/' . $awal_foto)) {
    //                 unlink(public_path('img/user/petugas/foto') . '/' . $awal_foto);
    //             }
    //         }

    //         $ubah->update($dt);
    //         return response()->json(['success' => 'Data berhasil diperbaharui', 200]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => [$e->getMessage()]
    //         ], 500);
    //     }
    // }

    public function update(Request $request, $id)
    {
        $petugas = PetugasMedis::findOrFail($id);
        $awal_foto = $petugas->path_foto;
        $idklinik = auth()->user()->id_klinik;
        // Mendapatkan data yang ada dalam database
        $nikLama = $petugas->nik;
        $idBagianLama = $petugas->id_bagian;
        $emailLama = $petugas->email;
        $usernameLama = $petugas->username;

        // Mendapatkan data yang baru dari permintaan (request)
        $nikBaru = $request->nik;
        $namaBaru = $request->input('nama');
        $idSatuSehatBaru = $request->input('id_satu_sehat');
        $idBagianBaru = $request->id_bagian;
        $emailBaru = $request->email;
        $alamatBaru = $request->input('alamat');
        $kotaBaru = $request->input('kota');
        $teleponBaru = $request->input('telepon');
        $tglMasukBaru = Carbon::createFromFormat('d F Y', $request->tgl_masuk)->format('Y-m-d');
        $usernameBaru = $request->username;
        $statusAktifBaru = $request->input('status_aktif');

        // Memeriksa apakah ada perubahan pada setiap field yang diharuskan unik
        $isUniqueChanged = false;

        if ($nikLama != $nikBaru) {
            $isUniqueChanged = true;
        }
        if ($emailLama != $emailBaru) {
            $isUniqueChanged = true;
        }
        if ($usernameLama != $usernameBaru) {
            $isUniqueChanged = true;
        }

        // Jika ada perubahan pada field yang diharuskan unik, lakukan validasi
        if ($isUniqueChanged) {
            $validator = Validator::make($request->all(), [
                'nik' => [
                    'required',
                    'max:16',
                    Rule::unique('petugas_medis')->where(function ($query) use ($idklinik, $nikBaru) {
                        return $query->join('bagian_spesialisasi as b', function($join) use ($idklinik) {
                                        $join->on('b.id', '=', 'petugas_medis.id_bagian')
                                             ->where('b.id_klinik', $idklinik);
                                     })
                                     ->where('petugas_medis.nik', $nikBaru);
                    }),
                ],
                'email' => [
                    'required',
                    Rule::unique('petugas_medis')->where(function ($query) use ($idklinik, $emailBaru) {
                        return $query->join('bagian_spesialisasi as b', function($join) use ($idklinik) {
                                        $join->on('b.id', '=', 'petugas_medis.id_bagian')
                                             ->where('b.id_klinik', $idklinik);
                                     })
                                     ->where('petugas_medis.email', $emailBaru);
                    }),
                ],
                'username' => [
                    'required',
                    'max:20',
                    Rule::unique('petugas_medis')->where(function ($query) use ($idklinik, $usernameBaru) {
                        return $query->join('bagian_spesialisasi as b', function($join) use ($idklinik) {
                                        $join->on('b.id', '=', 'petugas_medis.id_bagian')
                                             ->where('b.id_klinik', $idklinik);
                                     })
                                     ->where('petugas_medis.username', $usernameBaru);
                    }),
                ],
                'nama' => 'required',
                'id_satu_sehat' => 'nullable',
                'id_bagian' => 'required',
                'alamat' => 'nullable|max:255',
                'kota' => 'nullable|max:100',
                'telepon' => 'nullable|max:20',
                'tgl_masuk' => 'nullable',
            ], [
                'nik.required' => 'NIK harus diisi',
                'nik.unique' => 'NIK sudah digunakan',
                'nik.max' => 'Maksimal jumlah karakter untuk NIK adalah 16 digit',
                'email.required' => 'Email harus diisi.',
                'email.unique' => 'Email sudah digunakan.',
                'username.unique' => 'Username sudah digunakan.',
                'username.max' => 'Maksimal jumlah karakter untuk Nomor Username adalah 20 karakter.',
                'nama.required' => 'Nama harus diisi',
                'id_bagian.required' => 'Bagian/Spesialisasi harus diisi',
                'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
                'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
                'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all()
                ], 422);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|max:16',
                'email' => 'required',
                'username' => 'required|max:20',
                'nama' => 'required',
                'id_satu_sehat' => 'nullable',
                'id_bagian' => 'required',
                'alamat' => 'nullable|max:255',
                'kota' => 'nullable|max:100',
                'telepon' => 'nullable|max:20',
                'tgl_masuk' => 'nullable',
            ], [
                'nik.required' => 'NIK harus diisi',
                'nik.max' => 'Maksimal jumlah karakter untuk NIK adalah 16 digit',
                'email.required' => 'Email harus diisi.',
                'username.required' => 'Username harus diisi.',
                'username.max' => 'Maksimal jumlah karakter untuk Nomor Username adalah 20 karakter.',
                'nama.required' => 'Nama harus diisi',
                'id_bagian.required' => 'Bagian/Spesialisasi harus diisi',
                'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
                'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
                'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all()
                ], 422);
            }
        }

        $dt = [
            'nik' => $nikBaru,
            'nama' => $namaBaru,
            'id_satu_sehat' => $idSatuSehatBaru,
            'id_bagian' => $idBagianBaru,
            'email' => $emailBaru,
            'alamat' => $alamatBaru,
            'kota' => $kotaBaru,
            'telepon' => $teleponBaru,
            'tgl_masuk' => $tglMasukBaru,
            'username' => $usernameBaru,
            'status_aktif' => $statusAktifBaru,
        ];

        $hiddenFoto =  $request->hidden_foto;
        if($hiddenFoto == 'reset'){
            $dt['path_foto'] = 'no-photo.png';
            if ($awal_foto != 'no-photo.png' && file_exists(public_path('img/user/petugas/foto') . '/' . $awal_foto)) {
                unlink(public_path('img/user/petugas/foto') . '/' . $awal_foto);
            }
        }

        if ($request->hasFile('path_foto')){
            $nm_foto = $request->path_foto;
            $namaFile_foto = time() . rand(100, 999) . "." . $nm_foto->getClientOriginalExtension();
            $request->path_foto->move(public_path('img/user/petugas/foto/'), $namaFile_foto);
            $dt['path_foto'] = $namaFile_foto;
            if ($awal_foto != 'no-photo.png' && file_exists(public_path('img/user/petugas/foto') . '/' . $awal_foto)) {
                unlink(public_path('img/user/petugas/foto') . '/' . $awal_foto);
            }
        }

        $petugas->update($dt);

        return response()->json(['success' => 'Data berhasil diperbaharui'], 200);
    }


    public function show($id)
    {
        $petugas = PetugasMedis::find($id);
        return response()->json($petugas);
    }
    
    public function destroy($id)
    {
        try {
            $petugas = PetugasMedis::findOrFail($id);
            $path_foto = $petugas->path_foto;
            $petugas->delete();
            if ($path_foto !== 'no-photo.png' && file_exists(public_path('img/user/petugas/foto') . '/' . $path_foto)) {
                unlink(public_path('img/user/petugas/foto') . '/' . $path_foto);
            }
            return response()->json(['success'=>'petugas berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()]
            ], 500);
        }
    }

}
