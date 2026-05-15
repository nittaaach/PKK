@extends('admin-temp.layout_pokja_1')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_1.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Papan Data Pokja I</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Papan Data Pokja I</h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button
                    type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="py-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#AddPapanDataModal"><i class="ti ti-plus me-1"></i> Tambah Data</button>
                    </div>
                    <table id="basic-btn-papan" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="3" class="align-middle text-center">NO</th>
                                <th rowspan="3" class="align-middle text-center">NAMA WILAYAH</th>
                                <th colspan="3" class="text-center">JUMLAH KADER</th>
                                <th colspan="8" class="text-center">PENGHAYATAN PENGAMALAN PANCASILA</th>
                                <th colspan="5" class="text-center">GOTONG ROYONG</th>
                                <th rowspan="3" class="align-middle text-center">KET</th>
                                <th rowspan="3" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th rowspan="2" class="text-center">PKBN</th>
                                <th rowspan="2" class="text-center">PKDRT</th>
                                <th rowspan="2" class="text-center">POLA ASUH</th>
                                <th colspan="2" class="text-center">PKBN</th>
                                <th colspan="2" class="text-center">PKDRT</th>
                                <th colspan="2" class="text-center">POLA ASUH</th>
                                <th colspan="2" class="text-center">LANSIA</th>
                                <th rowspan="2" class="text-center">KERJA BAKTI</th>
                                <th rowspan="2" class="text-center">RUKUN KEMATIAN</th>
                                <th rowspan="2" class="text-center">KEAGAMAAN</th>
                                <th rowspan="2" class="text-center">JIMPITAN</th>
                                <th rowspan="2" class="text-center">ARISAN</th>
                            </tr>
                            <tr>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">JML ANGGOTA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">JML ANGGOTA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">JML ANGGOTA</th>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">JML ANGGOTA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($papan_data ?? [] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_wilayah ?? '-' }}</td>
                                    <td>{{ $item->kader_pkbn ?? '-' }}</td>
                                    <td>{{ $item->kader_pkdrt ?? '-' }}</td>
                                    <td>{{ $item->kader_pola_asuh ?? '-' }}</td>
                                    <td>{{ $item->pkbn_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->pkbn_jml_anggota ?? '-' }}</td>
                                    <td>{{ $item->pkdrt_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->pkdrt_jml_anggota ?? '-' }}</td>
                                    <td>{{ $item->pola_asuh_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->pola_asuh_jml_anggota ?? '-' }}</td>
                                    <td>{{ $item->lansia_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->lansia_jml_anggota ?? '-' }}</td>
                                    <td>{{ $item->kerja_bakti ?? '-' }}</td>
                                    <td>{{ $item->rukun_kematian ?? '-' }}</td>
                                    <td>{{ $item->keagamaan ?? '-' }}</td>
                                    <td>{{ $item->jimpitan ?? '-' }}</td>
                                    <td>{{ $item->arisan ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#UpdatePapanDataModal-{{ $item->id }}"></button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeletePapanDataModal-{{ $item->id }}"></button>
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

    <!-- Modal Tambah -->
    <div id="AddPapanDataModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Pokja I</h5><button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('papan_data.store_pokja1') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                    type="text" class="form-control" name="nama_wilayah" required></div>
                            <hr>
                            <h6>Jumlah Kader</h6>
                            <div class="col-md-4 mb-3"><label class="form-label">PKBN</label><input type="number"
                                    class="form-control" name="kader_pkbn"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">PKDRT</label><input type="number"
                                    class="form-control" name="kader_pkdrt"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Pola Asuh</label><input type="number"
                                    class="form-control" name="kader_pola_asuh"></div>
                            <hr>
                            <h6>Penghayatan Pengamalan Pancasila</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">PKBN Jml Klp</label><input
                                    type="number" class="form-control" name="pkbn_jml_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PKBN Jml Anggota</label><input
                                    type="number" class="form-control" name="pkbn_jml_anggota"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PKDRT Jml Klp</label><input
                                    type="number" class="form-control" name="pkdrt_jml_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PKDRT Jml Anggota</label><input
                                    type="number" class="form-control" name="pkdrt_jml_anggota"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Pola Asuh Jml Klp</label><input
                                    type="number" class="form-control" name="pola_asuh_jml_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Pola Asuh Jml Anggota</label><input
                                    type="number" class="form-control" name="pola_asuh_jml_anggota"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Lansia Jml Klp</label><input
                                    type="number" class="form-control" name="lansia_jml_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Lansia Jml Anggota</label><input
                                    type="number" class="form-control" name="lansia_jml_anggota"></div>
                            <hr>
                            <h6>Gotong Royong</h6>
                            <div class="col-md-4 mb-3"><label class="form-label">Kerja Bakti</label><input type="number"
                                    class="form-control" name="kerja_bakti"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Rukun Kematian</label><input
                                    type="number" class="form-control" name="rukun_kematian"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Keagamaan</label><input type="number"
                                    class="form-control" name="keagamaan"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Jimpitan</label><input type="number"
                                    class="form-control" name="jimpitan"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Arisan</label><input type="number"
                                    class="form-control" name="arisan"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="5"></textarea>
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

    @foreach ($papan_data ?? [] as $item)
        <div id="UpdatePapanDataModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Data Pokja I</h5><button type="button"
                            class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('papan_data.update_pokja1', $item->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                        type="text" class="form-control" name="nama_wilayah" required
                                        value="{{ $item->nama_wilayah }}"></div>
                                <hr>
                                <h6>Jumlah Kader</h6>
                                <div class="col-md-4 mb-3"><label class="form-label">PKBN</label><input type="number"
                                        class="form-control" name="kader_pkbn" value="{{ $item->kader_pkbn }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">PKDRT</label><input type="number"
                                        class="form-control" name="kader_pkdrt" value="{{ $item->kader_pkdrt }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Pola Asuh</label><input
                                        type="number" class="form-control" name="kader_pola_asuh"
                                        value="{{ $item->kader_pola_asuh }}"></div>
                                <hr>
                                <h6>Penghayatan Pengamalan Pancasila</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">PKBN Jml Klp</label><input
                                        type="number" class="form-control" name="pkbn_jml_klp"
                                        value="{{ $item->pkbn_jml_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PKBN Jml Anggota</label><input
                                        type="number" class="form-control" name="pkbn_jml_anggota"
                                        value="{{ $item->pkbn_jml_anggota }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PKDRT Jml Klp</label><input
                                        type="number" class="form-control" name="pkdrt_jml_klp"
                                        value="{{ $item->pkdrt_jml_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PKDRT Jml Anggota</label><input
                                        type="number" class="form-control" name="pkdrt_jml_anggota"
                                        value="{{ $item->pkdrt_jml_anggota }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Pola Asuh Jml Klp</label><input
                                        type="number" class="form-control" name="pola_asuh_jml_klp"
                                        value="{{ $item->pola_asuh_jml_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Pola Asuh Jml Anggota</label><input
                                        type="number" class="form-control" name="pola_asuh_jml_anggota"
                                        value="{{ $item->pola_asuh_jml_anggota }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Lansia Jml Klp</label><input
                                        type="number" class="form-control" name="lansia_jml_klp"
                                        value="{{ $item->lansia_jml_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Lansia Jml Anggota</label><input
                                        type="number" class="form-control" name="lansia_jml_anggota"
                                        value="{{ $item->lansia_jml_anggota }}"></div>
                                <hr>
                                <h6>Gotong Royong</h6>
                                <div class="col-md-4 mb-3"><label class="form-label">Kerja Bakti</label><input
                                        type="number" class="form-control" name="kerja_bakti"
                                        value="{{ $item->kerja_bakti }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Rukun Kematian</label><input
                                        type="number" class="form-control" name="rukun_kematian"
                                        value="{{ $item->rukun_kematian }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Keagamaan</label><input
                                        type="number" class="form-control" name="keagamaan"
                                        value="{{ $item->keagamaan }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Jimpitan</label><input
                                        type="number" class="form-control" name="jimpitan"
                                        value="{{ $item->jimpitan }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Arisan</label><input type="number"
                                        class="form-control" name="arisan" value="{{ $item->arisan }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" rows="5">{{ $item->keterangan }}</textarea>
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

        <div id="DeletePapanDataModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data</h5><button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('papan_data.destroy_pokja1', $item->id) }}" method="POST">@csrf
                            @method('DELETE')
                            <div class="text-center p-3">
                                <h5>Hapus data <strong class="text-danger">{{ $item->nama_wilayah }}</strong>?</h5>
                            </div>
                            <div class="modal-footer justify-content-center"><button type="button"
                                    class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button
                                    type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

