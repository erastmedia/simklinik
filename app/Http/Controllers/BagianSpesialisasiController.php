<?php
           
namespace App\Http\Controllers;
            
use App\Models\BagianSpesialisasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DataTables;
          
class BagianSpesialisasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('master.petugas.index');
    }

    public function getBagian()
    {
        $idklinik = auth()->user()->id_klinik;
        $bagian = BagianSpesialisasi::where('id_klinik', $idklinik)->latest()->get();
        return response()->json($bagian);
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $bagianspesialisasi = BagianSpesialisasi::where('id_klinik', $idklinik)->latest()->get();

        return Datatables::of($bagianspesialisasi)
            ->addIndexColumn()
            ->addColumn('action', function($bagianspesialisasi){
                    return '
                    <button onClick="editFormBagian(`'. route('bagianspesialisasi.update', $bagianspesialisasi->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                    <button onClick="deleteDataBagian(`'. route('bagianspesialisasi.update', $bagianspesialisasi->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    ';
            })
            ->rawColumns(['action'])
            ->make(true);

        return view('master.petugas.index');
    }

    public function store(Request $request)
    {
        $id_klinik = auth()->user()->id_klinik;

        $validator = Validator::make($request->all(), [
            'nama_bagian' => [
                'required',
                Rule::unique('bagian_spesialisasi')->where(function ($query) use ($id_klinik, $request) {
                    return $query->where('id_klinik', $id_klinik)
                                ->where('nama_bagian', $request->nama_bagian);
                }),
            ],
            'id_klinik' => 'required',
        ], [
            'nama_bagian.required' => 'Nama Bagian harus diisi.',
            'nama_bagian.unique' => 'Nama Bagian sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            
            BagianSpesialisasi::updateOrCreate([
                'id' => $request->id
            ], [
                'nama_bagian' => $request->nama_bagian,
                'id_klinik' => $id_klinik
            ]);

            return response()->json(['success' => 'Bagian Spesialisasi saved successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => ['Failed to save Bagian Spesialisasi. Please try again later.']
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $bagianSpesialisasi = BagianSpesialisasi::findOrFail($id);
        $namaBagianBaru = $request->input('nama_bagian');
        if ($bagianSpesialisasi->nama_bagian !== $namaBagianBaru) {
            $validator = Validator::make($request->all(), [
                'nama_bagian' => [
                    'required',
                    Rule::unique('bagian_spesialisasi')->where(function ($query) use ($namaBagianBaru) {
                        return $query->where('nama_bagian', $namaBagianBaru);
                    })->ignore($bagianSpesialisasi->id),
                ],
            ], [
                'nama_bagian.required' => 'Nama Bagian harus diisi.',
                'nama_bagian.unique' => 'Sudah ada data dengan Nama Bagian ini.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all()
                ], 422);
            }

            $bagianSpesialisasi->nama_bagian = $namaBagianBaru;
            $bagianSpesialisasi->save();
            return response()->json(['success' => 'Bagian/Spesialisasi berhasil diperbaharui.']);
        } else {
            return response()->json(['success' => 'Tidak ada perubahan data yang perlu disimpan.']);
        }
    }

    public function show($id)
    {
        $bagianspesialisasi = BagianSpesialisasi::find($id);
        return response()->json($bagianspesialisasi);
    }
    
    public function destroy($id)
    {
        BagianSpesialisasi::find($id)->delete();
        return response()->json(['success'=>'Bagian Spesialisasi deleted successfully.']);
    }
}