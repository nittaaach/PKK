<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKegiatanSekretaris;
use App\Models\LaporanKegiatanPokja1;
use App\Models\LaporanKegiatanPokja2;
use App\Models\LaporanKegiatanPokja3;
use App\Models\LaporanKegiatanPokja4;
use App\Imports\LaporanKegiatanImport;

class LaporanKegiatanController extends Controller
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
            $count = (new LaporanKegiatanImport($role))->import($request->file('import_file'));
            return back()->with('success', "Berhasil mengimpor {$count} data laporan kegiatan dari file!");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor file. ' . $e->getMessage());
        }
    }

    // ==================== MULTI-PRINT ====================
    /**
     * Print beberapa laporan kegiatan sekaligus berdasarkan IDs & role.
     * URL: /laporan_kegiatan/print-report?ids=1,2,3&role=sekretaris
     */
    public function print_report(Request $request)
    {
        $ids  = array_filter(explode(',', $request->query('ids', '')));
        $role = $request->query('role', 'sekretaris');

        if (empty($ids)) {
            return back()->with('error', 'Pilih minimal satu data laporan kegiatan!');
        }

        $modelMap = [
            'sekretaris' => LaporanKegiatanSekretaris::class,
            'pokja1'     => LaporanKegiatanPokja1::class,
            'pokja2'     => LaporanKegiatanPokja2::class,
            'pokja3'     => LaporanKegiatanPokja3::class,
            'pokja4'     => LaporanKegiatanPokja4::class,
        ];

        $labelMap = [
            'sekretaris' => 'Sekretaris',
            'pokja1'     => 'Pokja I',
            'pokja2'     => 'Pokja II',
            'pokja3'     => 'Pokja III',
            'pokja4'     => 'Pokja IV',
        ];

        $modelClass = $modelMap[$role] ?? LaporanKegiatanSekretaris::class;
        $items = $modelClass::whereIn('id', $ids)->orderBy('tanggal')->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        return view('admin-temp.print_laporan_kegiatan_report', [
            'items'      => $items,
            'role_label' => $labelMap[$role] ?? 'PKK',
        ]);
    }

    // ==================== SEKRETARIS ====================
    public function index_sekretaris()
    {
        return view('sekretaris.laporan_kegiatan', ['data' => LaporanKegiatanSekretaris::orderBy('tanggal', 'asc')->get()]);
    }

    public function store_sekretaris(Request $request)
    {
        try {
            LaporanKegiatanSekretaris::create($request->except(['_token', '_method']));
            return $this->crudResponse('ditambahkan');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update_sekretaris(Request $request, $id)
    {
        try {
            LaporanKegiatanSekretaris::findOrFail($id)->update($request->except(['_token', '_method']));
            return $this->crudResponse('diperbarui');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy_sekretaris($id)
    {
        try {
            LaporanKegiatanSekretaris::findOrFail($id)->delete();
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
        return view('pokja_1.laporan_kegiatan', ['data' => LaporanKegiatanPokja1::orderBy('tanggal', 'asc')->get()]);
    }

    public function store_pokja1(Request $request)
    {
        try {
            LaporanKegiatanPokja1::create($request->except(['_token', '_method']));
            return $this->crudResponse('ditambahkan');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update_pokja1(Request $request, $id)
    {
        try {
            LaporanKegiatanPokja1::findOrFail($id)->update($request->except(['_token', '_method']));
            return $this->crudResponse('diperbarui');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy_pokja1($id)
    {
        try {
            LaporanKegiatanPokja1::findOrFail($id)->delete();
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
        return view('pokja_2.laporan_kegiatan', ['data' => LaporanKegiatanPokja2::orderBy('tanggal', 'asc')->get()]);
    }

    public function store_pokja2(Request $request)
    {
        try {
            LaporanKegiatanPokja2::create($request->except(['_token', '_method']));
            return $this->crudResponse('ditambahkan');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update_pokja2(Request $request, $id)
    {
        try {
            LaporanKegiatanPokja2::findOrFail($id)->update($request->except(['_token', '_method']));
            return $this->crudResponse('diperbarui');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy_pokja2($id)
    {
        try {
            LaporanKegiatanPokja2::findOrFail($id)->delete();
            return $this->crudResponse('dihapus');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function import_pokja2(Request $request)
    {
        return $this->doImport($request, 'Pokja_2');
    }

    // ==================== POKJA 3 ====================
    public function index_pokja3()
    {
        return view('pokja_3.laporan_kegiatan', ['data' => LaporanKegiatanPokja3::orderBy('tanggal', 'asc')->get()]);
    }

    public function store_pokja3(Request $request)
    {
        try {
            LaporanKegiatanPokja3::create($request->except(['_token', '_method']));
            return $this->crudResponse('ditambahkan');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update_pokja3(Request $request, $id)
    {
        try {
            LaporanKegiatanPokja3::findOrFail($id)->update($request->except(['_token', '_method']));
            return $this->crudResponse('diperbarui');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy_pokja3($id)
    {
        try {
            LaporanKegiatanPokja3::findOrFail($id)->delete();
            return $this->crudResponse('dihapus');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function import_pokja3(Request $request)
    {
        return $this->doImport($request, 'Pokja_3');
    }

    // ==================== POKJA 4 ====================
    public function index_pokja4()
    {
        return view('pokja_4.laporan_kegiatan', ['data' => LaporanKegiatanPokja4::orderBy('tanggal', 'asc')->get()]);
    }

    public function store_pokja4(Request $request)
    {
        try {
            LaporanKegiatanPokja4::create($request->except(['_token', '_method']));
            return $this->crudResponse('ditambahkan');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update_pokja4(Request $request, $id)
    {
        try {
            LaporanKegiatanPokja4::findOrFail($id)->update($request->except(['_token', '_method']));
            return $this->crudResponse('diperbarui');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy_pokja4($id)
    {
        try {
            LaporanKegiatanPokja4::findOrFail($id)->delete();
            return $this->crudResponse('dihapus');
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function import_pokja4(Request $request)
    {
        return $this->doImport($request, 'Pokja_4');
    }
}
