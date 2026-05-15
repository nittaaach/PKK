<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KegiatanModels;

class KegiatanController extends Controller
{
    public function kegiatan_sekretaris()
    {
        return view('sekretaris.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Sekretaris')->get()]);
    }

    public function print_report(Request $request)
    {
        $ids = explode(',', $request->query('ids', ''));
        $ids = array_filter($ids); // Remove empty values
        
        if (empty($ids)) {
            return back()->with('error', 'Tidak ada data yang dipilih!');
        }

        $kegiatan = KegiatanModels::whereIn('id', $ids)->get();

        if ($kegiatan->isEmpty()) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        $first_kegiatan = $kegiatan->first();
        $nama = $first_kegiatan->nama ?? '-';
        $role = $first_kegiatan->role ?? '-';
        $bulan_tahun = $first_kegiatan->tanggal_kegiatan ? \Carbon\Carbon::parse($first_kegiatan->tanggal_kegiatan)->translatedFormat('F Y') : \Carbon\Carbon::now()->translatedFormat('F Y');

        return view('admin-temp.print_kegiatan', [
            'kegiatan' => $kegiatan,
            'nama' => $nama,
            'role' => $role,
            'bulan_tahun' => $bulan_tahun,
            'first_kegiatan' => $first_kegiatan
        ]);
    }
    public function kegiatan_pokja1()
    {
        return view('pokja_1.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_1')->get()]);
    }
    public function kegiatan_pokja2()
    {
        return view('pokja_2.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_2')->get()]);
    }
    public function kegiatan_pokja3()
    {
        return view('pokja_3.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_3')->get()]);
    }
    public function kegiatan_pokja4()
    {
        return view('pokja_4.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_4')->get()]);
    }

    public function store_kegiatan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'tempat' => 'nullable|string|max:255',
            'uraian' => 'required|string',
            'tanda_tangan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $validated['role'] = Auth::user()->role ?? 'Sekretaris';
        if ($request->hasFile('tanda_tangan')) {
            $validated['tanda_tangan'] = $request->file('tanda_tangan')->store('tanda_tangan', 'public');
        }
        KegiatanModels::create($validated);
        return back()->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function update_kegiatan(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'tempat' => 'nullable|string|max:255',
            'uraian' => 'required|string',
            'tanda_tangan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('tanda_tangan')) {
            $validated['tanda_tangan'] = $request->file('tanda_tangan')->store('tanda_tangan', 'public');
        }
        KegiatanModels::where('id', $id)->update($validated);
        return back()->with('success', 'Kegiatan berhasil diupdate!');
    }

    public function destroy_kegiatan($id)
    {
        KegiatanModels::where('id', $id)->delete();
        return back()->with('success', 'Kegiatan berhasil dihapus!');
    }

    // ==================== KETUA (Read-Only) ====================
    public function kegiatan_ketua_sekretaris()
    {
        return view('ketua.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Sekretaris')->get(), 'source_label' => 'Sekretaris']);
    }
    public function kegiatan_ketua_pokja1()
    {
        return view('ketua.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_1')->get(), 'source_label' => 'Pokja 1']);
    }
    public function kegiatan_ketua_pokja2()
    {
        return view('ketua.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_2')->get(), 'source_label' => 'Pokja 2']);
    }
    public function kegiatan_ketua_pokja3()
    {
        return view('ketua.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_3')->get(), 'source_label' => 'Pokja 3']);
    }
    public function kegiatan_ketua_pokja4()
    {
        return view('ketua.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_4')->get(), 'source_label' => 'Pokja 4']);
    }

    // ==================== WAKIL (Read-Only) ====================
    public function kegiatan_wakil_sekretaris()
    {
        return view('wakil.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Sekretaris')->get(), 'source_label' => 'Sekretaris']);
    }
    public function kegiatan_wakil_pokja1()
    {
        return view('wakil.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_1')->get(), 'source_label' => 'Pokja 1']);
    }
    public function kegiatan_wakil_pokja2()
    {
        return view('wakil.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_2')->get(), 'source_label' => 'Pokja 2']);
    }
    public function kegiatan_wakil_pokja3()
    {
        return view('wakil.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_3')->get(), 'source_label' => 'Pokja 3']);
    }
    public function kegiatan_wakil_pokja4()
    {
        return view('wakil.kegiatan', ['kegiatan' => KegiatanModels::where('role', 'Pokja_4')->get(), 'source_label' => 'Pokja 4']);
    }
}
