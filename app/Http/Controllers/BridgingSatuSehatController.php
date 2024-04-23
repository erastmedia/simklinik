<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BridgingSatuSehat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BridgingSatuSehatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idKlinik = auth()->user()->id_klinik;
        $satusehat = BridgingSatuSehat::where('id_klinik', $idKlinik)->first();
        return view('system.integrasi-satu-sehat', compact('satusehat'));
    }

    public function updateBridging(Request $request)
    {
        try {
            $idKlinik = auth()->user()->id_klinik;
            $satusehat = BridgingSatuSehat::where('id_klinik', $idKlinik)->first();
            $satusehat->organization_id = $request->input('organization_id');
            $satusehat->client_key = $request->input('client_key');
            $satusehat->secret_key = $request->input('secret_key');
            $satusehat->update();
            return response()->json('Konfigurasi Bridging Satu Sehat berhasil disimpan', 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);;
        }
    }

    public function getAccessToken()
    {

        $idKlinik = auth()->user()->id_klinik;
        $satusehat = BridgingSatuSehat::where('id_klinik', $idKlinik)->first();
        $client_id = $satusehat->client_key;
        $client_secret = $satusehat->secret_key;
        try {
            $response = Http::asForm()->post('https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials', [
                'client_id' => $client_id,
                'client_secret' => $client_secret,
            ]);
            $accessToken = $response->json()['access_token'];
            Session::put('access_token', $accessToken);
            return response()->json([
                'success' => 'Token berhasil tersimpan dalam Session',
                'access_token' => $accessToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [$th->getMessage()] 
            ], 500);
        }
        
    }
}
