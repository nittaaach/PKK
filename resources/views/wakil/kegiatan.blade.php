@extends('admin-temp.layout_wakil')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Wakil.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">{{ $source_label }}</li>
                        <li class="breadcrumb-item" aria-current="page">Kegiatan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Kegiatan - {{ $source_label }} <span class="badge bg-info">Lihat Saja</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-sm-12">
        <div class="card"><div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="basic-btn" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr><th>NO</th><th>NAMA</th><th>JABATAN</th><th>KATEGORI</th><th>TANGGAL</th><th>TEMPAT</th><th>URAIAN</th><th>TANDA TANGAN</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jabatan ?? '-' }}</td>
                                <td>{{ $item->kategori ?? '-' }}</td>
                                <td>{{ $item->tanggal_kegiatan ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d M Y') : '-' }}</td>
                                <td>{{ $item->tempat ?? '-' }}</td>
                                <td style="max-width:300px;white-space:normal;">{{ $item->uraian }}</td>
                                <td>
                                    @if ($item->tanda_tangan)
                                        <img src="{{ asset('storage/' . $item->tanda_tangan) }}" style="width:80px;height:60px;object-fit:contain;">
                                    @else - @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div></div>
    </div></div>
@endsection
