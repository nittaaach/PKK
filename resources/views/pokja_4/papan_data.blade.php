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
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
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
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#AddPapanDataModal"><i class="ti ti-plus me-1"></i> Tambah Data</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ImportModal"><i class="ti ti-file-import me-1"></i> Import File</button>
                    </div>
                    <table id="basic-btn-papan" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="4" class="align-middle text-center">NO</th>
                                <th rowspan="4" class="align-middle text-center">NAMA WILAYAH</th>
                                <th colspan="6" class="text-center">JUMLAH KADER</th>
                                <th colspan="5" class="text-center">KESEHATAN</th>
                                <th colspan="7" class="text-center">KELESTARIAN LINGKUNGAN HIDUP</th>
                                <th colspan="5" class="text-center">PERENCANAAN SEHAT</th>
                                <th rowspan="4" class="align-middle text-center">KET</th>
                                <th rowspan="4" class="align-middle text-center">ACTION</th>
                            </tr>
                            <tr>
                                <th rowspan="3" class="align-middle text-center">POSYANDU</th>
                                <th rowspan="3" class="align-middle text-center">GIZI</th>
                                <th rowspan="3" class="align-middle text-center">KESLING</th>
                                <th rowspan="3" class="align-middle text-center">PENYULUHAN NARKOBA</th>
                                <th rowspan="3" class="align-middle text-center">PHBS</th>
                                <th rowspan="3" class="align-middle text-center">KB</th>
                                <th colspan="5" class="text-center">POSYANDU</th>
                                <th colspan="3" class="text-center">JUMLAH RUMAH YANG MEMILIKI</th>
                                <th rowspan="3" class="align-middle text-center">JUMLAH MCK</th>
                                <th colspan="3" class="text-center">SUMBER AIR</th>
                                <th rowspan="3" class="align-middle text-center">JUMLAH PUS</th>
                                <th rowspan="3" class="align-middle text-center">JUMLAH WUS</th>
                                <th colspan="2" class="text-center">JUMLAH AKSEPTOR KB</th>
                                <th rowspan="3" class="align-middle text-center">JML KK YG MEMILIKI TABUNGAN KELUARGA</th>
                            </tr>
                            <tr>
                                <th rowspan="2" class="align-middle text-center">JUMLAH</th>
                                <th rowspan="2" class="align-middle text-center">TERINTEGRASI</th>
                                <th colspan="3" class="text-center">LANSIA</th>
                                <th rowspan="2" class="align-middle text-center">JAMBAN</th>
                                <th rowspan="2" class="align-middle text-center">SPAL</th>
                                <th rowspan="2" class="align-middle text-center">TEMPAT PEMBUANGAN SAMPAH</th>
                                <th rowspan="2" class="align-middle text-center">PDAM</th>
                                <th rowspan="2" class="align-middle text-center">SUMUR</th>
                                <th rowspan="2" class="align-middle text-center">LAIN-LAIN</th>
                                <th rowspan="2" class="align-middle text-center">L</th>
                                <th rowspan="2" class="align-middle text-center">P</th>
                            </tr>
                            <tr>
                                <th class="text-center">JML KLP</th>
                                <th class="text-center">JML ANGGOTA</th>
                                <th class="text-center">JML YANG MEMILIKI KARTU BEROBAT</th>
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
                                    <td>{{ $item->jml_mck ?? '-' }}</td>
                                    <td>{{ $item->pdam ?? '-' }}</td>
                                    <td>{{ $item->sumur ?? '-' }}</td>
                                    <td>{{ $item->air_lain ?? '-' }}</td>
                                    <td>{{ $item->jml_pus ?? '-' }}</td>
                                    <td>{{ $item->jml_wus ?? '-' }}</td>
                                    <td>{{ $item->akseptor_kb_l ?? '-' }}</td>
                                    <td>{{ $item->akseptor_kb_p ?? '-' }}</td>
                                    <td>{{ $item->tabungan_keluarga ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-primary ti ti-edit" data-bs-toggle="modal" data-bs-target="#UpdatePapanDataModal-{{ $item->id }}"></button>
                                            <button type="button" class="btn btn-sm btn-danger ti ti-trash" data-bs-toggle="modal" data-bs-target="#DeletePapanDataModal-{{ $item->id }}"></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="fw-bold bg-light">
                                <th colspan="2" class="text-center align-middle">JUMLAH</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('kader_posyandu')) ? ($papan_data->sum('kader_posyandu') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('kader_gizi')) ? ($papan_data->sum('kader_gizi') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('kader_kesling')) ? ($papan_data->sum('kader_kesling') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('kader_narkoba')) ? ($papan_data->sum('kader_narkoba') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('kader_phbs')) ? ($papan_data->sum('kader_phbs') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('kader_kb')) ? ($papan_data->sum('kader_kb') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('jml_posyandu')) ? ($papan_data->sum('jml_posyandu') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('terintegrasi')) ? ($papan_data->sum('terintegrasi') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('lansia_jml_klp')) ? ($papan_data->sum('lansia_jml_klp') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('lansia_anggota')) ? ($papan_data->sum('lansia_anggota') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('berobat_gratis')) ? ($papan_data->sum('berobat_gratis') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('jamban')) ? ($papan_data->sum('jamban') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('spal')) ? ($papan_data->sum('spal') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('sampah')) ? ($papan_data->sum('sampah') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('jml_mck')) ? ($papan_data->sum('jml_mck') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('pdam')) ? ($papan_data->sum('pdam') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('sumur')) ? ($papan_data->sum('sumur') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('air_lain')) ? ($papan_data->sum('air_lain') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('jml_pus')) ? ($papan_data->sum('jml_pus') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('jml_wus')) ? ($papan_data->sum('jml_wus') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('akseptor_kb_l')) ? ($papan_data->sum('akseptor_kb_l') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('akseptor_kb_p')) ? ($papan_data->sum('akseptor_kb_p') ?: '-') : '' }}</th>
                                <th class="text-center">{{ is_numeric($papan_data->sum('tabungan_keluarga')) ? ($papan_data->sum('tabungan_keluarga') ?: '-') : '' }}</th>
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
        'importRoute' => 'papan_data.import_pokja4',
        'title'       => 'Import Papan Data Pokja 4',
        'columns'     => 'nama_wilayah, kader_posyandu, kader_gizi, kader_kesling, kader_narkoba, kader_phbs, kader_kb, jml_posyandu, terintegrasi, lansia_jml_klp, lansia_anggota, berobat_gratis, jamban, spal, sampah, jml_mck, pdam, sumur, air_lain, jml_pus, jml_wus, akseptor_kb_l, akseptor_kb_p, tabungan_keluarga, keterangan',
    ])

    <!-- Modal Tambah -->
    <div id="AddPapanDataModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Pokja IV</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('papan_data.store_pokja4') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
