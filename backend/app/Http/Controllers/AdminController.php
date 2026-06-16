<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use App\Models\CommentModel;
use App\Models\CreateKelas;
use App\Models\KontenModel;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function tambahBlog(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/blogs', $image->hashName());
        }

        BlogModel::create([
            'judul_artikel'     => $request->judul_artikel,
            'artikel'           => $request->artikel,
            'gambar'            => $image->hashName(),
        ]);

        return redirect()->back()->with('msg', 'Kelas Berhasil Dibuat!');
    }
    
    public function editBlog(string $id)
    {
        $blog = BlogModel::findOrFail($id);
        return view('pages.form-edit', compact('blog'));
    }
    
    public function updateBlog(Request $request, $id)
    {
        $blog = BlogModel::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/blogs', $image->hashName());
        }

        $blog->update([
            'judul_artikel'     => $request->judul_artikel,
            'artikel'           => $request->artikel,
            'gambar'            => $image->hashName(),
        ]);
        return redirect()->route('admin.home')->with('msg', 'berhasil edit data');
    }
    
    public function hapusBlog($id)
    {
        $blog = BlogModel::findOrFail($id);

        $blog->delete();
        return redirect()->route('admin.home')->with('msg', 'berhasil edit data');
    }
    
    public function adminStatistik()
    {
        $total_keseluruhan = Transaksi::all()->where('status', 'selesai')->sum('harga');

        if ($total_keseluruhan) {
            $admin = $total_keseluruhan * 0.1;
            
            $revenue = HelperController::formatHarga($total_keseluruhan);
            $komisi = HelperController::formatHarga($admin);
    
            $data = Transaksi::whereBetween('created_at', [
                Carbon::now()->subDays(30)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->where('status', 'selesai')         // Filter berdasarkan user
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('d-m-Y'); // Grupkan berdasarkan tanggal
            });
    
            // Format data untuk menghitung jumlah transaksi per hari
            $transactionsPerDay = $data->mapWithKeys(function ($items, $date) {
                return [$date => $items->count()]; // Ambil ID transaksi per tanggal
            });
    
            $kelas_terbanyak = Transaksi::select('kelas_id', DB::raw('COUNT(kelas_id) as total'))
            ->groupBy('kelas_id')       // Kelompokkan berdasarkan kelas_id
            ->orderBy('total', 'desc')  // Urutkan berdasarkan jumlah kemunculan (paling banyak di atas)
            ->first();
            
            $user_id = Transaksi::where('kelas_id', $kelas_terbanyak->kelas_id)->first();
            $kelas_terlaris = Transaksi::where('kelas_id', $kelas_terbanyak->kelas_id)->first()->nama_kelas;
            $total_terjual = $kelas_terbanyak->total . 'x terjual';
            $kreator = User::where('id', $user_id->user_id)->first()->name;
            // dd($kreator);

            return view('pages.admin.admin-statistik', [
                'revenue' => $revenue,
                'komisi' => $komisi,
                'transactionsPerDay' => $transactionsPerDay,
                'kelas_terlaris' => $kelas_terlaris,
                'total_terjual' => $total_terjual,
                'kreator' => $kreator,
            ]);
        }else {
            return view('pages.admin.admin-statistik', [
                'revenue'               => 'belum ada penjualan',
                'transactionsPerDay'    => 'belum ada penjualan',
            ]);
        }
    }

    public function listKreator()
    {
        $kreators = User::where('role', 'kreator')->get();
        return view('pages.admin.list-kreator', compact('kreators'));
    }
    
    public function viewKreator($id)
    {
        $kreator        = User::findOrFail($id);
        $kelases        = CreateKelas::where('user_id', $kreator->id)->get();
        $jumlah_kelas   = CreateKelas::where('user_id', $kreator->id)->count();

        $kelases->each(function ($kelases) {
            $kelases->harga_format   = HelperController::formatHarga($kelases->harga);
        });

        $duwit = Transaksi::where('user_id', $kreator->id)->where('status', 'selesai')->sum('harga');
        $total_duwit = HelperController::formatHarga($duwit);        
        
        return view('pages.admin.view-kreator', [
            'kreator' => $kreator,
            'kelases' => $kelases,
            'jumlah_kelas' => $jumlah_kelas,
            'total_duwit' => $total_duwit,
        ]);
    }
    
    public function detailKelasKreator($id)
    {
        $konten = KontenModel::where('kelas_id', $id)->get();
        
        return view('pages.admin.konten-kelas', compact('konten'));
    }
    
    public function hapusKontenKreator($id)
    {
        $konten = KontenModel::findOrFail($id);
        $konten->delete();

        return redirect()->back()->with('msg', 'Berhasil Hapus Konten!');
    }
    
    public function deleteKreator($id)
    {
        $kreator = User::findOrFail($id);
        $kreator->delete();

        return redirect()->back()->with('msg', 'Berhasil Menghapus Kreator');
    }
    
    public function deleteKelas($id)
    {
        $kelas = CreateKelas::findOrFail($id);
        $kelas->delete();

        return redirect()->back()->with('msg', 'Berhasil Menghapus Kelas');
    }
    
    public function detailKelas($id)
    {
        $kelases = CreateKelas::findOrFail($id)->orderBy('created_at', 'desc');

        return view('pages.admin.view-kreator', compact('kelases'));
    }

    public function kelolaKomentar()
    {
        $komens = CommentModel::all();
        return view('pages.admin.komentar', compact('komens'));
    }

    public function hapusKomentar($id)
    {
        $komen = CommentModel::findOrFail($id);
        $komen->delete();

        return redirect()->back()->with('msg', 'Berhasil Menghapus Komentar');
    }
}
