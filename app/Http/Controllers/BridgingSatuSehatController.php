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

    // public function getPasienByNameGenderBirthdate()
    // {
    //     $accessToken = Session::get('access_token');
    //     $base_api_url = 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1/';
    //     $patient_name = 'Erastomo';
    //     $patient_birthdate = '1982-02-28';
    //     $patient_nik = '3303082802820004';
    //     $patient_gender = 'male';
    //     try {
    //         $response = Http::withToken($accessToken)->get( $base_api_url . 'Patient?name=' . $patient_name . '&birthdate=' . $patient_birthdate . '&nik=' . $patient_nik .'&gender=' . $patient_gender);
    //         return $response;
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'error' => [$th->getMessage()] 
    //         ], 500);
    //     }
    // }

    // public function getPasienByNameGenderBirthdate()
    // {
    //     $accessToken = Session::get('access_token');
    //     $base_api_url = 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1/';
    //     $patient_name = 'Erastomo';
    //     $patient_birthdate = '1982-02-28';
    //     $patient_nik = '3303082802820004';
    //     $patient_gender = 'male';
    //     try {
    //         $response = Http::withToken($accessToken)->get($base_api_url . 'Patient?name=' . $patient_name . '&birthdate=' . $patient_birthdate . '&nik=' . $patient_nik . '&gender=' . $patient_gender);
    //         $responseData = $response->json();
    //         if (isset($responseData['entry'][0]) && isset($responseData['entry'][0]['resource']['id'])) {
    //             $patientId = $responseData['entry'][0]['resource']['id'];
    //             return $patientId;
    //         } else {
    //             return response()->json([
    //                 'error' => 'Patient ID not found in the response'
    //             ], 404);
    //         }
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'error' => [$th->getMessage()]
    //         ], 500);
    //     }
    // }

    // public function getPasienByNameGenderBirthdate()
    // {
    //     $accessToken = Session::get('access_token');
    //     $base_api_url = 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1/';
    //     $patient_name = 'Erastomo';
    //     $patient_birthdate = '1982-02-28';
    //     $patient_nik = '3303082802820004';
    //     $patient_gender = 'male';
    //     try {
    //         $response = Http::withToken($accessToken)->get( $base_api_url . 'Patient?name=' . $patient_name . '&birthdate=' . $patient_birthdate . '&nik=' . $patient_nik .'&gender=' . $patient_gender);
            
    //         $responseData = $response->json();
            
    //         if(isset($responseData['entry']) && count($responseData['entry']) > 0) {
    //             $firstEntry = $responseData['entry'][0]['resource'];
                
    //             $patientId = $firstEntry['id'];
    //             $birthdate = $firstEntry['birthDate'];
    //             $gender = $firstEntry['gender'];
    //             $name = $firstEntry['name'][0]['text'];

    //             return [
    //                 'patientId' => $patientId,
    //                 'birthdate' => $birthdate,
    //                 'gender' => $gender,
    //                 'name' => $name
    //             ];
    //         } else {
    //             return null;
    //         }
            
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'error' => [$th->getMessage()] 
    //         ], 500);
    //     }
    // }

    // public function getPasienByNameGenderBirthdate()
    // {
    //     $accessToken = Session::get('access_token');
    //     $base_api_url = 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1/';
    //     $patient_name = 'Erastomo';
    //     $patient_birthdate = '1982-02-28';
    //     $patient_nik = '3303082802820004';
    //     $patient_gender = 'male';
    //     try {
    //         $response = Http::withToken($accessToken)->get( $base_api_url . 'Patient?name=' . $patient_name . '&birthdate=' . $patient_birthdate . '&nik=' . $patient_nik .'&gender=' . $patient_gender);
    //         $responseData = $response->json();
    //         $extractedData = [];
    //         if(isset($responseData['entry']) && count($responseData['entry']) > 0) {
    //             foreach($responseData['entry'] as $entry) {
    //                 $resource = $entry['resource'];
    //                 $extractedData[] = $resource;
    //             }
    //         }
    //         return $extractedData;
            
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'error' => [$th->getMessage()] 
    //         ], 500);
    //     }
    // }
    public function getPasienByNameGenderBirthdate()
    {
        $accessToken = Session::get('access_token');
        $base_api_url = 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1/';
        $patient_name = 'Erastomo';
        $patient_birthdate = '1982-02-28';
        $patient_nik = '3303082802820004';
        $patient_gender = 'male';
        try {
            $response = Http::withToken($accessToken)->get($base_api_url . 'Patient?name=' . $patient_name . '&birthdate=' . $patient_birthdate . '&nik=' . $patient_nik . '&gender=' . $patient_gender);
            
            // Decode the JSON response
            $responseData = $response->json();
            
            // Extracting the desired data
            $patientData = $responseData['entry'][0]['resource'];
            $patientId = $patientData['id'];
            $birthdate = $patientData['birthDate'];
            $gender = $patientData['gender'];
            $name = $patientData['name'][0]['text'];
            $citizenshipStatus = $patientData['extension'][0]['valueCode'];
            $language = $patientData['communication'][0]['language']['text'];
            
            // Return the extracted data
            return response()->json([
                'id' => $patientId,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'name' => $name,
                'citizenship_status' => $citizenshipStatus,
                'language' => $language
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [$th->getMessage()]
            ], 500);
        }
    }
 
}
