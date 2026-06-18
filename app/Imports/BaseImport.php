<?php

namespace App\Imports;

use Carbon\Carbon;

/**
 * Base class untuk semua custom importer.
 * Support: .xlsx, .xls, .csv, .ods
 * Tidak memerlukan package eksternal (PHP built-in ZipArchive + SimpleXML).
 */
abstract class BaseImport
{
    // Kolom alias → nama field model (lowercase, trim sudah ditangani)
    protected array $headerAliases = [];

    /**
     * Proses satu baris data yang sudah di-map ke nama field.
     */
    abstract protected function processRow(array $row): void;

    /**
     * Import dari file yang diupload.
     * @param \Illuminate\Http\UploadedFile $file
     * @return int jumlah baris yang berhasil diimport
     */
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

        // Baris pertama sebagai header
        $headers  = array_map(fn($h) => strtolower(trim((string) $h)), $rows[0]);
        $dataRows = array_slice($rows, 1);

        // Map index kolom ke nama field
        $fieldMap = [];
        foreach ($headers as $idx => $h) {
            $normalized = str_replace(' ', '_', $h);
            if (isset($this->headerAliases[$h])) {
                $fieldMap[$idx] = $this->headerAliases[$h];
            } elseif (isset($this->headerAliases[$normalized])) {
                $fieldMap[$idx] = $this->headerAliases[$normalized];
            } else {
                // fallback: gunakan nama header langsung sebagai field name
                $fieldMap[$idx] = $normalized;
            }
        }

        $count = 0;
        foreach ($dataRows as $row) {
            $mapped = [];
            foreach ($fieldMap as $idx => $field) {
                $mapped[$field] = isset($row[$idx]) ? trim((string) $row[$idx]) : null;
                if ($mapped[$field] === '') $mapped[$field] = null;
            }

            $this->processRow($mapped);
            $count++;
        }

        return $count;
    }

    // =================== READERS ===================

    protected function readXlsx(string $path): array
    {
        $zip = new \ZipArchive();
        if ($zip->open($path) !== true) {
            throw new \Exception('Gagal membuka file Excel. File mungkin rusak.');
        }

        $sharedStrings = [];
        $ssXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($ssXml !== false) {
            $ss = simplexml_load_string($ssXml);
            if ($ss) {
                foreach ($ss->si as $si) {
                    $text = '';
                    foreach ($si->r as $r) {
                        $text .= (string) ($r->t ?? '');
                    }
                    if (empty($text)) $text = (string) ($si->t ?? '');
                    $sharedStrings[] = $text;
                }
            }
        }

        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        $zip->close();

        if ($sheetXml === false) {
            throw new \Exception('Gagal membaca sheet pertama dari file Excel.');
        }

        $sheet = simplexml_load_string($sheetXml);
        $rows  = [];

        foreach ($sheet->sheetData->row as $row) {
            $rowData      = [];
            $prevColIndex = -1;

            foreach ($row->c as $cell) {
                $ref = (string) $cell['r'];
                preg_match('/^([A-Z]+)(\d+)$/', $ref, $m);
                $colIndex = $this->colLetterToIndex($m[1] ?? 'A');

                while ($prevColIndex < $colIndex - 1) {
                    $rowData[]    = null;
                    $prevColIndex++;
                }

                $type  = (string) ($cell['t'] ?? '');
                $value = (string) ($cell->v ?? '');

                $rowData[] = match ($type) {
                    's'        => $sharedStrings[(int) $value] ?? '',
                    'str', 'inlineStr' => (string) ($cell->is->t ?? $cell->v ?? ''),
                    default    => $value,
                };

                $prevColIndex = $colIndex;
            }

            $rows[] = $rowData;
        }

        return $rows;
    }

    protected function readCsv(string $path): array
    {
        $rows   = [];
        $handle = fopen($path, 'r');
        if (!$handle) throw new \Exception('Gagal membuka file CSV.');

        $firstLine = fgets($handle);
        rewind($handle);
        $delimiter = substr_count($firstLine, ';') > substr_count($firstLine, ',') ? ';' : ',';

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            $rows[] = $row;
        }
        fclose($handle);

        return $rows;
    }

    protected function readOds(string $path): array
    {
        $zip = new \ZipArchive();
        if ($zip->open($path) !== true) throw new \Exception('Gagal membuka file ODS.');

        $contentXml = $zip->getFromName('content.xml');
        $zip->close();

        if ($contentXml === false) throw new \Exception('Gagal membaca konten file ODS.');

        $xml  = simplexml_load_string(
            preg_replace('/\s+xmlns[^=]*="[^"]*"/', '', $contentXml)
        );

        $rows = [];
        $body = $xml->body ?? null;
        if (!$body) return $rows;

        $spreadsheet = $body->spreadsheet ?? null;
        if (!$spreadsheet) return $rows;

        $table = $spreadsheet->table ?? null;
        if (!$table) return $rows;

        foreach ($table->{'table-row'} as $tableRow) {
            $rowData = [];
            foreach ($tableRow->{'table-cell'} as $cell) {
                $repeat  = (int) ($cell->attributes()['number-columns-repeated'] ?? 1);
                $value   = (string) ($cell->p ?? '');
                for ($i = 0; $i < $repeat; $i++) {
                    $rowData[] = $value;
                }
            }
            $rows[] = $rowData;
        }

        return $rows;
    }

    // =================== HELPERS ===================

    private function colLetterToIndex(string $col): int
    {
        $col   = strtoupper($col);
        $index = 0;
        for ($i = 0, $len = strlen($col); $i < $len; $i++) {
            $index = $index * 26 + (ord($col[$i]) - ord('A') + 1);
        }
        return $index - 1;
    }

    protected function parseDate($value): ?string
    {
        if (is_null($value) || trim((string) $value) === '') return null;

        $value = trim((string) $value);

        if (is_numeric($value)) {
            $n = (int) $value;
            if ($n > 1 && $n < 100000) {
                $date = new \DateTime('1899-12-30');
                $date->modify("+{$n} days");
                return $date->format('Y-m-d');
            }
        }

        $formats = ['Y-m-d', 'd/m/Y', 'd-m-Y', 'm/d/Y', 'd M Y', 'Y/m/d', 'j/n/Y'];
        foreach ($formats as $fmt) {
            $d = \DateTime::createFromFormat($fmt, $value);
            if ($d && $d->format($fmt) === $value) return $d->format('Y-m-d');
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    protected function parseNumber($value): ?float
    {
        if (is_null($value) || trim((string) $value) === '') return null;
        $cleaned = str_replace(['.', ','], ['', '.'], (string) $value);
        return is_numeric($cleaned) ? (float) $cleaned : null;
    }

    protected function parseInt($value): ?int
    {
        $n = $this->parseNumber($value);
        return $n !== null ? (int) $n : null;
    }
}
