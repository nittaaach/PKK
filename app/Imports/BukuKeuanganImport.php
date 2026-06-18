<?php

namespace App\Imports;

use App\Models\BukuKeuangan;

/**
 * Import Buku Keuangan dari Excel/CSV/ODS.
 * Header: tanggal_penerimaan, sumber_dana_penerimaan, uraian_penerimaan,
 *         bukti_kas_penerimaan, penerimaan, tanggal_pengeluaran,
 *         sumber_dana_pengeluaran, uraian_pengeluaran, bukti_kas_pengeluaran, pengeluaran
 */
class BukuKeuanganImport extends BaseImport
{
    protected string $role;

    protected array $headerAliases = [
        'tanggal penerimaan'      => 'tanggal_penerimaan',
        'tgl_penerimaan'          => 'tanggal_penerimaan',
        'sumber dana penerimaan'  => 'sumber_dana_penerimaan',
        'uraian penerimaan'       => 'uraian_penerimaan',
        'bukti kas penerimaan'    => 'bukti_kas_penerimaan',
        'jumlah penerimaan'       => 'penerimaan',
        'jumlah_penerimaan'       => 'penerimaan',
        'tanggal pengeluaran'     => 'tanggal_pengeluaran',
        'tgl_pengeluaran'         => 'tanggal_pengeluaran',
        'sumber dana pengeluaran' => 'sumber_dana_pengeluaran',
        'uraian pengeluaran'      => 'uraian_pengeluaran',
        'bukti kas pengeluaran'   => 'bukti_kas_pengeluaran',
        'jumlah pengeluaran'      => 'pengeluaran',
        'jumlah_pengeluaran'      => 'pengeluaran',
    ];

    public function __construct(string $role = 'Sekretaris')
    {
        $this->role = $role;
    }

    protected function processRow(array $row): void
    {
        $hasPenerimaan  = !empty($row['penerimaan']) || !empty($row['tanggal_penerimaan']);
        $hasPengeluaran = !empty($row['pengeluaran']) || !empty($row['tanggal_pengeluaran']);

        if (!$hasPenerimaan && !$hasPengeluaran) return;

        BukuKeuangan::create([
            'role'                    => $this->role,
            'tanggal_penerimaan'      => $this->parseDate($row['tanggal_penerimaan'] ?? null),
            'sumber_dana_penerimaan'  => $row['sumber_dana_penerimaan'] ?? null,
            'uraian_penerimaan'       => $row['uraian_penerimaan'] ?? null,
            'bukti_kas_penerimaan'    => $row['bukti_kas_penerimaan'] ?? null,
            'penerimaan'              => $this->parseNumber($row['penerimaan'] ?? null),
            'tanggal_pengeluaran'     => $this->parseDate($row['tanggal_pengeluaran'] ?? null),
            'sumber_dana_pengeluaran' => $row['sumber_dana_pengeluaran'] ?? null,
            'uraian_pengeluaran'      => $row['uraian_pengeluaran'] ?? null,
            'bukti_kas_pengeluaran'   => $row['bukti_kas_pengeluaran'] ?? null,
            'pengeluaran'             => $this->parseNumber($row['pengeluaran'] ?? null),
        ]);
    }
}
