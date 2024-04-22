<?php

namespace App\Http\Controllers;
use App\Models\Dokter;
use App\Models\SpesialisasiDokter;
use App\Models\DokterPhoto;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DataTables;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        $spesialisasidokter = SpesialisasiDokter::pluck('nama_spesialisasi', 'id');
        return view('master.dokter.index', compact('spesialisasidokter'));
    }

    public function getFotoContent()
    {
        return view('master.dokter.foto');
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $spesialisasidokter = SpesialisasiDokter::all()->pluck('nama_spesialisasi', 'id');
        $dokter = Dokter::join('spesialisasi_dokter', 'spesialisasi_dokter.id', '=', 'dokter.id_spesialis')
                    ->select('dokter.*', 'spesialisasi_dokter.nama_spesialisasi')
                    ->where('dokter.id_klinik', $idklinik)
                    ->orderBy('dokter.id', 'desc')->get();

        return Datatables::of($dokter)
            ->addIndexColumn()
            ->addColumn('action', function($dokter){
                return '
                <div class="action-buttons">
                    <center>
                        <button onClick="editFormDokter(`'. route('dokter.update', $dokter->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                        <button onClick="deleteDataDokter(`'. route('dokter.update', $dokter->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    </center>
                </div>
                ';
            })
            ->rawColumns(['status_aktif', 'action'])
            ->make(true);

        return view('master.dokter.index', compact('spesialisasidokter'));
    }

    public function store(Request $request)
    {
        $idklinik = auth()->user()->id_klinik;
        $nik = $request->nik;
        // $username = $request->username;
        // $email = $request->email;
        $validator = Validator::make($request->all(), [
            'nik' => [
                'required',
                'max:16',
                Rule::unique('dokter')->where(function ($query) use ($idklinik, $nik) {
                    return $query->where('id_klinik', $idklinik)
                                 ->where('nik', $nik);
                }),
            ],
            'nama' => 'required',
            'id_satu_sehat' => 'nullable',
            'id_spesialis' => 'required',
            // 'email' => [
            //     'required',
            //     Rule::unique('dokter')->where(function ($query) use ($idklinik, $email) {
            //         return $query->join('spesialisasi_dokter as b', function($join) use ($idklinik) {
            //                         $join->on('b.id', '=', 'dokter.id_spesialis')
            //                              ->where('b.id_klinik', $idklinik);
            //                      })
            //                      ->where('dokter.email', $email);
            //     }),
            // ],
            'email' => 'required|unique:dokter',
            'alamat' => 'nullable|max:255',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'no_str' => 'nullable|max:100',
            'tgl_masuk' => 'nullable',
            'username' => 'required|max:20|unique:dokter',
            // 'username' => [
            //     'required',
            //     'max:20',
            //     Rule::unique('dokter')->where(function ($query) use ($idklinik, $username) {
            //         return $query->join('spesialisasi_dokter as b', function($join) use ($idklinik) {
            //                         $join->on('b.id', '=', 'dokter.id_spesialis')
            //                              ->where('b.id_klinik', $idklinik);
            //                      })
            //                      ->where('dokter.username', $username);
            //     }),
            // ],
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
            'no_str.max' => 'Maksimal jumlah karakter untuk Nomor STR adalah 100 karakter.',
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
            $dokter = new Dokter();
            $dokter->nik = $request->nik;
            $dokter->nama = $request->nama;
            $dokter->id_satu_sehat = $request->id_satu_sehat;
            $dokter->id_spesialis = $request->id_spesialis;
            $dokter->id_klinik = $idklinik;
            $dokter->email = $request->email;
            $dokter->alamat = $request->alamat;
            $dokter->kota = $request->kota;
            $dokter->telepon = $request->telepon;
            $dokter->no_str = $request->no_str;
            $dokter->tgl_masuk = $tglmasuk;
            $dokter->username = $request->username;
            $dokter->status_aktif = $request->status_aktif;

            if ($request->hasFile('path_foto')){
                $nm_foto = $request->path_foto;
                $namaFile_foto = time().rand(100, 999).".".$nm_foto->getClientOriginalExtension();
                $dokter->path_foto = $namaFile_foto;
                $nm_foto->move(public_path('img/user/dokter/foto/'), $namaFile_foto);
            }

            if ($request->hasFile('path_tdt')){
                $nm_tdt = $request->path_tdt;
                $namaFile_tdt = time().rand(100, 999).".".$nm_tdt->getClientOriginalExtension();
                $dokter->path_tdt = $namaFile_tdt;
                $nm_tdt->move(public_path('img/user/dokter/tdt/'), $namaFile_tdt);
            }

            if ($request->hasFile('path_stamp')){
                $nm_stamp = $request->path_stamp;
                $namaFile_stamp = time().rand(100, 999).".".$nm_stamp->getClientOriginalExtension();
                $dokter->path_stamp = $namaFile_stamp;
                $nm_stamp->move(public_path('img/user/dokter/stamp/'), $namaFile_stamp);
            }

            $dokter->save();

            return response()->json(['success' => 'Data baru berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] // Menampilkan pesan error asli dari Exception
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        $idklinik = auth()->user()->id_klinik;
        $awal_foto = $dokter->path_foto;
        $awal_tdt = $dokter->path_tdt;
        $awal_stamp = $dokter->path_stamp;
        $tglmasuk = Carbon::createFromFormat('d F Y', $request->tgl_masuk)->format('Y-m-d');

        // Mendapatkan data yang ada dalam database
        $nikLama = $dokter->nik;
        // $idSpesialisLama = $dokter->id_spesialis;
        $emailLama = $dokter->email;
        $usernameLama = $dokter->username;

        // Mendapatkan data yang baru dari permintaan (request)
        $nikBaru = $request->nik;
        $namaBaru = $request->nama;
        $idSatuSehatBaru = $request->id_satu_sehat;
        $idSpesialisBaru = $request->id_spesialis;
        $emailBaru = $request->email;
        $alamatBaru = $request->alamat;
        $kotaBaru = $request->kota;
        $teleponBaru = $request->telepon;
        $noStrBaru = $request->no_str;
        $tglMasukBaru = $tglmasuk;
        $usernameBaru = $request->username;
        $statusAktifBaru = $request->status_aktif;

        // Memeriksa apakah ada perubahan pada setiap field yang diharuskan unik
        // $isUniqueChanged = false;

        if ($nikLama != $nikBaru) {
            $validasiNik = Validator::make($request->all(), [
                'nik' => [
                    'required',
                    'max:16',
                    Rule::unique('dokter')->where(function ($query) use ($idklinik, $nikBaru) {
                        return $query->where('id_klinik', $idklinik)
                                     ->where('nik', $nikBaru);
                    }),
                ],
            ], [
                'nik.required' => 'NIK harus diisi.',
                'nik.unique' => 'NIK sudah digunakan.',
                'nik.max' => 'Maksimal jumlah karakter untuk NIK adalah 16 digit.',
            ]);

            if ($validasiNik->fails()) {
                return response()->json([
                    'error' => $validasiNik->errors()->all()
                ], 422);
            }
        }
        if ($usernameLama != $usernameBaru) {
            $validasiUsername = Validator::make($request->all(), [
                'username' => 'required|max:20|unique:dokter,username,'.$id,
            ], [
                'username.required' => 'Username harus diisi.',
                'username.max' => 'Maksimal jumlah karakter untuk Username adalah 20 digit.',
                'username.unique' => 'Username sudah digunakan.',
            ]);

            if ($validasiUsername->fails()) {
                return response()->json([
                    'error' => $validasiUsername->errors()->all()
                ], 422);
            }
        }

        if ($emailLama != $emailBaru) {
            $validasiEmail = Validator::make($request->all(), [
                'email' => 'required|unique:dokter,email,'.$id,
            ], [
                'email.required' => 'Email harus diisi.',
                'email.unique' => 'Email sudah digunakan.',
            ]);

            if ($validasiEmail->fails()) {
                return response()->json([
                    'error' => $validasiEmail->errors()->all()
                ], 422);
            }
        }

        $validator = Validator::make($request->all(), [
            'nik' => 'required|max:16',
            'email' => 'required',
            'username' => 'required|max:20',
            'nama' => 'required',
            'id_satu_sehat' => 'nullable',
            'id_spesialis' => 'required',
            'alamat' => 'nullable|max:255',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'no_str' => 'nullable|max:100',
            'tgl_masuk' => 'nullable',
        ], [
            'nik.required' => 'NIK harus diisi',
            'nik.max' => 'Maksimal jumlah karakter untuk NIK adalah 16 digit',
            'email.required' => 'Email harus diisi.',
            'username.required' => 'Username harus diisi.',
            'username.max' => 'Maksimal jumlah karakter untuk Nomor Username adalah 20 karakter.',
            'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
            'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
            'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            'no_str.max' => 'Maksimal jumlah karakter untuk Nomor STR adalah 100 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        // Jika ada perubahan pada field yang diharuskan unik, lakukan validasi
        // if ($isUniqueChanged) {
        //     $validator = Validator::make($request->all(), [
        //         'nik' => [
        //             'required',
        //             'max:16',
        //             Rule::unique('dokter')->where(function ($query) use ($idklinik, $nikBaru) {
        //                 return $query->join('spesialisasi_dokter as b', function($join) use ($idklinik) {
        //                                 $join->on('b.id', '=', 'dokter.id_spesialis')
        //                                      ->where('b.id_klinik', $idklinik);
        //                              })
        //                              ->where('dokter.nik', $nikBaru);
        //             }),
        //         ],
        //         'email' => 'required|unique:dokter,email,'.$id,
        //         'username' => 'required|max:20|unique:dokter,username,'.$id,
        //         'nama' => 'required',
        //         'id_satu_sehat' => 'nullable',
        //         'id_spesialis' => 'required',
        //         'alamat' => 'nullable|max:255',
        //         'kota' => 'nullable|max:100',
        //         'telepon' => 'nullable|max:20',
        //         'no_str' => 'nullable|max:100',
        //         'tgl_masuk' => 'nullable',
        //     ], [
        //         'nik.required' => 'NIK harus diisi.',
        //         'nik.unique' => 'NIK sudah digunakan.',
        //         'nik.max' => 'Maksimal jumlah karakter untuk NIK adalah 16 digit.',
        //         'email.required' => 'Email harus diisi.',
        //         'email.unique' => 'Email sudah digunakan.',
        //         'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
        //         'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
        //         'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
        //         'no_str.max' => 'Maksimal jumlah karakter untuk Nomor STR adalah 100 karakter.',
        //         'username.unique' => 'Username sudah digunakan.',
        //         'username.max' => 'Maksimal jumlah karakter untuk Nomor Username adalah 20 karakter.',
        //     ]);

        //     if ($validator->fails()) {
        //         return response()->json([
        //             'error' => $validator->errors()->all()
        //         ], 422);
        //     }
        // } else {
        //     $validator = Validator::make($request->all(), [
        //         'nik' => 'required|max:16',
        //         'email' => 'required',
        //         'username' => 'required|max:20',
        //         'nama' => 'required',
        //         'id_satu_sehat' => 'nullable',
        //         'id_spesialis' => 'required',
        //         'alamat' => 'nullable|max:255',
        //         'kota' => 'nullable|max:100',
        //         'telepon' => 'nullable|max:20',
        //         'no_str' => 'nullable|max:100',
        //         'tgl_masuk' => 'nullable',
        //     ], [
        //         'nik.required' => 'NIK harus diisi',
        //         'nik.max' => 'Maksimal jumlah karakter untuk NIK adalah 16 digit',
        //         'email.required' => 'Email harus diisi.',
        //         'username.required' => 'Username harus diisi.',
        //         'username.max' => 'Maksimal jumlah karakter untuk Nomor Username adalah 20 karakter.',
        //         'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
        //         'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
        //         'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
        //         'no_str.max' => 'Maksimal jumlah karakter untuk Nomor STR adalah 100 karakter.',
        //     ]);

        //     if ($validator->fails()) {
        //         return response()->json([
        //             'error' => $validator->errors()->all()
        //         ], 422);
        //     }
        // }

        $dt = [
            'nik' => $nikBaru,
            'nama' => $namaBaru,
            'id_satu_sehat' => $idSatuSehatBaru,
            'id_spesialis' => $idSpesialisBaru,
            'email' => $emailBaru,
            'alamat' => $alamatBaru,
            'kota' => $kotaBaru,
            'telepon' => $teleponBaru,
            'no_str' => $noStrBaru,
            'tgl_masuk' => $tglMasukBaru,
            'username' => $usernameBaru,
            'status_aktif' => $statusAktifBaru,
        ];

        $hiddenFoto =  $request->hidden_foto;
        if($hiddenFoto == 'reset'){
            $dt['path_foto'] = 'no-photo.png';
            if ($awal_foto != 'no-photo.png' && file_exists(public_path('img/user/dokter/foto') . '/' . $awal_foto)) {
                unlink(public_path('img/user/dokter/foto') . '/' . $awal_foto);
            }
        }

        if ($request->hasFile('path_foto')){
            $nm_foto = $request->path_foto;
            $namaFile_foto = time() . rand(100, 999) . "." . $nm_foto->getClientOriginalExtension();
            $request->path_foto->move(public_path('img/user/dokter/foto/'), $namaFile_foto);
            $dt['path_foto'] = $namaFile_foto;
            if ($awal_foto != 'no-photo.png' && file_exists(public_path('img/user/dokter/foto') . '/' . $awal_foto)) {
                unlink(public_path('img/user/dokter/foto') . '/' . $awal_foto);
            }
        }

        $hiddenTdt =  $request->hidden_tdt;
        if($hiddenTdt == 'reset'){
            $dt['path_tdt'] = 'no-photo.png';
            if ($awal_tdt != 'no-photo.png' && file_exists(public_path('img/user/dokter/tdt') . '/' . $awal_tdt)) {
                unlink(public_path('img/user/dokter/tdt') . '/' . $awal_tdt);
            }
        }

        if ($request->hasFile('path_tdt')){
            $nm_tdt = $request->path_tdt;
            $namaFile_tdt = time() . rand(100, 999) . "." . $nm_tdt->getClientOriginalExtension();
            $request->path_tdt->move(public_path('img/user/dokter/tdt'), $namaFile_tdt);
            $dt['path_tdt'] = $namaFile_tdt;
            if ($awal_tdt != 'no-photo.png' && file_exists(public_path('img/user/dokter/tdt') . '/' . $awal_tdt)) {
                unlink(public_path('img/user/dokter/tdt') . '/' . $awal_tdt);
            }
        }

        $hiddenStamp =  $request->hidden_stamp;
        if($hiddenStamp == 'reset'){
            $dt['path_stamp'] = 'no-photo.png';
            if ($awal_stamp != 'no-photo.png' && file_exists(public_path('img/user/dokter/stamp') . '/' . $awal_stamp)) {
                unlink(public_path('img/user/dokter/stamp') . '/' . $awal_stamp);
            }
        }

        if ($request->hasFile('path_stamp')){
            $nm_stamp = $request->path_stamp;
            $namaFile_stamp = time() . rand(100, 999) . "." . $nm_stamp->getClientOriginalExtension();
            $request->path_stamp->move(public_path('img/user/dokter/stamp'), $namaFile_stamp);
            $dt['path_stamp'] = $namaFile_stamp;
            if ($awal_stamp != 'no-photo.png' && file_exists(public_path('img/user/dokter/stamp') . '/' . $awal_stamp)) {
                unlink(public_path('img/user/dokter/stamp') . '/' . $awal_stamp);
            }
        }

        $dokter->update($dt);

        return response()->json(['success' => 'Data berhasil diperbaharui'], 200);
    }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'nik' => 'required|max:16|unique:dokter,nik,'.$id,
    //         'nama' => 'required',
    //         'id_satu_sehat' => 'nullable',
    //         'id_spesialis' => 'required',
    //         'email' => 'required|unique:dokter,email,'.$id,
    //         'alamat' => 'nullable|max:255',
    //         'kota' => 'nullable|max:100',
    //         'telepon' => 'nullable|max:20',
    //         'no_str' => 'nullable|max:100',
    //         'tgl_masuk' => 'nullable',
    //         'username' => 'required|max:20|unique:dokter,username,'.$id,
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
    //         'no_str.max' => 'Maksimal jumlah karakter untuk Nomor STR adalah 100 karakter.',
    //         'username.unique' => 'Username sudah digunakan.',
    //         'username.max' => 'Maksimal jumlah karakter untuk Nomor Username adalah 20 karakter.',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => $validator->errors()->all()
    //         ], 422);
    //     }

    //     try {
    //         $ubah = Dokter::findorfail($id);
    //         $awal_foto = $ubah->path_foto;
    //         $awal_tdt = $ubah->path_tdt;
    //         $awal_stamp = $ubah->path_stamp;
    //         $tglmasuk = Carbon::createFromFormat('d F Y', $request->tgl_masuk)->format('Y-m-d');
    //         $dt = [
    //             'nik' => $request['nik'],
    //             'nama' => $request['nama'],
    //             'id_satu_sehat' => $request['id_satu_sehat'],
    //             'id_spesialis' => $request['id_spesialis'],
    //             'email' => $request['email'],
    //             'alamat' => $request['alamat'],
    //             'kota' => $request['kota'],
    //             'telepon' => $request['telepon'],
    //             'no_str' => $request['no_str'],
    //             'tgl_masuk' => $tglmasuk,
    //             'username' => $request['username'],
    //             'status_aktif' => $request['status_aktif'],
    //         ];

    //         $hiddenFoto =  $request->hidden_foto;
    //         if($hiddenFoto == 'reset'){
    //             $dt['path_foto'] = 'no-photo.png';
    //             if ($awal_foto != 'no-photo.png' && file_exists(public_path('img/user/dokter/foto') . '/' . $awal_foto)) {
    //                 unlink(public_path('img/user/dokter/foto') . '/' . $awal_foto);
    //             }
    //         }

    //         if ($request->hasFile('path_foto')){
    //             $nm_foto = $request->path_foto;
    //             $namaFile_foto = time() . rand(100, 999) . "." . $nm_foto->getClientOriginalExtension();
    //             $request->path_foto->move(public_path('img/user/dokter/foto/'), $namaFile_foto);
    //             $dt['path_foto'] = $namaFile_foto;
    //             if ($awal_foto != 'no-photo.png' && file_exists(public_path('img/user/dokter/foto') . '/' . $awal_foto)) {
    //                 unlink(public_path('img/user/dokter/foto') . '/' . $awal_foto);
    //             }
    //         }

    //         $hiddenTdt =  $request->hidden_tdt;
    //         if($hiddenTdt == 'reset'){
    //             $dt['path_tdt'] = 'no-photo.png';
    //             if ($awal_tdt != 'no-photo.png' && file_exists(public_path('img/user/dokter/tdt') . '/' . $awal_tdt)) {
    //                 unlink(public_path('img/user/dokter/tdt') . '/' . $awal_tdt);
    //             }
    //         }

    //         if ($request->hasFile('path_tdt')){
    //             $nm_tdt = $request->path_tdt;
    //             $namaFile_tdt = time() . rand(100, 999) . "." . $nm_tdt->getClientOriginalExtension();
    //             $request->path_tdt->move(public_path('img/user/dokter/tdt'), $namaFile_tdt);
    //             $dt['path_tdt'] = $namaFile_tdt;
    //             if ($awal_tdt != 'no-photo.png' && file_exists(public_path('img/user/dokter/tdt') . '/' . $awal_tdt)) {
    //                 unlink(public_path('img/user/dokter/tdt') . '/' . $awal_tdt);
    //             }
    //         }

    //         $hiddenStamp =  $request->hidden_stamp;
    //         if($hiddenStamp == 'reset'){
    //             $dt['path_stamp'] = 'no-photo.png';
    //             if ($awal_stamp != 'no-photo.png' && file_exists(public_path('img/user/dokter/stamp') . '/' . $awal_stamp)) {
    //                 unlink(public_path('img/user/dokter/stamp') . '/' . $awal_stamp);
    //             }
    //         }

    //         if ($request->hasFile('path_stamp')){
    //             $nm_stamp = $request->path_stamp;
    //             $namaFile_stamp = time() . rand(100, 999) . "." . $nm_stamp->getClientOriginalExtension();
    //             $request->path_stamp->move(public_path('img/user/dokter/stamp'), $namaFile_stamp);
    //             $dt['path_stamp'] = $namaFile_stamp;
    //             if ($awal_stamp != 'no-photo.png' && file_exists(public_path('img/user/dokter/stamp') . '/' . $awal_stamp)) {
    //                 unlink(public_path('img/user/dokter/stamp') . '/' . $awal_stamp);
    //             }
    //         }

    //         $ubah->update($dt);
    //         return response()->json(['success' => 'Data berhasil diperbaharui', 200]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => [$e->getMessage()] // Menampilkan pesan error asli dari Exception
    //         ], 500);
    //     }
    // }

    // public function uploadFoto(Request $request)
    // {
    //     $path = public_path('img/user/dokter/foto');
    //     !file_exists($path) && mkdir($path, 0777, true);
    //     $file = $request->file('file');
    //     $name = $file->getClientOriginalName();
    //     $file->move($path, $name);
    //     return response()->json([
    //         'name' => $name,
    //         'original_name' => $file->getClientOriginalName(),
    //     ]);
    // }

    // public function fileFotoDestroy(Request $request)
    // {
    //     $path = public_path('img/user/dokter/foto') . '/' . $request->filename;
    //     if (file_exists($path)) {
    //         DokterPhoto::where('path', $request->filename)->delete();
    //         unlink($path);
    //     }
    //     return $request->filename;
    // }

    // public function readFotoFiles($id = "")
    // {
    //     $images = DokterPhoto::where('dokter_id', $id)->get()->toArray();
    //     $data = [];
    //     if (isset($images) && !empty($images)) {
    //         foreach ($images as $image) {
    //             $tableImages[] = $image['path'];
    //         }
    //         $storeFolder = public_path('img/user/dokter/foto');
    //         $file_path = public_path('img/user/dokter/foto');
    //         $files = scandir($storeFolder);
    //         $data = [];
    //         foreach ($files as $file) {
    //             if ($file != '.' && $file != '..' && in_array($file, $tableImages)) {
    //                 $obj['name'] = $file;
    //                 $file_path = public_path('img/user/dokter/foto') . '/' . $file;
    //                 $obj['size'] = filesize($file_path);
    //                 $obj['path'] = asset('img/user/dokter/foto') . '/' . $file;
    //                 $data[] = $obj;
    //             }

    //         }
    //     }
    //     return response()->json($data);
    // }

    public function show($id)
    {
        $poli = Dokter::find($id);
        return response()->json($poli);
    }
    
    public function destroy($id)
    {
        try {
            $dokter = Dokter::findOrFail($id);
            $path_foto = $dokter->path_foto;
            $path_tdt = $dokter->path_tdt;
            $path_stamp = $dokter->path_stamp;
            $dokter->delete();
            if ($path_foto !== 'no-photo.png' && file_exists(public_path('img/user/dokter/foto') . '/' . $path_foto)) {
                unlink(public_path('img/user/dokter/foto') . '/' . $path_foto);
            }
            if ($path_tdt !== 'no-photo.png' && file_exists(public_path('img/user/dokter/tdt') . '/' . $path_tdt)) {
                unlink(public_path('img/user/dokter/tdt') . '/' . $path_tdt);
            }
            if ($path_stamp !== 'no-photo.png' && file_exists(public_path('img/user/dokter/stamp') . '/' . $path_stamp)) {
                unlink(public_path('img/user/dokter/stamp') . '/' . $path_stamp);
            }
            return response()->json(['success'=>'Dokter berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()]
            ], 500);
        }
    }
}