<div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input type="text" class="form-control" name="nama_wilayah" required></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Posyandu</label><input type="number" class="form-control" name="kader_posyandu"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Gizi</label><input type="number" class="form-control" name="kader_gizi"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Kesling</label><input type="number" class="form-control" name="kader_kesling"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Penyuluhan Narkoba</label><input type="number" class="form-control" name="kader_narkoba"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader PHBS</label><input type="number" class="form-control" name="kader_phbs"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader KB</label><input type="number" class="form-control" name="kader_kb"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jml Posyandu</label><input type="number" class="form-control" name="jml_posyandu"></div>
<div class="col-md-3 mb-3"><label class="form-label">Posyandu Terintegrasi</label><input type="number" class="form-control" name="terintegrasi"></div>
<div class="col-md-3 mb-3"><label class="form-label">Lansia Jml Klp</label><input type="number" class="form-control" name="lansia_jml_klp"></div>
<div class="col-md-3 mb-3"><label class="form-label">Lansia Jml Anggota</label><input type="number" class="form-control" name="lansia_anggota"></div>
<div class="col-md-3 mb-3"><label class="form-label">Lansia Memiliki Kartu Berobat</label><input type="number" class="form-control" name="berobat_gratis"></div>
<div class="col-md-3 mb-3"><label class="form-label">Rumah Memiliki Jamban</label><input type="number" class="form-control" name="jamban"></div>
<div class="col-md-3 mb-3"><label class="form-label">Rumah Memiliki SPAL</label><input type="number" class="form-control" name="spal"></div>
<div class="col-md-3 mb-3"><label class="form-label">Rumah Memiliki Tempat Sampah</label><input type="number" class="form-control" name="sampah"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jumlah MCK</label><input type="number" class="form-control" name="jml_mck"></div>
<div class="col-md-3 mb-3"><label class="form-label">Sumber Air PDAM</label><input type="number" class="form-control" name="pdam"></div>
<div class="col-md-3 mb-3"><label class="form-label">Sumber Air Sumur</label><input type="number" class="form-control" name="sumur"></div>
<div class="col-md-3 mb-3"><label class="form-label">Sumber Air Lain-lain</label><input type="number" class="form-control" name="air_lain"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jumlah PUS</label><input type="number" class="form-control" name="jml_pus"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jumlah WUS</label><input type="number" class="form-control" name="jml_wus"></div>
<div class="col-md-3 mb-3"><label class="form-label">Akseptor KB (L)</label><input type="number" class="form-control" name="akseptor_kb_l"></div>
<div class="col-md-3 mb-3"><label class="form-label">Akseptor KB (P)</label><input type="number" class="form-control" name="akseptor_kb_p"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jml KK Memiliki Tabungan Keluarga</label><input type="number" class="form-control" name="tabungan_keluarga"></div>
<div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="3"></textarea></div>

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
                        <h5 class="modal-title">Update Data Pokja IV</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('papan_data.update_pokja4', $item->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
<div class="col-md-4 mb-3"><label class="form-label">Nama Wilayah *</label><input type="text" class="form-control" name="nama_wilayah" value="{{ $item->nama_wilayah }}" required></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Posyandu</label><input type="number" class="form-control" name="kader_posyandu" value="{{ $item->kader_posyandu }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Gizi</label><input type="number" class="form-control" name="kader_gizi" value="{{ $item->kader_gizi }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Kesling</label><input type="number" class="form-control" name="kader_kesling" value="{{ $item->kader_kesling }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader Penyuluhan Narkoba</label><input type="number" class="form-control" name="kader_narkoba" value="{{ $item->kader_narkoba }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader PHBS</label><input type="number" class="form-control" name="kader_phbs" value="{{ $item->kader_phbs }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Kader KB</label><input type="number" class="form-control" name="kader_kb" value="{{ $item->kader_kb }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jml Posyandu</label><input type="number" class="form-control" name="jml_posyandu" value="{{ $item->jml_posyandu }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Posyandu Terintegrasi</label><input type="number" class="form-control" name="terintegrasi" value="{{ $item->terintegrasi }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Lansia Jml Klp</label><input type="number" class="form-control" name="lansia_jml_klp" value="{{ $item->lansia_jml_klp }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Lansia Jml Anggota</label><input type="number" class="form-control" name="lansia_anggota" value="{{ $item->lansia_anggota }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Lansia Memiliki Kartu Berobat</label><input type="number" class="form-control" name="berobat_gratis" value="{{ $item->berobat_gratis }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Rumah Memiliki Jamban</label><input type="number" class="form-control" name="jamban" value="{{ $item->jamban }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Rumah Memiliki SPAL</label><input type="number" class="form-control" name="spal" value="{{ $item->spal }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Rumah Memiliki Tempat Sampah</label><input type="number" class="form-control" name="sampah" value="{{ $item->sampah }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jumlah MCK</label><input type="number" class="form-control" name="jml_mck" value="{{ $item->jml_mck }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Sumber Air PDAM</label><input type="number" class="form-control" name="pdam" value="{{ $item->pdam }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Sumber Air Sumur</label><input type="number" class="form-control" name="sumur" value="{{ $item->sumur }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Sumber Air Lain-lain</label><input type="number" class="form-control" name="air_lain" value="{{ $item->air_lain }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jumlah PUS</label><input type="number" class="form-control" name="jml_pus" value="{{ $item->jml_pus }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jumlah WUS</label><input type="number" class="form-control" name="jml_wus" value="{{ $item->jml_wus }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Akseptor KB (L)</label><input type="number" class="form-control" name="akseptor_kb_l" value="{{ $item->akseptor_kb_l }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Akseptor KB (P)</label><input type="number" class="form-control" name="akseptor_kb_p" value="{{ $item->akseptor_kb_p }}"></div>
<div class="col-md-3 mb-3"><label class="form-label">Jml KK Memiliki Tabungan Keluarga</label><input type="number" class="form-control" name="tabungan_keluarga" value="{{ $item->tabungan_keluarga }}"></div>
<div class="col-md-12 mb-3"><label class="form-label">Keterangan</label><textarea class="form-control" name="keterangan" rows="3">{{ $item->keterangan }}</textarea></div>

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
                        <h5 class="modal-title">Hapus Data</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('papan_data.destroy_pokja4', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="text-center p-3">
                                <h5>Hapus data <strong class="text-danger">{{ $item->nama_wilayah }}</strong>?</h5>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger"><i class="ti ti-trash"></i> Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection