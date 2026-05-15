<?php

namespace App\Http\Controllers;

use App\Models\DaftarAnggotaModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DaftarAnggotaController extends Controller
{
    // ==================== HELPER: Validasi Anggota ====================
    private function validateAnggota(Request $request, $isUpdate = false)
    {
        $rules = [
            'no_registrasi'      => 'nullable|string|max:255',
            'name'               => 'required|string|max:255',
            'jenis_kelamin'      => 'nullable|in:L,P',
            'role_pkk'           => 'nullable|string',
            'keanggotaan_tp_pkk' => 'nullable|string|max:255',
            'kader_umum'         => 'nullable|boolean',
            'kader_khusus'       => 'nullable|boolean',
            'tempat_lahir'       => 'nullable|string|max:255',
            'tanggal_lahir'      => 'nullable|date',
            'umur'               => 'nullable|integer',
            'status_perkawinan'  => 'nullable|string|max:255',
            'alamat'             => 'nullable|string',
            'pendidikan'         => 'nullable|string|max:255',
            'pekerjaan'          => 'nullable|string|max:255',
            'keterangan'         => 'nullable|string',
            'foto'               => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
        if (!$isUpdate) {
            $rules['id_users'] = 'required|exists:users,id';
        }
        $validated = $request->validate($rules);
        $validated['kader_umum'] = $request->has('kader_umum') ? true : false;
        $validated['kader_khusus'] = $request->has('kader_khusus') ? true : false;
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_anggota', 'public');
        }
        return $validated;
    }

    private function storeAnggota(Request $request, $successMsg)
    {
        $validated = $this->validateAnggota($request);
        DaftarAnggotaModels::create($validated);
        return back()->with('success', $successMsg);
    }

    private function updateAnggota(Request $request, $id, $successMsg)
    {
        $anggota = DaftarAnggotaModels::findOrFail($id);
        $validated = $this->validateAnggota($request, true);
        if ($request->hasFile('foto') && $anggota->foto && Storage::disk('public')->exists($anggota->foto)) {
            Storage::disk('public')->delete($anggota->foto);
        }
        $anggota->update($validated);
        return back()->with('success', $successMsg . $anggota->name);
    }

    private function destroyAnggota($id)
    {
        $anggota = DaftarAnggotaModels::findOrFail($id);
        if ($anggota->foto && Storage::exists('public/' . $anggota->foto)) {
            Storage::delete('public/' . $anggota->foto);
        }
        $anggota->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }

    private function indexAnggota($rolePkk, $viewName, $varName)
    {
        $anggota = DaftarAnggotaModels::where('role_pkk', $rolePkk)->get();
        $users = \App\Models\User::all();
        return view($viewName, [$varName => $anggota, 'users' => $users]);
    }

    // ==================== DAFTAR ANGGOTA: Sekretaris ====================
    public function index_sekretaris()
    {
        $anggota_sekretaris = DaftarAnggotaModels::all();
        $users = \App\Models\User::all();
        return view('sekretaris.daftar_anggota', compact('anggota_sekretaris', 'users'));
    }
    public function store_anggota_sekretaris(Request $request) { return $this->storeAnggota($request, 'Data Sekretaris berhasil ditambahkan!'); }
    public function update_anggota_sekretaris(Request $request, $id) { return $this->updateAnggota($request, $id, 'Data Sekretaris berhasil diupdate: '); }
    public function destroy_anggota_sekretaris($id) { return $this->destroyAnggota($id); }

    // ==================== DAFTAR ANGGOTA: Pokja 1 ====================
    public function index_pokja1() { return $this->indexAnggota('Pokja 1', 'pokja_1.daftar_anggota', 'anggota_pokja1'); }
    public function store_anggota_pokja1(Request $request) { return $this->storeAnggota($request, 'Data Anggota Pokja 1 berhasil ditambahkan!'); }
    public function update_anggota_pokja1(Request $request, $id) { return $this->updateAnggota($request, $id, 'Data Pokja 1 berhasil diupdate: '); }
    public function destroy_anggota_pokja1($id) { return $this->destroyAnggota($id); }

    // ==================== DAFTAR ANGGOTA: Pokja 2 ====================
    public function index_pokja2() { return $this->indexAnggota('Pokja 2', 'pokja_2.daftar_anggota', 'anggota_pokja2'); }
    public function store_anggota_pokja2(Request $request) { return $this->storeAnggota($request, 'Data Anggota Pokja 2 berhasil ditambahkan!'); }
    public function update_anggota_pokja2(Request $request, $id) { return $this->updateAnggota($request, $id, 'Data Pokja 2 berhasil diupdate: '); }
    public function destroy_anggota_pokja2($id) { return $this->destroyAnggota($id); }

    // ==================== DAFTAR ANGGOTA: Pokja 3 ====================
    public function index_pokja3() { return $this->indexAnggota('Pokja 3', 'pokja_3.daftar_anggota', 'anggota_pokja3'); }
    public function store_anggota_pokja3(Request $request) { return $this->storeAnggota($request, 'Data Anggota Pokja 3 berhasil ditambahkan!'); }
    public function update_anggota_pokja3(Request $request, $id) { return $this->updateAnggota($request, $id, 'Data Pokja 3 berhasil diupdate: '); }
    public function destroy_anggota_pokja3($id) { return $this->destroyAnggota($id); }

    // ==================== DAFTAR ANGGOTA: Pokja 4 ====================
    public function index_pokja4() { return $this->indexAnggota('Pokja 4', 'pokja_4.daftar_anggota', 'anggota_pokja4'); }
    public function store_anggota_pokja4(Request $request) { return $this->storeAnggota($request, 'Data Anggota Pokja 4 berhasil ditambahkan!'); }
    public function update_anggota_pokja4(Request $request, $id) { return $this->updateAnggota($request, $id, 'Data Pokja 4 berhasil diupdate: '); }
    public function destroy_anggota_pokja4($id) { return $this->destroyAnggota($id); }

    // ==================== KETUA (Read-Only) ====================
    public function index_ketua_sekretaris()
    {
        $anggota = DaftarAnggotaModels::all();
        return view('ketua.daftar_anggota_sekretaris', compact('anggota'));
    }
    public function index_ketua_pokja1()
    {
        $anggota = DaftarAnggotaModels::where('role_pkk', 'Pokja 1')->get();
        return view('ketua.daftar_anggota_pokja', ['anggota' => $anggota, 'pokja_label' => 'Pokja 1']);
    }
    public function index_ketua_pokja2()
    {
        $anggota = DaftarAnggotaModels::where('role_pkk', 'Pokja 2')->get();
        return view('ketua.daftar_anggota_pokja', ['anggota' => $anggota, 'pokja_label' => 'Pokja 2']);
    }
    public function index_ketua_pokja3()
    {
        $anggota = DaftarAnggotaModels::where('role_pkk', 'Pokja 3')->get();
        return view('ketua.daftar_anggota_pokja', ['anggota' => $anggota, 'pokja_label' => 'Pokja 3']);
    }
    public function index_ketua_pokja4()
    {
        $anggota = DaftarAnggotaModels::where('role_pkk', 'Pokja 4')->get();
        return view('ketua.daftar_anggota_pokja', ['anggota' => $anggota, 'pokja_label' => 'Pokja 4']);
    }

    // ==================== WAKIL (Read-Only) ====================
    public function index_wakil_sekretaris()
    {
        $anggota = DaftarAnggotaModels::all();
        return view('wakil.daftar_anggota_sekretaris', compact('anggota'));
    }
    public function index_wakil_pokja1()
    {
        $anggota = DaftarAnggotaModels::where('role_pkk', 'Pokja 1')->get();
        return view('wakil.daftar_anggota_pokja', ['anggota' => $anggota, 'pokja_label' => 'Pokja 1']);
    }
    public function index_wakil_pokja2()
    {
        $anggota = DaftarAnggotaModels::where('role_pkk', 'Pokja 2')->get();
        return view('wakil.daftar_anggota_pokja', ['anggota' => $anggota, 'pokja_label' => 'Pokja 2']);
    }
    public function index_wakil_pokja3()
    {
        $anggota = DaftarAnggotaModels::where('role_pkk', 'Pokja 3')->get();
        return view('wakil.daftar_anggota_pokja', ['anggota' => $anggota, 'pokja_label' => 'Pokja 3']);
    }
    public function index_wakil_pokja4()
    {
        $anggota = DaftarAnggotaModels::where('role_pkk', 'Pokja 4')->get();
        return view('wakil.daftar_anggota_pokja', ['anggota' => $anggota, 'pokja_label' => 'Pokja 4']);
    }
}
