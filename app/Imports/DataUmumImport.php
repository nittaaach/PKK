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
