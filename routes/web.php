<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaftarAnggotaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AgendaSuratController;
use App\Http\Controllers\PapanDataController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\DataUmumController;
use App\Http\Controllers\BukuKeuanganController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\GaleriController;
// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

//route for auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route for printing activities (accessible by multiple roles if needed)
Route::get('/kegiatan/print_report', [KegiatanController::class, 'print_report'])->name('kegiatan.print_report');


//================ Auth Group: Ketua ================
Route::middleware(['auth:ketua', 'role:Ketua'])->group(function () {
    Route::get('/ketua/dashboard', [DashboardController::class, 'index'])->name('Ketua.dashboard');
    Route::get('/ketua/dokumentasi', [DokumentasiController::class, 'index_ketua'])->name('Ketua.dokumentasi');
    Route::post('/ketua/dokumentasi', [DokumentasiController::class, 'store_ketua'])->name('dokumentasi.store_ketua');
    Route::put('/ketua/dokumentasi/{id}', [DokumentasiController::class, 'update_ketua'])->name('dokumentasi.update_ketua');
    Route::delete('/ketua/dokumentasi/{id}', [DokumentasiController::class, 'destroy_ketua'])->name('dokumentasi.destroy_ketua');
    Route::get('/ketua/buku_keuangan', [BukuKeuanganController::class, 'index_ketua'])->name('Ketua.buku_keuangan');
    Route::get('/ketua/sekretaris/daftar_anggota', [DaftarAnggotaController::class, 'index_ketua_sekretaris'])->name('Ketua.sekretaris_daftar_anggota');
    Route::get('/ketua/sekretaris/kegiatan', [KegiatanController::class, 'kegiatan_ketua_sekretaris'])->name('Ketua.sekretaris_kegiatan');
    Route::get('/ketua/sekretaris/agenda_surat', [AgendaSuratController::class, 'agenda_surat_ketua_sekretaris'])->name('Ketua.sekretaris_agenda_surat');
    Route::get('/ketua/sekretaris/papan_data', [PapanDataController::class, 'papan_data_ketua_sekretaris'])->name('Ketua.sekretaris_papan_data');
    Route::get('/ketua/sekretaris/data_umum', [DataUmumController::class, 'data_umum_ketua'])->name('Ketua.sekretaris_data_umum');
    Route::get('/ketua/sekretaris/data_potensi', [DataUmumController::class, 'data_potensi_ketua'])->name('Ketua.sekretaris_data_potensi');
    Route::get('/ketua/pokja1/daftar_anggota', [DaftarAnggotaController::class, 'index_ketua_pokja1'])->name('Ketua.pokja1_daftar_anggota');
    Route::get('/ketua/pokja1/kegiatan', [KegiatanController::class, 'kegiatan_ketua_pokja1'])->name('Ketua.pokja1_kegiatan');
    Route::get('/ketua/pokja1/agenda_surat', [AgendaSuratController::class, 'agenda_surat_ketua_pokja1'])->name('Ketua.pokja1_agenda_surat');
    Route::get('/ketua/pokja1/papan_data', [PapanDataController::class, 'papan_data_ketua_pokja1'])->name('Ketua.pokja1_papan_data');
    Route::get('/ketua/pokja2/daftar_anggota', [DaftarAnggotaController::class, 'index_ketua_pokja2'])->name('Ketua.pokja2_daftar_anggota');
    Route::get('/ketua/pokja2/kegiatan', [KegiatanController::class, 'kegiatan_ketua_pokja2'])->name('Ketua.pokja2_kegiatan');
    Route::get('/ketua/pokja2/agenda_surat', [AgendaSuratController::class, 'agenda_surat_ketua_pokja2'])->name('Ketua.pokja2_agenda_surat');
    Route::get('/ketua/pokja2/papan_data', [PapanDataController::class, 'papan_data_ketua_pokja2'])->name('Ketua.pokja2_papan_data');
    Route::get('/ketua/pokja3/daftar_anggota', [DaftarAnggotaController::class, 'index_ketua_pokja3'])->name('Ketua.pokja3_daftar_anggota');
    Route::get('/ketua/pokja3/kegiatan', [KegiatanController::class, 'kegiatan_ketua_pokja3'])->name('Ketua.pokja3_kegiatan');
    Route::get('/ketua/pokja3/agenda_surat', [AgendaSuratController::class, 'agenda_surat_ketua_pokja3'])->name('Ketua.pokja3_agenda_surat');
    Route::get('/ketua/pokja3/papan_data', [PapanDataController::class, 'papan_data_ketua_pokja3'])->name('Ketua.pokja3_papan_data');
    Route::get('/ketua/pokja4/daftar_anggota', [DaftarAnggotaController::class, 'index_ketua_pokja4'])->name('Ketua.pokja4_daftar_anggota');
    Route::get('/ketua/pokja4/kegiatan', [KegiatanController::class, 'kegiatan_ketua_pokja4'])->name('Ketua.pokja4_kegiatan');
    Route::get('/ketua/pokja4/agenda_surat', [AgendaSuratController::class, 'agenda_surat_ketua_pokja4'])->name('Ketua.pokja4_agenda_surat');
    Route::get('/ketua/pokja4/papan_data', [PapanDataController::class, 'papan_data_ketua_pokja4'])->name('Ketua.pokja4_papan_data');
});

