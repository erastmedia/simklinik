<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\User;

class MemberController extends Controller
{
    public function index($username)
    {
        try {
            // Coba untuk mencari pengguna berdasarkan username
            $user = User::where('username', $username)->firstOrFail();

            // Jika ditemukan, lanjutkan dengan menampilkan halaman
            return view('client.index', ['user' => $user]);
        } catch (ModelNotFoundException $e) {
            // Jika username tidak ditemukan, tangani secara khusus di sini
            return response()->view('404', [], 404);
        }
    }
}
