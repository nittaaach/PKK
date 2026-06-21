<?php

namespace App\Imports;

use App\Models\BukuKeuangan;

/**
 * Import Buku Keuangan dari Excel/CSV/ODS.
 * Header: tanggal_penerimaan, sumber_dana_penerimaan, uraian_penerimaan,
 *         bukti_kas_penerimaan, penerimaan, tanggal_pengeluaran,
 *         sumber_dana_pengeluaran, uraian_pengeluaran, bukti_kas_pengeluaran, pengeluaran
 */
class BukuKeuanganImport extends BaseImport
{
    protected string $role;

    protected array $headerAliases = [
        'tanggal penerimaan'      => 'tanggal_penerimaan',
        'tgl_penerimaan'          => 'tanggal_penerimaan',
        'sumber dana penerimaan'  => 'sumber_dana_penerimaan',
        'uraian penerimaan'       => 'uraian_penerimaan',
        'bukti kas penerimaan'    => 'bukti_kas_penerimaan',
        'jumlah penerimaan'       => 'penerimaan',
        'jumlah_penerimaan'       => 'penerimaan',
        'tanggal pengeluaran'     => 'tanggal_pengeluaran',
        'tgl_pengeluaran'         => 'tanggal_pengeluaran',
        'sumber dana pengeluaran' => 'sumber_dana_pengeluaran',
        'uraian pengeluaran'      => 'uraian_pengeluaran',
        'bukti kas pengeluaran'   => 'bukti_kas_pengeluaran',
        'jumlah pengeluaran'      => 'pengeluaran',
        'jumlah_pengeluaran'      => 'pengeluaran',
    ];

    public function __construct(string $role = 'Sekretaris')
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

        // Cari baris data pertama (baris yang memiliki angka di kolom NO, atau bukan header)
        $startDataIndex = 0;
        foreach ($dataRows as $i => $row) {
            $no1 = isset($row[0]) ? trim((string)$row[0]) : '';
            $no2 = isset($row[6]) ? trim((string)$row[6]) : '';
            if (($no1 !== '' && is_numeric($no1)) || ($no2 !== '' && is_numeric($no2))) {
                $startDataIndex = $i;
                break;
            }
        }

        if ($startDataIndex > 0) {
            $dataRows = array_slice($dataRows, $startDataIndex);
        } else {
            // Jika tidak ketemu, fallback buang 1 baris (header)
            array_shift($dataRows);
        }

        $count = 0;
        foreach ($dataRows as $row) {
            $no1 = isset($row[0]) ? trim((string)$row[0]) : '';
            $no2 = isset($row[6]) ? trim((string)$row[6]) : '';
            
            // Skip jika benar-benar kosong atau ini baris "Jumlah"
            if ($no1 === '' && $no2 === '' && empty(trim((string)($row[3]??''))) && empty(trim((string)($row[9]??'')))) {
                $cekJml = strtolower(trim((string)($row[3]??''))) . strtolower(trim((string)($row[4]??'')));
                if (str_contains($cekJml, 'jumlah')) continue;
            }

            $mapped = [
                'tanggal_penerimaan'      => isset($row[1]) ? trim((string)$row[1]) : null,
                'sumber_dana_penerimaan'  => isset($row[2]) ? trim((string)$row[2]) : null,
                'uraian_penerimaan'       => isset($row[3]) ? trim((string)$row[3]) : null,
                'bukti_kas_penerimaan'    => isset($row[4]) ? trim((string)$row[4]) : null,
                'penerimaan'              => isset($row[5]) ? trim((string)$row[5]) : null,
                
                'tanggal_pengeluaran'     => isset($row[7]) ? trim((string)$row[7]) : null,
                'sumber_dana_pengeluaran' => isset($row[8]) ? trim((string)$row[8]) : null,
                'uraian_pengeluaran'      => isset($row[9]) ? trim((string)$row[9]) : null,
                'bukti_kas_pengeluaran'   => isset($row[10]) ? trim((string)$row[10]) : null,
                'pengeluaran'             => isset($row[11]) ? trim((string)$row[11]) : null,
            ];

            $hasPenerimaan  = !empty($mapped['penerimaan']) || !empty($mapped['tanggal_penerimaan']) || !empty($mapped['uraian_penerimaan']);
            $hasPengeluaran = !empty($mapped['pengeluaran']) || !empty($mapped['tanggal_pengeluaran']) || !empty($mapped['uraian_pengeluaran']);

            // Jika "JUMLAH" masuk sebagai uraian atau bukti kas, skip
            if (strtolower((string)$mapped['uraian_penerimaan']) === 'jumlah' || strtolower((string)$mapped['bukti_kas_penerimaan']) === 'jumlah') $hasPenerimaan = false;
            if (strtolower((string)$mapped['uraian_pengeluaran']) === 'jumlah' || strtolower((string)$mapped['bukti_kas_pengeluaran']) === 'jumlah') $hasPengeluaran = false;

            if (!$hasPenerimaan && !$hasPengeluaran) continue;

            BukuKeuangan::create([
                'role'                    => $this->role,
                'tanggal_penerimaan'      => $this->parseDate($mapped['tanggal_penerimaan']),
                'sumber_dana_penerimaan'  => $mapped['sumber_dana_penerimaan'],
                'uraian_penerimaan'       => $mapped['uraian_penerimaan'],
                'bukti_kas_penerimaan'    => $mapped['bukti_kas_penerimaan'],
                'penerimaan'              => $this->parseNumber($mapped['penerimaan']),
                'tanggal_pengeluaran'     => $this->parseDate($mapped['tanggal_pengeluaran']),
                'sumber_dana_pengeluaran' => $mapped['sumber_dana_pengeluaran'],
                'uraian_pengeluaran'      => $mapped['uraian_pengeluaran'],
                'bukti_kas_pengeluaran'   => $mapped['bukti_kas_pengeluaran'],
                'pengeluaran'             => $this->parseNumber($mapped['pengeluaran']),
            ]);

            $count++;
        }

        return $count;
    }

    protected function processRow(array $row): void
    {
        // Dummy implementation to satisfy BaseImport's abstract method constraint.
        // We handle row processing directly in the import() method above.
    }
}
