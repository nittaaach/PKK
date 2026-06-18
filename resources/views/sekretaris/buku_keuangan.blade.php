@extends('admin-temp.layout_sekretaris')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Sekretaris.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Buku Keuangan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Buku Keuangan</h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ti ti-alert-circle me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <div class="py-3">
                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                data-bs-target="#AddModal">
                                <i class="ti ti-plus me-1"></i> Tambah Data Keuangan
                            </button>
                            <button type="button" class="btn btn-success me-2" data-bs-toggle="modal"
                                data-bs-target="#ImportModal">
                                <i class="ti ti-file-import me-1"></i> Import File
                            </button>
                            <button class="btn btn-secondary" onclick="window.print()">
                                <i class="ti ti-printer me-1"></i> Print / Cetak
                            </button>
                        </div>
                        <div class="print-area">
                            <table id="basic-btn-keuangan" class="table table-striped table-bordered" style="width:100%;">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL, BULAN, TAHUN</th>
                                        <th>SUMBER DANA</th>
                                        <th>URAIAN</th>
                                        <th>BUKTI KAS</th>
                                        <th>PENERIMAAN (Rp)</th>
                                        <th>NO</th>
                                        <th>TANGGAL, BULAN, TAHUN</th>
                                        <th>SUMBER DANA</th>
                                        <th>URAIAN</th>
                                        <th>BUKTI KAS</th>
                                        <th>PENGELUARAN (Rp)</th>
                                        <th class="no-print">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_penerimaan = 0;
                                        $total_pengeluaran = 0;
                                    @endphp
                                    @foreach ($buku_keuangan as $index => $item)
                                        @php
                                            $total_penerimaan += $item->penerimaan ?? 0;
                                            $total_pengeluaran += $item->pengeluaran ?? 0;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $item->tanggal_penerimaan ? \Carbon\Carbon::parse($item->tanggal_penerimaan)->translatedFormat('d M Y') : '' }}
                                            </td>
                                            <td>{{ $item->sumber_dana_penerimaan }}</td>
                                            <td>{{ $item->uraian_penerimaan }}</td>
                                            <td>{{ $item->bukti_kas_penerimaan }}</td>
                                            <td class="text-end">
                                                {{ $item->penerimaan ? number_format($item->penerimaan, 0, ',', '.') : '' }}
                                            </td>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $item->tanggal_pengeluaran ? \Carbon\Carbon::parse($item->tanggal_pengeluaran)->translatedFormat('d M Y') : '' }}
                                            </td>
                                            <td>{{ $item->sumber_dana_pengeluaran }}</td>
                                            <td>{{ $item->uraian_pengeluaran }}</td>
                                            <td>{{ $item->bukti_kas_pengeluaran }}</td>
                                            <td class="text-end">
                                                {{ $item->pengeluaran ? number_format($item->pengeluaran, 0, ',', '.') : '' }}
                                            </td>
                                            <td class="no-print text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-primary ti ti-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdateAnggotaModal-{{ $item->id }}">
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger ti ti-trash"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeleteAnggotaModal-{{ $item->id }}">
                                                    </button>
                                                </div>
                                                {{-- <div class="dropdown">
                                                    <button class="btn btn-sm btn-light py-0 px-1" type="button" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#UpdateModal-{{ $item->id }}">Edit</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#DeleteModal-{{ $item->id }}">Hapus</a></li>
                                                    </ul>
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold bg-light">
                                        <td colspan="5" class="text-end pe-3">JUMLAH</td>
                                        <td class="text-end">Rp {{ number_format($total_penerimaan, 0, ',', '.') }}</td>
                                        <td colspan="5" class="text-end pe-3">JUMLAH</td>
                                        <td class="text-end">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td>
                                        <td class="no-print"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div id="ImportModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="ti ti-file-import me-2"></i>Import Data Keuangan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('buku_keuangan.import_sekretaris') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <strong><i class="ti ti-info-circle me-1"></i>Format file yang diterima:</strong>
                            <ul class="mb-1 mt-1">
                                <li><strong>.xlsx / .xls</strong> &mdash; Microsoft Excel</li>
                                <li><strong>.csv</strong> &mdash; Comma Separated Values</li>
                                <li><strong>.ods</strong> &mdash; LibreOffice / Google Spreadsheet</li>
                            </ul>
                        </div>
                        <div class="alert alert-warning small">
                            <i class="ti ti-table me-1"></i>
                            Pastikan header kolom file sesuai:<br>
                            <code>tanggal_penerimaan, sumber_dana_penerimaan, uraian_penerimaan, bukti_kas_penerimaan, penerimaan, tanggal_pengeluaran, sumber_dana_pengeluaran, uraian_pengeluaran, bukti_kas_pengeluaran, pengeluaran</code>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="import_file" id="import_file"
                                accept=".xlsx,.xls,.csv,.ods" required>
                            <div class="form-text">Ukuran maksimal: 5 MB</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-upload me-1"></i> Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="AddModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Keuangan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('buku_keuangan.store_sekretaris') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 border-end pe-4">
                                <h5 class="mb-3 text-success">Penerimaan</h5>
                                <div class="mb-3"><label class="form-label">Tanggal</label><input type="date"
                                        class="form-control" name="tanggal_penerimaan"></div>
                                <div class="mb-3"><label class="form-label">Sumber Dana</label><input type="text"
                                        class="form-control" name="sumber_dana_penerimaan"></div>
                                <div class="mb-3"><label class="form-label">Uraian</label>
                                    <textarea class="form-control" name="uraian_penerimaan" rows="3"></textarea>
                                </div>
                                <div class="mb-3"><label class="form-label">Bukti Kas</label><input type="text"
                                        class="form-control" name="bukti_kas_penerimaan"></div>
                                <div class="mb-3"><label class="form-label">Jumlah Penerimaan (Rp)</label><input
                                        type="number" class="form-control" name="penerimaan" min="0"></div>
                            </div>
                            <div class="col-md-6 ps-4">
                                <h5 class="mb-3 text-danger">Pengeluaran</h5>
                                <div class="mb-3"><label class="form-label">Tanggal</label><input type="date"
                                        class="form-control" name="tanggal_pengeluaran"></div>
                                <div class="mb-3"><label class="form-label">Sumber Dana</label><input type="text"
                                        class="form-control" name="sumber_dana_pengeluaran"></div>
                                <div class="mb-3"><label class="form-label">Uraian</label>
                                    <textarea class="form-control" name="uraian_pengeluaran" rows="3"></textarea>
                                </div>
                                <div class="mb-3"><label class="form-label">Bukti Kas</label><input type="text"
                                        class="form-control" name="bukti_kas_pengeluaran"></div>
                                <div class="mb-3"><label class="form-label">Jumlah Pengeluaran (Rp)</label><input
                                        type="number" class="form-control" name="pengeluaran" min="0"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($buku_keuangan as $item)
        <!-- Modal Update -->
        <div id="UpdateModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Edit Data Keuangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('buku_keuangan.update_sekretaris', $item->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 border-end pe-4">
                                    <h5 class="mb-3 text-success">Penerimaan</h5>
                                    <div class="mb-3"><label class="form-label">Tanggal</label><input type="date"
                                            class="form-control" name="tanggal_penerimaan"
                                            value="{{ $item->tanggal_penerimaan }}"></div>
                                    <div class="mb-3"><label class="form-label">Sumber Dana</label><input
                                            type="text" class="form-control" name="sumber_dana_penerimaan"
                                            value="{{ $item->sumber_dana_penerimaan }}"></div>
                                    <div class="mb-3"><label class="form-label">Uraian</label>
                                        <textarea class="form-control" name="uraian_penerimaan" rows="3">{{ $item->uraian_penerimaan }}</textarea>
                                    </div>
                                    <div class="mb-3"><label class="form-label">Bukti Kas</label><input type="text"
                                            class="form-control" name="bukti_kas_penerimaan"
                                            value="{{ $item->bukti_kas_penerimaan }}"></div>
                                    <div class="mb-3"><label class="form-label">Jumlah Penerimaan (Rp)</label><input
                                            type="number" class="form-control" name="penerimaan" min="0"
                                            value="{{ $item->penerimaan }}"></div>
                                </div>
                                <div class="col-md-6 ps-4">
                                    <h5 class="mb-3 text-danger">Pengeluaran</h5>
                                    <div class="mb-3"><label class="form-label">Tanggal</label><input type="date"
                                            class="form-control" name="tanggal_pengeluaran"
                                            value="{{ $item->tanggal_pengeluaran }}"></div>
                                    <div class="mb-3"><label class="form-label">Sumber Dana</label><input
                                            type="text" class="form-control" name="sumber_dana_pengeluaran"
                                            value="{{ $item->sumber_dana_pengeluaran }}"></div>
                                    <div class="mb-3"><label class="form-label">Uraian</label>
                                        <textarea class="form-control" name="uraian_pengeluaran" rows="3">{{ $item->uraian_pengeluaran }}</textarea>
                                    </div>
                                    <div class="mb-3"><label class="form-label">Bukti Kas</label><input type="text"
                                            class="form-control" name="bukti_kas_pengeluaran"
                                            value="{{ $item->bukti_kas_pengeluaran }}"></div>
                                    <div class="mb-3"><label class="form-label">Jumlah Pengeluaran (Rp)</label><input
                                            type="number" class="form-control" name="pengeluaran" min="0"
                                            value="{{ $item->pengeluaran }}"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Delete -->
        <div id="DeleteModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data Keuangan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('buku_keuangan.destroy_sekretaris', $item->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <div class="p-3 text-center">
                                <h5>Apakah Anda yakin ingin menghapus baris data ini?</h5>
                                <p class="text-muted small">Data penerimaan dan pengeluaran pada baris ini akan dihapus
                                    permanen.</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Ya,
                                    Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }

            @page {
                size: landscape;
                margin: 1cm;
            }
        }
    </style>
@endsection
