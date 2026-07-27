<?php

namespace App\Imports;

use App\Models\NotulenSekretaris;
use App\Models\NotulenPokja1;
use App\Models\NotulenPokja2;
use App\Models\NotulenPokja3;
use App\Models\NotulenPokja4;
use Carbon\Carbon;

/**
 * Import Notulen dari Excel/CSV/ODS.
 * Format file berupa form tunggal notulen (seperti format cetak notulen PKK).
 * Mengambil field Dasar, Tanggal, Tempat, Acara, dsb dari cell tertentu,
 * dan menggabungkan tabel peserta (Nama | Uraian) menjadi isi_notulen.
 */
class NotulenImport extends BaseImport
{
    protected string $role;

    private static array $modelMap = [
        'Sekretaris' => NotulenSekretaris::class,
        'Pokja_1'    => NotulenPokja1::class,
        'Pokja_2'    => NotulenPokja2::class,
        'Pokja_3'    => NotulenPokja3::class,
        'Pokja_4'    => NotulenPokja4::class,
    ];

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    public function import($file): int
    {
        $ext  = strtolower($file->getClientOriginalExtension());
        $path = $file->getRealPath();

        // Menggunakan method bawaan dari BaseImport agar tidak butuh PhpSpreadsheet
        $dataRows = match (true) {
            in_array($ext, ['xlsx', 'xls']) => $this->readXlsx($path),
            $ext === 'csv'                  => $this->readCsv($path),
            $ext === 'ods'                  => $this->readOds($path),
            default                         => throw new \Exception("Format file tidak didukung: .$ext"),
        };

        $parsed = [
            'dasar'              => null,
            'tanggal'            => null,
            'waktu'              => null,
            'tempat'             => null,
            'acara'              => null,
            'pimpinan_rapat'     => null,
            'peserta'            => null,
            'isi_notulen'        => '',
            'kesimpulan'         => null,
            'mengetahui_jabatan' => null,
            'mengetahui_nama'    => null,
            'pencatat_nama'      => null,
        ];

        $parsingIsi = false;
        
        foreach ($dataRows as $i => $row) {
            $colA = trim((string)($row[0] ?? ''));
            $colB = trim((string)($row[1] ?? ''));
            $colC = trim((string)($row[2] ?? ''));
            $colD = trim((string)($row[3] ?? '')); // Uraian in colD
            $colE = trim((string)($row[4] ?? '')); 
            
            // Clean up leading colons
            $cleanB = ltrim($colB, ' :');
            $cleanC = ltrim($colC, ' :');
            $cleanD = ltrim($colD, ' :');

            // Find data in column C, D, or B
            $value = $cleanD !== '' ? $cleanD : ($cleanC !== '' ? $cleanC : $cleanB);

            if (stripos($colA, 'Dasar') !== false) $parsed['dasar'] = $value;
            elseif (stripos($colA, 'Hari,Tanggal') !== false || stripos($colA, 'Hari, Tanggal') !== false || stripos($colA, 'Tanggal') !== false) {
                // Remove day name if exists e.g., "Senin, 6 Januari 2025" -> "6 Januari 2025"
                $tglStr = $value;
                if (strpos($tglStr, ',') !== false) {
                    $tglStr = trim(explode(',', $tglStr, 2)[1]);
                }
                $parsed['tanggal'] = $tglStr; 
            }
            elseif (stripos($colA, 'Waktu') !== false) $parsed['waktu'] = $value;
            elseif (stripos($colA, 'Tempat') !== false) $parsed['tempat'] = $value;
            elseif (stripos($colA, 'Acara') !== false) $parsed['acara'] = $value;
            elseif (stripos($colA, 'Pimpinan Rapat') !== false) $parsed['pimpinan_rapat'] = $value;
            elseif (stripos($colA, 'Peserta') !== false) $parsed['peserta'] = $value;
            
            // Logic untuk membaca tabel Hasil Rapat
            // In the actual file: colB = 'Nama', colC = 'Nama', colD = 'Keterangan/Uraian'
            elseif (stripos($colB, 'Nama') !== false && stripos($colD, 'Keterangan') !== false) {
                $parsingIsi = true;
                continue;
            }
            elseif ($parsingIsi) {
                if (stripos($colA, 'Kesimpulan Rapat') !== false) {
                    $parsingIsi = false;
                    $parsed['kesimpulan'] = $value;
                } elseif (is_numeric($colA) && $colA !== '') {
                    // Baris valid dari isi tabel: "Nama | Uraian"
                    if ($colB !== '' || $colD !== '') {
                        $parsed['isi_notulen'] .= $colB . " | " . $colD . "\n";
                    }
                } elseif ($colA === '' && $colD !== '') {
                    // Multiline teks dari uraian tabel, sambungkan
                    $parsed['isi_notulen'] .= "  " . $colD . "\n";
                }
            }
            
            if (!$parsingIsi) {
                if (stripos($colA, 'Kesimpulan Rapat') !== false) {
                    $parsed['kesimpulan'] = $value;
                    // Cek jika baris selanjutnya juga bagian dari kesimpulan
                    if (isset($dataRows[$i+1])) {
                        $nextC = trim((string)($dataRows[$i+1][2] ?? ''));
                        $nextA = trim((string)($dataRows[$i+1][0] ?? ''));
                        if ($nextA === '' && $nextC !== '') {
                            $parsed['kesimpulan'] .= "\n" . ltrim($nextC, ' :');
                        }
                    }
                }
                elseif (stripos($colB, 'Mengetahui') !== false || stripos($colC, 'Mengetahui') !== false) {
                    // Jabatan biasanya ada di baris berikutnya
                    $jabCol = stripos($colC, 'Mengetahui') !== false ? 2 : 1;
                    if (isset($dataRows[$i+1])) {
                        $parsed['mengetahui_jabatan'] = trim((string)($dataRows[$i+1][$jabCol] ?? ''));
                    }
                }
                elseif (strpos($colB, '(') !== false && strpos($colB, ')') !== false) {
                    // Nama Mengetahui (berada dalam tanda kurung)
                    $parsed['mengetahui_nama'] = trim(str_replace(['(', ')'], '', $colB));
                    // Pencatat Nama di colD atau colE
                    $pencatat = trim((string)($row[3] ?? ''));
                    if ($pencatat === '') $pencatat = trim((string)($row[4] ?? ''));
                    if ($pencatat === '') $pencatat = trim((string)($row[5] ?? ''));
                    $parsed['pencatat_nama'] = $pencatat;
                }
                elseif (strpos($colC, '(') !== false && strpos($colC, ')') !== false) {
                    $parsed['mengetahui_nama'] = trim(str_replace(['(', ')'], '', $colC));
                    $pencatat = trim((string)($row[4] ?? ''));
                    if ($pencatat === '') $pencatat = trim((string)($row[5] ?? ''));
                    $parsed['pencatat_nama'] = $pencatat;
                }
            }
        }
        
        $parsed['isi_notulen'] = trim($parsed['isi_notulen']);

        // Format tanggal jika bisa di-parse (konversi nama bulan bahasa Indonesia)
        if ($parsed['tanggal']) {
            $parsed['tanggal'] = $this->parseIndonesianDate($parsed['tanggal']);
        }

        $this->processRow($parsed);
        
        return 1;
    }

