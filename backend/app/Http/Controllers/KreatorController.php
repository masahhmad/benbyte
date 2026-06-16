<?php

namespace App\Http\Controllers;

use App\Models\CreateKelas;
use App\Models\KontenModel;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KreatorController extends Controller
{
    public function createKelas()
    {
        $kelas = CreateKelas::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('pages.kreators.create-kelas',[
            'kelases'   => $kelas,
        ]);
    }

    public function deleteKelas($id)
    {
        $label = CreateKelas::findOrFail($id);
        $label->delete();
        
        return redirect()->back()->with('msg', 'Kelas Dihapus');
    }

    public function kontenKelas($id)
    {
        $konten     = KontenModel::where('kelas_id', $id)->orderBy('created_at', 'desc')->get();
        $kelas      = CreateKelas::findOrFail($id);
        $user       = User::where('id', $kelas->user_id)->first();

        return view('pages.kreators.konten-kelas', [
            'konten'    => $konten,
            'kelas'     => $kelas,
            'user'      => $user,
        ]);
    }
    
    public function viewKontenKelas($id)
    {
        $kelas = CreateKelas::findOrFail($id);
        
        return view('pages.kreators.konten-kelas', compact('kelas'));
    }
    
    public function storeKelas(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/thumbnails', $image->hashName());
        }
        
        CreateKelas::create([
            'user_id'       => Auth::user()->id,
            'nama_kelas'    => $request->nama_kelas,
            'deskripsi'     => $request->deskripsi,
            'kategori'      => $request->kategori,
            'harga'         => $request->harga,
            'thumbnail'     => $image->hashName(),
        ]);
        
        return redirect()->back()->with('msg', 'Kelas Berhasil Dibuat!');
    }
    
    public function gantiStatusKelas(CreateKelas $id)
    {
        if ($id->status === 'concluded') {
            $id->status = 'launched';
        } else {
            $id->status = 'concluded';
        }
        $id->save();
        
        return redirect()->back()->with('msg', 'Berhasil ganti status!');
    }
    
    public function  editKontenKelas($id)
    {
        // dd($id);
        $dasar      = KontenModel::where('kelas_id', $id);
        $konten     = $dasar->get();
        $konten2    = $dasar->first();

        $kelas      = CreateKelas::findOrFail($id);
        $user       = User::where('id', $kelas->user_id)->first();

        return view('pages.kreators.konten-kelas', [
            'konten'    => $konten,
            'konten2'   => $konten2,
            'kelas'     => $kelas,
            'user'      => $user,
        ]);
    }
    
    public function  updateKontenKelas(Request $request, $id)
    {
        $konten     = KontenModel::findOrFail($id);
        $back       = CreateKelas::where('id', $konten->kelas_id)->first();

        $konten->update([
            'label'     => $request->label_video,
            'konten'    => $request->link_video,
        ]);

        return redirect()->route('kreator.konten-kelas', $back->id)->with('msg', 'Berhasil Edit Konten');
    }
    
    public function storeKontenKelas(Request $request)
    {
        KontenModel::create([
            'user_id'   => $request->user_id,
            'kelas_id'  => $request->kelas_id,
            'label'     => $request->label_video,
            'konten'    => $request->link_video,
        ]);

        return redirect()->back()->with('msg', 'Kelas Berhasil Dibuat!');
    }

    public function hapusKontenKelas($id)
    {
        $konten = KontenModel::findOrFail($id);
        $konten->delete();

        return redirect()->back()->with('msg', 'Berhasil Hapus Konten!');
    }

    public function grafikPembelian()
    {
        $kelas_user = CreateKelas::where('user_id', Auth::user()->id)->get();
        
        $duwit = Transaksi::where('user_id', Auth::user()->id)->where('status', 'selesai')->sum('harga');
        $total_duwit = HelperController::formatHarga($duwit);
        // dd($total_duwit);

        $jumlah_terjual = [];

        $kelas_user->each(function ($kelas) use (&$jumlah_terjual) {
            $jumlah_terjual[$kelas->id] = Transaksi::where('kelas_id', $kelas->id)->where('status', 'selesai')->count();
        });

        $data = Transaksi::whereBetween('created_at', [
            Carbon::now()->subDays(30)->startOfDay(),
            Carbon::now()->endOfDay()
        ])
        ->where('status', 'selesai')
        ->where('user_id', Auth::user()->id)         // Filter berdasarkan user
        ->get()
        ->groupBy(function ($item) {
            return $item->created_at->format('d-m-Y'); // Grupkan berdasarkan tanggal
        });

        // Format data untuk menghitung jumlah transaksi per hari
        $transactionsPerDay = $data->mapWithKeys(function ($items, $date) {
            return [$date => $items->count()]; // Ambil ID transaksi per tanggal
        });

        return view('pages.kreators.grafik-pembelian', [
            'kelas_user'     => $kelas_user,
            'jumlah_terjual'     => $jumlah_terjual,
            'transactionsPerDay' => $transactionsPerDay,
            'total_duwit' => $total_duwit,
        ]);
    }
}
