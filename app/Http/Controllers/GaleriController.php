<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanModels;

class GaleriController extends Controller
{
    public function galeri()
    {
        // Get all activities that have dokumentasi_ids and where dokumentasi_ids is not null or "[]"
        $kegiatan = KegiatanModels::whereNotNull('dokumentasi_ids')
            ->where('dokumentasi_ids', '!=', '[]')
            ->where('tanggal_kegiatan', '<', now()->toDateString())
            ->orderBy('tanggal_kegiatan', 'desc')
            ->get();

        // Process dokumentasi for each kegiatan
        foreach ($kegiatan as $k) {
            $dok_ids = json_decode($k->dokumentasi_ids, true) ?? [];
            $k->dokumentasi_list = \App\Models\Dokumentasi::whereIn('id', $dok_ids)->get();
        }

        return view('galeri', compact('kegiatan'));
    }

    public function detailgaleri($id)
    {
        $activity = KegiatanModels::findOrFail($id);
        $dok_ids = json_decode($activity->dokumentasi_ids, true) ?? [];
        $activity->dokumentasi_list = \App\Models\Dokumentasi::whereIn('id', $dok_ids)->get();

        return view('detail_galeri', compact('activity'));
    }
}