//================ Auth Group: Wakil ================
Route::middleware(['auth:wakil', 'role:Wakil'])->group(function () {
    Route::get('/wakil/dashboard', [DashboardController::class, 'index'])->name('Wakil.dashboard');
    Route::get('/wakil/dokumentasi', [DokumentasiController::class, 'index_wakil'])->name('Wakil.dokumentasi');
    Route::post('/wakil/dokumentasi', [DokumentasiController::class, 'store_wakil'])->name('dokumentasi.store_wakil');
    Route::put('/wakil/dokumentasi/{id}', [DokumentasiController::class, 'update_wakil'])->name('dokumentasi.update_wakil');
    Route::delete('/wakil/dokumentasi/{id}', [DokumentasiController::class, 'destroy_wakil'])->name('dokumentasi.destroy_wakil');
    Route::get('/wakil/buku_keuangan', [BukuKeuanganController::class, 'index_wakil'])->name('Wakil.buku_keuangan');
    Route::get('/wakil/sekretaris/daftar_anggota', [DaftarAnggotaController::class, 'index_wakil_sekretaris'])->name('Wakil.sekretaris_daftar_anggota');
    Route::get('/wakil/sekretaris/kegiatan', [KegiatanController::class, 'kegiatan_wakil_sekretaris'])->name('Wakil.sekretaris_kegiatan');
    Route::get('/wakil/sekretaris/agenda_surat', [AgendaSuratController::class, 'agenda_surat_wakil_sekretaris'])->name('Wakil.sekretaris_agenda_surat');
    Route::get('/wakil/sekretaris/papan_data', [PapanDataController::class, 'papan_data_wakil_sekretaris'])->name('Wakil.sekretaris_papan_data');
    Route::get('/wakil/sekretaris/data_umum', [DataUmumController::class, 'data_umum_wakil'])->name('Wakil.sekretaris_data_umum');
    Route::get('/wakil/sekretaris/data_potensi', [DataUmumController::class, 'data_potensi_wakil'])->name('Wakil.sekretaris_data_potensi');
    Route::get('/wakil/pokja1/daftar_anggota', [DaftarAnggotaController::class, 'index_wakil_pokja1'])->name('Wakil.pokja1_daftar_anggota');
    Route::get('/wakil/pokja1/kegiatan', [KegiatanController::class, 'kegiatan_wakil_pokja1'])->name('Wakil.pokja1_kegiatan');
    Route::get('/wakil/pokja1/agenda_surat', [AgendaSuratController::class, 'agenda_surat_wakil_pokja1'])->name('Wakil.pokja1_agenda_surat');
    Route::get('/wakil/pokja1/papan_data', [PapanDataController::class, 'papan_data_wakil_pokja1'])->name('Wakil.pokja1_papan_data');
    Route::get('/wakil/pokja2/daftar_anggota', [DaftarAnggotaController::class, 'index_wakil_pokja2'])->name('Wakil.pokja2_daftar_anggota');
    Route::get('/wakil/pokja2/kegiatan', [KegiatanController::class, 'kegiatan_wakil_pokja2'])->name('Wakil.pokja2_kegiatan');
    Route::get('/wakil/pokja2/agenda_surat', [AgendaSuratController::class, 'agenda_surat_wakil_pokja2'])->name('Wakil.pokja2_agenda_surat');
    Route::get('/wakil/pokja2/papan_data', [PapanDataController::class, 'papan_data_wakil_pokja2'])->name('Wakil.pokja2_papan_data');
    Route::get('/wakil/pokja3/daftar_anggota', [DaftarAnggotaController::class, 'index_wakil_pokja3'])->name('Wakil.pokja3_daftar_anggota');
    Route::get('/wakil/pokja3/kegiatan', [KegiatanController::class, 'kegiatan_wakil_pokja3'])->name('Wakil.pokja3_kegiatan');
    Route::get('/wakil/pokja3/agenda_surat', [AgendaSuratController::class, 'agenda_surat_wakil_pokja3'])->name('Wakil.pokja3_agenda_surat');
    Route::get('/wakil/pokja3/papan_data', [PapanDataController::class, 'papan_data_wakil_pokja3'])->name('Wakil.pokja3_papan_data');
    Route::get('/wakil/pokja4/daftar_anggota', [DaftarAnggotaController::class, 'index_wakil_pokja4'])->name('Wakil.pokja4_daftar_anggota');
    Route::get('/wakil/pokja4/kegiatan', [KegiatanController::class, 'kegiatan_wakil_pokja4'])->name('Wakil.pokja4_kegiatan');
    Route::get('/wakil/pokja4/agenda_surat', [AgendaSuratController::class, 'agenda_surat_wakil_pokja4'])->name('Wakil.pokja4_agenda_surat');
    Route::get('/wakil/pokja4/papan_data', [PapanDataController::class, 'papan_data_wakil_pokja4'])->name('Wakil.pokja4_papan_data');
});

