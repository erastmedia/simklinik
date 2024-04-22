<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Klinik;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }

    
    public function index()
    {
        $id = auth()->user()->id_klinik;
        $klinik = Klinik::find($id);
        // $provinsi = Provinsi::all()->pluck('prov_name', 'prov_id');
        return view('home', compact('klinik'));
    }

    public function getKota($id)
    {
        $kotas = Kota::where('prov_id', $id)->get();
        return response()->json($kotas);
    }
}
