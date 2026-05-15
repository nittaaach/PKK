@extends('admin-temp.layout_sekretaris')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Sekretaris.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Papan Data / Catatan Data Kegiatan Warga</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Catatan Data dan Kegiatan Warga</h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <div class="py-3">
                        <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#AddPapanDataModal">
                            <i class="ti ti-plus me-1"></i> Tambah Data
                        </button>
                    </div>
                    <table id="#basic-btn-papan" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <!-- Baris 1 -->
                            <tr>
                                <th rowspan="3" class="align-middle text-center">NO</th>
                                <th rowspan="3" class="align-middle text-center">NOMOR RW</th>
                                <th rowspan="3" class="align-middle text-center">JUML.<br>RT</th>
                                <th rowspan="3" class="align-middle text-center">JUMLAH<br>DASA WISMA</th>
                                <th rowspan="3" class="align-middle text-center">JUML.<br>KRT</th>
                                <th rowspan="3" class="align-middle text-center">JUML.<br>KK</th>
                                <th colspan="11" class="align-middle text-center">JUMLAH ANGGOTA KELUARGA</th>
                                <th colspan="6" class="align-middle text-center">JUMLAH RUMAH</th>
                                <th colspan="3" class="align-middle text-center">SUMBER AIR</th>
                                <th colspan="2" class="align-middle text-center">MAKANAN POKOK</th>
                                <th colspan="4" class="align-middle text-center">WARGA MENGIKUTI KEGIATAN</th>
                                <th rowspan="3" class="align-middle text-center">KET</th>
                                <th rowspan="3" class="align-middle text-center">ACTION</th>
                            </tr>
                            <!-- Baris 2 -->
                            <tr>
                                <th colspan="2" class="text-center align-middle">TOTAL</th>
                                <th colspan="2" class="text-center align-middle">BALITA</th>
                                <!-- Tambahkan rowspan="2" di sini agar menembus baris 3 -->
                                <th rowspan="2" class="text-center align-middle">PUS</th>
                                <th rowspan="2" class="text-center align-middle">WUS</th>
                                <th rowspan="2" class="text-center align-middle">IBU HAMIL</th>
                                <th rowspan="2" class="text-center align-middle">IBU MENYUSUI</th>
                                <th rowspan="2" class="text-center align-middle">LANSIA</th>
                                <th rowspan="2" class="text-center align-middle">3 BUTA</th>
                                <th rowspan="2" class="text-center align-middle">BERKEBUTUHAN KHUSUS</th>
                                <th rowspan="2" class="text-center align-middle">SEHAT</th>
                                <th rowspan="2" class="text-center align-middle">TDK SEHAT</th>
                                <th rowspan="2" class="text-center align-middle">PEMB. SAMPAH</th>
                                <th rowspan="2" class="text-center align-middle">SPAL</th>
                                <th rowspan="2" class="text-center align-middle">JAMBAN</th>
                                <th rowspan="2" class="text-center align-middle">STIKER P4K</th>
                                <th rowspan="2" class="text-center align-middle">PDAM</th>
                                <th rowspan="2" class="text-center align-middle">SUMUR</th>
                                <th rowspan="2" class="text-center align-middle">DLL</th>
                                <th rowspan="2" class="text-center align-middle">BERAS</th>
                                <th rowspan="2" class="text-center align-middle">NON BERAS</th>
                                <th rowspan="2" class="text-center align-middle">UP2K</th>
                                <th rowspan="2" class="text-center align-middle">PEKARANGAN</th>
                                <th rowspan="2" class="text-center align-middle">IND. IRT</th>
                                <th rowspan="2" class="text-center align-middle">KES. LINGK.</th>
                            </tr>
                            <!-- Baris 3 -->
                            <tr>
                                <!-- Hanya tersisa L & P karena kolom lainnya sudah di-cover oleh rowspan="2" di atas -->
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ubah forelse menjadi foreach biasa -->
                            @foreach ($papan_data ?? [] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nomor_rw ?? '-' }}</td>
                                    <td>{{ $item->jumlah_rt ?? '-' }}</td>
                                    <td>{{ $item->jumlah_dasa_wisma ?? '-' }}</td>
                                    <td>{{ $item->jumlah_krt ?? '-' }}</td>
                                    <td>{{ $item->jumlah_kk ?? '-' }}</td>
                                    <td>{{ $item->total_l ?? '-' }}</td>
                                    <td>{{ $item->total_p ?? '-' }}</td>
                                    <td>{{ $item->balita_l ?? '-' }}</td>
                                    <td>{{ $item->balita_p ?? '-' }}</td>
                                    <td>{{ $item->pus ?? '-' }}</td>
                                    <td>{{ $item->wus ?? '-' }}</td>
                                    <td>{{ $item->ibu_hamil ?? '-' }}</td>
                                    <td>{{ $item->ibu_menyusui ?? '-' }}</td>
                                    <td>{{ $item->lansia ?? '-' }}</td>
                                    <td>{{ $item->tiga_buta ?? '-' }}</td>
                                    <td>{{ $item->berkebutuhan_khusus ?? '-' }}</td>
                                    <td>{{ $item->rumah_sehat ?? '-' }}</td>
                                    <td>{{ $item->rumah_tidak_sehat ?? '-' }}</td>
                                    <td>{{ $item->pembuangan_sampah ?? '-' }}</td>
                                    <td>{{ $item->spal ?? '-' }}</td>
                                    <td>{{ $item->jamban ?? '-' }}</td>
                                    <td>{{ $item->stiker_p4k ?? '-' }}</td>
                                    <td>{{ $item->pdam ?? '-' }}</td>
                                    <td>{{ $item->sumur ?? '-' }}</td>
                                    <td>{{ $item->air_dll ?? '-' }}</td>
                                    <td>{{ $item->beras ?? '-' }}</td>
                                    <td>{{ $item->non_beras ?? '-' }}</td>
                                    <td>{{ $item->up2k ?? '-' }}</td>
                                    <td>{{ $item->pemanfaatan_pekarangan ?? '-' }}</td>
                                    <td>{{ $item->industri_rumah_tangga ?? '-' }}</td>
                                    <td>{{ $item->kesehatan_lingkungan ?? '-' }}</td>
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
                    <h5 class="modal-title">Tambah Data Kegiatan Warga</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('papan_data.store_sekretaris') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 mb-3"><label class="form-label">Nomor RW *</label><input type="text"
                                    class="form-control" name="nomor_rw" required></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Jumlah RT</label><input type="number"
                                    class="form-control" name="jumlah_rt"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Jumlah Dasa Wisma</label><input
                                    type="number" class="form-control" name="jumlah_dasa_wisma"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Jumlah KRT</label><input type="number"
                                    class="form-control" name="jumlah_krt"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Jumlah KK</label><input type="number"
                                    class="form-control" name="jumlah_kk"></div>
                            <hr>
                            <h6 class="mb-3">Jumlah Anggota Keluarga</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Total L</label><input type="number"
                                    class="form-control" name="total_l"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Total P</label><input type="number"
                                    class="form-control" name="total_p"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Balita L</label><input type="number"
                                    class="form-control" name="balita_l"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Balita P</label><input type="number"
                                    class="form-control" name="balita_p"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PUS</label><input type="number"
                                    class="form-control" name="pus"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">WUS</label><input type="number"
                                    class="form-control" name="wus"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Ibu Hamil</label><input type="number"
                                    class="form-control" name="ibu_hamil"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Ibu Menyusui</label><input
                                    type="number" class="form-control" name="ibu_menyusui"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Lansia</label><input type="number"
                                    class="form-control" name="lansia"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">3 Buta</label><input type="number"
                                    class="form-control" name="tiga_buta"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Berkebutuhan Khusus</label><input
                                    type="number" class="form-control" name="berkebutuhan_khusus"></div>
                            <hr>
                            <h6 class="mb-3">Jumlah Rumah & Sumber Air</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Rumah Sehat</label><input type="number"
                                    class="form-control" name="rumah_sehat"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Rumah Tidak Sehat</label><input
                                    type="number" class="form-control" name="rumah_tidak_sehat"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Pembuangan Sampah</label><input
                                    type="number" class="form-control" name="pembuangan_sampah"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">SPAL</label><input type="number"
                                    class="form-control" name="spal"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Jamban</label><input type="number"
                                    class="form-control" name="jamban"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Stiker P4K</label><input type="number"
                                    class="form-control" name="stiker_p4k"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">PDAM</label><input type="number"
                                    class="form-control" name="pdam"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Sumur</label><input type="number"
                                    class="form-control" name="sumur"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Air DLL</label><input type="number"
                                    class="form-control" name="air_dll"></div>
                            <hr>
                            <h6 class="mb-3">Makanan Pokok & Kegiatan Warga</h6>
                            <div class="col-md-3 mb-3"><label class="form-label">Beras</label><input type="number"
                                    class="form-control" name="beras"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Non Beras</label><input type="number"
                                    class="form-control" name="non_beras"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">UP2K</label><input type="number"
                                    class="form-control" name="up2k"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Pemanfaatan Pekarangan</label><input
                                    type="number" class="form-control" name="pemanfaatan_pekarangan"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Industri RT</label><input type="number"
                                    class="form-control" name="industri_rumah_tangga"></div>
                            <div class="col-md-3 mb-3"><label class="form-label">Kesehatan Lingkungan</label><input
                                    type="number" class="form-control" name="kesehatan_lingkungan"></div>
                            <div class="col-md-6 mb-3"><label class="form-label">Keterangan</label>
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
                        <h5 class="modal-title">Update Data Kegiatan Warga</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('papan_data.update_sekretaris', $item->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 mb-3"><label class="form-label">Nomor RW *</label><input
                                        type="text" class="form-control" name="nomor_rw" required
                                        value="{{ $item->nomor_rw }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Jumlah RT</label><input
                                        type="number" class="form-control" name="jumlah_rt"
                                        value="{{ $item->jumlah_rt }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Jumlah Dasa Wisma</label><input
                                        type="number" class="form-control" name="jumlah_dasa_wisma"
                                        value="{{ $item->jumlah_dasa_wisma }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Jumlah KRT</label><input
                                        type="number" class="form-control" name="jumlah_krt"
                                        value="{{ $item->jumlah_krt }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Jumlah KK</label><input
                                        type="number" class="form-control" name="jumlah_kk"
                                        value="{{ $item->jumlah_kk }}"></div>
                                <hr>
                                <h6 class="mb-3">Jumlah Anggota Keluarga</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Total L</label><input type="number"
                                        class="form-control" name="total_l" value="{{ $item->total_l }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Total P</label><input type="number"
                                        class="form-control" name="total_p" value="{{ $item->total_p }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Balita L</label><input
                                        type="number" class="form-control" name="balita_l"
                                        value="{{ $item->balita_l }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Balita P</label><input
                                        type="number" class="form-control" name="balita_p"
                                        value="{{ $item->balita_p }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PUS</label><input type="number"
                                        class="form-control" name="pus" value="{{ $item->pus }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">WUS</label><input type="number"
                                        class="form-control" name="wus" value="{{ $item->wus }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Ibu Hamil</label><input
                                        type="number" class="form-control" name="ibu_hamil"
                                        value="{{ $item->ibu_hamil }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Ibu Menyusui</label><input
                                        type="number" class="form-control" name="ibu_menyusui"
                                        value="{{ $item->ibu_menyusui }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Lansia</label><input type="number"
                                        class="form-control" name="lansia" value="{{ $item->lansia }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">3 Buta</label><input type="number"
                                        class="form-control" name="tiga_buta" value="{{ $item->tiga_buta }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Berkebutuhan Khusus</label><input
                                        type="number" class="form-control" name="berkebutuhan_khusus"
                                        value="{{ $item->berkebutuhan_khusus }}"></div>
                                <hr>
                                <h6 class="mb-3">Jumlah Rumah & Sumber Air</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Rumah Sehat</label><input
                                        type="number" class="form-control" name="rumah_sehat"
                                        value="{{ $item->rumah_sehat }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Rumah Tidak Sehat</label><input
                                        type="number" class="form-control" name="rumah_tidak_sehat"
                                        value="{{ $item->rumah_tidak_sehat }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Pembuangan Sampah</label><input
                                        type="number" class="form-control" name="pembuangan_sampah"
                                        value="{{ $item->pembuangan_sampah }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">SPAL</label><input type="number"
                                        class="form-control" name="spal" value="{{ $item->spal }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Jamban</label><input type="number"
                                        class="form-control" name="jamban" value="{{ $item->jamban }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Stiker P4K</label><input
                                        type="number" class="form-control" name="stiker_p4k"
                                        value="{{ $item->stiker_p4k }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">PDAM</label><input type="number"
                                        class="form-control" name="pdam" value="{{ $item->pdam }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Sumur</label><input type="number"
                                        class="form-control" name="sumur" value="{{ $item->sumur }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Air DLL</label><input type="number"
                                        class="form-control" name="air_dll" value="{{ $item->air_dll }}"></div>
                                <hr>
                                <h6 class="mb-3">Makanan Pokok & Kegiatan Warga</h6>
                                <div class="col-md-3 mb-3"><label class="form-label">Beras</label><input type="number"
                                        class="form-control" name="beras" value="{{ $item->beras }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Non Beras</label><input
                                        type="number" class="form-control" name="non_beras"
                                        value="{{ $item->non_beras }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">UP2K</label><input type="number"
                                        class="form-control" name="up2k" value="{{ $item->up2k }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Pemanfaatan Pekarangan</label><input
                                        type="number" class="form-control" name="pemanfaatan_pekarangan"
                                        value="{{ $item->pemanfaatan_pekarangan }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Industri RT</label><input
                                        type="number" class="form-control" name="industri_rumah_tangga"
                                        value="{{ $item->industri_rumah_tangga }}"></div>
                                <div class="col-md-3 mb-3"><label class="form-label">Kesehatan Lingkungan</label><input
                                        type="number" class="form-control" name="kesehatan_lingkungan"
                                        value="{{ $item->kesehatan_lingkungan }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Keterangan</label>
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
                        <form action="{{ route('papan_data.destroy_sekretaris', $item->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <div class="text-center p-3">
                                <h5>Hapus data RW <strong class="text-danger">{{ $item->nomor_rw }}</strong>?</h5>
                                <p class="text-muted small">Data tidak dapat dikembalikan.</p>
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
