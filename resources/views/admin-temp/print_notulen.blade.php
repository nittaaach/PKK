<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notulen - {{ $item->acara ?? 'Rapat' }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #000;
            background: #fff;
            padding: 0;
            margin: 0;
        }

        .print-wrapper {
            max-width: 740px;
            margin: 20px auto;
            padding: 40px 60px;
            background: #fff;
        }

        /* ---- Print button ---- */
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-print {
            background: #1e40af;
            color: #fff;
            border: none;
            padding: 10px 28px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            margin-right: 8px;
        }
        .btn-print:hover { background: #1e3a8a; }
        .btn-back {
            background: #6b7280;
            color: #fff;
            border: none;
            padding: 10px 28px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover { background: #4b5563; }

        /* ---- Header ---- */
        .doc-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 24px;
            letter-spacing: 2px;
        }

        /* ---- Info table ---- */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 2px 4px;
            vertical-align: top;
            font-size: 12pt;
            line-height: 1.6;
        }
        .info-table td.label {
            width: 160px;
        }
        .info-table td.colon {
            width: 20px;
        }
        .info-table td.value {
            /* flex auto */
        }

        /* ---- Hasil Rapat ---- */
        .hasil-rapat-label {
            font-size: 12pt;
            margin-bottom: 6px;
            margin-top: 8px;
        }

        /* ---- Data table ---- */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 6px 10px;
            font-size: 11pt;
            line-height: 1.5;
        }
        .data-table th {
            text-align: center;
            font-weight: bold;
            background: #fff;
        }
        .data-table td:first-child {
            text-align: center;
            width: 45px;
        }
        .data-table td:nth-child(2) {
            width: 160px;
        }

        /* ---- Kesimpulan ---- */
        .kesimpulan-section {
            margin-bottom: 30px;
            font-size: 12pt;
        }
        .kesimpulan-section table td {
            vertical-align: top;
            padding: 2px 4px;
            line-height: 1.7;
        }
        .kesimpulan-section table td.label { width: 160px; }
        .kesimpulan-section table td.colon { width: 20px; }

        /* ---- Signature ---- */
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .sig-left, .sig-right {
            width: 45%;
            font-size: 11pt;
            line-height: 1.7;
        }
        .sig-right {
            text-align: right;
        }
        .sig-name {
            display: inline-block;
            margin-top: 60px;
            border-bottom: 1px solid #000;
            min-width: 180px;
            text-align: center;
            padding-bottom: 2px;
        }
        .sig-name-wrap {
            margin-top: 60px;
        }

        /* ---- Print media ---- */
        @media print {
            @page {
                size: A4;
                margin: 1.5cm 2cm;
            }
            body {
                padding: 0;
            }
            .print-wrapper {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="print-wrapper">

        {{-- Button bar (hidden on print) --}}
        <div class="no-print">
            <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
            <a class="btn-back" onclick="window.history.back()">← Kembali</a>
        </div>

        {{-- Judul --}}
        <div class="doc-title">NOTULEN</div>

        {{-- Info rapat --}}
        <table class="info-table">
            <tr>
                <td class="label">Dasar</td>
                <td class="colon">:</td>
                <td class="value">{{ $item->dasar ?? '-' }}</td>
            </tr>
            <tr><td colspan="3" style="padding:4px 0;"></td></tr>
            <tr>
                <td class="label">Hari, Tanggal</td>
                <td class="colon">:</td>
                <td class="value">
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
                <td class="value">{{ $item->waktu ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tempat</td>
                <td class="colon">:</td>
                <td class="value">{{ $item->tempat ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Acara</td>
                <td class="colon">:</td>
                <td class="value">{{ $item->acara ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pimpinan Rapat</td>
                <td class="colon">:</td>
                <td class="value">{{ $item->pimpinan_rapat ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Peserta</td>
                <td class="colon">:</td>
                <td class="value" style="white-space: pre-line;">{{ $item->peserta ?? '-' }}</td>
            </tr>
        </table>

        {{-- Hasil Rapat --}}
        <p class="hasil-rapat-label">Hasil Rapat &nbsp;&nbsp;:</p>

        @php
            // Parse isi_notulen: setiap baris adalah satu poin
            // Format: "Nama | Keterangan" per baris, atau baris biasa
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

        {{-- Kesimpulan --}}
        <div class="kesimpulan-section">
            <table style="width:100%; border-collapse:collapse;">
                <tr>
                    <td class="label">Kesimpulan Rapat</td>
                    <td class="colon">:</td>
                    <td style="white-space: pre-line;">{{ $item->kesimpulan ?? '-' }}</td>
                </tr>
            </table>
        </div>

        {{-- Tanda tangan --}}
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
</body>
</html>
