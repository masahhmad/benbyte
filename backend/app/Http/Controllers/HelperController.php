<?php

namespace App\Http\Controllers;

use App\Models\CreateKelas;
use App\Models\User;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public static function changeRole($id, $status = 'kreator')
    {
        $user = User::find($id);
        if($user) {
            $user->update([
                'role' => $status,
            ]);
        }
    }
    
    public static function changeStatus($id, $status = 'launched')
    {
        $kelas = CreateKelas::find($id);
        if($kelas) {
            $kelas->update([
                'status' => $status,
            ]);
        }
    }

    public static function formatHarga($harga)
    {
        $hasil = number_format($harga, '2', ',', '.');

        return 'Rp ' . $hasil;
    }
}
