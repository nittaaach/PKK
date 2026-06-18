<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratMasukModels;
use App\Models\SuratKeluarModels;
use App\Imports\SuratMasukImport;
use App\Imports\SuratKeluarImport;

class AgendaSuratController extends Controller
{
    // ==================== HELPER IMPORT ====================
    private function doImportMasuk(Request $request, string $role): \Illuminate\Http\RedirectResponse
    {
        $request->validate(['import_file' => 'required|file|mimes:xlsx,xls,csv,ods|max:5120']);
        try {
            $count = (new SuratMasukImport($role))->import($request->file('import_file'));
            return back()->with('success', "Berhasil mengimpor {$count} data surat masuk dari file!");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor: ' . $e->getMessage());
        }
    }

    private function doImportKeluar(Request $request, string $role): \Illuminate\Http\RedirectResponse
    {
        $request->validate(['import_file' => 'required|file|mimes:xlsx,xls,csv,ods|max:5120']);
        try {
            $count = (new SuratKeluarImport($role))->import($request->file('import_file'));
            return back()->with('success', "Berhasil mengimpor {$count} data surat keluar dari file!");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor: ' . $e->getMessage());
        }
    }

    public function import_surat_masuk_sekretaris(Request $r)  { return $this->doImportMasuk($r, 'Sekretaris'); }
    public function import_surat_masuk_pokja1(Request $r)      { return $this->doImportMasuk($r, 'Pokja_1'); }
    public function import_surat_masuk_pokja2(Request $r)      { return $this->doImportMasuk($r, 'Pokja_2'); }
    public function import_surat_masuk_pokja3(Request $r)      { return $this->doImportMasuk($r, 'Pokja_3'); }
    public function import_surat_masuk_pokja4(Request $r)      { return $this->doImportMasuk($r, 'Pokja_4'); }

    public function import_surat_keluar_sekretaris(Request $r) { return $this->doImportKeluar($r, 'Sekretaris'); }
    public function import_surat_keluar_pokja1(Request $r)     { return $this->doImportKeluar($r, 'Pokja_1'); }
    public function import_surat_keluar_pokja2(Request $r)     { return $this->doImportKeluar($r, 'Pokja_2'); }
    public function import_surat_keluar_pokja3(Request $r)     { return $this->doImportKeluar($r, 'Pokja_3'); }
    public function import_surat_keluar_pokja4(Request $r)     { return $this->doImportKeluar($r, 'Pokja_4'); }

    public function agenda_surat_sekretaris()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Sekretaris')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Sekretaris')->get();
        return view('sekretaris.agenda_surat', compact('surat_masuk', 'surat_keluar'));
    }
    public function agenda_surat_pokja1()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_1')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_1')->get();
        return view('pokja_1.agenda_surat', compact('surat_masuk', 'surat_keluar'));
    }
    public function agenda_surat_pokja2()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_2')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_2')->get();
        return view('pokja_2.agenda_surat', compact('surat_masuk', 'surat_keluar'));
    }
    public function agenda_surat_pokja3()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_3')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_3')->get();
        return view('pokja_3.agenda_surat', compact('surat_masuk', 'surat_keluar'));
    }
    public function agenda_surat_pokja4()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_4')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_4')->get();
        return view('pokja_4.agenda_surat', compact('surat_masuk', 'surat_keluar'));
    }

    public function store_surat_masuk(Request $request)
    {
        $validated = $request->validate([
            'tanggal_terima' => 'required|date',
            'tanggal_surat' => 'nullable|date',
            'no_surat' => 'nullable|string|max:255',
            'asal_surat' => 'nullable|string|max:255',
            'perihal' => 'required|string',
            'lampiran' => 'nullable|string|max:255',
            'diteruskan_kepada' => 'nullable|string|max:255',
        ]);
        $validated['role'] = Auth::user()->role ?? 'Sekretaris';
        SuratMasukModels::create($validated);
        return back()->with('success', 'Surat masuk berhasil ditambahkan!');
    }

    public function update_surat_masuk(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_terima' => 'nullable|date',
            'tanggal_surat' => 'nullable|date',
            'no_surat' => 'nullable|string|max:255',
            'asal_surat' => 'nullable|string|max:255',
            'perihal' => 'nullable|string',
            'lampiran' => 'nullable|string|max:255',
            'diteruskan_kepada' => 'nullable|string|max:255',
        ]);
        SuratMasukModels::where('id', $id)->update($validated);
        return back()->with('success', 'Surat masuk berhasil diupdate!');
    }

    public function destroy_surat_masuk($id)
    {
        SuratMasukModels::where('id', $id)->delete();
        return back()->with('success', 'Surat masuk berhasil dihapus!');
    }

    public function store_surat_keluar(Request $request)
    {
        $validated = $request->validate([
            'nomor_kode_surat' => 'nullable|string|max:255',
            'tanggal_surat' => 'required|date',
            'kepada' => 'required|string|max:255',
            'perihal' => 'required|string',
            'lampiran' => 'nullable|string|max:255',
            'tembusan' => 'nullable|string',
        ]);
        $validated['role'] = Auth::user()->role ?? 'Sekretaris';
        SuratKeluarModels::create($validated);
        return back()->with('success', 'Surat keluar berhasil ditambahkan!');
    }

    public function update_surat_keluar(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_kode_surat' => 'nullable|string|max:255',
            'tanggal_surat' => 'nullable|date',
            'kepada' => 'nullable|string|max:255',
            'perihal' => 'nullable|string',
            'lampiran' => 'nullable|string|max:255',
            'tembusan' => 'nullable|string',
        ]);
        SuratKeluarModels::where('id', $id)->update($validated);
        return back()->with('success', 'Surat keluar berhasil diupdate!');
    }

    public function destroy_surat_keluar($id)
    {
        SuratKeluarModels::where('id', $id)->delete();
        return back()->with('success', 'Surat keluar berhasil dihapus!');
    }

    // ==================== KETUA (Read-Only) ====================
    public function agenda_surat_ketua_sekretaris()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Sekretaris')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Sekretaris')->get();
        return view('ketua.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Sekretaris']);
    }
    public function agenda_surat_ketua_pokja1()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_1')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_1')->get();
        return view('ketua.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Pokja 1']);
    }
    public function agenda_surat_ketua_pokja2()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_2')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_2')->get();
        return view('ketua.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Pokja 2']);
    }
    public function agenda_surat_ketua_pokja3()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_3')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_3')->get();
        return view('ketua.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Pokja 3']);
    }
    public function agenda_surat_ketua_pokja4()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_4')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_4')->get();
        return view('ketua.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Pokja 4']);
    }

    // ==================== WAKIL (Read-Only) ====================
    public function agenda_surat_wakil_sekretaris()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Sekretaris')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Sekretaris')->get();
        return view('wakil.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Sekretaris']);
    }
    public function agenda_surat_wakil_pokja1()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_1')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_1')->get();
        return view('wakil.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Pokja 1']);
    }
    public function agenda_surat_wakil_pokja2()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_2')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_2')->get();
        return view('wakil.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Pokja 2']);
    }
    public function agenda_surat_wakil_pokja3()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_3')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_3')->get();
        return view('wakil.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Pokja 3']);
    }
    public function agenda_surat_wakil_pokja4()
    {
        $surat_masuk = SuratMasukModels::where('role', 'Pokja_4')->get();
        $surat_keluar = SuratKeluarModels::where('role', 'Pokja_4')->get();
        return view('wakil.agenda_surat', compact('surat_masuk', 'surat_keluar') + ['source_label' => 'Pokja 4']);
    }
}
