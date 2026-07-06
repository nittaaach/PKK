<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPrestasiPokja3;
use App\Models\GertamPokja3;
use App\Models\GptpPokja3;
use App\Models\InventarisPokja3;
use App\Models\NotulenPokja3;
use App\Models\LapKegiatanPokja3;
use App\Models\ProgramKerjaPokja3;
use App\Models\EvalProgramPokja3;
use App\Models\DataPtpPokja3;
use App\Models\DataPotensiPokja3;
use App\Imports\Pokja3DataImport;
class Pokja3DataController extends Controller
{
    // ==================== HELPER IMPORT ====================
    private function doImport(Request $request, string $modelClass, string $label): \Illuminate\Http\RedirectResponse
    {
        $request->validate(['import_file' => 'required|file|mimes:xlsx,xls,csv,ods|max:5120']);
        try {
            $count = (new Pokja3DataImport($modelClass))->import($request->file('import_file'));
            return back()->with('success', "Berhasil mengimpor {$count} baris {$label} dari file!");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor: ' . $e->getMessage());
        }
    }

    public function import_data_prestasi(Request $r) { return $this->doImport($r, DataPrestasiPokja3::class, 'Data Prestasi'); }
    public function import_gertam(Request $r) { return $this->doImport($r, GertamPokja3::class, 'Gertam'); }
    public function import_gptp(Request $r) { return $this->doImport($r, GptpPokja3::class, 'GPTP'); }
    public function import_eval_program(Request $r) { return $this->doImport($r, EvalProgramPokja3::class, 'Evaluasi Program'); }
    public function import_data_potensi(Request $r) { return $this->doImport($r, DataPotensiPokja3::class, 'Data Potensi'); }
    public function import_program_kerja(Request $r) { return $this->doImport($r, ProgramKerjaPokja3::class, 'Program Kerja'); }
    public function import_data_ptp(Request $r) { return $this->doImport($r, DataPtpPokja3::class, 'Data PTP'); }
    public function import_inventaris(Request $r) { return $this->doImport($r, InventarisPokja3::class, 'Inventaris'); }
    public function import_notulen(Request $r) { return $this->doImport($r, NotulenPokja3::class, 'Notulen'); }
    public function import_lap_kegiatan(Request $r) { return $this->doImport($r, LapKegiatanPokja3::class, 'Lap Kegiatan'); }

    // ==================== HELPER ====================
    private function crudResponse($action = 'ditambahkan')
    {
        return back()->with('success', "Data berhasil $action!");
    }
    private function errorResponse($e)
    {
        return back()->with('error', 'Gagal: ' . $e->getMessage());
    }

    // ==================== DATA PRESTASI ====================
    public function data_prestasi()
    {
        return view('pokja_3.data_prestasi', ['data' => DataPrestasiPokja3::orderBy('id', 'asc')->get()]);
    }
    public function store_data_prestasi(Request $request)
    {
        DataPrestasiPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_data_prestasi(Request $request, $id)
    {
        DataPrestasiPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_data_prestasi($id)
    {
        DataPrestasiPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }

    // ==================== GERTAM ====================
    public function gertam()
    {
        return view('pokja_3.gertam', ['data' => GertamPokja3::orderBy('id', 'asc')->get()]);
    }
    public function store_gertam(Request $request)
    {
        GertamPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_gertam(Request $request, $id)
    {
        GertamPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_gertam($id)
    {
        GertamPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }

    // ==================== GPTP ====================
    public function gptp()
    {
        return view('pokja_3.gptp', ['data' => GptpPokja3::orderBy('id', 'asc')->get()]);
    }
    public function store_gptp(Request $request)
    {
        GptpPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_gptp(Request $request, $id)
    {
        GptpPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_gptp($id)
    {
        GptpPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }

    // ==================== INVENTARIS ====================
    public function inventaris()
    {
        return view('pokja_3.inventaris', ['data' => InventarisPokja3::orderBy('id', 'asc')->get()]);
    }
    public function store_inventaris(Request $request)
    {
        InventarisPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_inventaris(Request $request, $id)
    {
        InventarisPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_inventaris($id)
    {
        InventarisPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }

    // ==================== NOTULEN ====================
    public function notulen()
    {
        return view('pokja_3.notulen', ['data' => NotulenPokja3::orderBy('id', 'asc')->get()]);
    }
    public function store_notulen(Request $request)
    {
        NotulenPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_notulen(Request $request, $id)
    {
        NotulenPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_notulen($id)
    {
        NotulenPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }

    // ==================== LAPORAN KEGIATAN ====================
    public function lap_kegiatan()
    {
        return view('pokja_3.lap_kegiatan', ['data' => LapKegiatanPokja3::orderBy('id', 'asc')->get()]);
    }
    public function store_lap_kegiatan(Request $request)
    {
        LapKegiatanPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_lap_kegiatan(Request $request, $id)
    {
        LapKegiatanPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_lap_kegiatan($id)
    {
        LapKegiatanPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }

    // ==================== PROGRAM KERJA ====================
    public function program_kerja()
    {
        return view('pokja_3.program_kerja', ['data' => ProgramKerjaPokja3::orderBy('id', 'asc')->get()]);
    }
    public function store_program_kerja(Request $request)
    {
        ProgramKerjaPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_program_kerja(Request $request, $id)
    {
        ProgramKerjaPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_program_kerja($id)
    {
        ProgramKerjaPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }

    // ==================== EVALUASI PROGRAM ====================
    public function eval_program()
    {
        return view('pokja_3.eval_program', ['data' => EvalProgramPokja3::orderBy('id', 'asc')->get()]);
    }
    public function store_eval_program(Request $request)
    {
        EvalProgramPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_eval_program(Request $request, $id)
    {
        EvalProgramPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_eval_program($id)
    {
        EvalProgramPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }

    // ==================== DATA PTP / HATINYA PKK ====================
    public function data_ptp()
    {
        return view('pokja_3.data_ptp', ['data' => DataPtpPokja3::get()]);
    }
    public function store_data_ptp(Request $request)
    {
        DataPtpPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_data_ptp(Request $request, $id)
    {
        DataPtpPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_data_ptp($id)
    {
        DataPtpPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }

    // ==================== DATA POTENSI ====================
    public function data_potensi()
    {
        return view('pokja_3.data_potensi', ['data' => DataPotensiPokja3::orderBy('id', 'asc')->get()]);
    }
    public function store_data_potensi(Request $request)
    {
        DataPotensiPokja3::create($request->except(['_token', '_method']));
        return $this->crudResponse('ditambahkan');
    }
    public function update_data_potensi(Request $request, $id)
    {
        DataPotensiPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
        return $this->crudResponse('diperbarui');
    }
    public function destroy_data_potensi($id)
    {
        DataPotensiPokja3::findOrFail($id)->delete();
        return $this->crudResponse('dihapus');
    }
}
