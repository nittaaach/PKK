@extends('admin-temp.layout_pokja_3')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_3.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Papan Data Pokja III</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Kegiatan PKK - Pokja III</h2>
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
                    <div class="py-3"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#AddPapanDataModal"><i class="ti ti-plus me-1"></i> Tambah Data</button></div>
                    <table id="basic-btn-papan" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="3" class="align-middle text-center">NO</th>
                                <th rowspan="3" class="align-middle text-center">NAMA WILAYAH</th>
                                <th colspan="3" class="text-center">JUMLAH KADER</th>
                                <th colspan="8" class="text-center">PANGAN</th>
                                <th colspan="3" class="text-center">JML INDUSTRI RT</th>
                                <th colspan="2" class="text-center">JUMLAH RUMAH</th>
                                <th rowspan="3" class="align-middle text-center">KET</th>
                                <th rowspan="3" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th rowspan="2" class="text-center">PANGAN</th>
                                <th rowspan="2" class="text-center">SANDANG</th>
                                <th rowspan="2" class="text-center">TATA LAKSANA RT</th>
                                <th colspan="2" class="text-center">MAKANAN POKOK</th>
                                <th colspan="6" class="text-center">PEMANFAATAN PEKARANGAN/HATINYA PKK</th>
                                <th rowspan="2" class="text-center">PANGAN</th>
                                <th rowspan="2" class="text-center">SANDANG</th>
                                <th rowspan="2" class="text-center">JASA</th>
                                <th rowspan="2" class="text-center">SEHAT</th>
                                <th rowspan="2" class="text-center">TDK SEHAT</th>
                            </tr>
                            <tr>
                                <th class="text-center">BERAS</th>
                                <th class="text-center">NON BERAS</th>
                                <th class="text-center">PETERNAKAN</th>
                                <th class="text-center">PERIKANAN</th>
                                <th class="text-center">WARUNG HIDUP</th>
                                <th class="text-center">LUMBUNG HIDUP</th>
                                <th class="text-center">TOGA</th>
                                <th class="text-center">TANAMAN KERAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($papan_data ?? [] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_wilayah ?? '-' }}</td>
                                    <td>{{ $item->kader_pangan ?? '-' }}</td>
                                    <td>{{ $item->kader_sandang ?? '-' }}</td>
                                    <td>{{ $item->kader_tata_laksana ?? '-' }}</td>
                                    <td>{{ $item->beras ?? '-' }}</td>
                                    <td>{{ $item->non_beras ?? '-' }}</td>
                                    <td>{{ $item->peternakan ?? '-' }}</td>
                                    <td>{{ $item->perikanan ?? '-' }}</td>
                                    <td>{{ $item->warung_hidup ?? '-' }}</td>
                                    <td>{{ $item->lumbung_hidup ?? '-' }}</td>
                                    <td>{{ $item->toga ?? '-' }}</td>
                                    <td>{{ $item->tanaman_keras ?? '-' }}</td>
                                    <td>{{ $item->industri_pangan ?? '-' }}</td>
                                    <td>{{ $item->industri_sandang ?? '-' }}</td>
                                    <td>{{ $item->industri_jasa ?? '-' }}</td>
                                    <td>{{ $item->rumah_sehat ?? '-' }}</td>
                                    <td>{{ $item->rumah_tidak_sehat ?? '-' }}</td>
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

    <div id="AddPapanDataModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Pokja III</h5><button type="button"
                        class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('papan_data.store_pokja3') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                    type="text" class="form-control" name="nama_wilayah" required></div>
                            <hr>
                            <h6>Jumlah Kader</h6>
                            <div class="col-md-4 mb-3"><label class="form-label">Pangan</label><input type="number"
                                    class="form-control" name="kader_pangan"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Sandang</label><input type="number"
                                    class="form-control" name="kader_sandang"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Tata Laksana RT</label><input
                                    type="number" class="form-control" name="kader_tata_laksana"></div>
                            <hr>
                            <h6>Pangan</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Beras</label><input type="number"
                                    class="form-control" name="beras"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Non Beras</label><input type="number"
                                    class="form-control" name="non_beras"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Peternakan</label><input type="number"
                                    class="form-control" name="peternakan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Perikanan</label><input type="number"
                                    class="form-control" name="perikanan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Warung Hidup</label><input
                                    type="number" class="form-control" name="warung_hidup"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Lumbung Hidup</label><input
                                    type="number" class="form-control" name="lumbung_hidup"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">TOGA</label><input type="number"
                                    class="form-control" name="toga"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Tanaman Keras</label><input
                                    type="number" class="form-control" name="tanaman_keras"></div>
                            <hr>
                            <h6>Industri RT & Rumah</h6>
                            <div class="col-md-4 mb-3"><label class="form-label">Industri Pangan</label><input
                                    type="number" class="form-control" name="industri_pangan"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Industri Sandang</label><input
                                    type="number" class="form-control" name="industri_sandang"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Industri Jasa</label><input
                                    type="number" class="form-control" name="industri_jasa"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Rumah Sehat</label><input type="number"
                                    class="form-control" name="rumah_sehat"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Rumah Tidak Sehat</label><input
                                    type="number" class="form-control" name="rumah_tidak_sehat"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button><button type="submit"
                            class="btn btn-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($papan_data ?? [] as $item)
        <div id="UpdatePapanDataModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Data Pokja III</h5><button type="button"
                            class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('papan_data.update_pokja3', $item->id) }}" method="POST">@csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                        type="text" class="form-control" name="nama_wilayah" required
                                        value="{{ $item->nama_wilayah }}"></div>
                                <hr>
                                <h6>Jumlah Kader</h6>
                                <div class="col-md-4 mb-3"><label class="form-label">Pangan</label><input type="number"
                                        class="form-control" name="kader_pangan" value="{{ $item->kader_pangan }}">
                                </div>
                                <div class="col-md-4 mb-3"><label class="form-label">Sandang</label><input type="number"
                                        class="form-control" name="kader_sandang" value="{{ $item->kader_sandang }}">
                                </div>
                                <div class="col-md-4 mb-3"><label class="form-label">Tata Laksana RT</label><input
                                        type="number" class="form-control" name="kader_tata_laksana"
                                        value="{{ $item->kader_tata_laksana }}"></div>
                                <hr>
                                <h6>Pangan</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Beras</label><input type="number"
                                        class="form-control" name="beras" value="{{ $item->beras }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Non Beras</label><input
                                        type="number" class="form-control" name="non_beras"
                                        value="{{ $item->non_beras }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Peternakan</label><input
                                        type="number" class="form-control" name="peternakan"
                                        value="{{ $item->peternakan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Perikanan</label><input
                                        type="number" class="form-control" name="perikanan"
                                        value="{{ $item->perikanan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Warung Hidup</label><input
                                        type="number" class="form-control" name="warung_hidup"
                                        value="{{ $item->warung_hidup }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Lumbung Hidup</label><input
                                        type="number" class="form-control" name="lumbung_hidup"
                                        value="{{ $item->lumbung_hidup }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">TOGA</label><input type="number"
                                        class="form-control" name="toga" value="{{ $item->toga }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Tanaman Keras</label><input
                                        type="number" class="form-control" name="tanaman_keras"
                                        value="{{ $item->tanaman_keras }}"></div>
                                <hr>
                                <h6>Industri RT & Rumah</h6>
                                <div class="col-md-4 mb-3"><label class="form-label">Industri Pangan</label><input
                                        type="number" class="form-control" name="industri_pangan"
                                        value="{{ $item->industri_pangan }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Industri Sandang</label><input
                                        type="number" class="form-control" name="industri_sandang"
                                        value="{{ $item->industri_sandang }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Industri Jasa</label><input
                                        type="number" class="form-control" name="industri_jasa"
                                        value="{{ $item->industri_jasa }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Rumah Sehat</label><input
                                        type="number" class="form-control" name="rumah_sehat"
                                        value="{{ $item->rumah_sehat }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Rumah Tidak Sehat</label><input
                                        type="number" class="form-control" name="rumah_tidak_sehat"
                                        value="{{ $item->rumah_tidak_sehat }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" rows="5">{{ $item->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Batal</button><button type="submit"
                                class="btn btn-primary">Simpan</button></div>
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
                        <form action="{{ route('papan_data.destroy_pokja3', $item->id) }}" method="POST">@csrf
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
