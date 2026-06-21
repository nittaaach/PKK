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

    public function import($file): int
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $path = $file->getRealPath();

        $dataRows = match ($ext) {
            'csv' => $this->readCsv($path),
            'ods' => $this->readOds($path),
            default => $this->readXlsx($path),
        };

        // Find where the actual data starts
        $startDataIndex = 0;
        foreach ($dataRows as $i => $row) {
            $no = isset($row[0]) ? trim((string)$row[0]) : '';
            if ($no !== '' && is_numeric($no)) {
                $col2 = isset($row[1]) ? trim((string)$row[1]) : '';
                if ($col2 === '2') {
                    // This is the numbering row (1, 2, 3...)
                    $startDataIndex = $i + 1;
                } else {
                    // This is actual data (NO = 1, but Col 2 is a date)
                    $startDataIndex = $i;
                }
                break;
            }
        }

        if ($startDataIndex > 0) {
            $dataRows = array_slice($dataRows, $startDataIndex);
        }

        $count = 0;
        $currentRow = null;

        foreach ($dataRows as $row) {
            $no = isset($row[0]) ? trim((string)$row[0]) : '';
            $asal_surat = isset($row[4]) ? trim((string)$row[4]) : '';
            
            $perihal_label = isset($row[5]) ? trim((string)$row[5]) : '';
            $perihal_val = isset($row[6]) ? trim((string)$row[6]) : '';
            $combined_perihal = trim($perihal_label . ($perihal_val !== '' ? ': ' . $perihal_val : ''));
            
            if ($no !== '' || $asal_surat !== '') {
                // Save previous row
                if ($currentRow !== null) {
                    $this->processRow($currentRow);
                    $count++;
                }

                $currentRow = [
                    'tanggal_terima'    => isset($row[1]) ? trim((string)$row[1]) : null,
                    'tanggal_surat'     => isset($row[2]) ? trim((string)$row[2]) : null,
                    'no_surat'          => isset($row[3]) ? trim((string)$row[3]) : null,
                    'asal_surat'        => $asal_surat !== '' ? $asal_surat : null,
                    'perihal'           => $combined_perihal !== '' ? $combined_perihal : null,
                    'lampiran'          => isset($row[7]) ? trim((string)$row[7]) : null,
                    'diteruskan_kepada' => isset($row[8]) ? trim((string)$row[8]) : null,
                ];
            } else {
                // Continuation (merged cells)
                if ($currentRow !== null && $combined_perihal !== '') {
                    $currentRow['perihal'] .= "\n" . $combined_perihal;
                }
            }
        }

        // Process last row
        if ($currentRow !== null) {
            $this->processRow($currentRow);
            $count++;
        }

        return $count;
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
            'perihal'           => $row['perihal'] ?? '-',
            'lampiran'          => $row['lampiran'] ?? null,
            'diteruskan_kepada' => $row['diteruskan_kepada'] ?? null,
        ]);
    }
}
