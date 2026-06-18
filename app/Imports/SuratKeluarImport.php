<?php

namespace App\Imports;

use App\Models\SuratKeluarModels;

/**
 * Import Surat Keluar dari Excel/CSV/ODS.
 * Header: nomor_kode_surat, tanggal_surat, kepada, perihal, lampiran, tembusan
 */
class SuratKeluarImport extends BaseImport
{
    protected string $role;

    protected array $headerAliases = [
        'nomor kode surat' => 'nomor_kode_surat',
        'no kode surat'    => 'nomor_kode_surat',
        'kode surat'       => 'nomor_kode_surat',
        'tanggal surat'    => 'tanggal_surat',
        'tgl surat'        => 'tanggal_surat',
        'tgl_surat'        => 'tanggal_surat',
    ];

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    protected function processRow(array $row): void
    {
        if (empty($row['perihal']) && empty($row['kepada'])) return;

        SuratKeluarModels::create([
            'role'             => $this->role,
            'nomor_kode_surat' => $row['nomor_kode_surat'] ?? null,
            'tanggal_surat'    => $this->parseDate($row['tanggal_surat'] ?? null),
            'kepada'           => $row['kepada'] ?? null,
            'perihal'          => $row['perihal'] ?? null,
            'lampiran'         => $row['lampiran'] ?? null,
            'tembusan'         => $row['tembusan'] ?? null,
        ]);
    }
}
