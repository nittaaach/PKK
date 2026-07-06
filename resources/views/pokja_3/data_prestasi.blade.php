@extends('admin-temp.layout_pokja_3')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_3.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Data Prestasi</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Buku Data Prestasi</h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu - Pokja III</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="ti ti-alert-circle me-1"></i> {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="py-3">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="ti ti-plus me-1"></i> Tambah Data</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ImportModal"><i class="ti ti-file-import me-1"></i> Import File</button>
                    </div>
                    <table id="basic-btn" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle text-center">NO</th>
                                <th rowspan="2" class="align-middle text-center">TGL/TAHUN LOMBA</th>
                                <th rowspan="2" class="align-middle text-center">NAMA PESERTA</th>
                                <th rowspan="2" class="align-middle text-center">NAMA LOMBA</th>
                                <th rowspan="2" class="align-middle text-center">PRESTASI YANG DIRAIH</th>
                                <th rowspan="2" class="align-middle text-center">TEMPAT DILAKSANAKAN</th>
                                <th colspan="4" class="text-center">TINGKAT</th>
                                <th rowspan="2" class="align-middle text-center">KET</th>
                                <th rowspan="2" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th class="text-center">KELURAHAN</th>
                                <th class="text-center">KECAMATAN</th>
                                <th class="text-center">KOTA</th>
                                <th class="text-center">PROVINSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data ?? [] as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->tgl_tahun_lomba ?? '-' }}</td>
                                    <td>{{ $item->nama_peserta ?? '-' }}</td>
                                    <td>{{ $item->nama_lomba ?? '-' }}</td>
                                    <td>{{ $item->prestasi ?? '-' }}</td>
                                    <td>{{ $item->tempat ?? '-' }}</td>
                                    <td class="text-center">{{ $item->tingkat_kelurahan ?? '-' }}</td>
                                    <td class="text-center">{{ $item->tingkat_kecamatan ?? '-' }}</td>
                                    <td class="text-center">{{ $item->tingkat_kota ?? '-' }}</td>
                                    <td class="text-center">{{ $item->tingkat_provinsi ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit" data-bs-toggle="modal" data-bs-target="#UpdateModal-{{ $item->id }}"></button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash" data-bs-toggle="modal" data-bs-target="#DeleteModal-{{ $item->id }}"></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div id="AddModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Prestasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('data_prestasi.store_pokja3') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label">Tgl/Tahun Lomba</label><input type="text" class="form-control" name="tgl_tahun_lomba" placeholder="cth: 12 Maret 2025"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Nama Peserta</label><input type="text" class="form-control" name="nama_peserta"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Nama Lomba</label><input type="text" class="form-control" name="nama_lomba"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Prestasi yang Diraih</label><input type="text" class="form-control" name="prestasi"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Tempat Dilaksanakan</label><input type="text" class="form-control" name="tempat"></div>
                            <div class="col-md-12 mb-2"><h6 class="fw-bold">Tingkat</h6></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Kelurahan</label><input type="text" class="form-control" name="tingkat_kelurahan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Kecamatan</label><input type="text" class="form-control" name="tingkat_kecamatan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Kota</label><input type="text" class="form-control" name="tingkat_kota"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Provinsi</label><input type="text" class="form-control" name="tingkat_provinsi"></div>
                            <div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="3"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Update & Delete --}}
    @foreach ($data ?? [] as $item)
        <div id="UpdateModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Edit Data Prestasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('data_prestasi.update_pokja3', $item->id) }}" method="POST">@csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Tgl/Tahun Lomba</label><input type="text" class="form-control" name="tgl_tahun_lomba" value="{{ $item->tgl_tahun_lomba }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Nama Peserta</label><input type="text" class="form-control" name="nama_peserta" value="{{ $item->nama_peserta }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Nama Lomba</label><input type="text" class="form-control" name="nama_lomba" value="{{ $item->nama_lomba }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Prestasi yang Diraih</label><input type="text" class="form-control" name="prestasi" value="{{ $item->prestasi }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Tempat Dilaksanakan</label><input type="text" class="form-control" name="tempat" value="{{ $item->tempat }}"></div>
                                <div class="col-md-12 mb-2"><h6 class="fw-bold">Tingkat</h6></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Kelurahan</label><input type="text" class="form-control" name="tingkat_kelurahan" value="{{ $item->tingkat_kelurahan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Kecamatan</label><input type="text" class="form-control" name="tingkat_kecamatan" value="{{ $item->tingkat_kecamatan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Kota</label><input type="text" class="form-control" name="tingkat_kota" value="{{ $item->tingkat_kota }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Provinsi</label><input type="text" class="form-control" name="tingkat_provinsi" value="{{ $item->tingkat_provinsi }}"></div>
                                <div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="3">{{ $item->keterangan }}</textarea></div>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-warning">Update</button></div>
                    </form>
                </div>
            </div>
        </div>
        <div id="DeleteModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('data_prestasi.destroy_pokja3', $item->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="text-center p-3"><h5>Hapus data prestasi <strong class="text-danger">{{ $item->nama_lomba ?? $item->nama_peserta }}</strong>?</h5></div>
                            <div class="modal-footer justify-content-center"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Hapus</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Import -->
    <div id="ImportModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import File Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('Pokja_3.import_data_prestasi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Pastikan format file excel sesuai dengan urutan kolom di tabel. Data akan dibaca dari baris pertama yang berisi angka di kolom No.
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih File (Excel / CSV)</label>
                            <input type="file" class="form-control" name="import_file" accept=".xlsx, .xls, .csv" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection