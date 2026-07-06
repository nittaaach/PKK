@extends('admin-temp.layout_pokja_3')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_3.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Notulen</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Notulen Rapat</h2>
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
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="ti ti-plus me-1"></i> Tambah Notulen</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ImportModal"><i class="ti ti-file-import me-1"></i> Import File</button>
                    </div>
                    <table id="basic-btn" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">DASAR</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">WAKTU</th>
                                <th class="text-center">TEMPAT</th>
                                <th class="text-center">ACARA</th>
                                <th class="text-center">PIMPINAN RAPAT</th>
                                <th class="text-center">PESERTA</th>
                                <th class="text-center">ISI NOTULEN</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data ?? [] as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->dasar ?? '-' }}</td>
                                    <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}</td>
                                    <td>{{ $item->waktu ?? '-' }}</td>
                                    <td>{{ $item->tempat ?? '-' }}</td>
                                    <td>{{ $item->acara ?? '-' }}</td>
                                    <td>{{ $item->pimpinan_rapat ?? '-' }}</td>
                                    <td style="min-width:200px; white-space:normal">{!! nl2br(e($item->peserta ?? '-')) !!}</td>
                                    <td style="min-width:300px; white-space:normal">{!! nl2br(e(\Illuminate\Support\Str::limit($item->isi_notulen, 300) ?? '-')) !!}</td>
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

    <div id="AddModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Notulen Rapat</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('notulen.store_pokja3') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label">Dasar (No. Surat)</label><input type="text" class="form-control" name="dasar" placeholder="cth: 001/Pokja III/PKK.Kec/I/2025"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Waktu</label><input type="text" class="form-control" name="waktu" placeholder="cth: 09.00 s.d Selesai"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Tempat</label><input type="text" class="form-control" name="tempat"></div>
                            <div class="col-md-12 mb-3"><label class="form-label">Acara</label><input type="text" class="form-control" name="acara"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Pimpinan Rapat</label><input type="text" class="form-control" name="pimpinan_rapat"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Peserta</label><textarea class="form-control" name="peserta" rows="4" placeholder="Satu per baris"></textarea></div>
                            <div class="col-md-12 mb-3"><label class="form-label">Isi Notulen</label><textarea class="form-control" name="isi_notulen" rows="8"></textarea></div>
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
                        <h5 class="modal-title">Edit Notulen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('notulen.update_pokja3', $item->id) }}" method="POST">@csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Dasar (No. Surat)</label><input type="text" class="form-control" name="dasar" value="{{ $item->dasar }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Tanggal</label><input type="date" class="form-control" name="tanggal" value="{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') : '' }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Waktu</label><input type="text" class="form-control" name="waktu" value="{{ $item->waktu }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Tempat</label><input type="text" class="form-control" name="tempat" value="{{ $item->tempat }}"></div>
                                <div class="col-md-12 mb-3"><label class="form-label">Acara</label><input type="text" class="form-control" name="acara" value="{{ $item->acara }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Pimpinan Rapat</label><input type="text" class="form-control" name="pimpinan_rapat" value="{{ $item->pimpinan_rapat }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Peserta</label><textarea class="form-control" name="peserta" rows="4">{{ $item->peserta }}</textarea></div>
                                <div class="col-md-12 mb-3"><label class="form-label">Isi Notulen</label><textarea class="form-control" name="isi_notulen" rows="8">{{ $item->isi_notulen }}</textarea></div>
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
                        <form action="{{ route('notulen.destroy_pokja3', $item->id) }}" method="POST">@csrf @method('DELETE')
                            <div class="text-center p-3"><h5>Hapus notulen <strong class="text-danger">{{ $item->acara }}</strong>?</h5></div>
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
                <form action="{{ route('Pokja_3.import_notulen') }}" method="POST" enctype="multipart/form-data">
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