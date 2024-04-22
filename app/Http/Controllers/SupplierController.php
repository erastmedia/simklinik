<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        return view('master.supplier.index', compact('idklinik'));
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $supplier = Supplier::where('supplier.id_klinik', $idklinik)
                    ->orderBy('supplier.id', 'desc')->get();

        return Datatables::of($supplier)
            ->addIndexColumn()
            ->addColumn('action', function($supplier){
                return '
                <div class="action-buttons">
                    <center>
                        <button onClick="editFormSupplier(`'. route('supplier.update', $supplier->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                        <button onClick="deleteDataSupplier(`'. route('supplier.update', $supplier->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    </center>
                </div>
                ';
            })
            ->rawColumns(['status_aktif', 'action'])
            ->make(true);

        return view('master.supplier.index', compact('idklinik'));
    }

    public function store(Request $request)
    {
        $idklinik = auth()->user()->id_klinik;
        $nama = $request->nama;
        $lastSupplier = Supplier::where('id_klinik', $idklinik)->orderBy('id', 'desc')->first();

        if ($lastSupplier) {
            $lastKodeSupplier = $lastSupplier->kode;
            $kodeSupplierNumber = (int)substr($lastKodeSupplier, 3);
            $kodeSupplierNumber++;
            $newKodeSupplier = 'SPL' . str_pad($kodeSupplierNumber, 4, '0', STR_PAD_LEFT);
        } else {
            $newKodeSupplier = 'SPL0001';
        }

        $request->merge(['kode' => $newKodeSupplier]);

        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => [
                'required',
                'max:100',
                Rule::unique('supplier')->where(function ($query) use ($idklinik, $nama) {
                    return $query->where('id_klinik', $idklinik)
                                 ->where('nama', $nama);
                }),
            ],
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|max:100',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'no_hp' => 'nullable|max:30',
            'rekening' => 'nullable|max:30',
            'npwp' => 'nullable|max:35',
        ], 
        [
            'kode.required' => 'Kode harus diisi.',
            'nama.required' => 'Nama Supplier harus diisi.',
            'nama.unique' => 'Nama Supplier sudah digunakan.',
            'nama.max' => 'Maksimal jumlah karakter untuk Nama Supplier adalah 100 digit.',
            'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
            'email.max' => 'Maksimal jumlah karakter untuk Email adalah 100 karakter.',
            'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
            'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            'no_hp.max' => 'Maksimal jumlah karakter untuk Nomor Handphone adalah 30 karakter.',
            'rekening.max' => 'Maksimal jumlah karakter untuk Nomor Rekening adalah 30 karakter.',
            'npwp.max' => 'Maksimal jumlah karakter untuk NPWP adalah 35 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $supplier = new Supplier();
            $supplier->id_klinik = $idklinik;
            $supplier->kode = $request->kode;
            $supplier->nama = $nama;
            $supplier->alamat = $request->alamat;
            $supplier->kota = $request->kota;
            $supplier->telepon = $request->telepon;
            $supplier->no_hp = $request->no_hp;
            $supplier->email = $request->email;
            $supplier->rekening = $request->rekening;
            $supplier->npwp = $request->npwp;
            $supplier->status_aktif = $request->status_aktif;

            $supplier->save();

            return response()->json(['success' => 'Data baru berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] 
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $idklinik = auth()->user()->id_klinik;
        $namaLama = $supplier->nama;
        $namaBaru = $request->nama;

        if ($namaLama != $namaBaru) {
            $validasiNama = Validator::make($request->all(), [
                'nama' => [
                    'required',
                    'max:100',
                    Rule::unique('supplier')->where(function ($query) use ($idklinik, $namaBaru) {
                        return $query->where('id_klinik', $idklinik)
                                     ->where('nama', $namaBaru);
                    }),
                ],
            ], [
                'nama.required' => 'Nama Supplier harus diisi.',
                'nama.unique' => 'Nama Supplier sudah digunakan.',
                'nama.max' => 'Maksimal jumlah karakter untuk Nama Supplier adalah 100 digit.',
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
            'rekening' => 'nullable|max:30',
            'npwp' => 'nullable|max:35',
        ], 
        [
            'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
            'email.max' => 'Maksimal jumlah karakter untuk Email adalah 100 karakter.',
            'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
            'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            'no_hp.max' => 'Maksimal jumlah karakter untuk Nomor Handphone adalah 30 karakter.',
            'rekening.max' => 'Maksimal jumlah karakter untuk Nomor Rekening adalah 30 karakter.',
            'npwp.max' => 'Maksimal jumlah karakter untuk NPWP adalah 35 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        $supplier->nama = $namaBaru;
        $supplier->alamat = $request->alamat;
        $supplier->kota = $request->kota;
        $supplier->telepon = $request->telepon;
        $supplier->no_hp = $request->no_hp;
        $supplier->email = $request->email;
        $supplier->rekening = $request->rekening;
        $supplier->npwp = $request->npwp;
        $supplier->status_aktif = $request->status_aktif;

        $supplier->update();

        return response()->json(['success' => 'Data berhasil diperbaharui'], 200);
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }
    
    public function destroy($id)
    {
        Supplier::find($id)->delete();
      
        return response()->json(['success'=>'Supplier deleted successfully.']);
    }

}
