@extends('admin-temp.layout_pokja_3')
@section('content_admin')
    <!-- [ Main Content ] start -->

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Pokja_3.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Data</a></li>
                        <li class="breadcrumb-item" aria-current="page">Data Anggota Pokja 3</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Anggota Pokja 3</h2>
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
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="ti ti-alert-circle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="ktp-rw12" role="tabpanel" aria-labelledby="ktp-rw12-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <div class="py-3">
                                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                    data-bs-target="#AddAnggotaModal">
                                    <i class="ti ti-plus me-1"></i> Tambah Anggota
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#ImportModal">
                                    <i class="ti ti-file-import me-1"></i> Import File
                                </button>
                            </div>
                            <table id="basic-btn-da" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <!-- Baris Header Pertama -->
                                    <tr>
                                        <th rowspan="2" class="align-middle">NO</th>
                                        <th rowspan="2" class="align-middle text-center">NO. REGISTRASI TP<br>PKK</th>
                                        <th rowspan="2" class="align-middle text-center">NAMA</th>
                                        <th rowspan="2" class="align-middle text-center">JENIS KELAMIN<br>L/P</th>
                                        <th colspan="3" class="align-middle text-center">KEDUDUKAN/FUNGSI</th>
                                        <th rowspan="2" class="align-middle text-center">TGL/BLN/THN<br>LAHIR/UMUR</th>
                                        <th rowspan="2" class="align-middle text-center">STATUS</th>
                                        <th rowspan="2" class="align-middle text-center">ALAMAT</th>
                                        <th rowspan="2" class="align-middle text-center">PENDIDIKAN</th>
                                        <th rowspan="2" class="align-middle text-center">PEKERJAAN</th>
                                        <th rowspan="2" class="align-middle text-center">KETERANGAN</th>
                                        <th rowspan="2" class="align-middle text-center">ACTION</th>
                                    </tr>
                                    <!-- Baris Header Kedua (Sub Kedudukan/Fungsi) -->
                                    <tr>
                                        <th class="align-middle text-center">DALAM KEANGGOTAAN<br>TP PKK</th>
                                        <th class="align-middle text-center">KADER UMUM</th>
                                        <th class="align-middle text-center">KADER KHUSUS</th>
                                    </tr>
                                    <!-- Baris Header Ketiga (Penomoran Kolom) -->
                                    <tr class="bg-blue-200">
                                        <th class="text-center">1</th>
                                        <th class="text-center">2</th>
                                        <th class="text-center">3</th>
                                        <th class="text-center">4</th>
                                        <th class="text-center">5</th>
                                        <th class="text-center">6</th>
                                        <th class="text-center">7</th>
                                        <th class="text-center">8</th>
                                        <th class="text-center">9</th>
                                        <th class="text-center">10</th>
                                        <th class="text-center">11</th>
                                        <th class="text-center">12</th>
                                        <th class="text-center">13</th>
                                        <th class="text-center">14</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggota_pokja3 as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->no_registrasi ?? '-' }}</td>

                                            <!-- Kolom Nama + Foto di bawahnya -->
                                            <td>
                                                <strong>{{ strtoupper($item->name) }}</strong><br>
                                                @if ($item->foto)
                                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                                        alt="{{ $item->name }}"
                                                        style="width: 80px; height: 100px; object-fit: cover; margin-top: 8px; cursor: pointer;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#FotoModal-{{ $item->id }}">
                                                @else
                                                    <div
                                                        style="width: 80px; height: 100px; background-color: #e9ecef; margin: 8px auto 0 auto; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #6c757d;">
                                                        No Photo
                                                    </div>
                                                @endif
                                            </td>

                                            <td>{{ $item->jenis_kelamin }}</td>

                                            <td style="max-width: 200px; white-space: normal;">
                                                {{ strtoupper($item->role_pkk) }} <br>
                                                {{ strtoupper($item->keanggotaan_tp_pkk) }}
                                            </td>

                                            <!-- Pengecekan boolean Kader -->
                                            <td>{{ $item->kader_umum ? 'V' : '-' }}</td>
                                            <td>{{ $item->kader_khusus ? 'V' : '-' }}</td>

                                            <!-- Format Tanggal dan Umur -->
                                            <td>
                                                {{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('F Y') : '-' }}
                                                /
                                                {{ $item->umur ?? '-' }}
                                            </td>

                                            <td>{{ strtoupper($item->status_perkawinan ?? '-') }}</td>

                                            <td style="min-width: 200px; max-width: 400px; white-space: normal;">
                                                {{ strtoupper($item->alamat ?? '-') }}
                                            </td>

                                            <td>{{ strtoupper($item->pendidikan ?? '-') }}</td>
                                            <td>{{ strtoupper($item->pekerjaan ?? '-') }}</td>
                                            <td>{{ $item->keterangan ?? '-' }}</td>

                                            <!-- Tombol Action -->
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-primary ti ti-edit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdateAnggotaModal-{{ $item->id }}">
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger ti ti-trash"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeleteAnggotaModal-{{ $item->id }}">
                                                    </button>
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
        <!-- Alternative Pagination table end -->

    @include('admin-temp.partials.import_modal', [
        'importRoute' => 'daftar_anggota.import_pokja3',
        'title'       => 'Import Daftar Anggota Pokja 3',
        'columns'     => 'no_registrasi, name, jenis_kelamin, status_perkawinan, role_pkk, keanggotaan_tp_pkk, kader_umum, kader_khusus, tempat_lahir, tanggal_lahir, umur, pendidikan, pekerjaan, alamat, keterangan',
    ])

    <!-- Modal Tambah Anggota -->
    <div id="AddAnggotaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddAnggotaModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Anggota Pokja 3</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('daftar_anggota.store_anggota_pokja3') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Akun User & Foto -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pilih Akun Login (User) <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="id_users" required>
                                    <option value="">-- Pilih Akun --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Foto Anggota</label>
                                <input type="file" name="foto" class="form-control"
                                    accept="image/png, image/jpeg, image/jpg">
                                <small class="text-muted">Format: .jpg, .jpeg, .png (max 2MB)</small>
                            </div>

                            <!-- Identitas Utama -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. Registrasi TP PKK</label>
                                <input type="text" class="form-control" name="no_registrasi"
                                    placeholder="Masukkan No. Registrasi">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Masukkan Nama Anggota" required>
                            </div>

                            <!-- Kelamin & Status -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin">
                                    <option value="">-- Pilih --</option>
                                    <option value="P">Perempuan</option>
                                    <option value="L">Laki-laki</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Perkawinan</label>
                                <select class="form-select" name="status_perkawinan">
                                    <option value="">-- Pilih --</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                </select>
                            </div>

                            <!-- Kedudukan / Jabatan -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Role di PKK</label>
                                <select class="form-select" name="role_pkk">
                                    <option value="Anggota">Anggota</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Pokja 1">Pokja 1</option>
                                    <option value="Pokja 2" selected>Pokja 2</option>
                                    <option value="Pokja 3">Pokja 3</option>
                                    <option value="Pokja 4">Pokja 4</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dalam Keanggotaan TP PKK</label>
                                <input type="text" class="form-control" name="keanggotaan_tp_pkk"
                                    placeholder="Cth: Anggota I Kelompok...">
                            </div>

                            <!-- Kader -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label d-block">Status Kader</label>
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="checkbox" name="kader_umum" value="1"
                                        id="kaderUmum">
                                    <label class="form-check-label" for="kaderUmum">Kader Umum</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="kader_khusus" value="1"
                                        id="kaderKhusus">
                                    <label class="form-check-label" for="kaderKhusus">Kader Khusus</label>
                                </div>
                            </div>

                            <!-- Tempat Tanggal Lahir & Umur -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir"
                                    placeholder="Kota Kelahiran">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Umur</label>
                                <input type="number" class="form-control" name="umur" placeholder="Umur">
                            </div>

                            <!-- Pendidikan & Pekerjaan -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pendidikan</label>
                                <input type="text" class="form-control" name="pendidikan"
                                    placeholder="Cth: SMA / S1">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" name="pekerjaan"
                                    placeholder="Cth: Mengurus Rumah Tangga">
                            </div>

                            <!-- Alamat & Keterangan -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat" rows="5" placeholder="Masukkan Alamat"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Keterangan Tambahan</label>
                                <textarea class="form-control" name="keterangan" rows="5" placeholder="Catatan tambahan (opsional)"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Anggota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update Anggota -->
    @foreach ($anggota_pokja3 as $item)
        <div id="UpdateAnggotaModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Form Update Anggota Pokja 3</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('daftar_anggota.update_anggota_pokja3', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <!-- Foto -->
                                <div class="col-md-12 mb-3 text-center">
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Lama"
                                            class="img-thumbnail mb-2" style="height: 120px; object-fit: cover;">
                                    @else
                                        <div class="mb-2 text-muted">Belum ada foto</div>
                                    @endif
                                    <input type="file" name="foto" class="form-control mt-2"
                                        accept="image/png, image/jpeg, image/jpg">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto (max
                                        2MB).</small>
                                </div>

                                <!-- Identitas Utama -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. Registrasi TP PKK</label>
                                    <input type="text" class="form-control" name="no_registrasi"
                                        value="{{ $item->no_registrasi }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $item->name }}" required>
                                </div>

                                <!-- Kelamin & Status -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="">-- Pilih --</option>
                                        <option value="P" {{ $item->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                        <option value="L" {{ $item->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Perkawinan</label>
                                    <input type="text" class="form-control" name="status_perkawinan"
                                        value="{{ $item->status_perkawinan }}">
                                </div>

                                <!-- Kedudukan / Jabatan -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Role di PKK</label>
                                    <select class="form-select" name="role_pkk">
                                        <option value="Anggota" {{ $item->role_pkk == 'Anggota' ? 'selected' : '' }}>
                                            Anggota</option>
                                        <option value="Sekretaris" {{ $item->role_pkk == 'Sekretaris' ? 'selected' : '' }}>
                                            Sekretaris</option>
                                        <option value="Pokja 1" {{ $item->role_pkk == 'Pokja 1' ? 'selected' : '' }}>
                                            Pokja 1</option>
                                        <option value="Pokja 2" {{ $item->role_pkk == 'Pokja 2' ? 'selected' : '' }}>
                                            Pokja 2</option>
                                        <option value="Pokja 3" {{ $item->role_pkk == 'Pokja 3' ? 'selected' : '' }}>
                                            Pokja 3</option>
                                        <option value="Pokja 4" {{ $item->role_pkk == 'Pokja 4' ? 'selected' : '' }}>
                                            Pokja 4</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Dalam Keanggotaan TP PKK</label>
                                    <input type="text" class="form-control" name="keanggotaan_tp_pkk"
                                        value="{{ $item->keanggotaan_tp_pkk }}">
                                </div>

                                <!-- Kader -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label d-block">Status Kader</label>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="checkbox" name="kader_umum" value="1"
                                            id="kaderUmum-{{ $item->id }}" {{ $item->kader_umum ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kaderUmum-{{ $item->id }}">Kader
                                            Umum</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="kader_khusus"
                                            value="1" id="kaderKhusus-{{ $item->id }}"
                                            {{ $item->kader_khusus ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kaderKhusus-{{ $item->id }}">Kader
                                            Khusus</label>
                                    </div>
                                </div>

                                <!-- Tempat Tanggal Lahir & Umur -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        value="{{ $item->tempat_lahir }}">
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        value="{{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('Y-m-d') : '' }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Umur</label>
                                    <input type="number" class="form-control" name="umur"
                                        placeholder="Ketik umur..." value="{{ $item->umur }}">
                                </div>

                                <!-- Pendidikan & Pekerjaan -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendidikan</label>
                                    <input type="text" class="form-control" name="pendidikan"
                                        value="{{ $item->pendidikan }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan"
                                        value="{{ $item->pekerjaan }}">
                                </div>

                                <!-- Alamat & Keterangan -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" rows="5">{{ $item->alamat }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Keterangan Tambahan</label>
                                    <textarea class="form-control" name="keterangan" rows="5">{{ $item->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete Anggota -->
    @foreach ($anggota_pokja3 as $item)
        <div id="DeleteAnggotaModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeleteAnggotaModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeleteAnggotaModalTitle-{{ $item->id }}">Hapus Data Anggota</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('daftar_anggota.destroy_anggota_pokja3', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3 text-center">
                                <div class="form-group mb-4">
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Anggota"
                                            style="height: 150px; object-fit: cover;" class="img-thumbnail mb-2">
                                        <p class="text-muted small">Foto Profil Saat Ini</p>
                                    @else
                                        <div class="d-inline-flex align-items-center justify-content-center bg-light text-muted img-thumbnail mb-2"
                                            style="width: 120px; height: 150px;">
                                            <i class="ti ti-user-off fs-1"></i>
                                        </div>
                                        <p class="text-muted small fst-italic">Tidak ada foto profil</p>
                                    @endif
                                </div>
                                <h5>
                                    Apakah Anda yakin ingin menghapus data anggota <br>
                                    <strong class="text-danger">"{{ $item->name }}"</strong>?
                                </h5>
                                <p class="text-muted small">Data yang dihapus beserta fotonya tidak dapat dikembalikan.</p>
                            </div>

                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash"></i> Ya, Hapus Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Review Foto -->
    @foreach ($anggota_pokja3 ?? [] as $item)
        @if ($item->foto)
            <div id="FotoModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Review Foto: {{ $item->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->name }}"
                                class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
