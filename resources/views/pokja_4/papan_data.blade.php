@extends('admin-temp.layout_pokja_4')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_4.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Papan Data Pokja IV</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Kegiatan PKK - Pokja IV</h2>
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
                            data-bs-target="#AddPapanDataModal"><i class="ti ti-plus me-1"></i> Tambah Data</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#ImportModal"><i class="ti ti-file-import me-1"></i> Import File</button>
                    </div>
                    <table id="basic-btn-papan" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="3" class="align-middle text-center">NO</th>
                                <th rowspan="3" class="align-middle text-center">NAMA WILAYAH</th>
                                <th colspan="6" class="text-center">JUMLAH KADER</th>
                                <th colspan="5" class="text-center">KESEHATAN</th>
                                <th colspan="6" class="text-center">KELESTARIAN LINGKUNGAN HIDUP</th>
                                <th colspan="4" class="text-center">PERENCANAAN SEHAT</th>
                                <th rowspan="3" class="align-middle text-center">KET</th>
                                <th rowspan="3" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th rowspan="2" class="text-center">POSYANDU</th>
                                <th rowspan="2" class="text-center">GIZI</th>
                                <th rowspan="2" class="text-center">KESLING</th>
                                <th rowspan="2" class="text-center">NARKOBA</th>
                                <th rowspan="2" class="text-center">PHBS</th>
                                <th rowspan="2" class="text-center">KB</th>
                                <th rowspan="2" class="text-center">JML POSYANDU</th>
                                <th rowspan="2" class="text-center">TERINTEGRASI</th>
                                <th colspan="2" class="text-center">LANSIA</th>
                                <th rowspan="2" class="text-center">BEROBAT GRATIS</th>
                                <th rowspan="2" class="text-center">JAMBAN</th>
                                <th rowspan="2" class="text-center">SPAL</th>
                                <th rowspan="2" class="text-center">SAMPAH</th>
                                <th rowspan="2" class="text-center">PDAM</th>
                                <th rowspan="2" class="text-center">SUMUR</th>
                                <th rowspan="2" class="text-center">LAIN</th>
                                <th rowspan="2" class="text-center">JML PUS</th>
                                <th rowspan="2" class="text-center">JML WUS</th>
                                <th colspan="2" class="text-center">AKSEPTOR KB</th>
                            </tr>
                            <tr>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">ANGGOTA</th>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($papan_data ?? [] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_wilayah ?? '-' }}</td>
                                    <td>{{ $item->kader_posyandu ?? '-' }}</td>
                                    <td>{{ $item->kader_gizi ?? '-' }}</td>
                                    <td>{{ $item->kader_kesling ?? '-' }}</td>
                                    <td>{{ $item->kader_narkoba ?? '-' }}</td>
                                    <td>{{ $item->kader_phbs ?? '-' }}</td>
                                    <td>{{ $item->kader_kb ?? '-' }}</td>
                                    <td>{{ $item->jml_posyandu ?? '-' }}</td>
                                    <td>{{ $item->terintegrasi ?? '-' }}</td>
                                    <td>{{ $item->lansia_jml_klp ?? '-' }}</td>
                                    <td>{{ $item->lansia_anggota ?? '-' }}</td>
                                    <td>{{ $item->berobat_gratis ?? '-' }}</td>
                                    <td>{{ $item->jamban ?? '-' }}</td>
                                    <td>{{ $item->spal ?? '-' }}</td>
                                    <td>{{ $item->sampah ?? '-' }}</td>
                                    <td>{{ $item->pdam ?? '-' }}</td>
                                    <td>{{ $item->sumur ?? '-' }}</td>
                                    <td>{{ $item->air_lain ?? '-' }}</td>
                                    <td>{{ $item->jml_pus ?? '-' }}</td>
                                    <td>{{ $item->jml_wus ?? '-' }}</td>
                                    <td>{{ $item->akseptor_kb_l ?? '-' }}</td>
                                    <td>{{ $item->akseptor_kb_p ?? '-' }}</td>
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

    @include('admin-temp.partials.import_modal', [
        'importRoute' => 'papan_data.import_pokja4',
        'title'       => 'Import Papan Data Pokja 4',
        'columns'     => 'nama_wilayah, kader_posyandu, kader_gizi, kader_kesling, kader_narkoba, kader_phbs, kader_kb, jml_posyandu, terintegrasi, lansia_jml_klp, lansia_anggota, berobat_gratis, jamban, spal, sampah, pdam, sumur, air_lain, jml_pus, jml_wus, akseptor_kb_l, akseptor_kb_p, keterangan',
    ])

    <div id="AddPapanDataModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Pokja IV</h5><button type="button"
                        class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('papan_data.store_pokja4') }}" method="POST">@csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                    type="text" class="form-control" name="nama_wilayah" required></div>
                            <hr>
                            <h6>Jumlah Kader</h6>
                            <div class="col-md-4 mb-3"><label class="form-label">Posyandu</label><input type="number"
                                    class="form-control" name="kader_posyandu"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Gizi</label><input type="number"
                                    class="form-control" name="kader_gizi"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Kesling</label><input type="number"
                                    class="form-control" name="kader_kesling"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">Narkoba</label><input type="number"
                                    class="form-control" name="kader_narkoba"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">PHBS</label><input type="number"
                                    class="form-control" name="kader_phbs"></div>
                            <div class="col-md-4 mb-3"><label class="form-label">KB</label><input type="number"
                                    class="form-control" name="kader_kb"></div>
                            <hr>
                            <h6>Kesehatan</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Jml Posyandu</label><input
                                    type="number" class="form-control" name="jml_posyandu"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Terintegrasi</label><input
                                    type="number" class="form-control" name="terintegrasi"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Lansia Jml KLP</label><input
                                    type="number" class="form-control" name="lansia_jml_klp"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Lansia Anggota</label><input
                                    type="number" class="form-control" name="lansia_anggota"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Berobat Gratis</label><input
                                    type="number" class="form-control" name="berobat_gratis"></div>
                            <hr>
                            <h6>Lingkungan Hidup</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Jamban</label><input type="number"
                                    class="form-control" name="jamban"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">SPAL</label><input type="number"
                                    class="form-control" name="spal"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Sampah</label><input type="number"
                                    class="form-control" name="sampah"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PDAM</label><input type="number"
                                    class="form-control" name="pdam"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Sumur</label><input type="number"
                                    class="form-control" name="sumur"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Lain-lain</label><input type="number"
                                    class="form-control" name="air_lain"></div>
                            <hr>
                            <h6>Perencanaan Sehat</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Jml PUS</label><input type="number"
                                    class="form-control" name="jml_pus"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Jml WUS</label><input type="number"
                                    class="form-control" name="jml_wus"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Akseptor KB L</label><input
                                    type="number" class="form-control" name="akseptor_kb_l"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Akseptor KB P</label><input
                                    type="number" class="form-control" name="akseptor_kb_p"></div>
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

    @foreach ($papan_data ?? [] as $item)
        <div id="UpdatePapanDataModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Data Pokja IV</h5><button type="button"
                            class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('papan_data.update_pokja4', $item->id) }}" method="POST">@csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input
                                        type="text" class="form-control" name="nama_wilayah" required
                                        value="{{ $item->nama_wilayah }}"></div>
                                <hr>
                                <h6>Jumlah Kader</h6>
                                <div class="col-md-4 mb-3"><label class="form-label">Posyandu</label><input
                                        type="number" class="form-control" name="kader_posyandu"
                                        value="{{ $item->kader_posyandu }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Gizi</label><input type="number"
                                        class="form-control" name="kader_gizi" value="{{ $item->kader_gizi }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Kesling</label><input type="number"
                                        class="form-control" name="kader_kesling" value="{{ $item->kader_kesling }}">
                                </div>
                                <div class="col-md-4 mb-3"><label class="form-label">Narkoba</label><input type="number"
                                        class="form-control" name="kader_narkoba" value="{{ $item->kader_narkoba }}">
                                </div>
                                <div class="col-md-4 mb-3"><label class="form-label">PHBS</label><input type="number"
                                        class="form-control" name="kader_phbs" value="{{ $item->kader_phbs }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">KB</label><input type="number"
                                        class="form-control" name="kader_kb" value="{{ $item->kader_kb }}"></div>
                                <hr>
                                <h6>Kesehatan</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Jml Posyandu</label><input
                                        type="number" class="form-control" name="jml_posyandu"
                                        value="{{ $item->jml_posyandu }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Terintegrasi</label><input
                                        type="number" class="form-control" name="terintegrasi"
                                        value="{{ $item->terintegrasi }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Lansia Jml KLP</label><input
                                        type="number" class="form-control" name="lansia_jml_klp"
                                        value="{{ $item->lansia_jml_klp }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Lansia Anggota</label><input
                                        type="number" class="form-control" name="lansia_anggota"
                                        value="{{ $item->lansia_anggota }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Berobat Gratis</label><input
                                        type="number" class="form-control" name="berobat_gratis"
                                        value="{{ $item->berobat_gratis }}"></div>
                                <hr>
                                <h6>Lingkungan Hidup</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Jamban</label><input type="number"
                                        class="form-control" name="jamban" value="{{ $item->jamban }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">SPAL</label><input type="number"
                                        class="form-control" name="spal" value="{{ $item->spal }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Sampah</label><input type="number"
                                        class="form-control" name="sampah" value="{{ $item->sampah }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PDAM</label><input type="number"
                                        class="form-control" name="pdam" value="{{ $item->pdam }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Sumur</label><input type="number"
                                        class="form-control" name="sumur" value="{{ $item->sumur }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Lain-lain</label><input
                                        type="number" class="form-control" name="air_lain"
                                        value="{{ $item->air_lain }}"></div>
                                <hr>
                                <h6>Perencanaan Sehat</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Jml PUS</label><input type="number"
                                        class="form-control" name="jml_pus" value="{{ $item->jml_pus }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Jml WUS</label><input type="number"
                                        class="form-control" name="jml_wus" value="{{ $item->jml_wus }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Akseptor KB L</label><input
                                        type="number" class="form-control" name="akseptor_kb_l"
                                        value="{{ $item->akseptor_kb_l }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Akseptor KB P</label><input
                                        type="number" class="form-control" name="akseptor_kb_p"
                                        value="{{ $item->akseptor_kb_p }}"></div>
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

        <div id="DeletePapanDataModal-{{ $item->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Hapus Data</h5><button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('papan_data.destroy_pokja4', $item->id) }}" method="POST">@csrf
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
