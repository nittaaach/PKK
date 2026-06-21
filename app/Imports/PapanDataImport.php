<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\Model;

/**
 * Import Papan Data dari Excel/CSV/ODS.
 * Dapat digunakan untuk semua model PapanData (sekretaris / pokja 1-4).
 * Kolom disesuaikan secara otomatis berdasarkan $fillable model.
 */
class PapanDataImport extends BaseImport
{
    protected string $modelClass;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;

        if (stripos($modelClass, 'Sekretaris') !== false) {
            $this->expectedSheetName = 'sekretaris';
        } elseif (stripos($modelClass, 'Pokja1') !== false) {
            $this->expectedSheetName = 'pokja';
        } elseif (stripos($modelClass, 'Pokja2') !== false) {
            $this->expectedSheetName = 'pokja 2';
        } elseif (stripos($modelClass, 'Pokja3') !== false) {
            $this->expectedSheetName = 'pokja 3';
        } elseif (stripos($modelClass, 'Pokja4') !== false) {
            $this->expectedSheetName = 'pokja 4';
        }
    }

    public function import($file): int
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $path      = $file->getRealPath();

        // Khusus Pokja 1, karena namanya kadang "Pokja I" atau "Pokja 1"
        if (stripos($this->modelClass, 'Pokja1') !== false) {
            $rows = [];
            $sheetNamesToTry = ['pokja 1', 'pokja i'];
            foreach ($sheetNamesToTry as $name) {
                $this->expectedSheetName = $name;
                try {
                    $rows = $this->readXlsx($path);
                    if (!empty($rows)) break;
                } catch (\Exception $e) {}
            }
        } else {
            $rows = match (true) {
                in_array($extension, ['xlsx', 'xls']) => $this->readXlsx($path),
                $extension === 'csv'                  => $this->readCsv($path),
                $extension === 'ods'                  => $this->readOds($path),
                default                               => throw new \Exception("Format file tidak didukung: .$extension"),
            };
        }

        if (empty($rows)) {
            throw new \Exception('File kosong atau sheet yang sesuai tidak ditemukan.');
        }

        $startIndex = -1;
        foreach ($rows as $idx => $row) {
            if (isset($row[0]) && $row[0] == '1' && isset($row[1]) && $row[1] == '2' && isset($row[2]) && $row[2] == '3') {
                $startIndex = $idx + 1;
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
        /** @var Model $modelClass */
        $modelClass = $this->modelClass;

        // Ambil $fillable dari model, filter hanya kolom yang ada di row
        $instance = new $modelClass();
        $fillable  = $instance->getFillable();

        $data = [];
        foreach ($fillable as $field) {
            if (array_key_exists($field, $row)) {
                $data[$field] = $row[$field];
            }
        }

        // Skip jika semua nilai null / kosong
        $allEmpty = collect($data)->every(fn($v) => is_null($v) || $v === '');
        if ($allEmpty) return;

        // Parse angka untuk field numerik (semua kecuali nama_wilayah & keterangan)
        $nonNumeric = ['nama_wilayah', 'keterangan', 'nomor_rw'];
        foreach ($data as $k => $v) {
            if (!in_array($k, $nonNumeric)) {
                $data[$k] = $this->parseInt($v);
            }
        }

        $modelClass::create($data);
    }
}