//================ Auth Group: Bendahara ================
Route::middleware(['auth:bendahara', 'role:Bendahara'])->group(function () {
    Route::get('/bendahara/dashboard', [DashboardController::class, 'index'])->name('Bendahara.dashboard');
    Route::get('/bendahara/dokumentasi', [DokumentasiController::class, 'index_bendahara'])->name('Bendahara.dokumentasi');
    Route::post('/bendahara/dokumentasi', [DokumentasiController::class, 'store_bendahara'])->name('dokumentasi.store_bendahara');
    Route::put('/bendahara/dokumentasi/{id}', [DokumentasiController::class, 'update_bendahara'])->name('dokumentasi.update_bendahara');
    Route::delete('/bendahara/dokumentasi/{id}', [DokumentasiController::class, 'destroy_bendahara'])->name('dokumentasi.destroy_bendahara');
    Route::get('/bendahara/buku_keuangan', [BukuKeuanganController::class, 'index_bendahara'])->name('Bendahara.buku_keuangan');
    Route::post('/bendahara/buku_keuangan', [BukuKeuanganController::class, 'store_bendahara'])->name('buku_keuangan.store_bendahara');
    Route::put('/bendahara/buku_keuangan/{id}', [BukuKeuanganController::class, 'update_bendahara'])->name('buku_keuangan.update_bendahara');
    Route::delete('/bendahara/buku_keuangan/{id}', [BukuKeuanganController::class, 'destroy_bendahara'])->name('buku_keuangan.destroy_bendahara');
});