    private function parseIndonesianDate(string $dateStr): ?string
    {
        $months = [
            'januari' => '01', 'februari' => '02', 'maret' => '03', 'april' => '04', 
            'mei' => '05', 'juni' => '06', 'juli' => '07', 'agustus' => '08', 
            'september' => '09', 'oktober' => '10', 'november' => '11', 'desember' => '12'
        ];
        
        $dateStr = strtolower(trim($dateStr));
        foreach ($months as $id => $num) {
            if (strpos($dateStr, $id) !== false) {
                $dateStr = str_replace($id, '-' . $num . '-', $dateStr);
                break;
            }
        }
        $dateStr = str_replace(' ', '', $dateStr); // Hapus spasi sisa agar format menjadi DD-MM-YYYY
        $dateStr = trim($dateStr, '-'); // Hapus dash di awal/akhir jika ada
        
        try {
            return Carbon::parse($dateStr)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // Fallback jika gagal parse
        }
    }

    protected function processRow(array $row): void
    {
        if (empty($row['acara']) && empty($row['isi_notulen'])) return;

        $modelClass = self::$modelMap[$this->role] ?? null;
        if (!$modelClass) return;

        $modelClass::create([
            'dasar'              => $row['dasar'] ?? '-',
            'tanggal'            => $row['tanggal'],
            'waktu'              => $row['waktu'] ?? '-',
            'tempat'             => $row['tempat'] ?? '-',
            'acara'              => $row['acara'] ?? '-',
            'pimpinan_rapat'     => $row['pimpinan_rapat'] ?? '-',
            'peserta'            => $row['peserta'] ?? '-',
            'isi_notulen'        => $row['isi_notulen'] ?? '-',
            'kesimpulan'         => $row['kesimpulan'] ?? '-',
            'mengetahui_jabatan' => $row['mengetahui_jabatan'] ?? '-',
            'mengetahui_nama'    => $row['mengetahui_nama'] ?? '-',
            'pencatat_nama'      => $row['pencatat_nama'] ?? '-',
        ]);
    }
}
