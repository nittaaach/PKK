@extends('admin-temp.layout_wakil')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Wakil.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">{{ $source_label }}</li>
                        <li class="breadcrumb-item" aria-current="page">Agenda Surat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Agenda Surat - {{ $source_label }} <span class="badge bg-info">Lihat Saja</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Surat Masuk</h5>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="surat-masuk-tbl" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>TGL TERIMA</th>
                                    <th>TGL SURAT</th>
                                    <th>NO SURAT</th>
                                    <th>ASAL SURAT</th>
                                    <th>PERIHAL</th>
                                    <th>LAMPIRAN</th>
                                    <th>DITERUSKAN KEPADA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat_masuk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal_terima ? \Carbon\Carbon::parse($item->tanggal_terima)->translatedFormat('d M Y') : '-' }}
                                        </td>
                                        <td>{{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d M Y') : '-' }}
                                        </td>
                                        <td>{{ $item->no_surat ?? '-' }}</td>
                                        <td>{{ $item->asal_surat ?? '-' }}</td>
                                        <td style="max-width:250px;white-space:normal;">{{ $item->perihal }}</td>
                                        <td>{{ $item->lampiran ?? '-' }}</td>
                                        <td>{{ $item->diteruskan_kepada ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Surat Keluar</h5>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="surat-keluar-tbl" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NOMOR/KODE SURAT</th>
                                    <th>TGL SURAT</th>
                                    <th>KEPADA</th>
                                    <th>PERIHAL</th>
                                    <th>LAMPIRAN</th>
                                    <th>TEMBUSAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat_keluar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nomor_kode_surat ?? '-' }}</td>
                                        <td>{{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d M Y') : '-' }}
                                        </td>
                                        <td>{{ $item->kepada ?? '-' }}</td>
                                        <td style="max-width:250px;white-space:normal;">{{ $item->perihal }}</td>
                                        <td>{{ $item->lampiran ?? '-' }}</td>
                                        <td>{{ $item->tembusan ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
