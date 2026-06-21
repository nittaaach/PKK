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

    public function import($file): int
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $path = $file->getRealPath();

        $dataRows = match ($ext) {
            'csv' => $this->readCsv($path),
            'ods' => $this->readOds($path),
            default => $this->readXlsx($path),
        };

        // Cari baris data pertama (mengabaikan judul tabel dan baris penomoran)
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
            if ($no === '') continue; // Abaikan baris kosong

            SuratKeluarModels::create([
                'role'             => $this->role,
                'nomor_kode_surat' => isset($row[1]) ? trim((string)$row[1]) : null,
                'tanggal_surat'    => isset($row[2]) ? $this->parseDate($row[2]) : null,
                'kepada'           => isset($row[3]) ? trim((string)$row[3]) : null,
                'perihal'          => isset($row[4]) ? trim((string)$row[4]) : null,
                'lampiran'         => isset($row[5]) ? trim((string)$row[5]) : null,
                'tembusan'         => isset($row[6]) ? trim((string)$row[6]) : null,
            ]);
            
            $count++;
        }

        return $count;
    }

    protected function processRow(array $row): void
    {
        // Tidak digunakan lagi karena kita sudah meng-override import()
    }
}