//================ Auth Group: Sekretaris ================
Route::middleware(['auth:sekretaris', 'role:Sekretaris'])->group(function () {
    Route::get('/sekretaris/dashboard', [DashboardController::class, 'index'])->name('Sekretaris.dashboard');
    Route::get('/sekretaris/dokumentasi', [DokumentasiController::class, 'index_sekretaris'])->name('Sekretaris.dokumentasi');
    Route::post('/sekretaris/dokumentasi', [DokumentasiController::class, 'store_sekretaris'])->name('dokumentasi.store_sekretaris');
    Route::put('/sekretaris/dokumentasi/{id}', [DokumentasiController::class, 'update_sekretaris'])->name('dokumentasi.update_sekretaris');
    Route::delete('/sekretaris/dokumentasi/{id}', [DokumentasiController::class, 'destroy_sekretaris'])->name('dokumentasi.destroy_sekretaris');
    Route::get('/sekretaris/daftar_anggota', [DaftarAnggotaController::class, 'index_sekretaris'])->name('Sekretaris.daftar_anggota');
    Route::get('/sekretaris/kegiatan', [KegiatanController::class, 'kegiatan_sekretaris'])->name('Sekretaris.kegiatan');
    Route::get('/sekretaris/agenda_surat', [AgendaSuratController::class, 'agenda_surat_sekretaris'])->name('Sekretaris.agenda_surat');
    Route::get('/sekretaris/papan_data', [PapanDataController::class, 'papan_data_sekretaris'])->name('Sekretaris.papan_data');
    Route::get('/sekretaris/data_umum', [DataUmumController::class, 'data_umum_sekretaris'])->name('Sekretaris.data_umum');
    Route::get('/sekretaris/data_potensi_wilayah', [DataUmumController::class, 'data_potensi_sekretaris'])->name('Sekretaris.data_potensi_wilayah');
    Route::get('/sekretaris/buku_keuangan', [BukuKeuanganController::class, 'index_sekretaris'])->name('Sekretaris.buku_keuangan');
    Route::post('/sekretaris/buku_keuangan', [BukuKeuanganController::class, 'store_sekretaris'])->name('buku_keuangan.store_sekretaris');
    Route::put('/sekretaris/buku_keuangan/{id}', [BukuKeuanganController::class, 'update_sekretaris'])->name('buku_keuangan.update_sekretaris');
    Route::delete('/sekretaris/buku_keuangan/{id}', [BukuKeuanganController::class, 'destroy_sekretaris'])->name('buku_keuangan.destroy_sekretaris');

    Route::post('/sekretaris/daftar_anggota/', [DaftarAnggotaController::class, 'store_anggota_sekretaris'])->name('daftar_anggota.store_anggota_sekretaris');
    Route::put('/sekretaris/daftar_anggota/{id}', [DaftarAnggotaController::class, 'update_anggota_sekretaris'])->name('daftar_anggota.update_anggota_sekretaris');
    Route::delete('/sekretaris/daftar_anggota/{id}', [DaftarAnggotaController::class, 'destroy_anggota_sekretaris'])->name('daftar_anggota.destroy_anggota_sekretaris');

    Route::post('/sekretaris/kegiatan', [KegiatanController::class, 'store_kegiatan'])->name('kegiatan.store_sekretaris');
    Route::put('/sekretaris/kegiatan/{id}', [KegiatanController::class, 'update_kegiatan'])->name('kegiatan.update_sekretaris');
    Route::delete('/sekretaris/kegiatan/{id}', [KegiatanController::class, 'destroy_kegiatan'])->name('kegiatan.destroy_sekretaris');

    Route::post('/sekretaris/surat_masuk', [AgendaSuratController::class, 'store_surat_masuk'])->name('agenda_surat.store_masuk_sekretaris');
    Route::put('/sekretaris/surat_masuk/{id}', [AgendaSuratController::class, 'update_surat_masuk'])->name('agenda_surat.update_masuk_sekretaris');
    Route::delete('/sekretaris/surat_masuk/{id}', [AgendaSuratController::class, 'destroy_surat_masuk'])->name('agenda_surat.destroy_masuk_sekretaris');

    Route::post('/sekretaris/surat_keluar', [AgendaSuratController::class, 'store_surat_keluar'])->name('agenda_surat.store_keluar_sekretaris');
    Route::put('/sekretaris/surat_keluar/{id}', [AgendaSuratController::class, 'update_surat_keluar'])->name('agenda_surat.update_keluar_sekretaris');
    Route::delete('/sekretaris/surat_keluar/{id}', [AgendaSuratController::class, 'destroy_surat_keluar'])->name('agenda_surat.destroy_keluar_sekretaris');

    Route::post('/sekretaris/papan_data', [PapanDataController::class, 'store_papan_data'])->name('papan_data.store_sekretaris');
    Route::put('/sekretaris/papan_data/{id}', [PapanDataController::class, 'update_papan_data'])->name('papan_data.update_sekretaris');
    Route::delete('/sekretaris/papan_data/{id}', [PapanDataController::class, 'destroy_papan_data'])->name('papan_data.destroy_sekretaris');

    Route::post('/sekretaris/data_umum', [DataUmumController::class, 'store_data_umum'])->name('data_umum.store_sekretaris');
    Route::put('/sekretaris/data_umum/{id}', [DataUmumController::class, 'update_data_umum'])->name('data_umum.update_sekretaris');
    Route::delete('/sekretaris/data_umum/{id}', [DataUmumController::class, 'destroy_data_umum'])->name('data_umum.destroy_sekretaris');

    Route::post('/sekretaris/data_potensi', [DataUmumController::class, 'store_data_potensi'])->name('data_potensi.store_sekretaris');
    Route::put('/sekretaris/data_potensi/{id}', [DataUmumController::class, 'update_data_potensi'])->name('data_potensi.update_sekretaris');
    Route::delete('/sekretaris/data_potensi/{id}', [DataUmumController::class, 'destroy_data_potensi'])->name('data_potensi.destroy_sekretaris');
});

//================ Auth Group: Admin ================
Route::middleware(['auth:admin', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('Admin.dashboard');
    Route::get('/admin/katalog', [KatalogController::class, 'index'])->name('admin.katalog');
    Route::post('/admin/katalog', [KatalogController::class, 'store_pkk'])->name('katalog.store_pkk');
    Route::put('/admin/katalog/{id}', [KatalogController::class, 'update_pkk'])->name('katalog.update_pkk');
    Route::delete('/admin/katalog/{id}', [KatalogController::class, 'destroy_pkk'])->name('katalog.destroy_pkk');
});

//================ Auth Group: Pokja 1 ================
Route::middleware(['auth:pokja_1', 'role:Pokja_1'])->group(function () {
    Route::get('/pokja_1/dashboard', [DashboardController::class, 'index'])->name('Pokja_1.dashboard');
    Route::get('/pokja_1/dokumentasi', [DokumentasiController::class, 'index_pokja1'])->name('Pokja_1.dokumentasi');
    Route::post('/pokja_1/dokumentasi', [DokumentasiController::class, 'store_pokja1'])->name('dokumentasi.store_pokja1');
    Route::put('/pokja_1/dokumentasi/{id}', [DokumentasiController::class, 'update_pokja1'])->name('dokumentasi.update_pokja1');
    Route::delete('/pokja_1/dokumentasi/{id}', [DokumentasiController::class, 'destroy_pokja1'])->name('dokumentasi.destroy_pokja1');
    Route::get('/pokja_1/daftar_anggota', [DaftarAnggotaController::class, 'index_pokja1'])->name('Pokja_1.daftar_anggota');
    Route::get('/pokja_1/kegiatan', [KegiatanController::class, 'kegiatan_pokja1'])->name('Pokja_1.kegiatan');
    Route::get('/pokja_1/agenda_surat', [AgendaSuratController::class, 'agenda_surat_pokja1'])->name('Pokja_1.agenda_surat');
    Route::get('/pokja_1/papan_data', [PapanDataController::class, 'papan_data_pokja1'])->name('Pokja_1.papan_data');

    // Daftar Anggota (pokja1) crud
    Route::post('/pokja_1/daftar_anggota/', [DaftarAnggotaController::class, 'store_anggota_pokja1'])->name('daftar_anggota.store_anggota_pokja1');
    Route::put('/pokja_1/daftar_anggota/{id}', [DaftarAnggotaController::class, 'update_anggota_pokja1'])->name('daftar_anggota.update_anggota_pokja1');
    Route::delete('/pokja_1/daftar_anggota/{id}', [DaftarAnggotaController::class, 'destroy_anggota_pokja1'])->name('daftar_anggota.destroy_anggota_pokja1');

    // Kegiatan (pokja1) crud
    Route::post('/pokja_1/kegiatan', [KegiatanController::class, 'store_kegiatan'])->name('kegiatan.store_pokja1');
    Route::put('/pokja_1/kegiatan/{id}', [KegiatanController::class, 'update_kegiatan'])->name('kegiatan.update_pokja1');
    Route::delete('/pokja_1/kegiatan/{id}', [KegiatanController::class, 'destroy_kegiatan'])->name('kegiatan.destroy_pokja1');

    // Agenda Surat (pokja1) crud
    Route::post('/pokja_1/surat_masuk', [AgendaSuratController::class, 'store_surat_masuk'])->name('agenda_surat.store_masuk_pokja1');
    Route::put('/pokja_1/surat_masuk/{id}', [AgendaSuratController::class, 'update_surat_masuk'])->name('agenda_surat.update_masuk_pokja1');
    Route::delete('/pokja_1/surat_masuk/{id}', [AgendaSuratController::class, 'destroy_surat_masuk'])->name('agenda_surat.destroy_masuk_pokja1');
    Route::post('/pokja_1/surat_keluar', [AgendaSuratController::class, 'store_surat_keluar'])->name('agenda_surat.store_keluar_pokja1');
    Route::put('/pokja_1/surat_keluar/{id}', [AgendaSuratController::class, 'update_surat_keluar'])->name('agenda_surat.update_keluar_pokja1');
    Route::delete('/pokja_1/surat_keluar/{id}', [AgendaSuratController::class, 'destroy_surat_keluar'])->name('agenda_surat.destroy_keluar_pokja1');

    // Papan Data (pokja1) crud
    Route::post('/pokja_1/papan_data', [PapanDataController::class, 'store_papan_data'])->name('papan_data.store_pokja1');
    Route::put('/pokja_1/papan_data/{id}', [PapanDataController::class, 'update_papan_data'])->name('papan_data.update_pokja1');
    Route::delete('/pokja_1/papan_data/{id}', [PapanDataController::class, 'destroy_papan_data'])->name('papan_data.destroy_pokja1');
});

