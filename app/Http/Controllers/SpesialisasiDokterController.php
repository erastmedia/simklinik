<?php
           
namespace App\Http\Controllers;
            
use App\Models\SpesialisasiDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
          
class SpesialisasiDokterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('master.dokter.index');
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $spesialisasidokter = SpesialisasiDokter::where('id_klinik', $idklinik)->latest()->get();

        return Datatables::of($spesialisasidokter)
            ->addIndexColumn()
            ->addColumn('action', function($spesialisasidokter){
                    return '
                    <button onClick="editFormSpDok(`'. route('spesialisasidokter.update', $spesialisasidokter->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                    <button onClick="deleteDataSpDok(`'. route('spesialisasidokter.update', $spesialisasidokter->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    ';
            })
            ->rawColumns(['action'])
            ->make(true);

        return view('master.dokter.index');
    }

    public function store(Request $request)
    {
        $id_klinik = auth()->user()->id_klinik;

        $validator = Validator::make($request->all(), [
            'nama_spesialisasi' => 'required|unique:spesialisasi_dokter',
            'id_klinik' => 'required',
        ], [
            'nama_spesialisasi.required' => 'Nama tipe harus diisi.',
            'nama_spesialisasi.unique' => 'Nama Tipe Lokasi Poli sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            
            SpesialisasiDokter::updateOrCreate([
                'id' => $request->id
            ], [
                'nama_spesialisasi' => $request->nama_spesialisasi,
                'id_klinik' => $id_klinik
            ]);

            return response()->json(['success' => 'Spesialisasi Dokter saved successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => ['Failed to save Spesialisasi Dokter. Please try again later.']
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {

        $ubah = SpesialisasiDokter::findorfail($id);

        $dt = [
            'nama_spesialisasi' => $request['nama_spesialisasi'],
        ];

        $ubah->update($dt);
        return response()->json('Data berhasil disimpan', 200);
    }

    public function show($id)
    {
        $spesialisasidokter = SpesialisasiDokter::find($id);
        return response()->json($spesialisasidokter);
    }
    
    public function destroy($id)
    {
        SpesialisasiDokter::find($id)->delete();
      
        return response()->json(['success'=>'Spesialisasi Dokter deleted successfully.']);
    }
}