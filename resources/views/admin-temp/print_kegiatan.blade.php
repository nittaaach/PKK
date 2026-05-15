<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan Bulanan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            margin: 0;
            padding: 20px 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h3 {
            margin: 5px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .info-table {
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 3px 10px 3px 0;
            vertical-align: top;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            text-align: center;
            font-weight: bold;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            padding: 0 50px;
        }

        .signature-box {
            text-align: center;
            width: 250px;
        }

        .signature-img {
            height: 80px;
            margin: 10px 0;
            object-fit: contain;
        }

        @media print {
            @page {
                margin: 0;
            }
            body {
                padding: 1.5cm;
            }

            .no-print {
                display: none;
            }
        }

        .print-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-bottom: 20px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }

        .print-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <button onclick="window.print()" class="print-btn no-print">Print / Save as PDF</button>

    <div class="header">
        <h3>LAPORAN KEGIATAN BULANAN PENGURUS TP PKK</h3>
        <h3>KELURAHAN CIPINANG MELAYU</h3>
    </div>

    <table class="info-table">
        <tr>
            <td width="250">NAMA</td>
            <td width="10">:</td>
            <td>{{ strtoupper($nama) }}</td>
        </tr>
        <tr>
            <td>BULAN, TAHUN</td>
            <td>:</td>
            <td>{{ strtoupper($bulan_tahun) }}</td>
        </tr>
        <tr>
            <td>JABATAN KEPENGURUSAN</td>
            <td>:</td>
            <td>{{ strtoupper($role) }}</td>
        </tr>
        <tr>
            <td>KEPENGURUSAN TP PKK TINGKAT</td>
            <td>:</td>
            <td>Kelurahan</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="50">NO</th>
                <th>NAMA KEGIATAN</th>
                <th width="50">HARI, TANGGAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $categories = [
                    'Piket' => 'PIKET',
                    'Rapat' => 'RAPAT',
                    'Pemantauan' => 'PEMANTAUAN',
                    'Pelaksanaan Kegiatan' => 'PELAKSANAAN KEGIATAN',
                    'Pelaksanaan Ceremonial' => 'MENGHADIRI ACARA SEREMONIAL',
                ];
            @endphp
            @foreach ($categories as $db_cat => $display_cat)
                <tr>
                    <td></td>
                    <td style="text-align: center; font-weight: bold;">{{ $display_cat }}</td>
                    <td></td>
                </tr>
                @php
                    $no = 1;
                    $hasData = false;
                @endphp
                @foreach ($kegiatan as $item)
                    @if (strtolower($item->kategori) == strtolower($db_cat))
                        <tr>
                            <td style="text-align: center;">{{ $no++ }}</td>
                            <td>{{ $item->uraian }}</td>
                            <td style="text-align: center;">
                                {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        @php $hasData = true; @endphp
                    @endif
                @endforeach

                @if (!$hasData)
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div style="text-align: right; margin-right: 50px; margin-bottom: 20px;">
        Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <p style="margin: 0;">Yang melaporkan</p>
            <p style="margin: 5px 0 0 0;">{{ $role }} Kelurahan</p>

            @if (isset($first_kegiatan) && $first_kegiatan->tanda_tangan)
                <img src="{{ asset('storage/' . $first_kegiatan->tanda_tangan) }}" alt="Tanda Tangan"
                    class="signature-img">
            @else
                <div style="height: 80px;"></div>
            @endif

            <p style="margin: 0;"><u>{{ $nama }}</u></p>
        </div>
        <div class="signature-box">
            <p style="margin: 0;">Mengetahui</p>
            {{-- <p style="margin: 5px 0 0 0;">{{ strtoupper($role) }} Kelurahan</p> --}}
            <p style="margin: 5px 0 0 0;">Sekretaris TP PKK <br> Tingkat Kelurahan</p>

            <!-- Tempat tanda tangan ketua PKK / statis atau ambil dari db jika ada -->
            <!-- Placeholder for now -->
            <img src="{{ asset('assets/images/ttd_ketua.png') }}" onerror="this.style.display='none'"
                class="signature-img" style="display: none;">
            <div style="height: 80px;"></div>

            <p style="margin: 6px;"><u>__________________</u></p>
        </div>
    </div>

</body>

</html>
