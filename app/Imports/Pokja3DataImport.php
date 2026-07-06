<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\Model;

/**
 * Import Pokja 3 Data dari Excel/CSV/ODS.
 * Kolom otomatis disesuaikan dengan $fillable model yang diinject.
 */
class Pokja3DataImport extends BaseImport
{
    protected string $modelClass;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function import($file): int
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $path      = $file->getRealPath();

        $rows = match (true) {
            in_array($extension, ['xlsx', 'xls']) => $this->readXlsx($path),
            $extension === 'csv'                  => $this->readCsv($path),
            $extension === 'ods'                  => $this->readOds($path),
            default                               => throw new \Exception("Format file tidak didukung: .$extension"),
        };

        if (empty($rows)) {
            throw new \Exception('File kosong atau tidak memiliki data.');
        }

        // Cari baris indikator nomor kolom (1, 2, 3, 4, ...)
        $startIndex = -1;
        foreach ($rows as $idx => $row) {
            if (isset($row[0]) && $row[0] == '1' && isset($row[1]) && $row[1] == '2' && isset($row[2]) && $row[2] == '3') {
                $startIndex = $idx + 1; // Data dimulai setelah baris ini
                break;
            }
        }

        if ($startIndex === -1) {
            // Coba temukan baris data pertama dengan mengecek isi kolom 'NO'
            foreach ($rows as $idx => $row) {
                if ($idx < 1) continue;
                $col0 = strtolower(trim((string)($row[0] ?? '')));
                if (is_numeric($col0) && $col0 > 0) {
                    $startIndex = $idx;
                    break;
                }
            }
        }

        if ($startIndex === -1) {
            // Jika tetap tidak ketemu, fallback ke index 2 (asumsi 2 baris header)
            $startIndex = 2;
        }

        $dataRows = array_slice($rows, $startIndex);
        
        $instance = new $this->modelClass();
        $fillable = $instance->getFillable();
        
        $count = 0;
        $lastRowData = [];
        foreach ($dataRows as $row) {
            $mapped = [];
            foreach ($fillable as $idx => $field) {
                // Kolom B (index 1) adalah kolom pertama untuk data
                $colIdx = $idx + 1;
                $mapped[$field] = isset($row[$colIdx]) ? trim((string) $row[$colIdx]) : null;
                if ($mapped[$field] === '') $mapped[$field] = null;
            }

            // Abaikan baris jika kosong semua
            $allEmpty = collect($mapped)->every(fn($v) => is_null($v) || $v === '');
            if ($allEmpty) {
                continue;
            }

            // Abaikan baris jika tidak ada data baru (duplikat murni atau padding mergeCell vertikal)
            $isNewData = false;
            foreach ($mapped as $field => $val) {
                if ($val !== null && $val !== '') {
                    if ($val !== ($lastRowData[$field] ?? null)) {
                        $isNewData = true;
                        break;
                    }
                }
            }
            if (!$isNewData && !empty($lastRowData)) {
                continue;
            }

            $lastRowData = $mapped;
            $this->processRow($mapped);
            $count++;
        }

        return $count;
    }

    protected function processRow(array $row): void
    {
        $modelClass = $this->modelClass;
        $instance   = new $modelClass();
        $fillable   = $instance->getFillable();

        $data = [];
        foreach ($fillable as $field) {
            if (array_key_exists($field, $row)) {
                $data[$field] = $row[$field];
            }
        }

        // Otomatis ubah numerik dan tanggal
        foreach ($data as $k => $v) {
            // Cek untuk kondisi (boolean)
            if (in_array($k, ['kondisi_hidup', 'kondisi_mati'])) {
                $data[$k] = !empty(trim((string)$v)) ? 1 : 0;
            } 
            // Cek untuk kolom tanggal dari format Excel (serial number)
            elseif (in_array($k, ['tgl_tahun_lomba', 'waktu_penerimaan', 'tgl_penerimaan', 'tanggal_bantuan', 'tanggal_penerimaan']) && is_numeric($v) && $v > 20000) {
                // Convert Excel serial date to Unix timestamp and format as d/m/Y
                $unixDate = ($v - 25569) * 86400;
                $data[$k] = gmdate("d/m/Y", (int)$unixDate);
            }
            // Coba untuk numerik kecuali ada kata tertentu
            elseif (is_numeric($v) && !in_array($k, ['keterangan', 'program_pokok', 'jenis_kegiatan', 'nama', 'alamat', 'tgl_tahun_lomba', 'waktu_penerimaan', 'tanggal_bantuan', 'tanggal_penerimaan'])) {
                $data[$k] = $this->parseInt($v);
            }
        }

        $modelClass::create($data);
    }
}
