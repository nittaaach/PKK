@extends('admin-temp.layout_pokja_3')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_3.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">GPTP</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Gerakan Perempuan Tanam dan Pelihara Pohon (GPTP)</h2>
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
                                <th rowspan="2" class="align-middle text-center">JENIS TANAMAN</th>
                                <th rowspan="2" class="align-middle text-center">JUMLAH</th>
                                <th rowspan="2" class="align-middle text-center">LOKASI TANAMAN</th>
                                <th rowspan="2" class="align-middle text-center">BANTUAN (TANGGAL)</th>
                                <th colspan="2" class="text-center">KONDISI</th>
                                <th rowspan="2" class="align-middle text-center">KETERANGAN</th>
                                <th rowspan="2" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th class="text-center">HIDUP</th>
                                <th class="text-center">MATI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data ?? [] as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->jenis_tanaman ?? '-' }}</td>
                                    <td>{{ $item->jumlah ?? '-' }}</td>
                                    <td>{{ $item->lokasi_tanaman ?? '-' }}</td>
                                    <td>{{ $item->tanggal_bantuan ?? '-' }}</td>
                                    <td class="text-center">{{ $item->kondisi_hidup ? '√' : '-' }}</td>
                                    <td class="text-center">{{ $item->kondisi_mati ? '√' : '-' }}</td>
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data GPTP</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('gptp.store_pokja3') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label">Jenis Tanaman</label><input type="text" class="form-control" name="jenis_tanaman"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Jumlah</label><input type="text" class="form-control" name="jumlah"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Lokasi Tanaman</label><input type="text" class="form-control" name="lokasi_tanaman"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Bantuan (Tanggal)</label><input type="text" class="form-control" name="tanggal_bantuan" placeholder="cth: Sudin KPKP / 2 Januari 2025"></div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Kondisi Hidup</label>
                                <select class="form-select" name="kondisi_hidup">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya (√)</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Kondisi Mati</label>
                                <select class="form-select" name="kondisi_mati">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya (√)</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="3"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data ?? [] as $item)
        <div id="UpdateModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Edit Data GPTP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('gptp.update_pokja3', $item->id) }}" method="POST">@csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Jenis Tanaman</label><input type="text" class="form-control" name="jenis_tanaman" value="{{ $item->jenis_tanaman }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Jumlah</label><input type="text" class="form-control" name="jumlah" value="{{ $item->jumlah }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Lokasi Tanaman</label><input type="text" class="form-control" name="lokasi_tanaman" value="{{ $item->lokasi_tanaman }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Bantuan (Tanggal)</label><input type="text" class="form-control" name="tanggal_bantuan" value="{{ $item->tanggal_bantuan }}"></div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Kondisi Hidup</label>
                                    <select class="form-select" name="kondisi_hidup">
                                        <option value="0" {{ !$item->kondisi_hidup ? 'selected' : '' }}>Tidak</option>
                                        <option value="1" {{ $item->kondisi_hidup ? 'selected' : '' }}>Ya (√)</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Kondisi Mati</label>
                                    <select class="form-select" name="kondisi_mati">
                                        <option value="0" {{ !$item->kondisi_mati ? 'selected' : '' }}>Tidak</option>
                                        <option value="1" {{ $item->kondisi_mati ? 'selected' : '' }}>Ya (√)</option>
                                    </select>
                                </div>
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
                        <form action="{{ route('gptp.destroy_pokja3', $item->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="text-center p-3"><h5>Hapus data <strong class="text-danger">{{ $item->jenis_tanaman }}</strong>?</h5></div>
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
                <form action="{{ route('Pokja_3.import_gptp') }}" method="POST" enctype="multipart/form-data">
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