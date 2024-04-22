<?php

namespace App\Http\Controllers;
use App\Models\Gudang;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class GudangController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        return view('master.gudang.index', compact('idklinik'));
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $gudang = Gudang::where('gudang.id_klinik', $idklinik)
                    ->orderBy('gudang.id', 'asc')->get();

        return Datatables::of($gudang)
            ->addIndexColumn()
            ->addColumn('action', function($gudang){
                $defaultButton = '';
                if($gudang->as_default == 0) {
                    $defaultButton = '
                        <button onClick="deleteDataGudang(`'. route('gudang.update', $gudang->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                        <button onClick="defaultDataGudang(`'. route('gudang.setdefault', $gudang->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-primary pl-2 pr-2" data-toggle="tooltip" title="Set as Default"><i class="fa fa-key text-xs"></i></button>
                    ';
                } else {
                    $defaultButton = '
                        <button onClick="deleteDataGudang(`'. route('gudang.update', $gudang->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-gray pl-2 pr-2" data-toggle="tooltip" title="Delete" disabled><i class="fa fa-trash text-xs"></i></button>
                        <button onClick="defaultDataGudang(`'. route('gudang.setdefault', $gudang->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-gray pl-2 pr-2" data-toggle="tooltip" title="Already as Default" disabled><i class="fa fa-key text-xs"></i></button>
                    ';
                }
                return '
                <div class="action-buttons">
                    <center>
                        <button onClick="editFormGudang(`'. route('gudang.update', $gudang->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                        '.$defaultButton.'
                    </center>
                </div>
                ';
            })
            ->rawColumns(['status_aktif', 'action'])
            ->make(true);

        return view('master.gudang.index', compact('idklinik'));
    }

    public function store(Request $request)
    {
        $idklinik = auth()->user()->id_klinik;

        $lastGudang = Gudang::where('id_klinik', $idklinik)->orderBy('id', 'desc')->first();

        if ($lastGudang) {
            $lastKodeGudang = $lastGudang->kode;
            $kodeGudangNumber = (int)substr($lastKodeGudang, 3);
            $kodeGudangNumber++;
            $newKodeGudang = 'GDG' . str_pad($kodeGudangNumber, 4, '0', STR_PAD_LEFT);
        } else {
            $newKodeGudang = 'GDG0001';
        }

        $request->merge(['kode' => $newKodeGudang]);
        $nama = $request->nama;

        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => [
                'required',
                'max:100',
                Rule::unique('gudang')->where(function ($query) use ($idklinik, $nama) {
                    return $query->where('id_klinik', $idklinik)
                                 ->where('nama', $nama);
                }),
            ],
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|max:100',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'no_hp' => 'nullable|max:30',
        ], 
        [
            'kode.required' => 'Kode harus diisi.',
            'nama.required' => 'Nama Gudang harus diisi.',
            'nama.unique' => 'Nama Gudang sudah digunakan.',
            'nama.max' => 'Maksimal jumlah karakter untuk Nama Gudang adalah 100 digit.',
            'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
            'email.max' => 'Maksimal jumlah karakter untuk Email adalah 100 karakter.',
            'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
            'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            'no_hp.max' => 'Maksimal jumlah karakter untuk Nomor Handphone adalah 30 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $gudang = new Gudang();
            $gudang->id_klinik = $idklinik;
            $gudang->kode = $request->kode;
            $gudang->nama = $request->nama;
            $gudang->alamat = $request->alamat;
            $gudang->kota = $request->kota;
            $gudang->telepon = $request->telepon;
            $gudang->no_hp = $request->no_hp;
            $gudang->email = $request->email;
            $gudang->status_aktif = $request->status_aktif;
            $gudang->as_default = 0;

            $gudang->save();

            return response()->json(['success' => 'Data baru berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] 
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $gudang = Gudang::findOrFail($id);
        $idklinik = auth()->user()->id_klinik;
        $namaLama = $gudang->nama;
        $namaBaru = $request->nama;
        $statusLama = $gudang->status_aktif;
        $statusBaru = $request->status_aktif;
        
        if ($gudang->as_default == 1) {
            if ($statusLama != $statusBaru) {
                return response()->json(['error' => 'Data tidak dapat dinonaktifkan karena sedang ditetapkan sebagai data Gudang default.'], 422);
            }
        }

        if ($namaLama != $namaBaru) {
            $validasiNama = Validator::make($request->all(), [
                'nama' => [
                    'required',
                    'max:100',
                    Rule::unique('gudang')->where(function ($query) use ($idklinik, $namaBaru) {
                        return $query->where('id_klinik', $idklinik)
                                     ->where('nama', $namaBaru);
                    }),
                ],
            ], [
                'nama.required' => 'Nama Gudang harus diisi.',
                'nama.unique' => 'Nama Gudang sudah digunakan.',
                'nama.max' => 'Maksimal jumlah karakter untuk Nama Gudang adalah 100 digit.',
            ]);

            if ($validasiNama->fails()) {
                return response()->json([
                    'error' => $validasiNama->errors()->all()
                ], 422);
            }
        }

        $validator = Validator::make($request->all(), [
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|max:100',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'no_hp' => 'nullable|max:30',
        ], 
        [
            'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
            'email.max' => 'Maksimal jumlah karakter untuk Email adalah 100 karakter.',
            'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
            'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            'no_hp.max' => 'Maksimal jumlah karakter untuk Nomor Handphone adalah 30 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        $gudang->nama = $namaBaru;
        $gudang->alamat = $request->alamat;
        $gudang->kota = $request->kota;
        $gudang->telepon = $request->telepon;
        $gudang->no_hp = $request->no_hp;
        $gudang->email = $request->email;
        $gudang->status_aktif = $request->status_aktif;

        $gudang->update();

        return response()->json(['success' => 'Data berhasil diperbaharui'], 200);
    }

    public function setAsDefault($id)
    {
        $idklinik = auth()->user()->id_klinik;
        $gudang = Gudang::findOrFail($id);
        $status = $gudang->status_aktif;

        if($status == 0) {
            return response()->json(['error' => 'Data dengan status Non Aktif tidak dapat ditetapkan sebagai Gudang default.'], 422);
        } else {
            Gudang::where('id_klinik', $idklinik)->update(['as_default' => 0]);
            $gudang->as_default = 1;
            $gudang->save();
            return response()->json(['success' => 'Data berhasil ditetapkan sebagai Gudang default.'], 200);
        }
    }

    public function show($id)
    {
        $gudang = Gudang::find($id);
        return response()->json($gudang);
    }
    
    public function destroy($id)
    {
        $gudang = Gudang::find($id);
        
        if ($gudang->as_default == 0) {
            $gudang->delete();
            return response()->json(['success'=>'Data Gudang berhasil dihapus.']);
        } else {
            return response()->json(['error'=>'Data Gudang ini tidak dapat dihapus karena ditetapkan sebagai Gudang default.'], 403);
        }
    }

}