//================ Auth Group: Pokja 2 ================
Route::middleware(['auth:pokja_2', 'role:Pokja_2'])->group(function () {
    Route::get('/pokja_2/dashboard', [DashboardController::class, 'index'])->name('Pokja_2.dashboard');
    Route::get('/pokja_2/dokumentasi', [DokumentasiController::class, 'index_pokja2'])->name('Pokja_2.dokumentasi');
    Route::post('/pokja_2/dokumentasi', [DokumentasiController::class, 'store_pokja2'])->name('dokumentasi.store_pokja2');
    Route::put('/pokja_2/dokumentasi/{id}', [DokumentasiController::class, 'update_pokja2'])->name('dokumentasi.update_pokja2');
    Route::delete('/pokja_2/dokumentasi/{id}', [DokumentasiController::class, 'destroy_pokja2'])->name('dokumentasi.destroy_pokja2');
    Route::get('/pokja_2/daftar_anggota', [DaftarAnggotaController::class, 'index_pokja2'])->name('Pokja_2.daftar_anggota');
    Route::get('/pokja_2/kegiatan', [KegiatanController::class, 'kegiatan_pokja2'])->name('Pokja_2.kegiatan');
    Route::get('/pokja_2/agenda_surat', [AgendaSuratController::class, 'agenda_surat_pokja2'])->name('Pokja_2.agenda_surat');
    Route::get('/pokja_2/papan_data', [PapanDataController::class, 'papan_data_pokja2'])->name('Pokja_2.papan_data');

    Route::post('/pokja_2/daftar_anggota/', [DaftarAnggotaController::class, 'store_anggota_pokja2'])->name('daftar_anggota.store_anggota_pokja2');
    Route::put('/pokja_2/daftar_anggota/{id}', [DaftarAnggotaController::class, 'update_anggota_pokja2'])->name('daftar_anggota.update_anggota_pokja2');
    Route::delete('/pokja_2/daftar_anggota/{id}', [DaftarAnggotaController::class, 'destroy_anggota_pokja2'])->name('daftar_anggota.destroy_anggota_pokja2');

    Route::post('/pokja_2/kegiatan', [KegiatanController::class, 'store_kegiatan'])->name('kegiatan.store_pokja2');
    Route::put('/pokja_2/kegiatan/{id}', [KegiatanController::class, 'update_kegiatan'])->name('kegiatan.update_pokja2');
    Route::delete('/pokja_2/kegiatan/{id}', [KegiatanController::class, 'destroy_kegiatan'])->name('kegiatan.destroy_pokja2');

    Route::post('/pokja_2/surat_masuk', [AgendaSuratController::class, 'store_surat_masuk'])->name('agenda_surat.store_masuk_pokja2');
    Route::put('/pokja_2/surat_masuk/{id}', [AgendaSuratController::class, 'update_surat_masuk'])->name('agenda_surat.update_masuk_pokja2');
    Route::delete('/pokja_2/surat_masuk/{id}', [AgendaSuratController::class, 'destroy_surat_masuk'])->name('agenda_surat.destroy_masuk_pokja2');
    Route::post('/pokja_2/surat_keluar', [AgendaSuratController::class, 'store_surat_keluar'])->name('agenda_surat.store_keluar_pokja2');
    Route::put('/pokja_2/surat_keluar/{id}', [AgendaSuratController::class, 'update_surat_keluar'])->name('agenda_surat.update_keluar_pokja2');
    Route::delete('/pokja_2/surat_keluar/{id}', [AgendaSuratController::class, 'destroy_surat_keluar'])->name('agenda_surat.destroy_keluar_pokja2');

    Route::post('/pokja_2/papan_data', [PapanDataController::class, 'store_papan_data'])->name('papan_data.store_pokja2');
    Route::put('/pokja_2/papan_data/{id}', [PapanDataController::class, 'update_papan_data'])->name('papan_data.update_pokja2');
    Route::delete('/pokja_2/papan_data/{id}', [PapanDataController::class, 'destroy_papan_data'])->name('papan_data.destroy_pokja2');
});

