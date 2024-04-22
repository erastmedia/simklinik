<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\TipeLokasiPoli;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DataTables;

class PoliController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        // $tipelokasipoli = TipeLokasiPoli::where('id_klinik', $idklinik)->pluck('nama_tipe', 'id');
        return view('master.poli.index');
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $tipelokasipoli = TipeLokasiPoli::where('id_klinik', $idklinik)->pluck('nama_tipe', 'id');
        $poli = Poli::join('tipe_lokasi_poli', 'tipe_lokasi_poli.id', '=', 'poli.id_tipe_lokasi_poli')
                    ->select('poli.*', 'tipe_lokasi_poli.nama_tipe')
                    ->where('tipe_lokasi_poli.id_klinik', $idklinik)
                    ->orderBy('poli.id', 'desc')->get();

        return Datatables::of($poli)
            ->addIndexColumn()
            ->addColumn('action', function($poli){
                    return '
                    <button onClick="editFormPoli(`'. route('poli.update', $poli->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                    <button onClick="deleteDataPoli(`'. route('poli.update', $poli->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    ';
            })
            ->rawColumns(['action'])
            ->make(true);

        return view('master.poli.index', compact('tipelokasipoli'));
    }

    public function store(Request $request)
    {
        $id_tipe_lokasi_poli = $request->id_tipe_lokasi_poli;
        $validator = Validator::make($request->all(), [
            'nama_poli' => [
                'required',
                Rule::unique('poli')->where(function ($query) use ($id_tipe_lokasi_poli, $request) {
                    return $query->where('id_tipe_lokasi_poli', $id_tipe_lokasi_poli)
                                ->where('nama_poli', $request->nama_poli);
                }),
            ],
            'deskripsi' => 'required',
            'id_tipe_lokasi_poli' => 'required',
        ], 
        [
            'nama_poli.required' => 'Nama Poli harus diisi.',
            'nama_poli.unique' => 'Nama Poli yang sama sudah digunakan untuk Tipe Lokasi Poli terpilih.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'id_tipe_lokasi_poli.required' => 'Tipe Lokasi Poli harus dipilih.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            Poli::updateOrCreate([
                'id' => $request->id
            ], 
            [
                'nama_poli' => $request->nama_poli,
                'deskripsi' => $request->deskripsi,
                'id_tipe_lokasi_poli' => $request->id_tipe_lokasi_poli
            ]);

            return response()->json(['success' => 'Data Poli berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] 
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);
        
        $namaPoliLama = $poli->nama_poli;
        $deskripsiLama = $poli->deskripsi;
        $idTipeLokasiPoliLama = $poli->id_tipe_lokasi_poli;
        
        $namaPoliBaru = $request->input('nama_poli');
        $deskripsiBaru = $request->input('deskripsi');
        $idTipeLokasiPoliBaru = $request->input('id_tipe_lokasi_poli');
        
        $isChanged = false;

        if ($namaPoliLama !== $namaPoliBaru) {
            $isChanged = true;
        }

        if ($deskripsiLama !== $deskripsiBaru) {
            $isChanged = true;
        }

        if ($idTipeLokasiPoliLama !== $idTipeLokasiPoliBaru) {
            $isChanged = true;
        }
        
        if (!$isChanged) {
            return response()->json('Tidak ada perubahan yang perlu disimpan', 200);
        }

        $validator = Validator::make($request->all(), [
            'nama_poli' => [
                'required',
                Rule::unique('poli')->where(function ($query) use ($idTipeLokasiPoliBaru, $namaPoliBaru) {
                    return $query->where('id_tipe_lokasi_poli', $idTipeLokasiPoliBaru)
                                ->where('nama_poli', $namaPoliBaru);
                })->ignore($poli->id),
            ],
            'deskripsi' => 'required',
            'id_tipe_lokasi_poli' => 'required',
        ], [
            'nama_poli.required' => 'Nama Poli harus diisi.',
            'nama_poli.unique' => 'Nama Poli yang sama sudah digunakan untuk Tipe Lokasi Poli terpilih.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'id_tipe_lokasi_poli.required' => 'Tipe Lokasi Poli harus dipilih.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        $poli->update([
            'nama_poli' => $namaPoliBaru,
            'deskripsi' => $deskripsiBaru,
            'id_tipe_lokasi_poli' => $idTipeLokasiPoliBaru
        ]);

        return response()->json('Data berhasil disimpan', 200);
    }


    public function show($id)
    {
        $poli = Poli::find($id);
        return response()->json($poli);
    }
    
    public function destroy($id)
    {
        Poli::find($id)->delete();
      
        return response()->json(['success'=>'Poli deleted successfully.']);
    }
}
