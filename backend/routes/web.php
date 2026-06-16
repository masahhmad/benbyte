<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KreatorController;
use App\Http\Controllers\UserController;
use App\Models\CreateKelas;

Route::get('/', function () {
    $kelases = CreateKelas::all()->take(4);

    $kelases->each(function ($kelas) {
        $kelas->harga_format = HelperController::formatHarga($kelas->harga);
    });

    return view('welcome', compact('kelases'));
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/{id}/blog', [HomeController::class, 'blog'])->name('blog');
    Route::post('/tambah-blog', [AdminController::class, 'tambahBlog'])->name('tambah-blog');
    Route::get('/{id}/edit-blog', [AdminController::class, 'editBlog'])->name('edit-blog');
    Route::post('/{id}/edit-blog/update', [AdminController::class, 'updateBlog'])->name('update-blog');
    Route::get('/{id}/hapus-blog/hapus', [AdminController::class, 'hapusBlog'])->name('hapus-blog');
    Route::get('/statistik', [AdminController::class, 'adminStatistik'])->name('statistik');
    Route::get('/list-kreator', [AdminController::class, 'listKreator'])->name('list-kreator');
    Route::get('/{id}/view-kreator', [AdminController::class, 'viewKreator'])->name('view-kreator');
    Route::get('/{id}/detail-kelas-kreator', [AdminController::class, 'detailKelasKreator'])->name('detail-kelas-kreator');
    Route::delete('/{id}/delete-konten-kreator', [AdminController::class, 'hapusKontenKreator'])->name('hapus-konten-kreator');
    Route::delete('/{id}/delete-kelas', [AdminController::class, 'deleteKelas'])->name('delete-kelas');
    Route::get('/{id}/delete-kreator', [AdminController::class, 'deleteKreator'])->name('delete-kreator');
    Route::get('/komentar', [HomeController::class, 'komentar'])->name('komentar');
    Route::get('/kelola-komentar', [AdminController::class, 'kelolaKomentar'])->name('kelola-komentar');
    Route::get('/kelola-komentar/{id}/hapus', [AdminController::class, 'hapusKomentar'])->name('hapus-komentar');
}); 

Route::prefix('kreator')->middleware(['auth', 'kreator'])->name('kreator.')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/{id}/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/komentar', [HomeController::class, 'komentar'])->name('komentar');
    Route::post('/komentar/kirim', [HomeController::class, 'kirimKomentar'])->name('kirim-komentar');
    Route::get('/create', [KreatorController::class, 'createKelas'])->name('create-kelas');
    Route::post('/create/store', [KreatorController::class, 'storeKelas'])->name('store-kelas');
    Route::post('/create/{id}/ganti-status', [KreatorController::class, 'gantiStatusKelas'])->name('ganti-status');
    Route::get('/{id}/delete-kelas', [KreatorController::class, 'deleteKelas'])->name('delete-kelas');
    Route::get('/{id}/konten-kelas', [KreatorController::class, 'kontenKelas'])->name('konten-kelas');
    Route::get('{id}/edit-konten-kelas', [KreatorController::class, 'editKontenKelas'])->name('edit-konten-kelas');
    Route::post('{id}/update-konten-kelas', [KreatorController::class, 'updateKontenKelas'])->name('update-konten-kelas');
    Route::post('/{user_id}/konten-kelas/{kelas_id}/store', [KreatorController::class, 'storeKontenKelas'])->name('store-konten-kelas');
    Route::get('/konten-kelas/{id}/hapus-label', [KreatorController::class, 'hapusLabel'])->name('hapus-label');
    Route::get('/konten-kelas/{id}/edit-label', [KreatorController::class, 'editLabel'])->name('edit-label');
    Route::post('/konten-kelas/tambah-label', [KreatorController::class, 'tambahLabelKelas'])->name('tambah-label-kelas');
    Route::delete('/konten-kelas/{id}/hapus-konten', [KreatorController::class, 'hapusKontenKelas'])->name('hapus-konten');
    Route::get('/grafik-pembelian', [KreatorController::class, 'grafikPembelian'])->name('grafik-pembelian');
});

Route::prefix('user')->middleware(['auth', 'user'])->name('user.')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/{id}/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/komentar', [HomeController::class, 'komentar'])->name('komentar');
    Route::post('/komentar/kirim', [HomeController::class, 'kirimKomentar'])->name('kirim-komentar');
    Route::get('/toko-programming', [UserController::class, 'programmingKelas'])->name('programming-kelas');
    Route::get('/toko-uiux', [UserController::class, 'uiuxKelas'])->name('uiux-kelas');
    Route::get('/toko-network', [UserController::class, 'networkKelas'])->name('network-kelas');
    Route::post('beli-kelas', [UserController::class, 'beliKelas'])->name('beli-kelas');
    Route::get('/beli-kelas/{transaksi}/sukses', [UserController::class, 'beliKelasSukses'])->name('beli-kelas-sukses');
    Route::get('/kelasku', [UserController::class, 'kelasKu'])->name('kelasku');
    Route::get('/kelasku/{id}/masuk', [UserController::class, 'masukKelasKu'])->name('masuk-kelasku');
    Route::get('/{id}/lanjut-beli', [UserController::class, 'lanjutBeli'])->name('lanjut-beli');
    // Route::get('/{transaksi}/lanjut-beli-sukses', [UserController::class, 'lanjutBeliKelasSukses'])->name('lanjut-beli-sukses');
    Route::delete('/{id}/hapus-request', [UserController::class, 'hapusRequest'])->name('hapus-request');
    Route::get('/{id}/registrasi', [UserController::class, 'registrasiKreator'])->name('registrasi-kreator');
    Route::post('/{id}/registrasi/kirim', [UserController::class, 'kirimRegistrasiKreator'])->name('kirim-registrasi-kreator');
});