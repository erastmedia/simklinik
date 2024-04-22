<?php

namespace App\Http\Controllers;
use App\Models\Jaminan;
use Illuminatew\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class JaminanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        return view('pendaftaran-klinik.jaminan.index', compact('idklinik'));
    }

    public function copyPreset()
    {
        $id_klinik = auth()->user()->id_klinik;
        $current_time = now();
        $jaminans = [
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIBIOTIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MULTIVITAMIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SALEP', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT HERBAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ALAT KESEHATAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SUPLEMEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT BATUK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT FLU', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT TURUN PANAS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT PILEK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT SAKIT KEPALA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT DEMAM', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'VITAMIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KOLESTEROL', 'keterangan' => 'MENURUNKAN KADAR KOLESTEROL DI TUBUH'],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIHIPERTENSI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT KERAS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'TOPIKAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'INJEKSI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'VAKSIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT BEBAS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIHISTAMIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PREPARAT AKNE', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTISEPTIK DAN DESINFEKTAN KULIT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIVIRUS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT BATUK DAN PILEK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT BATUK FLU', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIBIOTIK TOPIKAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KOMBINASI ANTIBAKTERIAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIINFEKSI TOPIKAL DENGAN KORTIKOSTEROID', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'INHALES', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT PENYAKIT DEGENERASI SARAF', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIVIRUS - PATEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OAINS - PATEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT ANTI INFLAMASI NON STEROID (OAINS) - PATEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT LAMBUNG', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'HEMOSTATIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT ANTI INFLAMASI NON STEROID (OAINS)', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIHISTAMIN DAN ANTIALERGI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT HIPERURISEMIA DAN GOUT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT SALURAN KEMIH KELAMIN GOLONGAN LAIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT ANTIBIOTIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT ANTIANGINA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIEMETIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANALGESIK, ANTIPIRETIK, ANTIKOAGULAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'NOOTROPIK DAN NEUROTONIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT LAIN YANG BEKERJA PADA SISTEM MUSKULOSKELETA / NYERI SENDI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIKOAGULAN, ANTIPLATELET DAN FIBRINOLITIK (TROMBOLITIK)', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SUPLEMEN MINERAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PREPARAT ANTIASMA DAN PPOK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'HEPATITIS B', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT DISLIPIDEMIA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTASID, OBAT ANTIREFLUKS & ANTIULSERASI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ORAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MUKOLITIK -GENERIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'GENERIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SYRUP', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIMUAL/MABUK PERJALANAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANALGESIK (NON OPIAT) DAN ANTIPIRETIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT HERBAL/JAMU UNTUK WASIR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'VITAMIN & SUPLEMEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIHIPERTENSI - PATEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTASID,OBAT ANTIREFLUKS & ANTIULSERASI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'HIDUNG TERSUMBAT /PILEK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KONTRASEPSI ORAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KORTIKOSTEROID TOPIKAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'DEKONGESTAN NASAL DAN PREPARAT NASAL LAIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT KULIT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SUPLEMEN DAN TERAPI PENUNJANG', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'VITAMIN DAN MINERAL (PEDIATRIK)', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'TERAPI SUPORTIF UNTUK MEMELIHARA KESEHATAN MATA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PREKURSOR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'TETES MATA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI ALERGI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI DIABETIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PREPARAT ANOREKTAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT KUMUR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BAHAN MEDIS HABIS PAKAI ( BMHP )', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT ANTIDIABETES', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PREPARAT MULUT ATAU TENGGOROKAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'TOPIKAL BABY', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIKONVULSAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT BATUK DAN PILEK TOPIKAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KULIT BERJERAWAT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIHISTAMIN / ANTIALERGI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIDIABETES MELITUS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTI KOLESTEROL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'EMOLIEN DAN PELINDUNG KULIT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'DIABETES MELITUS - GENERIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ASAM URAT / OBAT OTOT, SENDI ATAU TULANG', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT BATUK BERDAHAK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT ANTIHIPERTENSI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT ANALGETIK NON STEROID (NSAID)', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'VITAMIN DAN/ MINERAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MAKROLID', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'VITAMIN-SUPLEMEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTIVIRUS TOPIKAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SUSU', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'GULA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BUBUR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'CEMILAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BAYI/ANAK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTISERANGGA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'BEDAK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'TISU', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KAPAS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ANTISEPTIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MADU', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'HERBAL', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MULTIVITAMIN/SUPLEMEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'JAMU', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KOMPRES', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SIRUP', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MULLTIVITAMIN/SUPLEMEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'DROPS', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT GOSOK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'LAIN-LAIN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SEMPROT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'TAB/KAP', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'INHALER', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SUPPOSITORIA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PLESTER', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PATEN BOX', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KONTRASEPSI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'ALKES', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OB/OBT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OOT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'OBAT MATA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'KOSMETIK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'TAB/CAP', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PUYER', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MB', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PERAWATAN MUKA', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PARFUM', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PERAWATAN RAMBUT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SEMIR RAMBUT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PEMBERSIH', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SABUN CUCI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SABUN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MINYAK', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PARFUME', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PEWANGI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'RAMBUT', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SABUN KEWANITAAN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SABUN CAIR', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SAMPO', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SHAMPO', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SIKAT GIGI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PASTA GIGI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SABUN MANDI', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'PERMEN', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'SILET', 'keterangan' => ''],
            ['id_klinik' => $id_klinik, 'nama' => 'MINUMAN', 'keterangan' => ''],
        ];
        try {
            foreach ($jaminans as $jaminan) {
                $existingData = DB::table('jaminan')
                    ->where('id_klinik', $jaminan['id_klinik'])
                    ->where('nama', $jaminan['nama'])
                    ->first();
                if (!$existingData) {
                    $jaminan['created_at'] = $current_time;
                    $jaminan['updated_at'] = $current_time;
                    DB::table('jaminan')->insert($jaminan);
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
        $jaminan = Jaminan::where('jaminan.id_klinik', $idklinik)
                    ->orderBy('jaminan.id', 'asc')->get();

        return Datatables::of($jaminan)
            ->addIndexColumn()
            ->addColumn('action', function($jaminan){
                return '
                <div class="action-buttons">
                    <center>
                        <button onClick="editFormJaminan(`'. route('jaminan.update', $jaminan->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                        <button onClick="deleteDataJaminan(`'. route('jaminan.update', $jaminan->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    </center>
                </div>
                ';
            })
            ->rawColumns(['status_aktif', 'action'])
            ->make(true);

        return view('pendaftaran-klinik.jaminan.index', compact('idklinik'));
    }

    public function store(Request $request)
    {
        $idklinik = auth()->user()->id_klinik;
        $nama = $request->nama;

        $validator = Validator::make($request->all(), [
            'nama' => [
                'required',
                'max:100',
                Rule::unique('jaminan')->where(function ($query) use ($idklinik, $nama) {
                    return $query->where('id_klinik', $idklinik)
                                 ->where('nama', $nama);
                }),
            ],
            'keterangan' => 'nullable|max:255',
        ], 
        [
            'nama.required' => 'Nama Jaminan Obat harus diisi.',
            'nama.unique' => 'Nama Jaminan Obat sudah digunakan.',
            'nama.max' => 'Maksimal jumlah karakter untuk Nama Jaminan Obat adalah 100 digit.',
            'keterangan.max' => 'Maksimal jumlah karakter untuk Keterangan adalah 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $jaminan = new Jaminan();
            $jaminan->id_klinik = $idklinik;
            $jaminan->nama = $request->nama;
            $jaminan->keterangan = $request->keterangan;
            $jaminan->status_aktif = $request->status_aktif;
            $jaminan->save();

            return response()->json(['success' => 'Data baru berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] 
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $jaminan = Jaminan::findOrFail($id);
        $idklinik = auth()->user()->id_klinik;
        $namaLama = $jaminan->nama;
        $namaBaru = $request->nama;

        if ($namaLama != $namaBaru) {
            $validasiNama = Validator::make($request->all(), [
                'nama' => [
                    'required',
                    'max:100',
                    Rule::unique('jaminan')->where(function ($query) use ($idklinik, $namaBaru) {
                        return $query->where('id_klinik', $idklinik)
                                     ->where('nama', $namaBaru);
                    }),
                ],
            ], [
                'nama.required' => 'Nama Jaminan Obat harus diisi.',
                'nama.unique' => 'Nama Jaminan Obat sudah digunakan.',
                'nama.max' => 'Maksimal jumlah karakter untuk Nama Jaminan Obat adalah 100 digit.',
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

        $jaminan->nama = $namaBaru;
        $jaminan->keterangan = $request->keterangan;
        $jaminan->status_aktif = $request->status_aktif;

        $jaminan->update();

        return response()->json(['success' => 'Data berhasil diperbaharui'], 200);
    }

    public function show($id)
    {
        $jaminan = Jaminan::find($id);
        return response()->json($jaminan);
    }
    
    public function destroy($id)
    {
        Jaminan::find($id)->delete();
      
        return response()->json(['success'=>'Jaminan Obat deleted successfully.']);
    }

}
