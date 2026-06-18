<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PapanDataSekretarisModels;
use App\Models\PapanDataPokja1Models;
use App\Models\PapanDataPokja2Models;
use App\Models\PapanDataPokja3Models;
use App\Models\PapanDataPokja4Models;
use App\Imports\PapanDataImport;

class PapanDataController extends Controller
{
    // ==================== HELPER IMPORT ====================
    private function doImport(Request $request, string $modelClass): \Illuminate\Http\RedirectResponse
    {
        $request->validate(['import_file' => 'required|file|mimes:xlsx,xls,csv,ods|max:5120']);
        try {
            $count = (new PapanDataImport($modelClass))->import($request->file('import_file'));
            return back()->with('success', "Berhasil mengimpor {$count} baris data papan data dari file!");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor: ' . $e->getMessage());
        }
    }

    public function import_papan_data_sekretaris(Request $r) { return $this->doImport($r, PapanDataSekretarisModels::class); }
    public function import_papan_data_pokja1(Request $r)     { return $this->doImport($r, PapanDataPokja1Models::class); }
    public function import_papan_data_pokja2(Request $r)     { return $this->doImport($r, PapanDataPokja2Models::class); }
    public function import_papan_data_pokja3(Request $r)     { return $this->doImport($r, PapanDataPokja3Models::class); }
    public function import_papan_data_pokja4(Request $r)     { return $this->doImport($r, PapanDataPokja4Models::class); }

    public function papan_data_sekretaris() { return view('sekretaris.papan_data', ['papan_data' => PapanDataSekretarisModels::get()]); }
    public function papan_data_pokja1() { return view('pokja_1.papan_data', ['papan_data' => PapanDataPokja1Models::get()]); }
    public function papan_data_pokja2() { return view('pokja_2.papan_data', ['papan_data' => PapanDataPokja2Models::get()]); }
    public function papan_data_pokja3() { return view('pokja_3.papan_data', ['papan_data' => PapanDataPokja3Models::get()]); }
    public function papan_data_pokja4() { return view('pokja_4.papan_data', ['papan_data' => PapanDataPokja4Models::get()]); }

    private function getModelByRole()
    {
        $role = Auth::user()->role ?? 'Sekretaris';
        $modelMap = [
            'Sekretaris' => PapanDataSekretarisModels::class,
            'Pokja_1' => PapanDataPokja1Models::class, 'Pokja_2' => PapanDataPokja2Models::class,
            'Pokja_3' => PapanDataPokja3Models::class, 'Pokja_4' => PapanDataPokja4Models::class,
        ];
        return $modelMap[$role] ?? PapanDataSekretarisModels::class;
    }

    public function store_papan_data(Request $request)
    {
        $model = $this->getModelByRole();
        $model::create($request->except(['_token', '_method']));
        return back()->with('success', 'Data berhasil ditambahkan!');
    }
    public function update_papan_data(Request $request, $id)
    {
        $model = $this->getModelByRole();
        $model::where('id', $id)->update($request->except(['_token', '_method']));
        return back()->with('success', 'Data berhasil diupdate!');
    }
    public function destroy_papan_data($id)
    {
        $model = $this->getModelByRole();
        $model::where('id', $id)->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }

    // KETUA (Read-Only)
    public function papan_data_ketua_sekretaris() { return view('ketua.papan_data', ['papan_data' => PapanDataSekretarisModels::get(), 'source_label' => 'Sekretaris']); }
    public function papan_data_ketua_pokja1() { return view('ketua.papan_data', ['papan_data' => PapanDataPokja1Models::get(), 'source_label' => 'Pokja 1']); }
    public function papan_data_ketua_pokja2() { return view('ketua.papan_data', ['papan_data' => PapanDataPokja2Models::get(), 'source_label' => 'Pokja 2']); }
    public function papan_data_ketua_pokja3() { return view('ketua.papan_data', ['papan_data' => PapanDataPokja3Models::get(), 'source_label' => 'Pokja 3']); }
    public function papan_data_ketua_pokja4() { return view('ketua.papan_data', ['papan_data' => PapanDataPokja4Models::get(), 'source_label' => 'Pokja 4']); }

    // WAKIL (Read-Only)
    public function papan_data_wakil_sekretaris() { return view('wakil.papan_data', ['papan_data' => PapanDataSekretarisModels::get(), 'source_label' => 'Sekretaris']); }
    public function papan_data_wakil_pokja1() { return view('wakil.papan_data', ['papan_data' => PapanDataPokja1Models::get(), 'source_label' => 'Pokja 1']); }
    public function papan_data_wakil_pokja2() { return view('wakil.papan_data', ['papan_data' => PapanDataPokja2Models::get(), 'source_label' => 'Pokja 2']); }
    public function papan_data_wakil_pokja3() { return view('wakil.papan_data', ['papan_data' => PapanDataPokja3Models::get(), 'source_label' => 'Pokja 3']); }
    public function papan_data_wakil_pokja4() { return view('wakil.papan_data', ['papan_data' => PapanDataPokja4Models::get(), 'source_label' => 'Pokja 4']); }
}
