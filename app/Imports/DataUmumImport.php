<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\Model;

/**
 * Import Data Umum / Data Potensi Wilayah dari Excel/CSV/ODS.
 * Kolom otomatis disesuaikan dengan $fillable model yang diinject.
 */
class DataUmumImport extends BaseImport
{
    protected string $modelClass;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
        
        if (stripos($modelClass, 'DataPotensiWilayah') !== false) {
            $this->expectedSheetName = 'potensi';
        } elseif (stripos($modelClass, 'DataUmum') !== false) {
            $this->expectedSheetName = 'data umum sekre'; // or 'umum'
        }
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

        // Cari baris indikator nomor kolom (1, 2, 3, 4, ...) yang biasanya ada di template PKK
        $startIndex = -1;
        foreach ($rows as $idx => $row) {
            if (isset($row[0]) && $row[0] == '1' && isset($row[1]) && $row[1] == '2' && isset($row[2]) && $row[2] == '3') {
                $startIndex = $idx + 1; // Data dimulai setelah baris ini
                break;
            }
        }

        if ($startIndex === -1) {
            foreach ($rows as $idx => $row) {
                if ($idx < 2) continue; // Baris 0 dan 1 hampir pasti header
                
                $col1 = strtolower(trim((string)($row[1] ?? '')));
                
                // Jika kosong atau baris jumlah, abaikan
                if ($col1 === '' || str_contains($col1, 'jumlah') || str_contains($col1, 'total')) {
                    continue;
                }
                
                // Jika col1 bukan kata-kata header, maka ini adalah baris data pertama!
                if (!in_array($col1, ['nomor rw', 'nama wilayah', 'wilayah', 'nama', 'rw', 'p', 'l'])) {
                    $startIndex = $idx;
                    break;
                }
            }
        }

        if ($startIndex === -1) {
            // Jika tetap tidak ketemu, fallback ke index 4 (asumsi 4 baris header)
            $startIndex = 4;
        }

        $dataRows = array_slice($rows, $startIndex);
        
        $instance = new $this->modelClass();
        $fillable = $instance->getFillable();
        
        $count = 0;
        foreach ($dataRows as $row) {
            $mapped = [];
            foreach ($fillable as $idx => $field) {
                // Kolom B (index 1) adalah kolom pertama untuk data (Nama Wilayah, dst)
                $colIdx = $idx + 1;
                $mapped[$field] = isset($row[$colIdx]) ? trim((string) $row[$colIdx]) : null;
                if ($mapped[$field] === '') $mapped[$field] = null;
            }

            $identifier = $mapped['nama_wilayah'] ?? $mapped['wilayah'] ?? $mapped['nomor_rw'] ?? '';
            $nama = strtolower(trim((string)$identifier));
            
            if ($nama === '' || str_contains($nama, 'jumlah') || str_contains($nama, 'total')) {
                continue;
            }

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

        $allEmpty = collect($data)->every(fn($v) => is_null($v) || $v === '');
        if ($allEmpty) return;

        // Kolom teks tidak perlu parse
        $textFields = ['nama_wilayah', 'wilayah', 'keterangan'];
        foreach ($data as $k => $v) {
            if (!in_array($k, $textFields)) {
                $data[$k] = $this->parseInt($v);
            }
        }

        $modelClass::create($data);
    }
}
