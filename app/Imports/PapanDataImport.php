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