//================ Auth Group: Pokja 3 ================
Route::middleware(['auth:pokja_3', 'role:Pokja_3'])->group(function () {
    Route::get('/pokja_3/dashboard', [DashboardController::class, 'index'])->name('Pokja_3.dashboard');
    Route::get('/pokja_3/dokumentasi', [DokumentasiController::class, 'index_pokja3'])->name('Pokja_3.dokumentasi');
    Route::post('/pokja_3/dokumentasi', [DokumentasiController::class, 'store_pokja3'])->name('dokumentasi.store_pokja3');
    Route::put('/pokja_3/dokumentasi/{id}', [DokumentasiController::class, 'update_pokja3'])->name('dokumentasi.update_pokja3');
    Route::delete('/pokja_3/dokumentasi/{id}', [DokumentasiController::class, 'destroy_pokja3'])->name('dokumentasi.destroy_pokja3');
    Route::get('/pokja_3/daftar_anggota', [DaftarAnggotaController::class, 'index_pokja3'])->name('Pokja_3.daftar_anggota');
    Route::get('/pokja_3/kegiatan', [KegiatanController::class, 'kegiatan_pokja3'])->name('Pokja_3.kegiatan');
    Route::get('/pokja_3/agenda_surat', [AgendaSuratController::class, 'agenda_surat_pokja3'])->name('Pokja_3.agenda_surat');
    Route::get('/pokja_3/papan_data', [PapanDataController::class, 'papan_data_pokja3'])->name('Pokja_3.papan_data');

    Route::post('/pokja_3/daftar_anggota/', [DaftarAnggotaController::class, 'store_anggota_pokja3'])->name('daftar_anggota.store_anggota_pokja3');
    Route::put('/pokja_3/daftar_anggota/{id}', [DaftarAnggotaController::class, 'update_anggota_pokja3'])->name('daftar_anggota.update_anggota_pokja3');
    Route::delete('/pokja_3/daftar_anggota/{id}', [DaftarAnggotaController::class, 'destroy_anggota_pokja3'])->name('daftar_anggota.destroy_anggota_pokja3');

    Route::post('/pokja_3/kegiatan', [KegiatanController::class, 'store_kegiatan'])->name('kegiatan.store_pokja3');
    Route::put('/pokja_3/kegiatan/{id}', [KegiatanController::class, 'update_kegiatan'])->name('kegiatan.update_pokja3');
    Route::delete('/pokja_3/kegiatan/{id}', [KegiatanController::class, 'destroy_kegiatan'])->name('kegiatan.destroy_pokja3');

    Route::post('/pokja_3/surat_masuk', [AgendaSuratController::class, 'store_surat_masuk'])->name('agenda_surat.store_masuk_pokja3');
    Route::put('/pokja_3/surat_masuk/{id}', [AgendaSuratController::class, 'update_surat_masuk'])->name('agenda_surat.update_masuk_pokja3');
    Route::delete('/pokja_3/surat_masuk/{id}', [AgendaSuratController::class, 'destroy_surat_masuk'])->name('agenda_surat.destroy_masuk_pokja3');
    Route::post('/pokja_3/surat_keluar', [AgendaSuratController::class, 'store_surat_keluar'])->name('agenda_surat.store_keluar_pokja3');
    Route::put('/pokja_3/surat_keluar/{id}', [AgendaSuratController::class, 'update_surat_keluar'])->name('agenda_surat.update_keluar_pokja3');
    Route::delete('/pokja_3/surat_keluar/{id}', [AgendaSuratController::class, 'destroy_surat_keluar'])->name('agenda_surat.destroy_keluar_pokja3');

    Route::post('/pokja_3/papan_data', [PapanDataController::class, 'store_papan_data'])->name('papan_data.store_pokja3');
    Route::put('/pokja_3/papan_data/{id}', [PapanDataController::class, 'update_papan_data'])->name('papan_data.update_pokja3');
    Route::delete('/pokja_3/papan_data/{id}', [PapanDataController::class, 'destroy_papan_data'])->name('papan_data.destroy_pokja3');
});

