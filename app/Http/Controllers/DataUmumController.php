<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataUmumModels;
use App\Models\DataPotensiWilayahModels;
use App\Imports\DataUmumImport;

class DataUmumController extends Controller
{
    // ==================== HELPER IMPORT ====================
    private function doImport(Request $request, string $modelClass, string $label): \Illuminate\Http\RedirectResponse
    {
        $request->validate(['import_file' => 'required|file|mimes:xlsx,xls,csv,ods|max:5120']);
        try {
            $count = (new DataUmumImport($modelClass))->import($request->file('import_file'));
            return back()->with('success', "Berhasil mengimpor {$count} baris {$label} dari file!");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor: ' . $e->getMessage());
        }
    }

    public function import_data_umum(Request $r)    { return $this->doImport($r, DataUmumModels::class, 'data umum'); }
    public function import_data_potensi(Request $r) { return $this->doImport($r, DataPotensiWilayahModels::class, 'data potensi wilayah'); }

    // ==================== DATA UMUM (hanya Sekretaris) ====================
    public function data_umum_sekretaris() { return view('sekretaris.data_umum', ['data_umum' => DataUmumModels::get()]); }

    public function store_data_umum(Request $request)
    {
        DataUmumModels::create($request->except(['_token', '_method']));
        return back()->with('success', 'Data umum berhasil ditambahkan!');
    }
    public function update_data_umum(Request $request, $id)
    {
        DataUmumModels::where('id', $id)->update($request->except(['_token', '_method']));
        return back()->with('success', 'Data umum berhasil diupdate!');
    }
    public function destroy_data_umum($id)
    {
        DataUmumModels::where('id', $id)->delete();
        return back()->with('success', 'Data umum berhasil dihapus!');
    }

    // ==================== DATA POTENSI WILAYAH (hanya Sekretaris) ====================
    public function data_potensi_sekretaris() { return view('sekretaris.data_potensi_wilayah', ['data_potensi' => DataPotensiWilayahModels::get()]); }

    public function store_data_potensi(Request $request)
    {
        DataPotensiWilayahModels::create($request->except(['_token', '_method']));
        return back()->with('success', 'Data potensi wilayah berhasil ditambahkan!');
    }
    public function update_data_potensi(Request $request, $id)
    {
        DataPotensiWilayahModels::where('id', $id)->update($request->except(['_token', '_method']));
        return back()->with('success', 'Data potensi wilayah berhasil diupdate!');
    }
    public function destroy_data_potensi($id)
    {
        DataPotensiWilayahModels::where('id', $id)->delete();
        return back()->with('success', 'Data potensi wilayah berhasil dihapus!');
    }

    // KETUA (Read-Only)
    public function data_umum_ketua() { return view('ketua.data_umum', ['data_umum' => DataUmumModels::get()]); }
    public function data_potensi_ketua() { return view('ketua.data_potensi_wilayah', ['data_potensi' => DataPotensiWilayahModels::get()]); }

    // WAKIL (Read-Only)
    public function data_umum_wakil() { return view('wakil.data_umum', ['data_umum' => DataUmumModels::get()]); }
    public function data_potensi_wakil() { return view('wakil.data_potensi_wilayah', ['data_potensi' => DataPotensiWilayahModels::get()]); }
}
