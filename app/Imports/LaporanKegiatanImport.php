<?php

namespace App\Imports;

use App\Models\LaporanKegiatanSekretaris;
use App\Models\LaporanKegiatanPokja1;
use App\Models\LaporanKegiatanPokja2;
use App\Models\LaporanKegiatanPokja3;
use App\Models\LaporanKegiatanPokja4;
use Carbon\Carbon;

/**
 * Import Laporan Kegiatan dari Excel/CSV/ODS.
 * Format file sama persis dengan notulen rapat PKK.
 */
class LaporanKegiatanImport extends BaseImport
{
    protected string $role;

    private static array $modelMap = [
        'Sekretaris' => LaporanKegiatanSekretaris::class,
        'Pokja_1'    => LaporanKegiatanPokja1::class,
        'Pokja_2'    => LaporanKegiatanPokja2::class,
        'Pokja_3'    => LaporanKegiatanPokja3::class,
        'Pokja_4'    => LaporanKegiatanPokja4::class,
    ];

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    public function import($file): int
    {
        $ext  = strtolower($file->getClientOriginalExtension());
        $path = $file->getRealPath();

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
            $colD = trim((string)($row[3] ?? ''));
            $colE = trim((string)($row[4] ?? ''));

            $cleanB = ltrim($colB, ' :');
            $cleanC = ltrim($colC, ' :');
            $cleanD = ltrim($colD, ' :');

            $value = $cleanD !== '' ? $cleanD : ($cleanC !== '' ? $cleanC : $cleanB);

            if (stripos($colA, 'Dasar') !== false) $parsed['dasar'] = $value;
            elseif (stripos($colA, 'Hari,Tanggal') !== false || stripos($colA, 'Hari, Tanggal') !== false || stripos($colA, 'Tanggal') !== false) {
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

            elseif (stripos($colB, 'Nama') !== false && stripos($colD, 'Keterangan') !== false) {
                $parsingIsi = true;
                continue;
            }
            elseif ($parsingIsi) {
                if (stripos($colA, 'Kesimpulan Rapat') !== false) {
                    $parsingIsi = false;
                    $parsed['kesimpulan'] = $value;
                } elseif (is_numeric($colA) && $colA !== '') {
                    if ($colB !== '' || $colD !== '') {
                        $parsed['isi_notulen'] .= $colB . " | " . $colD . "\n";
                    }
                } elseif ($colA === '' && $colD !== '') {
                    $parsed['isi_notulen'] .= "  " . $colD . "\n";
                }
            }

            if (!$parsingIsi) {
                if (stripos($colA, 'Kesimpulan Rapat') !== false) {
                    $parsed['kesimpulan'] = $value;
                    if (isset($dataRows[$i+1])) {
                        $nextC = trim((string)($dataRows[$i+1][2] ?? ''));
                        $nextA = trim((string)($dataRows[$i+1][0] ?? ''));
                        if ($nextA === '' && $nextC !== '') {
                            $parsed['kesimpulan'] .= "\n" . ltrim($nextC, ' :');
                        }
                    }
                }
                elseif (stripos($colB, 'Mengetahui') !== false || stripos($colC, 'Mengetahui') !== false) {
                    $jabCol = stripos($colC, 'Mengetahui') !== false ? 2 : 1;
                    if (isset($dataRows[$i+1])) {
                        $parsed['mengetahui_jabatan'] = trim((string)($dataRows[$i+1][$jabCol] ?? ''));
                    }
                }
                elseif (strpos($colB, '(') !== false && strpos($colB, ')') !== false) {
                    $parsed['mengetahui_nama'] = trim(str_replace(['(', ')'], '', $colB));
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
        $dateStr = str_replace(' ', '', $dateStr);
        $dateStr = trim($dateStr, '-');

        try {
            return Carbon::parse($dateStr)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
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
