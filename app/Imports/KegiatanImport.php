<?php

namespace App\Imports;

use App\Models\KegiatanModels;

/**
 * Import Kegiatan dari Excel/CSV/ODS.
 * Header: nama, jabatan, kategori, tanggal_kegiatan, tempat, uraian
 */
class KegiatanImport extends BaseImport
{
    protected string $role;

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    protected function processRow(array $row): void
    {
        if (empty($row['nama']) && empty($row['uraian'])) return;

        KegiatanModels::create([
            'role'             => $this->role,
            'nama'             => $row['nama'] ?? null,
            'jabatan'          => $row['jabatan'] ?? null,
            'kategori'         => $row['kategori'] ?? null,
            'tanggal_kegiatan' => $this->parseDate($row['tanggal_kegiatan'] ?? null),
            'tempat'           => $row['tempat'] ?? null,
            'uraian'           => $row['uraian'] ?? null,
            'dokumentasi_ids'  => json_encode([]),
        ]);
    }
}
