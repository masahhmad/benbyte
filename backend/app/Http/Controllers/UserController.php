<?php

namespace App\Http\Controllers;

use App\Models\CreateKelas;
use App\Models\KontenModel;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{
    public function programmingKelas()
    {
        $kelases = CreateKelas::where('kategori', 'programming')->where('status', 'launched')->orderBy('created_at', 'desc')->get();
        
        // Create an array to hold user data for each 'CreateKelas'
        $user = [];

        // Fetch the user for each 'CreateKelas'
        $kelases->each(function ($kelases) use (&$user) {
            // Retrieve the user associated with the 'user_id' in the 'CreateKelas' record
            $user[$kelases->id]     = User::find($kelases->user_id);
            
            // Format the price (harga) for the class
            $kelases->harga_format  = HelperController::formatHarga($kelases->harga);
        });

        return view('pages.users.tokos.programming-kelas', [
            'kelases'   => $kelases,
            'user'      => $user,
        ]);
    }

    public function uiuxKelas()
    {
        $kelases = CreateKelas::where('kategori', 'uiux')->where('status', 'launched')->orderBy('created_at', 'desc')->get();
        
        // Create an array to hold user data for each 'CreateKelas'
        $user = [];

        // Fetch the user for each 'CreateKelas'
        $kelases->each(function ($kelases) use (&$user) {
            // Retrieve the user associated with the 'user_id' in the 'CreateKelas' record
            $user[$kelases->id]     = User::find($kelases->user_id);
            
            // Format the price (harga) for the class
            $kelases->harga_format  = HelperController::formatHarga($kelases->harga);
        });

        return view('pages.users.tokos.uiux-kelas', [
            'kelases'   => $kelases,
            'user'      => $user,
        ]);
    }

    public function networkKelas()
    {
        $kelases    = CreateKelas::where('kategori', 'network')->where('status', 'launched')->orderBy('created_at', 'desc')->get();

        $user       = [];

        $kelases->each(function ($kelases) use (&$user) {
            $user[$kelases->id]     = User::find($kelases->user_id);
            
            $kelases->harga_format  = HelperController::formatHarga($kelases->harga);
        });

        // dd($user[$kelases->id]);

        return view('pages.users.tokos.network-kelas', [
            'kelases'   => $kelases,
            'user'      => $user,
        ]);
    }

    public function beliKelas(Request $request)
    {
        // midtrans
        // dd($request->user_id);

        $transaksi = Transaksi::create([
            'user_id'       => Auth::user()->id,
            'kelas_id'      => $request->kelas_id,
            'kategori'      => $request->kategori,
            'harga'         => $request->harga_kelas,
            'nama_kelas'    => $request->nama_kelas,
            'thumbnail'     => $request->thumbnail,
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details'   => array(
                'order_id'          => rand(),
                'gross_amount'      => $request->harga_kelas,
            ),
            'customer_details'  => array(
                'first_name'    => Auth::user()->name,
                'email'         => Auth::user()->email,
            ),
        );

        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        $transaksi->snap_token = $snapToken;
        $transaksi->save();
        
        $kelas_id = Transaksi::where('kelas_id', $transaksi->kelas_id)->first();
        $kelases = CreateKelas::where('id', $kelas_id->kelas_id)->get();
        
        $kelases->each(function ($kelas) {
            $kelas->harga_format = HelperController::formatHarga($kelas->harga);
        });
        
        // dd($transaksi);
        
        return view('pages.users.beli-kelas', [
            'transaksi' => $transaksi,
            'kelases'   => $kelases,
        ]);
    }

    public function beliKelasSukses(Transaksi $transaksi)
    {
        $transaksi->status = 'selesai';
        $transaksi->save();

        $kelas = $transaksi->kategori;

        return redirect()->route('user.' . $kelas . '-kelas')->with('msg', 'Pembayaran berhasil!');
    }

    public function kelasKu()
    {
        $data2 = Transaksi::all();
        $kelas = $data2->where('user_id', Auth::user()->id)->where('status', 'selesai');

        $transaksi  = $kelas->first();

        // dd($data);

        if ($transaksi) {
            $user       = User::where('id', $transaksi->user_id)->first();
            return view('pages.users.kelasku', [
                'kelas'         => $kelas,
                'transaksi'     => $transaksi,
                'user'          => $user,
            ]);
        }else{
            return view('pages.users.kelasku', [
                'kelas'         => $kelas,
                'transaksi'     => $transaksi,
            ]);
        }
    }

    public function masukKelasKu(KontenModel $konten, $id)
    {
        $kelases = $konten->where('kelas_id', $id)->get();
        // dd($kelases);

        return view('pages.users.konten-kelas', [
            'kelases'   => $kelases,
        ]); 
    }

    public function lanjutBeli($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $kelases = CreateKelas::where('id', $transaksi->kelas_id)->get();
        
        $kelases->each(function ($kelas) {
            $kelas->harga_format = HelperController::formatHarga($kelas->harga);
        });

        $data_trans = $transaksi->id;
        $data_token = $transaksi->snap_token;
        // dd($data_token);
        
        return view('pages.users.lanjut-beli', [
            'transaksi' => $transaksi,
            'kelases' => $kelases,
            'data_trans' => $data_trans,
            'data_token' => $data_token,
        ]);
    }
    
    public function lanjutBeliKelasSukses(Transaksi $transaksi)
    {

        dd($transaksi);
        $transaksi->status = 'selesai';
        $transaksi->save();

        return redirect()->route('user.kelasku')->with('msg', 'Berhasil beli kelas!');
    }

    public function hapusRequest($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->deleta();
        
        return redirect()->back();
    }

    public function registrasiKreator($id)
    {
        $user = User::findOrFail($id);

        return view('pages.users.registrasi-kreator', compact('user'));
    }

    public function kirimRegistrasiKreator(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'asal' => $request->asal,
            'telp' => $request->telp,
        ]);

        HelperController::changeRole($id);
        
        return redirect()->route('kreator.home')->with('msg', 'Anda Telah Menjadi Kreator');
    }
}
