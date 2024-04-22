<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Auth;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function searchData(Request $request)
    {
        $this->middleware('auth');

        $datas = Kota::where('prov_id', 13)
        ->where('city_name', 'LIKE', '%'.$request->namakota.'%')
        ->get();

        $formatted_datas = [];

        foreach ($datas as $data) {
            $formatted_datas[] = ['id' => $data->city_id, 'text' => $data->city_name];
        }
        return response()->json($formatted_datas);
    }
}
