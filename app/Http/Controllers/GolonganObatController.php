<?php

namespace App\Http\Controllers;
use App\Models\GolonganObat;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class GolonganObatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        return view('master.golobat.index', compact('idklinik'));
    }

    public function copyPreset()
    {
        $id_klinik = auth()->user()->id_klinik;
        $current_time = now();
        $golobats = [
            ['id_klinik' => $id_klinik, 'nama' => 'ALAT KESEHATAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANALGESIK ANTIINFLAMASI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANALGESIK ANTIPIRETIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANASTESI LOKAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI AMUBA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI BAKTERI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI HIPERGLIKEMIA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI HIPERLIPIDEMIA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI HIPERTENSI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI HISTAMIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI JAMUR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI KEJANG', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI SPASMODIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI VERTIGO', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI VIRUS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIBIOTIKA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIVIRUS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BATUK PILEK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BEBAS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BEBAS TERBATAS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BELAKANG', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BHP', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BRONKODILATOR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'DEPAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'DIURETIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'EKSPEKTORAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'HIPERURISEMIC', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'INFUS/INJEKSI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KARDIOVASKULAR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KERAS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KORTIKOSTEROID', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MUKOLITIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'NUTRISI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT ALTERNATIF', 'keterangan' => 'Obat yang dipakai sebagai cadangan'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT BEBAS', 'keterangan' => 'Obat yang dijual bebas di pasaran dan dapat dibeli tanpa resep dokter.'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT BEBAS TERBATAS', 'keterangan' => 'Obat yang sebenarnya termasuk obat keras tetapi masih dapat dijual atau dibeli bebas tanpa resep dokter, dan disertai dengan tanda peringatan.'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT DEMAM', 'keterangan' => 'Digunakan Saat Terkena Demam'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT HERBAL', 'keterangan' => 'Obat yang Berbahan Dasar Tumbuhan Alami'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT KERAS', 'keterangan' => 'Obat yang hanya dapat dibeli di apotek dengan resep dokter.'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT NARKOTIKA', 'keterangan' => 'Obat yang berasal dari tanaman atau bukan tanaman baik sintetis maupun semi sintetis yang dapat menyebabkan penurunan atau perubahan kesadaran, hilangnya rasa, mengurangi sampai menghilangkan rasa nyeri dan menimbulkan ketergantungan.'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT OBAT TERTENTU', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT PREKUSOR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT PSIKOTROPIKA', 'keterangan' => 'Obat keras baik alamiah maupun sintetis bukan narkotik, yang berkhasiat psikoaktif melalui pengaruh selektif pada susunan saraf pusat yang menyebabkan perubahan khas pada aktivitas mental dan perilaku.'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT SAKIT ANAK', 'keterangan' => 'Digunakan Saat Anak Terkena Sakit'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT SAKIT KEPALA', 'keterangan' => 'Digunakan Saat Sakit Kepala'],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT TRADISIONAL', 'keterangan' => 'Obat yang Berbahan Dasar dari Resep Turun Temurun'],
            ['id_klinik' => $id_klinik, 'nama' => 'OTC', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PATEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PKRT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PREKURSOR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SALURAN PENCERNAAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SEDIAAN KULIT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SEDIAAN MATA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SEDIAAN REKTAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SUPLEMEN KESEHATAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'TETES MATA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'VAKSIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'VITAMIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'VITAMIN & SUPLEMEN', 'keterangan' => ''],
        ];
        try {
            foreach ($golobats as $golobat) {
                $existingData = DB::table('golongan_obat')
                    ->where('id_klinik', $golobat['id_klinik'])
                    ->where('nama', $golobat['nama'])
                    ->first();
                if (!$existingData) {
                    $golobat['created_at'] = $current_time;
                    $golobat['updated_at'] = $current_time;
                    DB::table('golongan_obat')->insert($golobat);
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
        $golobat = GolonganObat::where('golongan_obat.id_klinik', $idklinik)
                    ->orderBy('golongan_obat.id', 'asc')->get();

        return Datatables::of($golobat)
            ->addIndexColumn()
            ->addColumn('action', function($golobat){
                return '
                <div class="action-buttons">
                    <center>
                        <button onClick="editFormGolobat(`'. route('golobat.update', $golobat->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                        <button onClick="deleteDataGolobat(`'. route('golobat.update', $golobat->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    </center>
                </div>
                ';
            })
            ->rawColumns(['status_aktif', 'action'])
            ->make(true);

        return view('master.golobat.index', compact('idklinik'));
    }

    public function store(Request $request)
    {
        $idklinik = auth()->user()->id_klinik;
        $nama = $request->nama;

        $validator = Validator::make($request->all(), [
            'nama' => [
                'required',
                'max:100',
                Rule::unique('golongan_obat')->where(function ($query) use ($idklinik, $nama) {
                    return $query->where('id_klinik', $idklinik)
                                 ->where('nama', $nama);
                }),
            ],
            'keterangan' => 'nullable|max:255',
        ], 
        [
            'nama.required' => 'Nama Golongan Obat harus diisi.',
            'nama.unique' => 'Nama Golongan Obat sudah digunakan.',
            'nama.max' => 'Maksimal jumlah karakter untuk Nama Golongan Obat adalah 100 digit.',
            'keterangan.max' => 'Maksimal jumlah karakter untuk Keterangan adalah 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $golobat = new GolonganObat();
            $golobat->id_klinik = $idklinik;
            $golobat->nama = $request->nama;
            $golobat->keterangan = $request->keterangan;
            $golobat->status_aktif = $request->status_aktif;
            $golobat->save();

            return response()->json(['success' => 'Data baru berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] 
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $golobat = GolonganObat::findOrFail($id);
        $idklinik = auth()->user()->id_klinik;
        $namaLama = $golobat->nama;
        $namaBaru = $request->nama;

        if ($namaLama != $namaBaru) {
            $validasiNama = Validator::make($request->all(), [
                'nama' => [
                    'required',
                    'max:100',
                    Rule::unique('golongan_obat')->where(function ($query) use ($idklinik, $namaBaru) {
                        return $query->where('id_klinik', $idklinik)
                                     ->where('nama', $namaBaru);
                    }),
                ],
            ], [
                'nama.required' => 'Nama Golongan Obat harus diisi.',
                'nama.unique' => 'Nama Golongan Obat sudah digunakan.',
                'nama.max' => 'Maksimal jumlah karakter untuk Nama Golongan Obat adalah 100 digit.',
            ]);

            if ($validasiNama->fails()) {
                return response()->json([
                    'error' => $validasiNama->errors()->all()
                ], 422);
            }
        }

        $validator = Validator::make($request->all(), [
            'keterangan' => 'nullable|max:255',
        ], 
        [
            'keterangan.max' => 'Maksimal jumlah karakter untuk Keterangan adalah 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        $golobat->nama = $namaBaru;
        $golobat->keterangan = $request->keterangan;
        $golobat->status_aktif = $request->status_aktif;

        $golobat->update();

        return response()->json(['success' => 'Data berhasil diperbaharui'], 200);
    }

    public function show($id)
    {
        $golobat = GolonganObat::find($id);
        return response()->json($golobat);
    }
    
    public function destroy($id)
    {
        GolonganObat::find($id)->delete();
      
        return response()->json(['success'=>'Golongan Obat deleted successfully.']);
    }

}