//================ Auth Group: Pokja 4 ================
Route::middleware(['auth:pokja_4', 'role:Pokja_4'])->group(function () {
    Route::get('/pokja_4/dashboard', [DashboardController::class, 'index'])->name('Pokja_4.dashboard');
    Route::get('/pokja_4/dokumentasi', [DokumentasiController::class, 'index_pokja4'])->name('Pokja_4.dokumentasi');
    Route::post('/pokja_4/dokumentasi', [DokumentasiController::class, 'store_pokja4'])->name('dokumentasi.store_pokja4');
    Route::put('/pokja_4/dokumentasi/{id}', [DokumentasiController::class, 'update_pokja4'])->name('dokumentasi.update_pokja4');
    Route::delete('/pokja_4/dokumentasi/{id}', [DokumentasiController::class, 'destroy_pokja4'])->name('dokumentasi.destroy_pokja4');
    Route::get('/pokja_4/daftar_anggota', [DaftarAnggotaController::class, 'index_pokja4'])->name('Pokja_4.daftar_anggota');
    Route::get('/pokja_4/kegiatan', [KegiatanController::class, 'kegiatan_pokja4'])->name('Pokja_4.kegiatan');
    Route::get('/pokja_4/agenda_surat', [AgendaSuratController::class, 'agenda_surat_pokja4'])->name('Pokja_4.agenda_surat');
    Route::get('/pokja_4/papan_data', [PapanDataController::class, 'papan_data_pokja4'])->name('Pokja_4.papan_data');

    Route::post('/pokja_4/daftar_anggota/', [DaftarAnggotaController::class, 'store_anggota_pokja4'])->name('daftar_anggota.store_anggota_pokja4');
    Route::put('/pokja_4/daftar_anggota/{id}', [DaftarAnggotaController::class, 'update_anggota_pokja4'])->name('daftar_anggota.update_anggota_pokja4');
    Route::delete('/pokja_4/daftar_anggota/{id}', [DaftarAnggotaController::class, 'destroy_anggota_pokja4'])->name('daftar_anggota.destroy_anggota_pokja4');

    Route::post('/pokja_4/kegiatan', [KegiatanController::class, 'store_kegiatan'])->name('kegiatan.store_pokja4');
    Route::put('/pokja_4/kegiatan/{id}', [KegiatanController::class, 'update_kegiatan'])->name('kegiatan.update_pokja4');
    Route::delete('/pokja_4/kegiatan/{id}', [KegiatanController::class, 'destroy_kegiatan'])->name('kegiatan.destroy_pokja4');

    Route::post('/pokja_4/surat_masuk', [AgendaSuratController::class, 'store_surat_masuk'])->name('agenda_surat.store_masuk_pokja4');
    Route::put('/pokja_4/surat_masuk/{id}', [AgendaSuratController::class, 'update_surat_masuk'])->name('agenda_surat.update_masuk_pokja4');
    Route::delete('/pokja_4/surat_masuk/{id}', [AgendaSuratController::class, 'destroy_surat_masuk'])->name('agenda_surat.destroy_masuk_pokja4');
    Route::post('/pokja_4/surat_keluar', [AgendaSuratController::class, 'store_surat_keluar'])->name('agenda_surat.store_keluar_pokja4');
    Route::put('/pokja_4/surat_keluar/{id}', [AgendaSuratController::class, 'update_surat_keluar'])->name('agenda_surat.update_keluar_pokja4');
    Route::delete('/pokja_4/surat_keluar/{id}', [AgendaSuratController::class, 'destroy_surat_keluar'])->name('agenda_surat.destroy_keluar_pokja4');

    Route::post('/pokja_4/papan_data', [PapanDataController::class, 'store_papan_data'])->name('papan_data.store_pokja4');
    Route::put('/pokja_4/papan_data/{id}', [PapanDataController::class, 'update_papan_data'])->name('papan_data.update_pokja4');
    Route::delete('/pokja_4/papan_data/{id}', [PapanDataController::class, 'destroy_papan_data'])->name('papan_data.destroy_pokja4');
});


//route for home
Route::get('/', [HomeController::class, 'HomeLanding'])->name('landing');
Route::get('/landing', [HomeController::class, 'HomeLanding'])->name('landing');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/katalog', [KatalogController::class, 'katalog'])->name('katalog');
Route::get('/detail_katalog/{id}', [KatalogController::class, 'detail_katalog'])->name('detail_katalog');
Route::get('/struktural', [HomeController::class, 'struktural'])->name('struktural');
Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{id}', [GaleriController::class, 'detailgaleri'])->name('galeri.detail');
Route::get('/kegiatan/akan-datang', [KegiatanController::class, 'kegiatanAkanDatang'])->name('kegiatan.akan_datang');
Route::get('/kegiatan/terlaksana', [KegiatanController::class, 'kegiatanTerlaksana'])->name('kegiatan.terlaksana');

// Dynamic route to serve storage files (useful for shared hosting without symlink support)
Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!\Illuminate\Support\Facades\File::exists($path)) {
        abort(404);
    }

    $file = \Illuminate\Support\Facades\File::get($path);
    $type = \Illuminate\Support\Facades\File::mimeType($path);

    $response = \Illuminate\Support\Facades\Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->where('filename', '.*');
