@extends('admin-temp.layout_ketua')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Ketua.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">{{ $source_label }}</li>
                        <li class="breadcrumb-item" aria-current="page">Agenda Surat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Agenda Surat - {{ $source_label }} <span class="badge bg-info">Lihat Saja</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="ti ti-alert-circle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Button Switcher Surat Masuk / Surat Keluar -->
        <ul class="nav nav-pills mb-3" id="agendaSuratTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="surat-masuk-tab" data-bs-toggle="pill" data-bs-target="#surat-masuk"
                    type="button" role="tab" aria-controls="surat-masuk" aria-selected="true">
                    <i class="ti ti-mail-forward me-1"></i> Surat Masuk
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="surat-keluar-tab" data-bs-toggle="pill" data-bs-target="#surat-keluar"
                    type="button" role="tab" aria-controls="surat-keluar" aria-selected="false">
                    <i class="ti ti-mail me-1"></i> Surat Keluar
                </button>
            </li>
        </ul>

        <div class="tab-content" id="agendaSuratTabContent">
            <!-- ==================== TABLE SURAT MASUK ==================== -->
            <div class="tab-pane fade show active" id="surat-masuk" role="tabpanel" aria-labelledby="surat-masuk-tab">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0 text-white">
                            <i class="ti ti-mail-forward me-2"></i>Buku Agenda Surat Masuk
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="basic-btn-suratm" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">NO</th>
                                        <th class="align-middle text-center">TANGGAL TERIMA<br>SURAT</th>
                                        <th class="align-middle text-center">TANGGAL<br>SURAT</th>
                                        <th class="align-middle text-center">NOMOR SURAT</th>
                                        <th class="align-middle text-center">ASAL SURAT / DARI</th>
                                        <th class="align-middle text-center">PERIHAL</th>
                                        <th class="align-middle text-center">LAMPIRAN</th>
                                        <th class="align-middle text-center">DITERUSKAN KEPADA</th>
                                    </tr>

                                    <!-- Baris Penomoran Kolom -->
                                    <tr class="bg-blue-200">
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">6</th>
                                        <th class="text-center">7</th>
                                        <th class="text-center">8</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surat_masuk ?? [] as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal_terima ? \Carbon\Carbon::parse($item->tanggal_terima)->translatedFormat('d/m/Y') : '-' }}
                                            </td>
                                            <td>{{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d/m/Y') : '-' }}
                                            </td>
                                            <td style="min-width: 200px; max-width: 400px; white-space: normal;">
                                                {{ $item->no_surat ?? '-' }}</td>
                                            <td style="min-width: 200px; max-width: 400px; white-space: normal;">
                                                {{ $item->asal_surat ?? '-' }}</td>
                                            <td style="min-width: 400px; max-width: 800px; white-space: normal;">
                                                {!! nl2br(e(\Illuminate\Support\Str::limit($item->perihal, 1000) ?? '-')) !!}</td>
                                            <td>{{ $item->lampiran ?? '-' }}</td>
                                            <td style="min-width: 100px; max-width: 200px; white-space: normal;">
                                                {{ $item->diteruskan_kepada ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== TABLE SURAT KELUAR ==================== -->
            <div class="tab-pane fade" id="surat-keluar" role="tabpanel" aria-labelledby="surat-keluar-tab">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0 text-white">
                            <i class="ti ti-mail me-2"></i>Buku Agenda Surat Keluar
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="basic-btn-suratk" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">NO</th>
                                        <th class="align-middle text-center">NO. DAN<br>KODE SURAT</th>
                                        <th class="align-middle text-center">TANGGAL<br>SURAT</th>
                                        <th class="align-middle text-center">KEPADA</th>
                                        <th class="align-middle text-center">PERIHAL</th>
                                        <th class="align-middle text-center">LAMPIRAN</th>
                                        <th class="align-middle text-center">TEMBUSAN</th>
                                    </tr>
                                    <!-- Baris Penomoran Kolom -->
                                    <tr class="bg-blue-200">
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">6</th>
                                        <th class="text-center">7</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surat_keluar ?? [] as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomor_kode_surat ?? '-' }}</td>
                                            <td>{{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d/m/Y') : '-' }}
                                            </td>
                                            <td style="min-width: 200px; max-width: 400px; white-space: normal;">
                                                {{ $item->kepada ?? '-' }}</td>
                                            <td style="min-width: 400px; max-width: 800px; white-space: normal;">
                                                {!! nl2br(e(\Illuminate\Support\Str::limit($item->perihal, 1000) ?? '-')) !!}</td>
                                            <td>{{ $item->lampiran ?? '-' }}</td>
                                            <td style="min-width: 100px; max-width: 200px; white-space: normal;">
                                                {{ $item->tembusan ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
