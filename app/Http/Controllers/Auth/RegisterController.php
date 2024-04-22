<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Klinik;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $klinik = Klinik::create([
            'nama_klinik' => '', 
            'nama_pemilik' => '', 
            'penanggung_jawab' => '', 
            'penanggung_jawab_lab' => '', 
            'id_tipe' => 0, 
            'prov_id' => 0, 
            'city_id' => 0, 
            'dis_id' => 0, 
            'subdis_id' => 0, 
            'kode_pos' => '', 
            'rt' => '', 
            'rw' => '', 
            'telepon' => '', 
            'email' => '', 
            'alamat' => '', 
            'latitude' => '-7.389320000000001', 
            'longitude' => '109.3632836', 
            'website' => '', 
            'npwp' => '', 
            'no_register' => '', 
            'tgl_berlaku_register' => '', 
            'nama_apj' => '', 
            'no_stra' => '', 
            'tgl_berlaku_stra' => '', 
            'no_sipa' => '', 
            'tgl_berlaku_sipa' => '', 
            'file_logo' => '', 
            'file_register' => '', 
            'file_stra' => '', 
            'file_sipa' => '', 
        ]);
        
        $newlyInsertedId = $klinik->id;

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_klinik' => $newlyInsertedId,
            'username' => $data['username'],
        ]);
    }
}
