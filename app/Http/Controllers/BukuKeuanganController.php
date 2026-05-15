<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuKeuangan;

class BukuKeuanganController extends Controller
{
    // ==================== BENDAHARA (Full CRUD) ====================
    public function index_bendahara()
    {
        $buku_keuangan = BukuKeuangan::all();
        return view('bendahara.buku_keuangan', compact('buku_keuangan'));
    }

    public function store_bendahara(Request $request)
    {
        $validated = $request->validate([
            'tanggal_penerimaan' => 'nullable|date',
            'sumber_dana_penerimaan' => 'nullable|string|max:255',
            'uraian_penerimaan' => 'nullable|string',
            'bukti_kas_penerimaan' => 'nullable|string|max:255',
            'penerimaan' => 'nullable|numeric',
            'tanggal_pengeluaran' => 'nullable|date',
            'sumber_dana_pengeluaran' => 'nullable|string|max:255',
            'uraian_pengeluaran' => 'nullable|string',
            'bukti_kas_pengeluaran' => 'nullable|string|max:255',
            'pengeluaran' => 'nullable|numeric',
        ]);
        $validated['role'] = 'Bendahara';
        
        BukuKeuangan::create($validated);
        return back()->with('success', 'Data buku keuangan berhasil ditambahkan!');
    }

    public function update_bendahara(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_penerimaan' => 'nullable|date',
            'sumber_dana_penerimaan' => 'nullable|string|max:255',
            'uraian_penerimaan' => 'nullable|string',
            'bukti_kas_penerimaan' => 'nullable|string|max:255',
            'penerimaan' => 'nullable|numeric',
            'tanggal_pengeluaran' => 'nullable|date',
            'sumber_dana_pengeluaran' => 'nullable|string|max:255',
            'uraian_pengeluaran' => 'nullable|string',
            'bukti_kas_pengeluaran' => 'nullable|string|max:255',
            'pengeluaran' => 'nullable|numeric',
        ]);

        BukuKeuangan::findOrFail($id)->update($validated);
        return back()->with('success', 'Data buku keuangan berhasil diupdate!');
    }

    public function destroy_bendahara($id)
    {
        BukuKeuangan::findOrFail($id)->delete();
        return back()->with('success', 'Data buku keuangan berhasil dihapus!');
    }

    // ==================== SEKRETARIS (Full CRUD) ====================
    public function index_sekretaris()
    {
        $buku_keuangan = BukuKeuangan::all();
        return view('sekretaris.buku_keuangan', compact('buku_keuangan'));
    }

    public function store_sekretaris(Request $request)
    {
        $validated = $request->validate([
            'tanggal_penerimaan' => 'nullable|date',
            'sumber_dana_penerimaan' => 'nullable|string|max:255',
            'uraian_penerimaan' => 'nullable|string',
            'bukti_kas_penerimaan' => 'nullable|string|max:255',
            'penerimaan' => 'nullable|numeric',
            'tanggal_pengeluaran' => 'nullable|date',
            'sumber_dana_pengeluaran' => 'nullable|string|max:255',
            'uraian_pengeluaran' => 'nullable|string',
            'bukti_kas_pengeluaran' => 'nullable|string|max:255',
            'pengeluaran' => 'nullable|numeric',
        ]);
        $validated['role'] = 'Sekretaris';
        
        BukuKeuangan::create($validated);
        return back()->with('success', 'Data buku keuangan berhasil ditambahkan!');
    }

    public function update_sekretaris(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_penerimaan' => 'nullable|date',
            'sumber_dana_penerimaan' => 'nullable|string|max:255',
            'uraian_penerimaan' => 'nullable|string',
            'bukti_kas_penerimaan' => 'nullable|string|max:255',
            'penerimaan' => 'nullable|numeric',
            'tanggal_pengeluaran' => 'nullable|date',
            'sumber_dana_pengeluaran' => 'nullable|string|max:255',
            'uraian_pengeluaran' => 'nullable|string',
            'bukti_kas_pengeluaran' => 'nullable|string|max:255',
            'pengeluaran' => 'nullable|numeric',
        ]);

        BukuKeuangan::findOrFail($id)->update($validated);
        return back()->with('success', 'Data buku keuangan berhasil diupdate!');
    }

    public function destroy_sekretaris($id)
    {
        BukuKeuangan::findOrFail($id)->delete();
        return back()->with('success', 'Data buku keuangan berhasil dihapus!');
    }

    // ==================== KETUA (Read-Only) ====================
    public function index_ketua()
    {
        $buku_keuangan = BukuKeuangan::all();
        return view('ketua.buku_keuangan', compact('buku_keuangan'));
    }

    // ==================== WAKIL (Read-Only) ====================
    public function index_wakil()
    {
        $buku_keuangan = BukuKeuangan::all();
        return view('wakil.buku_keuangan', compact('buku_keuangan'));
    }
}
