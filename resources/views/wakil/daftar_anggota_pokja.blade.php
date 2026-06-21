@extends('admin-temp.layout_wakil')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Wakil.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">{{ $pokja_label }}</li>
                        <li class="breadcrumb-item" aria-current="page">Daftar Anggota</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Daftar Anggota - {{ $pokja_label }} <span class="badge bg-info">Lihat Saja</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-sm-12">
        <div class="card"><div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="basic-btn-da" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>NO</th><th>NO. REGISTRASI</th><th>NAMA</th><th>L/P</th>
                            <th>KEDUDUKAN</th><th>KADER UMUM</th><th>KADER KHUSUS</th>
                            <th>TGL LAHIR/UMUR</th><th>STATUS</th><th>ALAMAT</th>
                            <th>PENDIDIKAN</th><th>PEKERJAAN</th><th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->no_registrasi ?? '-' }}</td>
                                <td>
                                    <strong>{{ strtoupper($item->name) }}</strong><br>
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" style="width:60px;height:75px;object-fit:cover;margin-top:4px;">
                                    @endif
                                </td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ strtoupper($item->role_pkk) }} <br> {{ strtoupper($item->keanggotaan_tp_pkk) }}</td>
                                <td>{{ $item->kader_umum ? 'V' : '-' }}</td>
                                <td>{{ $item->kader_khusus ? 'V' : '-' }}</td>
                                <td>{{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('F Y') : '-' }} / {{ $item->umur ?? '-' }}</td>
                                <td>{{ strtoupper($item->status_perkawinan ?? '-') }}</td>
                                <td style="max-width:200px;white-space:normal;">{{ strtoupper($item->alamat ?? '-') }}</td>
                                <td>{{ strtoupper($item->pendidikan ?? '-') }}</td>
                                <td>{{ strtoupper($item->pekerjaan ?? '-') }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                        <tfoot>
                            <tr class="fw-bold bg-light">
                                <th colspan="2" class="text-center align-middle">JUMLAH</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center">{{ $anggota->sum('umur') ?: '-' }}</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div></div>
    </div></div>
@endsection
