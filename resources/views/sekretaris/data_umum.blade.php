@extends('admin-temp.layout_sekretaris')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Sekretaris.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Data Umum PKK</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Umum PKK</h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu - Kecamatan Makasar - Kota Jakarta Timur
                            - Provinsi DKI Jakarta</p>
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
                            data-bs-target="#AddDataUmumModal"><i class="ti ti-plus me-1"></i> Tambah Data</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#ImportModal"><i class="ti ti-file-import me-1"></i> Import File</button>
                    </div>
                    <table id="basic-btn-umum" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="3" class="align-middle text-center">NO</th>
                                <th rowspan="3" class="align-middle text-center">NAMA WILAYAH</th>
                                <th colspan="3" class="text-center">JUMLAH KELOMPOK</th>
                                <th colspan="2" class="text-center">JUMLAH</th>
                                <th colspan="2" class="text-center">JUMLAH JIWA</th>
                                <th colspan="6" class="text-center">JUMLAH KADER</th>
                                <th colspan="4" class="text-center">TENAGA KERJA SEKRETARIAT</th>
                                <th rowspan="3" class="align-middle text-center">KET</th>
                                <th rowspan="3" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th rowspan="2" class="text-center">PKK RW</th>
                                <th rowspan="2" class="text-center">PKK RT</th>
                                <th rowspan="2" class="text-center">DASA WISMA</th>
                                <th rowspan="2" class="text-center">KRT</th>
                                <th rowspan="2" class="text-center">KK</th>
                                <th rowspan="2" class="text-center">L</th>
                                <th rowspan="2" class="text-center">P</th>
                                <th colspan="2" class="text-center">ANGGOTA TP PKK</th>
                                <th colspan="2" class="text-center">UMUM</th>
                                <th colspan="2" class="text-center">KHUSUS</th>
                                <th colspan="2" class="text-center">HONORER</th>
                                <th colspan="2" class="text-center">BANTUAN</th>
                            </tr>
                            <tr>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_umum ?? [] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_wilayah ?? '-' }}</td>
                                    <td>{{ $item->pkk_rw ?? '-' }}</td>
                                    <td>{{ $item->pkk_rt ?? '-' }}</td>
                                    <td>{{ $item->dasa_wisma ?? '-' }}</td>
                                    <td>{{ $item->krt ?? '-' }}</td>
                                    <td>{{ $item->kk ?? '-' }}</td>
                                    <td>{{ $item->jiwa_l ?? '-' }}</td>
                                    <td>{{ $item->jiwa_p ?? '-' }}</td>
                                    <td>{{ $item->kader_tp_pkk_l ?? '-' }}</td>
                                    <td>{{ $item->kader_tp_pkk_p ?? '-' }}</td>
                                    <td>{{ $item->kader_umum_l ?? '-' }}</td>
                                    <td>{{ $item->kader_umum_p ?? '-' }}</td>
                                    <td>{{ $item->kader_khusus_l ?? '-' }}</td>
                                    <td>{{ $item->kader_khusus_p ?? '-' }}</td>
                                    <td>{{ $item->honorer_l ?? '-' }}</td>
                                    <td>{{ $item->honorer_p ?? '-' }}</td>
                                    <td>{{ $item->bantuan_l ?? '-' }}</td>
                                    <td>{{ $item->bantuan_p ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#UpdateDataUmumModal-{{ $item->id }}"></button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeleteDataUmumModal-{{ $item->id }}"></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold bg-light">
                                <th colspan="2" class="text-center align-middle">JUMLAH</th>
                                <th class="text-center">{{ $data_umum->sum('pkk_rw') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('pkk_rt') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('dasa_wisma') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('krt') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('kk') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('jiwa_l') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('jiwa_p') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('kader_tp_pkk_l') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('kader_tp_pkk_p') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('kader_umum_l') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('kader_umum_p') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('kader_khusus_l') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('kader_khusus_p') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('honorer_l') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('honorer_p') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('bantuan_l') ?: '-' }}</th>
                                <th class="text-center">{{ $data_umum->sum('bantuan_p') ?: '-' }}</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin-temp.partials.import_modal', [
        'importRoute' => 'data_umum.import_sekretaris',
        'title'       => 'Import Data Umum PKK',
        'columns'     => 'nama_wilayah, pkk_rw, pkk_rt, dasa_wisma, krt, kk, jiwa_l, jiwa_p, kader_tp_pkk_l, kader_tp_pkk_p, kader_umum_l, kader_umum_p, kader_khusus_l, kader_khusus_p, honorer_l, honorer_p, bantuan_l, bantuan_p, keterangan',
    ])

    <div id="AddDataUmumModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Umum PKK</h5><button type="button"
                        class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('data_umum.store_sekretaris') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                    type="text" class="form-control" name="nama_wilayah" required></div>
                            <hr>
                            <h6>Jumlah Kelompok</h6>
                            <div class="col-md-4 mb-3"><label class="form-label">PKK RW</label><input type="number"
                                    class="form-control" name="pkk_rw"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">PKK RT</label><input type="number"
                                    class="form-control" name="pkk_rt"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Dasa Wisma</label><input type="number"
                                    class="form-control" name="dasa_wisma"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">KRT</label><input type="number"
                                    class="form-control" name="krt"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">KK</label><input type="number"
                                    class="form-control" name="kk"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Jiwa L</label><input type="number"
                                    class="form-control" name="jiwa_l"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Jiwa P</label><input type="number"
                                    class="form-control" name="jiwa_p"></div>
                            <hr>
                            <h6>Jumlah Kader</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">TP PKK L</label><input type="number"
                                    class="form-control" name="kader_tp_pkk_l"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">TP PKK P</label><input type="number"
                                    class="form-control" name="kader_tp_pkk_p"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Umum L</label><input type="number"
                                    class="form-control" name="kader_umum_l"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Umum P</label><input type="number"
                                    class="form-control" name="kader_umum_p"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Khusus L</label><input type="number"
                                    class="form-control" name="kader_khusus_l"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Khusus P</label><input type="number"
                                    class="form-control" name="kader_khusus_p"></div>
                            <hr>
                            <h6>Tenaga Kerja Sekretariat</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Honorer L</label><input type="number"
                                    class="form-control" name="honorer_l"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Honorer P</label><input type="number"
                                    class="form-control" name="honorer_p"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Bantuan L</label><input type="number"
                                    class="form-control" name="bantuan_l"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Bantuan P</label><input type="number"
                                    class="form-control" name="bantuan_p"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Keterangan</label>
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

    @foreach ($data_umum ?? [] as $item)
        <div id="UpdateDataUmumModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Data Umum PKK</h5><button type="button"
                            class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('data_umum.update_sekretaris', $item->id) }}" method="POST">@csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                        type="text" class="form-control" name="nama_wilayah" required
                                        value="{{ $item->nama_wilayah }}"></div>
                                <hr>
                                <h6>Jumlah Kelompok</h6>
                                <div class="col-md-4 mb-3"><label class="form-label">PKK RW</label><input type="number"
                                        class="form-control" name="pkk_rw" value="{{ $item->pkk_rw }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">PKK RT</label><input type="number"
                                        class="form-control" name="pkk_rt" value="{{ $item->pkk_rt }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Dasa Wisma</label><input
                                        type="number" class="form-control" name="dasa_wisma"
                                        value="{{ $item->dasa_wisma }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">KRT</label><input type="number"
                                        class="form-control" name="krt" value="{{ $item->krt }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">KK</label><input type="number"
                                        class="form-control" name="kk" value="{{ $item->kk }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Jiwa L</label><input type="number"
                                        class="form-control" name="jiwa_l" value="{{ $item->jiwa_l }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Jiwa P</label><input type="number"
                                        class="form-control" name="jiwa_p" value="{{ $item->jiwa_p }}"></div>
                                <hr>
                                <h6>Jumlah Kader</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">TP PKK L</label><input
                                        type="number" class="form-control" name="kader_tp_pkk_l"
                                        value="{{ $item->kader_tp_pkk_l }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">TP PKK P</label><input
                                        type="number" class="form-control" name="kader_tp_pkk_p"
                                        value="{{ $item->kader_tp_pkk_p }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Umum L</label><input type="number"
                                        class="form-control" name="kader_umum_l" value="{{ $item->kader_umum_l }}">
                                </div>
                                <div class="col-md-3 mb-3"><label class="form-label">Umum P</label><input type="number"
                                        class="form-control" name="kader_umum_p" value="{{ $item->kader_umum_p }}">
                                </div>
                                <div class="col-md-3 mb-3"><label class="form-label">Khusus L</label><input
                                        type="number" class="form-control" name="kader_khusus_l"
                                        value="{{ $item->kader_khusus_l }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Khusus P</label><input
                                        type="number" class="form-control" name="kader_khusus_p"
                                        value="{{ $item->kader_khusus_p }}"></div>
                                <hr>
                                <h6>Tenaga Kerja Sekretariat</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Honorer L</label><input
                                        type="number" class="form-control" name="honorer_l"
                                        value="{{ $item->honorer_l }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Honorer P</label><input
                                        type="number" class="form-control" name="honorer_p"
                                        value="{{ $item->honorer_p }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Bantuan L</label><input
                                        type="number" class="form-control" name="bantuan_l"
                                        value="{{ $item->bantuan_l }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Bantuan P</label><input
                                        type="number" class="form-control" name="bantuan_p"
                                        value="{{ $item->bantuan_p }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Keterangan</label>
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

        <div id="DeleteDataUmumModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data</h5><button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('data_umum.destroy_sekretaris', $item->id) }}" method="POST">@csrf
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
