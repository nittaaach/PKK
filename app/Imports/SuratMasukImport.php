<?php

namespace App\Imports;

use App\Models\SuratMasukModels;

/**
 * Import Surat Masuk dari Excel/CSV/ODS.
 * Header: tanggal_terima, tanggal_surat, no_surat, asal_surat, perihal, lampiran, diteruskan_kepada
 */
class SuratMasukImport extends BaseImport
{
    protected string $role;

    protected array $headerAliases = [
        'tanggal terima'   => 'tanggal_terima',
        'tgl terima'       => 'tanggal_terima',
        'tgl_terima'       => 'tanggal_terima',
        'tanggal surat'    => 'tanggal_surat',
        'tgl surat'        => 'tanggal_surat',
        'tgl_surat'        => 'tanggal_surat',
        'no surat'         => 'no_surat',
        'nomor surat'      => 'no_surat',
        'nomor_surat'      => 'no_surat',
        'asal surat'       => 'asal_surat',
        'diteruskan kepada' => 'diteruskan_kepada',
    ];

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    protected function processRow(array $row): void
    {
        if (empty($row['perihal']) && empty($row['asal_surat'])) return;

        SuratMasukModels::create([
            'role'              => $this->role,
            'tanggal_terima'    => $this->parseDate($row['tanggal_terima'] ?? null),
            'tanggal_surat'     => $this->parseDate($row['tanggal_surat'] ?? null),
            'no_surat'          => $row['no_surat'] ?? null,
            'asal_surat'        => $row['asal_surat'] ?? null,
            'perihal'           => $row['perihal'] ?? null,
            'lampiran'          => $row['lampiran'] ?? null,
            'diteruskan_kepada' => $row['diteruskan_kepada'] ?? null,
        ]);
    }
}
