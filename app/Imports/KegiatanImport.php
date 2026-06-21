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

    public function import($file): int
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $path = $file->getRealPath();

        $dataRows = match ($ext) {
            'csv' => $this->readCsv($path),
            'ods' => $this->readOds($path),
            default => $this->readXlsx($path),
        };

        $startDataIndex = 0;
        foreach ($dataRows as $i => $row) {
            $no = isset($row[0]) ? trim((string)$row[0]) : '';
            if ($no !== '' && is_numeric($no)) {
                $col2 = isset($row[1]) ? trim((string)$row[1]) : '';
                if ($col2 === '2') {
                    // Ini adalah baris penomoran (1, 2, 3...)
                    $startDataIndex = $i + 1;
                } else {
                    // Ini adalah data asli (NO = 1, tapi Kolom 2 bukan '2')
                    $startDataIndex = $i;
                }
                break;
            }
        }

        if ($startDataIndex > 0) {
            $dataRows = array_slice($dataRows, $startDataIndex);
        }

        $count = 0;
        foreach ($dataRows as $row) {
            $no = isset($row[0]) ? trim((string)$row[0]) : '';
            if ($no === '') continue; // Skip baris kosong

            $mapped = [
                'nama'             => isset($row[1]) ? trim((string)$row[1]) : null,
                'jabatan'          => isset($row[2]) ? trim((string)$row[2]) : null,
                'kategori'         => null,
                'tanggal_kegiatan' => isset($row[3]) ? trim((string)$row[3]) : null,
                'tempat'           => isset($row[4]) ? trim((string)$row[4]) : null,
                'uraian'           => isset($row[5]) ? trim((string)$row[5]) : null,
            ];

            $this->processRow($mapped);
            $count++;
        }

        return $count;
    }

    protected function processRow(array $row): void
    {
        if (empty($row['nama']) && empty($row['uraian'])) return;

        KegiatanModels::create([
            'role'             => $this->role,
            'nama'             => $row['nama'] ?? '-',
            'jabatan'          => $row['jabatan'],
            'kategori'         => $row['kategori'],
            'tanggal_kegiatan' => $this->parseDate($row['tanggal_kegiatan']),
            'tempat'           => $row['tempat'],
            'uraian'           => $row['uraian'] ?? '-',
            'dokumentasi_ids'  => json_encode([]),
        ]);
    }
}
