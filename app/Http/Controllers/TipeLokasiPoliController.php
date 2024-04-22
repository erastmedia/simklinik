<?php
           
namespace App\Http\Controllers;
            
use Illuminate\Support\Facades\DB;
use App\Models\TipeLokasiPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;
          
class TipeLokasiPoliController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('master.poli.index');
    }

    public function getTipePoli()
    {
        $idklinik = auth()->user()->id_klinik;
        $tipelokasipoli = TipeLokasiPoli::where('id_klinik', $idklinik)->latest()->get();
        return response()->json($tipelokasipoli);
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $tipelokasipoli = TipeLokasiPoli::where('id_klinik', $idklinik)->get();

        return Datatables::of($tipelokasipoli)
            ->addIndexColumn()
            ->addColumn('action', function($tipelokasipoli){
                    return '
                    <button onClick="editFormTipe(`'. route('tipelokasipoli.update', $tipelokasipoli->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                    <button onClick="deleteData(`'. route('tipelokasipoli.update', $tipelokasipoli->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    ';
            })
            ->rawColumns(['action'])
            ->make(true);

        return view('master.poli.index');
    }

    public function store(Request $request)
    {
        $id_klinik = auth()->user()->id_klinik;
        
        $validator = Validator::make($request->all(), [
            'nama_tipe' => [
                'required',
                Rule::unique('tipe_lokasi_poli')->where(function ($query) use ($id_klinik, $request) {
                    return $query->where('id_klinik', $id_klinik)
                                ->where('nama_tipe', $request->nama_tipe);
                }),
            ],
        ], [
            'nama_tipe.required' => 'Nama tipe harus diisi.',
            'nama_tipe.unique' => 'Sudah ada data dengan nama tipe yang sama di klinik ini.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            TipeLokasiPoli::updateOrCreate([
                'id' => $request->id
            ], [
                'nama_tipe' => $request->nama_tipe,
                'id_klinik' => $id_klinik
            ]);

            return response()->json(['success' => 'Tipe Lokasi Poli saved successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => ['Failed to save Tipe Lokasi Poli. Please try again later.']
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $tipeLokasiPoli = TipeLokasiPoli::findOrFail($id);
        $namaTipeBaru = $request->input('nama_tipe');
        if ($tipeLokasiPoli->nama_tipe !== $namaTipeBaru) {
            $validator = Validator::make($request->all(), [
                'nama_tipe' => [
                    'required',
                    Rule::unique('tipe_lokasi_poli')->where(function ($query) use ($namaTipeBaru) {
                        return $query->where('nama_tipe', $namaTipeBaru);
                    })->ignore($tipeLokasiPoli->id),
                ],
            ], [
                'nama_tipe.required' => 'Nama tipe harus diisi.',
                'nama_tipe.unique' => 'Sudah ada data dengan nama tipe ini.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all()
                ], 422);
            }

            $tipeLokasiPoli->nama_tipe = $namaTipeBaru;
            $tipeLokasiPoli->save();
            return response()->json(['success' => 'Tipe Lokasi Poli berhasil diperbaharui.']);
        } else {
            return response()->json(['success' => 'Tidak ada perubahan data yang perlu disimpan.']);
        }
    }

    public function show($id)
    {
        $tipelokasipoli = TipeLokasiPoli::find($id);
        return response()->json($tipelokasipoli);
    }
    
    public function destroy($id)
    {
        TipeLokasiPoli::find($id)->delete();
      
        return response()->json(['success'=>'Tipe Lokasi Poli deleted successfully.']);
    }

    public function copyPreset()
    {
        $id_klinik = auth()->user()->id_klinik;
        $current_time = now();
        $tipepoli = [
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'AREA'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'BED'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'BUILDING'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'CABINET'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'CORRIDOR'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'HOUSE'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'JURISDICTION'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'LEVEL'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'ROAD'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'ROOM'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'SITE'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'VEHICLE'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'VIRTUAL'],
            ['id_klinik' => $id_klinik, 'nama_tipe' => 'WARD'],
        ];
        try {
            foreach ($tipepoli as $tipe) {
                // Memeriksa keberadaan data sebelum memasukkan data baru
                $existingData = DB::table('tipe_lokasi_poli')
                    ->where('id_klinik', $tipe['id_klinik'])
                    ->where('nama_tipe', $tipe['nama_tipe'])
                    ->first();
                    
                if (!$existingData) {
                    // Jika data belum ada, maka masukkan data baru
                    $tipe['created_at'] = $current_time;
                    $tipe['updated_at'] = $current_time;
                    DB::table('tipe_lokasi_poli')->insert($tipe);
                }
            }
            return response()->json(['success' => 'Data baru berhasil ditambahkan dari Preset.']);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [$th->getMessage()]
            ], 500);
        }
    }

}