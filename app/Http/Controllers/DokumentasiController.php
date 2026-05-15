<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumentasi;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    private function _store(Request $request, $role)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('foto')->store('dokumentasi', 'public');

        Dokumentasi::create([
            'foto' => $path,
            'caption' => $request->caption,
            'role' => $role,
        ]);

        return redirect()->back()->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    private function _update(Request $request, $id, $role)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $dokumentasi = Dokumentasi::where('role', $role)->findOrFail($id);
        $data = ['caption' => $request->caption];

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($dokumentasi->foto);
            $path = $request->file('foto')->store('dokumentasi', 'public');
            $data['foto'] = $path;
        }

        $dokumentasi->update($data);
        return redirect()->back()->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    private function _destroy($id, $role)
    {
        $dokumentasi = Dokumentasi::where('role', $role)->findOrFail($id);
        Storage::disk('public')->delete($dokumentasi->foto);
        $dokumentasi->delete();
        return redirect()->back()->with('success', 'Dokumentasi berhasil dihapus.');
    }

    // ==================== KETUA ====================
    public function index_ketua() { return view('ketua.dokumentasi', ['dokumentasi' => Dokumentasi::where('role', 'Ketua')->latest()->get()]); }
    public function store_ketua(Request $request) { return $this->_store($request, 'Ketua'); }
    public function update_ketua(Request $request, $id) { return $this->_update($request, $id, 'Ketua'); }
    public function destroy_ketua($id) { return $this->_destroy($id, 'Ketua'); }

    // ==================== WAKIL ====================
    public function index_wakil() { return view('wakil.dokumentasi', ['dokumentasi' => Dokumentasi::where('role', 'Wakil')->latest()->get()]); }
    public function store_wakil(Request $request) { return $this->_store($request, 'Wakil'); }
    public function update_wakil(Request $request, $id) { return $this->_update($request, $id, 'Wakil'); }
    public function destroy_wakil($id) { return $this->_destroy($id, 'Wakil'); }

    // ==================== SEKRETARIS ====================
    public function index_sekretaris() { return view('sekretaris.dokumentasi', ['dokumentasi' => Dokumentasi::where('role', 'Sekretaris')->latest()->get()]); }
    public function store_sekretaris(Request $request) { return $this->_store($request, 'Sekretaris'); }
    public function update_sekretaris(Request $request, $id) { return $this->_update($request, $id, 'Sekretaris'); }
    public function destroy_sekretaris($id) { return $this->_destroy($id, 'Sekretaris'); }

    // ==================== BENDAHARA ====================
    public function index_bendahara() { return view('bendahara.dokumentasi', ['dokumentasi' => Dokumentasi::where('role', 'Bendahara')->latest()->get()]); }
    public function store_bendahara(Request $request) { return $this->_store($request, 'Bendahara'); }
    public function update_bendahara(Request $request, $id) { return $this->_update($request, $id, 'Bendahara'); }
    public function destroy_bendahara($id) { return $this->_destroy($id, 'Bendahara'); }

    // ==================== POKJA 1 ====================
    public function index_pokja1() { return view('pokja_1.dokumentasi', ['dokumentasi' => Dokumentasi::where('role', 'Pokja 1')->latest()->get()]); }
    public function store_pokja1(Request $request) { return $this->_store($request, 'Pokja 1'); }
    public function update_pokja1(Request $request, $id) { return $this->_update($request, $id, 'Pokja 1'); }
    public function destroy_pokja1($id) { return $this->_destroy($id, 'Pokja 1'); }

    // ==================== POKJA 2 ====================
    public function index_pokja2() { return view('pokja_2.dokumentasi', ['dokumentasi' => Dokumentasi::where('role', 'Pokja 2')->latest()->get()]); }
    public function store_pokja2(Request $request) { return $this->_store($request, 'Pokja 2'); }
    public function update_pokja2(Request $request, $id) { return $this->_update($request, $id, 'Pokja 2'); }
    public function destroy_pokja2($id) { return $this->_destroy($id, 'Pokja 2'); }

    // ==================== POKJA 3 ====================
    public function index_pokja3() { return view('pokja_3.dokumentasi', ['dokumentasi' => Dokumentasi::where('role', 'Pokja 3')->latest()->get()]); }
    public function store_pokja3(Request $request) { return $this->_store($request, 'Pokja 3'); }
    public function update_pokja3(Request $request, $id) { return $this->_update($request, $id, 'Pokja 3'); }
    public function destroy_pokja3($id) { return $this->_destroy($id, 'Pokja 3'); }

    // ==================== POKJA 4 ====================
    public function index_pokja4() { return view('pokja_4.dokumentasi', ['dokumentasi' => Dokumentasi::where('role', 'Pokja 4')->latest()->get()]); }
    public function store_pokja4(Request $request) { return $this->_store($request, 'Pokja 4'); }
    public function update_pokja4(Request $request, $id) { return $this->_update($request, $id, 'Pokja 4'); }
    public function destroy_pokja4($id) { return $this->_destroy($id, 'Pokja 4'); }
}
