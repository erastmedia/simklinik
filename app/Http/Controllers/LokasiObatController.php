<?php

namespace App\Http\Controllers;
use App\Models\LokasiObat;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class LokasiObatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        return view('master.lokasi-obat.index', compact('idklinik'));
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $lokasi = LokasiObat::where('lokasi_obat.id_klinik', $idklinik)
                    ->orderBy('lokasi_obat.id', 'asc')->get();

        return Datatables::of($lokasi)
            ->addIndexColumn()
            ->addColumn('action', function($lokasi){
                return '
                <div class="action-buttons">
                    <center>
                        <button onClick="editFormLokasi(`'. route('lokasiobat.update', $lokasi->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                        <button onClick="deleteDataLokasi(`'. route('lokasiobat.update', $lokasi->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    </center>
                </div>
                ';
            })
            ->rawColumns(['status_aktif', 'action'])
            ->make(true);

        return view('master.lokasi-obat.index', compact('idklinik'));
    }

    public function store(Request $request)
    {
        $idklinik = auth()->user()->id_klinik;
        $nama = $request->nama;

        $validator = Validator::make($request->all(), [
            'nama' => [
                'required',
                'max:100',
                Rule::unique('lokasi_obat')->where(function ($query) use ($idklinik, $nama) {
                    return $query->where('id_klinik', $idklinik)
                                 ->where('nama', $nama);
                }),
            ],
        ], 
        [
            'nama.required' => 'Nama Lokasi Obat harus diisi.',
            'nama.unique' => 'Nama Lokasi Obat sudah digunakan.',
            'nama.max' => 'Maksimal jumlah karakter untuk Nama Lokasi Obat adalah 100 digit.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $lokasi = new LokasiObat();
            $lokasi->id_klinik = $idklinik;
            $lokasi->nama = $request->nama;
            $lokasi->status_aktif = $request->status_aktif;
            $lokasi->save();

            return response()->json(['success' => 'Data baru berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] 
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $lokasi = LokasiObat::findOrFail($id);
        $idklinik = auth()->user()->id_klinik;
        $namaLama = $lokasi->nama;
        $namaBaru = $request->nama;

        if ($namaLama != $namaBaru) {
            $validasiNama = Validator::make($request->all(), [
                'nama' => [
                    'required',
                    'max:100',
                    Rule::unique('lokasi_obat')->where(function ($query) use ($idklinik, $namaBaru) {
                        return $query->where('id_klinik', $idklinik)
                                     ->where('nama', $namaBaru);
                    }),
                ],
            ], [
                'nama.required' => 'Nama Lokasi Obat harus diisi.',
                'nama.unique' => 'Nama Lokasi Obat sudah digunakan.',
                'nama.max' => 'Maksimal jumlah karakter untuk Nama Lokasi Obat adalah 100 digit.',
            ]);

            if ($validasiNama->fails()) {
                return response()->json([
                    'error' => $validasiNama->errors()->all()
                ], 422);
            }
        }

        $lokasi->nama = $namaBaru;
        $lokasi->status_aktif = $request->status_aktif;

        $lokasi->update();

        return response()->json(['success' => 'Data berhasil diperbaharui'], 200);
    }

    public function show($id)
    {
        $lokasi = LokasiObat::find($id);
        return response()->json($lokasi);
    }
    
    public function destroy($id)
    {
        LokasiObat::find($id)->delete();
      
        return response()->json(['success'=>'Lokasi Obat deleted successfully.']);
    }

}
