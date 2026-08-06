<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotulenSekretaris;
use App\Models\NotulenPokja1;
use App\Models\NotulenPokja2;
use App\Models\NotulenPokja4;
use App\Models\NotulenPokja3;
use App\Imports\NotulenImport;

class NotulenController extends Controller
{
    // ==================== HELPER ====================
    private function crudResponse($action = 'ditambahkan')
    {
        return back()->with('success', "Data berhasil $action!");
    }

    private function errorResponse($e)
    {
        return back()->with('error', 'Gagal: ' . $e->getMessage());
    }

    private function doImport(Request $request, string $role)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls,csv,ods|max:5120',
        ], [
            'import_file.required' => 'File import wajib dipilih.',
            'import_file.mimes'    => 'Format file harus Excel (.xlsx/.xls), CSV, atau ODS.',
            'import_file.max'      => 'Ukuran file maksimal 5 MB.',
        ]);

        try {
            $count = (new NotulenImport($role))->import($request->file('import_file'));
            return back()->with('success', "Berhasil mengimpor {$count} data notulen dari file!");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor file. ' . $e->getMessage());
        }
    }

    // ==================== MULTI-PRINT ====================
    /**
     * Print beberapa notulen sekaligus berdasarkan IDs & role query string.
     * URL: /notulen/print-report?ids=1,2,3&role=sekretaris
     */
    public function print_report(Request $request)
    {
        $ids  = array_filter(explode(',', $request->query('ids', '')));
        $role = $request->query('role', 'sekretaris');

        if (empty($ids)) {
            return back()->with('error', 'Pilih minimal satu data notulen!');
        }

        $modelMap = [
            'sekretaris' => NotulenSekretaris::class,
            'pokja1'     => NotulenPokja1::class,
            'pokja2'     => NotulenPokja2::class,
            'pokja3'     => NotulenPokja3::class,
            'pokja4'     => NotulenPokja4::class,
        ];

        $labelMap = [
            'sekretaris' => 'Sekretaris',
            'pokja1'     => 'Pokja I',
            'pokja2'     => 'Pokja II',
            'pokja3'     => 'Pokja III',
            'pokja4'     => 'Pokja IV',
        ];

        $modelClass = $modelMap[$role] ?? NotulenSekretaris::class;
        $items = $modelClass::whereIn('id', $ids)->orderBy('tanggal')->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        return view('admin-temp.print_notulen_report', [
            'items'      => $items,
            'role_label' => $labelMap[$role] ?? 'PKK',
        ]);
    }

    // ==================== SEKRETARIS ====================
    public function index_sekretaris()
    {
        return view('sekretaris.buku_notulen_rapat', ['data' => NotulenSekretaris::orderBy('tanggal', 'asc')->get()]);
    }

    public function store_sekretaris(Request $request)
    {
        try {
            NotulenSekretaris::create($request->except(['_token', '_method']));
            return $this->crudResponse('ditambahkan');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update_sekretaris(Request $request, $id)
    {
        try {
            NotulenSekretaris::findOrFail($id)->update($request->except(['_token', '_method']));
            return $this->crudResponse('diperbarui');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy_sekretaris($id)
    {
        try {
            NotulenSekretaris::findOrFail($id)->delete();
            return $this->crudResponse('dihapus');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function import_sekretaris(Request $request)
    {
        return $this->doImport($request, 'Sekretaris');
    }

    // ==================== POKJA 1 ====================
    public function index_pokja1()
    {
        return view('pokja_1.notulen', ['data' => NotulenPokja1::orderBy('tanggal', 'asc')->get()]);
    }

    public function store_pokja1(Request $request)
    {
        try {
            NotulenPokja1::create($request->except(['_token', '_method']));
            return $this->crudResponse('ditambahkan');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update_pokja1(Request $request, $id)
    {
        try {
            NotulenPokja1::findOrFail($id)->update($request->except(['_token', '_method']));
            return $this->crudResponse('diperbarui');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy_pokja1($id)
    {
        try {
            NotulenPokja1::findOrFail($id)->delete();
            return $this->crudResponse('dihapus');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function import_pokja1(Request $request)
    {
        return $this->doImport($request, 'Pokja_1');
    }

    // ==================== POKJA 2 ====================
    public function index_pokja2()
    {
        return view('pokja_2.notulen', ['data' => NotulenPokja2::orderBy('tanggal', 'asc')->get()]);
    }

    public function store_pokja2(Request $request)
    {
        try {
            NotulenPokja2::create($request->except(['_token', '_method']));
            return $this->crudResponse('ditambahkan');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update_pokja2(Request $request, $id)
    {
        try {
            NotulenPokja2::findOrFail($id)->update($request->except(['_token', '_method']));
            return $this->crudResponse('diperbarui');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy_pokja2($id)
    {
        try {
            NotulenPokja2::findOrFail($id)->delete();
            return $this->crudResponse('dihapus');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function import_pokja2(Request $request)
    {
        return $this->doImport($request, 'Pokja_2');
    }

    // ==================== POKJA 4 ====================
    public function index_pokja4()
    {
        return view('pokja_4.notulen', ['data' => NotulenPokja4::orderBy('tanggal', 'asc')->get()]);
    }

    public function store_pokja4(Request $request)
    {
        try {
            NotulenPokja4::create($request->except(['_token', '_method']));
            return $this->crudResponse('ditambahkan');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update_pokja4(Request $request, $id)
    {
        try {
            NotulenPokja4::findOrFail($id)->update($request->except(['_token', '_method']));
            return $this->crudResponse('diperbarui');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy_pokja4($id)
    {
        try {
            NotulenPokja4::findOrFail($id)->delete();
            return $this->crudResponse('dihapus');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function import_pokja4(Request $request)
    {
        return $this->doImport($request, 'Pokja_4');
    }

    // ==================== POKJA 3 (import only new) ====================
    public function import_pokja3(Request $request)
    {
        return $this->doImport($request, 'Pokja_3');
    }
}
