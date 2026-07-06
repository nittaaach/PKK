@extends('admin-temp.layout_pokja_3')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_3.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Program Kerja</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Buku Program / Rencana Kegiatan Pokja III</h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu</p>
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
                                <th  class="align-middle text-center">NO</th>
                                <th  class="align-middle text-center">PROGRAM POKOK</th>
                                <th  class="align-middle text-center">PROGRAM PRIORITAS</th>
                                <th  class="align-middle text-center">JENIS KEGIATAN</th>
                                <th  class="align-middle text-center">TUJUAN</th>
                                <th  class="align-middle text-center">OUTPUT / HASIL</th>
                                <th  class="align-middle text-center">SASARAN</th>
                                <th  class="align-middle text-center">VOLUME</th>
                                <th  class="align-middle text-center">LOKASI</th>
                                <th  class="align-middle text-center">JADWAL KEGIATAN</th>
                                <th  class="align-middle text-center">MITRA / LEMBAGA</th>
                                <th  class="align-middle text-center">KET</th>
                                <th  class="align-middle text-center">ACTION</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            @foreach ($data ?? [] as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->program_pokok ?? '-' }}</td>
                                    <td>{{ $item->program_prioritas ?? '-' }}</td>
                                    <td>{{ $item->jenis_kegiatan ?? '-' }}</td>
                                    <td style="min-width:200px; white-space:normal">{{ $item->tujuan ?? '-' }}</td>
                                    <td style="min-width:200px; white-space:normal">{{ $item->output_hasil ?? '-' }}</td>
                                    <td>{{ $item->sasaran ?? '-' }}</td>
                                    <td>{{ $item->volume ?? '-' }}</td>
                                    <td>{{ $item->lokasi ?? '-' }}</td>
                                    <td>{{ $item->jadwal_kegiatan ?? '-' }}</td>
                                    <td>{{ $item->mitra_lembaga ?? '-' }}</td>
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
                    <h5 class="modal-title">Tambah Program Kerja</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('program_kerja.store_pokja3') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label">Program Pokok</label><input type="text" class="form-control" name="program_pokok" placeholder="cth: Pangan, Sandang, Tata Laksana RT"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Program Prioritas</label><input type="text" class="form-control" name="program_prioritas"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Jenis Kegiatan</label><input type="text" class="form-control" name="jenis_kegiatan"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Tujuan</label><textarea class="form-control" name="tujuan" rows="3"></textarea></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Output / Hasil</label><textarea class="form-control" name="output_hasil" rows="3"></textarea></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Sasaran</label><input type="text" class="form-control" name="sasaran"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Volume</label><input type="text" class="form-control" name="volume"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="lokasi"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Jadwal Kegiatan</label><input type="text" class="form-control" name="jadwal_kegiatan"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Mitra / Lembaga</label><input type="text" class="form-control" name="mitra_lembaga"></div>
                            <div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="2"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data ?? [] as $item)
        <div id="UpdateModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Edit Program Kerja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('program_kerja.update_pokja3', $item->id) }}" method="POST">@csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Program Pokok</label><input type="text" class="form-control" name="program_pokok" value="{{ $item->program_pokok }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Program Prioritas</label><input type="text" class="form-control" name="program_prioritas" value="{{ $item->program_prioritas }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Jenis Kegiatan</label><input type="text" class="form-control" name="jenis_kegiatan" value="{{ $item->jenis_kegiatan }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Tujuan</label><textarea class="form-control" name="tujuan" rows="3">{{ $item->tujuan }}</textarea></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Output / Hasil</label><textarea class="form-control" name="output_hasil" rows="3">{{ $item->output_hasil }}</textarea></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Sasaran</label><input type="text" class="form-control" name="sasaran" value="{{ $item->sasaran }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Volume</label><input type="text" class="form-control" name="volume" value="{{ $item->volume }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Lokasi</label><input type="text" class="form-control" name="lokasi" value="{{ $item->lokasi }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Jadwal Kegiatan</label><input type="text" class="form-control" name="jadwal_kegiatan" value="{{ $item->jadwal_kegiatan }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Mitra / Lembaga</label><input type="text" class="form-control" name="mitra_lembaga" value="{{ $item->mitra_lembaga }}"></div>
                                <div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="2">{{ $item->keterangan }}</textarea></div>
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
                        <form action="{{ route('program_kerja.destroy_pokja3', $item->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="text-center p-3"><h5>Hapus data <strong class="text-danger">{{ $item->program_prioritas ?? $item->jenis_kegiatan }}</strong>?</h5></div>
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
                <form action="{{ route('Pokja_3.import_program_kerja') }}" method="POST" enctype="multipart/form-data">
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