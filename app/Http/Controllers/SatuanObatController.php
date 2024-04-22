<?php

namespace App\Http\Controllers;
use App\Models\SatuanObat;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SatuanObatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        return view('master.satuan-obat.index', compact('idklinik'));
    }

    public function copyPreset()
    {
        $id_klinik = auth()->user()->id_klinik;
        $current_time = now();
        $satuans = [
            ['id_klinik' => $id_klinik, 'nama' => 'AMPUL'],
            ['id_klinik' => $id_klinik, 'nama' => 'BLISTER'],
            ['id_klinik' => $id_klinik, 'nama' => 'BOTOL'],
            ['id_klinik' => $id_klinik, 'nama' => 'BOTOL KACA'],
            ['id_klinik' => $id_klinik, 'nama' => 'BOTOL PLASTIK'],
            ['id_klinik' => $id_klinik, 'nama' => 'BOX'],
            ['id_klinik' => $id_klinik, 'nama' => 'Bundle'],
            ['id_klinik' => $id_klinik, 'nama' => 'BUNGKUS'],
            ['id_klinik' => $id_klinik, 'nama' => 'CAP'],
            ['id_klinik' => $id_klinik, 'nama' => 'CAPSUL'],
            ['id_klinik' => $id_klinik, 'nama' => 'CATCH COVER'],
            ['id_klinik' => $id_klinik, 'nama' => 'DOZ'],
            ['id_klinik' => $id_klinik, 'nama' => 'DRUM'],
            ['id_klinik' => $id_klinik, 'nama' => 'DRUM PLASTIK'],
            ['id_klinik' => $id_klinik, 'nama' => 'DUS'],
            ['id_klinik' => $id_klinik, 'nama' => 'FIBER DRUM'],
            ['id_klinik' => $id_klinik, 'nama' => 'Kaleng'],
            ['id_klinik' => $id_klinik, 'nama' => 'KAPLET'],
            ['id_klinik' => $id_klinik, 'nama' => 'KAPSUL'],
            ['id_klinik' => $id_klinik, 'nama' => 'KARTON'],
            ['id_klinik' => $id_klinik, 'nama' => 'KOTAK'],
            ['id_klinik' => $id_klinik, 'nama' => 'LEMBAR'],
            ['id_klinik' => $id_klinik, 'nama' => 'mini dos'],
            ['id_klinik' => $id_klinik, 'nama' => 'NEBULES'],
            ['id_klinik' => $id_klinik, 'nama' => 'PACK'],
            ['id_klinik' => $id_klinik, 'nama' => 'PAK'],
            ['id_klinik' => $id_klinik, 'nama' => 'PCS'],
            ['id_klinik' => $id_klinik, 'nama' => 'Plastik'],
            ['id_klinik' => $id_klinik, 'nama' => 'POT'],
            ['id_klinik' => $id_klinik, 'nama' => 'RENCENG'],
            ['id_klinik' => $id_klinik, 'nama' => 'SACHET'],
            ['id_klinik' => $id_klinik, 'nama' => 'SPO'],
            ['id_klinik' => $id_klinik, 'nama' => 'STP'],
            ['id_klinik' => $id_klinik, 'nama' => 'STRIP'],
            ['id_klinik' => $id_klinik, 'nama' => 'SUPPOSITORIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TAB'],
            ['id_klinik' => $id_klinik, 'nama' => 'Tab/kap'],
            ['id_klinik' => $id_klinik, 'nama' => 'TABLET'],
            ['id_klinik' => $id_klinik, 'nama' => 'TB'],
            ['id_klinik' => $id_klinik, 'nama' => 'TUBE'],
            ['id_klinik' => $id_klinik, 'nama' => 'UNIT'],
            ['id_klinik' => $id_klinik, 'nama' => 'VIAL'],
        ];
        try {
            foreach ($satuans as $satuan) {
                $existingData = DB::table('satuan_obat')
                    ->where('id_klinik', $satuan['id_klinik'])
                    ->where('nama', $satuan['nama'])
                    ->first();
                if (!$existingData) {
                    $satuan['created_at'] = $current_time;
                    $satuan['updated_at'] = $current_time;
                    DB::table('satuan_obat')->insert($satuan);
                }
            }
            return response()->json(['success' => 'Data baru berhasil ditambahkan dari Preset.']);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [$th->getMessage()]
            ], 500);
        }
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $satuan = SatuanObat::where('satuan_obat.id_klinik', $idklinik)
                    ->orderBy('satuan_obat.id', 'asc')->get();

        return Datatables::of($satuan)
            ->addIndexColumn()
            ->addColumn('action', function($satuan){
                return '
                <div class="action-buttons">
                    <center>
                        <button onClick="editFormSatuan(`'. route('satuanobat.update', $satuan->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                        <button onClick="deleteDataSatuan(`'. route('satuanobat.update', $satuan->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    </center>
                </div>
                ';
            })
            ->rawColumns(['status_aktif', 'action'])
            ->make(true);

        return view('master.satuan-obat.index', compact('idklinik'));
    }

    public function store(Request $request)
    {
        $idklinik = auth()->user()->id_klinik;
        $nama = $request->nama;

        $validator = Validator::make($request->all(), [
            'nama' => [
                'required',
                'max:100',
                Rule::unique('satuan_obat')->where(function ($query) use ($idklinik, $nama) {
                    return $query->where('id_klinik', $idklinik)
                                 ->where('nama', $nama);
                }),
            ],
        ], 
        [
            'nama.required' => 'Nama Satuan Obat harus diisi.',
            'nama.unique' => 'Nama Satuan Obat sudah digunakan.',
            'nama.max' => 'Maksimal jumlah karakter untuk Nama Satuan Obat adalah 100 digit.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $satuan = new SatuanObat();
            $satuan->id_klinik = $idklinik;
            $satuan->nama = $request->nama;
            $satuan->status_aktif = $request->status_aktif;
            $satuan->save();

            return response()->json(['success' => 'Data baru berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] 
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $satuan = SatuanObat::findOrFail($id);
        $idklinik = auth()->user()->id_klinik;
        $namaLama = $satuan->nama;
        $namaBaru = $request->nama;
        $namaLamaUpper = strtoupper($namaLama);
        $namaBaruUpper = strtoupper($namaBaru);

        if ($namaLamaUpper != $namaBaruUpper) {
            $validasiNama = Validator::make($request->all(), [
                'nama' => [
                    'required',
                    'max:100',
                    Rule::unique('satuan_obat')->where(function ($query) use ($idklinik, $namaBaru) {
                        return $query->where('id_klinik', $idklinik)
                                     ->where('nama', $namaBaru);
                    }),
                ],
            ], [
                'nama.required' => 'Nama Satuan Obat harus diisi.',
                'nama.unique' => 'Nama Satuan Obat sudah digunakan.',
                'nama.max' => 'Maksimal jumlah karakter untuk Nama Satuan Obat adalah 100 digit.',
            ]);

            if ($validasiNama->fails()) {
                return response()->json([
                    'error' => $validasiNama->errors()->all()
                ], 422);
            }
        }

        $satuan->nama = $namaBaru;
        $satuan->status_aktif = $request->status_aktif;

        $satuan->update();

        return response()->json(['success' => 'Data berhasil diperbaharui'], 200);
    }

    public function show($id)
    {
        $satuan = SatuanObat::find($id);
        return response()->json($satuan);
    }
    
    public function destroy($id)
    {
        SatuanObat::find($id)->delete();
      
        return response()->json(['success'=>'Satuan Obat deleted successfully.']);
    }

}
