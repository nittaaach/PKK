<?php

namespace App\Http\Controllers;

use App\Models\DaftarAnggotaModels;


class HomeController extends Controller
{
    public function HomeLanding()
    {
        $galeriLanding = \App\Models\KegiatanModels::whereNotNull('dokumentasi_ids')
            ->where('dokumentasi_ids', '!=', '[]')
            ->where('tanggal_kegiatan', '<', now()->toDateString())
            ->where('tanggal_kegiatan', '>=', now()->subMonth()->toDateString())
            ->orderBy('tanggal_kegiatan', 'desc')
            ->take(8)
            ->get();

        foreach ($galeriLanding as $k) {
            $dok_ids = json_decode($k->dokumentasi_ids, true) ?? [];
            $k->dokumentasi_list = \App\Models\Dokumentasi::whereIn('id', $dok_ids)->get();
        }

        // Ambil gambar untuk hero carousel (kegiatan seminggu terakhir / 7 hari terakhir)
        $kegiatanSeminggu = \App\Models\KegiatanModels::whereNotNull('dokumentasi_ids')
            ->where('dokumentasi_ids', '!=', '[]')
            ->where('tanggal_kegiatan', '>=', now()->subDays(7)->toDateString())
            ->orderBy('tanggal_kegiatan', 'desc')
            ->get();

        $carouselIds = [];
        foreach ($kegiatanSeminggu as $k) {
            $ids = json_decode($k->dokumentasi_ids, true);
            if (is_array($ids)) {
                $carouselIds = array_merge($carouselIds, $ids);
            }
        }
        $carouselIds = array_unique($carouselIds);

        $carouselImages = collect();
        if (!empty($carouselIds)) {
            $carouselImages = \App\Models\Dokumentasi::whereIn('id', $carouselIds)
                ->take(3)
                ->get();
        }

        return view('landing', compact('galeriLanding', 'carouselImages'));
    }

    public function profil()
    {
        return view('/profil');
    }
    

    public function struktural()
    {
        $ketua = DaftarAnggotaModels::where('role_pkk', 'Ketua')->get();
        $wakil = DaftarAnggotaModels::where('role_pkk', 'Wakil')->get();
        $bendahara = DaftarAnggotaModels::where('role_pkk', 'Bendahara')->get();
        $sekretaris = DaftarAnggotaModels::where('role_pkk', 'Sekretaris')->get();
        $pokja1 = DaftarAnggotaModels::where('role_pkk', 'Pokja 1')->get();
        $pokja2 = DaftarAnggotaModels::where('role_pkk', 'Pokja 2')->get();
        $pokja3 = DaftarAnggotaModels::where('role_pkk', 'Pokja 3')->get();
        $pokja4 = DaftarAnggotaModels::where('role_pkk', 'Pokja 4')->get();

        return view('struktural', compact('ketua', 'wakil', 'bendahara', 'sekretaris', 'pokja1', 'pokja2', 'pokja3', 'pokja4'));
    }
}
