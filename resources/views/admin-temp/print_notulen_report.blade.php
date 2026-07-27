<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Notulen - {{ $role_label }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; color: #000; background: #fff; }

        .print-wrapper { max-width: 800px; margin: 20px auto; padding: 40px 60px; background: #fff; }

        .no-print { text-align: center; margin-bottom: 24px; }
        .btn-print { background: #1e40af; color: #fff; border: none; padding: 10px 28px; font-size: 14px; border-radius: 6px; cursor: pointer; font-family: Arial, sans-serif; margin-right: 8px; }
        .btn-print:hover { background: #1e3a8a; }
        .btn-back { background: #6b7280; color: #fff; border: none; padding: 10px 28px; font-size: 14px; border-radius: 6px; cursor: pointer; font-family: Arial, sans-serif; text-decoration: none; display: inline-block; }
        .btn-back:hover { background: #4b5563; }

        .notulen-item { margin-bottom: 60px; page-break-inside: avoid; }
        .notulen-item + .notulen-item { border-top: 2px dashed #ccc; padding-top: 40px; }

        .doc-title { text-align: center; font-size: 14pt; font-weight: bold; text-decoration: underline; margin-bottom: 20px; letter-spacing: 2px; }

        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 18px; }
        .info-table td { padding: 2px 4px; vertical-align: top; font-size: 12pt; line-height: 1.6; }
        .info-table td.label { width: 160px; }
        .info-table td.colon { width: 20px; }

        .hasil-rapat-label { font-size: 12pt; margin-bottom: 6px; margin-top: 8px; }

        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 18px; }
        .data-table th, .data-table td { border: 1px solid #000; padding: 5px 8px; font-size: 11pt; line-height: 1.5; }
        .data-table th { text-align: center; font-weight: bold; }
        .data-table td:first-child { text-align: center; width: 40px; }
        .data-table td:nth-child(2) { width: 150px; }

        .kesimpulan-section { margin-bottom: 28px; font-size: 12pt; }
        .kesimpulan-section table td { vertical-align: top; padding: 2px 4px; line-height: 1.7; }
        .kesimpulan-section table td.label { width: 160px; }
        .kesimpulan-section table td.colon { width: 20px; }

        .signature-section { display: flex; justify-content: space-between; align-items: flex-start; margin-top: 32px; }
        .sig-left, .sig-right { width: 45%; font-size: 11pt; line-height: 1.7; }
        .sig-right { text-align: right; }
        .sig-name-wrap { margin-top: 56px; }

        @media print {
            @page { size: A4; margin: 1.5cm 2cm; }
            body, .print-wrapper { max-width: 100%; margin: 0; padding: 0; }
            .no-print { display: none !important; }
            .notulen-item + .notulen-item { page-break-before: always; border-top: none; padding-top: 0; }
        }
    </style>
</head>
<body>
<div class="print-wrapper">

    <div class="no-print">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
        <a class="btn-back" onclick="window.history.back()">← Kembali</a>
        <p style="margin-top:8px; font-size:13px; color:#555;">Mencetak <strong>{{ $items->count() }}</strong> notulen — {{ $role_label }}</p>
    </div>

    @foreach($items as $item)
        <div class="notulen-item">
            <div class="doc-title">NOTULEN</div>

            <table class="info-table">
                <tr>
                    <td class="label">Dasar</td>
                    <td class="colon">:</td>
                    <td>{{ $item->dasar ?? '-' }}</td>
                </tr>
                <tr><td colspan="3" style="padding:3px 0;"></td></tr>
                <tr>
                    <td class="label">Hari, Tanggal</td>
                    <td class="colon">:</td>
                    <td>
                        @if($item->tanggal)
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="label">Waktu</td>
                    <td class="colon">:</td>
                    <td>{{ $item->waktu ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Tempat</td>
                    <td class="colon">:</td>
                    <td>{{ $item->tempat ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Acara</td>
                    <td class="colon">:</td>
                    <td>{{ $item->acara ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Pimpinan Rapat</td>
                    <td class="colon">:</td>
                    <td>{{ $item->pimpinan_rapat ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Peserta</td>
                    <td class="colon">:</td>
                    <td style="white-space: pre-line;">{{ $item->peserta ?? '-' }}</td>
                </tr>
            </table>

            <p class="hasil-rapat-label">Hasil Rapat &nbsp;&nbsp;:</p>

            @php
                $baris = [];
                if ($item->isi_notulen) {
                    $lines = array_filter(explode("\n", trim($item->isi_notulen)));
                    foreach ($lines as $line) {
                        $line = trim($line);
                        if ($line === '') continue;
                        if (strpos($line, '|') !== false) {
                            $parts = explode('|', $line, 2);
                            $baris[] = ['nama' => trim($parts[0]), 'ket' => trim($parts[1])];
                        } else {
                            $baris[] = ['nama' => $item->pimpinan_rapat ?? '-', 'ket' => $line];
                        }
                    }
                }
                if (empty($baris)) {
                    $baris[] = ['nama' => $item->pimpinan_rapat ?? '-', 'ket' => $item->isi_notulen ?? '-'];
                }
            @endphp

            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Keterangan/Uraian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($baris as $idx => $row)
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>{{ $row['nama'] }}</td>
                            <td style="white-space: pre-line;">{{ $row['ket'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="kesimpulan-section">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td class="label">Kesimpulan Rapat</td>
                        <td class="colon">:</td>
                        <td style="white-space: pre-line;">{{ $item->kesimpulan ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <div class="signature-section">
                <div class="sig-left">
                    <div>Mengetahui</div>
                    <div>{{ $item->mengetahui_jabatan ?? 'Ketua TP PKK Kec. Makasar' }}</div>
                    <div class="sig-name-wrap">
                        <div>( {{ $item->mengetahui_nama ?? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' }} )</div>
                    </div>
                </div>
                <div class="sig-right">
                    <div>Jakarta,
                        @if($item->tanggal)
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        @else
                            {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                        @endif
                    </div>
                    <div class="sig-name-wrap">
                        <div>{{ $item->pencatat_nama ?? $item->pimpinan_rapat ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
</body>
</html>
