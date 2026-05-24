@extends('admin-temp.layout_admin')
@section('content_admin')
    @php
        if (!function_exists('formatNomorIndo')) {
            function formatNomorIndo($nomor) {
                if (empty($nomor) || $nomor === '-') {
                    return '-';
                }
                
                // Bersihkan karakter non-digit
                $cleaned = preg_replace('/[^0-9]/', '', $nomor);
                
                // Jika dimulai dengan 0, ubah ke 62
                if (strpos($cleaned, '0') === 0) {
                    $cleaned = '62' . substr($cleaned, 1);
                }
                
                // Format ke +62 8xx-xxxx-xxxx
                if (strlen($cleaned) >= 9) {
                    $country = '+' . substr($cleaned, 0, 2);
                    $prefix = substr($cleaned, 2, 3); // 8xx
                    $part1 = substr($cleaned, 5, 4); // xxxx
                    $part2 = substr($cleaned, 9); // xxxx...
                    
                    if ($part2 !== false && $part2 !== '') {
                        return "{$country} {$prefix}-{$part1}-{$part2}";
                    }
                    return "{$country} {$prefix}-{$part1}";
                }
                
                return $nomor;
            }
        }
    @endphp
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Pages</a></li>
                        <li class="breadcrumb-item" aria-current="page">Katalog PKK Anyelir</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Katalog PKK Anyelir.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="ktp-rw12" role="tabpanel" aria-labelledby="ktp-rw12-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                {{-- <h5 class="mb-3">KTP RW 12</h5> --}}
                                <div class="py-3">
                                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                                        data-bs-target="#AddkatalogModal">
                                        Tambah katalog
                                    </button>
                                </div>
                                <table id="basic-btn-rw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Stock</th>
                                            <th>Kategori</th>
                                            <th>Nama Penjual</th>
                                            <th>No. Telp</th>
                                            <th>Status Stock</th>
                                            <th>Status Penjualan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($katalog as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item->fotoProduk && $item->fotoProduk->isNotEmpty())
                                                        @foreach ($item->fotoProduk as $foto)
                                                            <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                                                alt="{{ $item->nama_produk }}" width="90"
                                                                style="height: 90px; object-fit: cover; margin-right: 5px; border-radius: 4px;">
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted small">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->nama_produk }}</td>
                                                <td>Rp. {{ number_format($item->harga, 0, ',', '.') }},-</td>
                                                <td>{{ $item->stok }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->nama_penjual }}</td>
                                                <td>{{ formatNomorIndo($item->kontak_penjual) }}</td>
                                                <td>{{ $item->status_stock }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatekatalogModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeletekatalogModal-{{ $item->id }}">
                                                        Delete
                                                    </button>
                                                    <button type="button" class="btn btn-info me-3" data-bs-toggle="modal"
                                                        data-bs-target="#DetailkatalogModal-{{ $item->id }}">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Stock</th>
                                            <th>Kategori</th>
                                            <th>Nama Penjual</th>
                                            <th>No. Telp</th>
                                            <th>Status Stock</th>
                                            <th>Status Penjualan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah katalog -->
    <div id="AddkatalogModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddkatalogModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Katalog RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('katalog.store_pkk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- ================= KIRI ================= -->
                            <div class="col-md-6">

                                <div class="form-group mb-4">
                                    <label class="form-label">Gambar Produk (Maksimal 3)</label>
                                    <input type="file" name="foto[]" class="form-control" accept="image/*" multiple
                                        required>
                                    <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048 per file)</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama_produk"
                                        placeholder="Masukan Nama Produk" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Deskripsi Produk</label>
                                    <textarea class="form-control" placeholder="Masukan Deskripsi Produk" name="deskripsi" required></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Stock Produk</label>
                                    <input type="number" class="form-control" name="stok"
                                        placeholder="Masukan Stock Produk" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Harga Produk</label>
                                    <input type="number" class="form-control" name="harga"
                                        placeholder="Masukan Harga Produk" required>
                                </div>

                                <!-- KATEGORI PRODUK -->
                                <div class="form-group mb-4">
                                    <label class="form-label">Kategori Produk</label>
                                    <select class="form-select" name="kategori" id="kategoriSelect" required>
                                        <option value="">-- Pilih Kategori Produk --</option>
                                        <option value="Makanan">Makanan</option>
                                        <option value="Minuman">Minuman</option>
                                        <option value="Pakaian">Pakaian</option>
                                        <option value="Kerajinan Tangan">Kerajinan Tangan</option>
                                        <option value="Aksesoris">Aksesoris</option>
                                        <option value="Kecantikan">Kecantikan</option>
                                        <option value="Kesehatan">Kesehatan</option>
                                        <option value="Pertanian">Pertanian</option>
                                        <option value="Peternakan">Peternakan</option>
                                        <option value="Olahan Rumah Tangga">Olahan Rumah Tangga</option>
                                        <option value="Digital">Digital</option>
                                        <option value="Lainnya">Lainnya (Isi Manual)</option>
                                    </select>

                                    <!-- Input tambahan kalau pilih "Lainnya" -->
                                    <input type="text" class="form-control mt-2 d-none" id="kategoriLainnya"
                                        name="kategori_lainnya" placeholder="Masukkan kategori lainnya">
                                </div>
                            </div>

                            <!-- ================= KANAN ================= -->
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3">🗂️ Data Penjual</h6>

                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Penjual</label>
                                    <input type="text" class="form-control" name="nama_penjual"
                                        placeholder="Masukan Nama Penjual" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Nomor Telepon Penjual</label>
                                    <input type="text" class="form-control" name="kontak_penjual" required>
                                    <small class="form-text text-muted">Contoh: 0897963773529</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Alamat Penjual</label>
                                    <textarea class="form-control" placeholder="Masukan Alamat Penjual" name="alamat_penjual" required></textarea>
                                </div>

                                <h6 class="fw-bold mb-3 mt-4">📄 Link Sosial Media</h6>

                                <div class="form-group mb-3">
                                    <label class="form-label">Pilih Platform</label>
                                    <div class="d-flex align-items-center">
                                        <select id="platformSelect" class="form-select me-2">
                                            <option value="">-- Pilih Platform --</option>
                                            <option value="whatsapp">WhatsApp</option>
                                            <option value="facebook">Facebook</option>
                                            <option value="instagram">Instagram</option>
                                            <option value="tiktok">Tiktok</option>
                                            <option value="tokopedia">Tokopedia</option>
                                            <option value="shopee">Shopee</option>
                                        </select>
                                        <button type="button" class="btn btn-icon btn-link-primary">
                                            <i class="ti ti-plus" id="addPlatformBtn"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Container tempat input muncul -->
                                <div id="platformList"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Katalog</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update katalog -->
    @foreach ($katalog as $item)
        <div id="UpdatekatalogModal-{{ $item->id }}" class="modal fade" tabindex="-1"
            aria-labelledby="UpdatekatalogModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content shadow-lg border-0">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Update Katalog RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="{{ route('katalog.update_pkk', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body p-4">
                            <div class="row g-4">
                                <!-- ==================== KOLOM KIRI ==================== -->
                                <div class="col-md-6">
                                    <h6 class="fw-bold mb-3 text-primary">📦 Data Produk</h6>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Gambar Produk (Maks 3)</label>
                                        <input type="file" name="foto[]" class="form-control" accept="image/*"
                                            multiple>

                                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah
                                            foto.</small>
                                        <small class="text-danger d-block mt-1 fw-semibold">
                                            ⚠️ Perhatian: Mengupload foto baru akan MENGGANTI semua foto lama.
                                        </small>
                                        @if ($item->fotoProduk && $item->fotoProduk->isNotEmpty())
                                            <div class="mt-3">
                                                <p class="text-muted mb-2 fw-semibold">Foto Saat Ini:</p>
                                                <div class="d-flex flex-wrap justify-content-start">

                                                    @foreach ($item->fotoProduk as $foto)
                                                        <div class="me-2 mb-2">
                                                            <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                                                alt="Foto Produk"
                                                                class="img-fluid rounded shadow-sm border"
                                                                style="width: 100px; height: 100px; object-fit: cover;">
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        @else
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Belum ada foto untuk produk ini.</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Produk</label>
                                        <input type="text" class="form-control" name="nama_produk"
                                            value="{{ $item->nama_produk }}" placeholder="Masukkan Nama Produk" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Deskripsi Produk</label>
                                        <textarea class="form-control" name="deskripsi" rows="3" required>{{ $item->deskripsi }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Stok Produk</label>
                                            <input type="number" class="form-control" name="stok"
                                                value="{{ $item->stok }}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Harga Produk</label>
                                            <input type="number" class="form-control" name="harga"
                                                value="{{ $item->harga }}" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Kategori Produk</label>
                                        <select class="form-select kategoriSelect" name="kategori" required>
                                            <option value="">-- Pilih Kategori Produk --</option>
                                            <option value="Makanan" {{ $item->kategori == 'Makanan' ? 'selected' : '' }}>
                                                Makanan</option>
                                            <option value="Minuman" {{ $item->kategori == 'Minuman' ? 'selected' : '' }}>
                                                Minuman</option>
                                            <option value="Pakaian" {{ $item->kategori == 'Pakaian' ? 'selected' : '' }}>
                                                Pakaian</option>
                                            <option value="Kerajinan Tangan"
                                                {{ $item->kategori == 'Kerajinan Tangan' ? 'selected' : '' }}>Kerajinan
                                                Tangan</option>
                                            <option value="Aksesoris"
                                                {{ $item->kategori == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                                            <option value="Kecantikan"
                                                {{ $item->kategori == 'Kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                                            <option value="Kesehatan"
                                                {{ $item->kategori == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                            <option value="Pertanian"
                                                {{ $item->kategori == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                            <option value="Peternakan"
                                                {{ $item->kategori == 'Peternakan' ? 'selected' : '' }}>Peternakan</option>
                                            <option value="Olahan Rumah Tangga"
                                                {{ $item->kategori == 'Olahan Rumah Tangga' ? 'selected' : '' }}>Olahan
                                                Rumah Tangga</option>
                                            <option value="Digital" {{ $item->kategori == 'Digital' ? 'selected' : '' }}>
                                                Digital</option>
                                            <option value="Lainnya"
                                                {{ !in_array($item->kategori, [
                                                    'Makanan',
                                                    'Minuman',
                                                    'Pakaian',
                                                    'Kerajinan Tangan',
                                                    'Aksesoris',
                                                    'Kecantikan',
                                                    'Kesehatan',
                                                    'Pertanian',
                                                    'Peternakan',
                                                    'Olahan Rumah Tangga',
                                                    'Digital',
                                                ])
                                                    ? 'selected'
                                                    : '' }}>
                                                Lainnya</option>
                                        </select>

                                        <div class="mt-2 inputKategoriLainnya"
                                            style="{{ !in_array($item->kategori, [
                                                'Makanan',
                                                'Minuman',
                                                'Pakaian',
                                                'Kerajinan Tangan',
                                                'Aksesoris',
                                                'Kecantikan',
                                                'Kesehatan',
                                                'Pertanian',
                                                'Peternakan',
                                                'Olahan Rumah Tangga',
                                                'Digital',
                                            ])
                                                ? ''
                                                : 'display:none;' }}">
                                            <input type="text" class="form-control" name="kategori_lainnya"
                                                placeholder="Masukkan kategori lainnya"
                                                value="{{ !in_array($item->kategori, [
                                                    'Makanan',
                                                    'Minuman',
                                                    'Pakaian',
                                                    'Kerajinan Tangan',
                                                    'Aksesoris',
                                                    'Kecantikan',
                                                    'Kesehatan',
                                                    'Pertanian',
                                                    'Peternakan',
                                                    'Olahan Rumah Tangga',
                                                    'Digital',
                                                ])
                                                    ? $item->kategori
                                                    : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- ==================== KOLOM KANAN ==================== -->
                                <div class="col-md-6">
                                    <h6 class="fw-bold mb-3 text-primary">👩‍🦰 Data Penjual</h6>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Penjual</label>
                                        <input type="text" name="nama_penjual" class="form-control"
                                            value="{{ $item->nama_penjual }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nomor Telepon</label>
                                        <input type="text" name="kontak_penjual" class="form-control"
                                            value="{{ $item->kontak_penjual }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Alamat Penjual</label>
                                        <textarea name="alamat_penjual" class="form-control" rows="2" required>{{ $item->alamat_penjual }}</textarea>
                                    </div>

                                    <h6 class="fw-bold mb-3 text-primary">🌐 Link Sosial Media & E-Commerce</h6>

                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <input type="url" name="link_whatsapp" class="form-control"
                                                placeholder="Link WhatsApp" value="{{ $item->link_whatsapp }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="url" name="link_instagram" class="form-control"
                                                placeholder="Link Instagram" value="{{ $item->link_instagram }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="url" name="link_tiktok" class="form-control"
                                                placeholder="Link TikTok" value="{{ $item->link_tiktok }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="url" name="link_tokopedia" class="form-control"
                                                placeholder="Link Tokopedia" value="{{ $item->link_tokopedia }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="url" name="link_shopee" class="form-control"
                                                placeholder="Link Shopee" value="{{ $item->link_shopee }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="url" name="link_facebook" class="form-control"
                                                placeholder="Link Facebook" value="{{ $item->link_facebook }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete katalog -->
    @foreach ($katalog as $item)
        <div id="DeletekatalogModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletekatalogModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletekatalogModalTitle-{{ $item->id }}">
                            Hapus Produk
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('katalog.destroy_pkk', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3 text-center">
                                <div class="mb-3 text-center">
                                    <h4 class="text-danger fw-bold">Konfirmasi Hapus</h4>
                                    <p class="fs-5">Anda yakin ingin menghapus produk ini?</p>
                                    <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan.</p>
                                    <hr>
                                    <h5 class="fw-semibold mb-3">{{ $item->nama_produk }}</h5>
                                    @if ($item->fotoProduk && $item->fotoProduk->isNotEmpty())
                                        <div class="d-flex flex-wrap justify-content-center">
                                            @foreach ($item->fotoProduk as $foto)
                                                <div class="me-2 mb-2">
                                                    <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                                        alt="Foto Produk" class="img-fluid rounded shadow-sm border"
                                                        style="width: 100px; height: 100px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-center text-muted small">(Produk ini tidak memiliki foto)</p>
                                    @endif
                                </div>
                                <h5 class="fw-bold text-danger mt-3">
                                    Yakin ingin menghapus produk
                                    <strong>{{ $item->nama_produk }}</strong>?
                                </h5>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Tutup
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash"></i> Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Detail katalog -->
    @foreach ($katalog as $item)
        <div id="DetailkatalogModal-{{ $item->id }}" class="modal fade" tabindex="-1"
            aria-labelledby="DetailkatalogModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content shadow-lg border-0">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Detail Katalog RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <div class="row g-4">
                            <!-- ================= KIRI ================= -->
                            <div class="col-md-6">
                                <div class="text-center mb-4">
                                    <label class="form-label fw-bold d-block mb-2">Foto Produk</label>
                                    @if ($item->fotoProduk && $item->fotoProduk->isNotEmpty())
                                        @foreach ($item->fotoProduk as $foto)
                                            <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                                alt="{{ $item->nama_produk }}" width="150"
                                                style="height: 150px; object-fit: cover; margin-right: 5px; border-radius: 4px;">
                                        @endforeach
                                    @else
                                        <span class="text-muted small">N/A</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Produk</label>
                                    <input type="text" class="form-control bg-light"
                                        value="{{ $item->nama_produk ?? '-' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Deskripsi Produk</label>
                                    <textarea class="form-control bg-light" rows="3" readonly>{{ $item->deskripsi ?? '-' }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Stok Produk</label>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ $item->stok ?? '-' }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Harga Produk</label>
                                        <input type="text" class="form-control bg-light"
                                            value="Rp {{ number_format($item->harga, 0, ',', '.') }},-" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Kategori Produk</label>
                                    <input type="text" class="form-control bg-light"
                                        value="{{ $item->kategori ?? '-' }}" readonly>
                                </div>
                            </div>

                            <!-- ================= KANAN ================= -->
                            <div class="col-md-6">
                                <div class="border-start ps-3">
                                    <h6 class="fw-bold mb-3 text-primary">🗂️ Data Penjual</h6>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Penjual</label>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ $item->nama_penjual ?? '-' }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nomor Telepon Penjual</label>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ formatNomorIndo($item->kontak_penjual ?? '-') }}" readonly>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Alamat Penjual</label>
                                        <textarea class="form-control bg-light" rows="2" readonly>{{ $item->alamat_penjual ?? '-' }}</textarea>
                                    </div>

                                    <h6 class="fw-bold mb-3 text-primary">📱 Link Sosial Media & E-Commerce</h6>

                                    <div class="d-flex flex-column gap-2">
                                        @if ($item->link_whatsapp)
                                            <a href="{{ $item->link_whatsapp }}" target="_blank"
                                                class="text-decoration-none">
                                                <i class="ti ti-brand-whatsapp text-success me-2"></i> WhatsApp
                                            </a>
                                            <input type="url" name="link_facebook" class="form-control"
                                                placeholder="Link Facebook" value="{{ $item->link_whatsapp }}" readonly>
                                        @endif

                                        @if ($item->link_facebook)
                                            <a href="{{ $item->link_facebook }}" target="_blank"
                                                class="text-decoration-none">
                                                <i class="ti ti-brand-facebook text-primary me-2"></i> Facebook
                                            </a>
                                            <input type="url" name="link_facebook" class="form-control"
                                                placeholder="Link Facebook" value="{{ $item->link_facebook }}" readonly>
                                        @endif

                                        @if ($item->link_instagram)
                                            <a href="{{ $item->link_instagram }}" target="_blank"
                                                class="text-decoration-none">
                                                <i class="ti ti-brand-instagram text-danger me-2"></i> Instagram
                                            </a>
                                            <input type="url" name="link_facebook" class="form-control"
                                                placeholder="Link Facebook" value="{{ $item->link_instagram }}" readonly>
                                        @endif

                                        @if ($item->link_tiktok)
                                            <a href="{{ $item->link_tiktok }}" target="_blank"
                                                class="text-decoration-none">
                                                <i class="ti ti-brand-tiktok text-dark me-2"></i> TikTok
                                            </a>
                                            <input type="url" name="link_facebook" class="form-control"
                                                placeholder="Link Facebook" value="{{ $item->link_tiktok }}" readonly>
                                        @endif

                                        @if ($item->link_tokopedia)
                                            <a href="{{ $item->link_tokopedia }}" target="_blank"
                                                class="text-decoration-none">
                                                <i class="ti ti-shopping-bag text-success me-2"></i> Tokopedia
                                            </a>
                                            <input type="url" name="link_facebook" class="form-control"
                                                placeholder="Link Facebook" value="{{ $item->link_tokopedia }}" readonly>
                                        @endif

                                        @if ($item->link_shopee)
                                            <a href="{{ $item->link_shopee }}" target="_blank"
                                                class="text-decoration-none">
                                                <i class="ti ti-shopping-cart text-warning me-2"></i> Shopee
                                            </a>
                                            <input type="url" name="link_facebook" class="form-control"
                                                placeholder="Link Facebook" value="{{ $item->link_shopee }}" readonly>
                                        @endif

                                        @if (
                                            !$item->link_whatsapp &&
                                                !$item->link_facebook &&
                                                !$item->link_instagram &&
                                                !$item->link_tiktok &&
                                                !$item->link_tokopedia &&
                                                !$item->link_shopee)
                                            <p class="text-muted">Tidak ada link sosial media</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Script JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('platformSelect');
            const addBtn = document.getElementById('addPlatformBtn');
            const container = document.getElementById('platformList');
            const addedPlatforms = new Set();

            addBtn.addEventListener('click', function() {
                const selected = select.value;

                if (!selected) {
                    alert('Pilih platform terlebih dahulu!');
                    return;
                }

                if (addedPlatforms.has(selected)) {
                    alert('Platform ini sudah ditambahkan!');
                    return;
                }

                addedPlatforms.add(selected);

                const label = selected.charAt(0).toUpperCase() + selected.slice(1);
                const placeholder = `Masukkan link ${label}`;
                const name = `link_${selected}`;

                const div = document.createElement('div');
                div.classList.add('form-group', 'mb-3');
                div.innerHTML = `
            <label class="form-label">${label}</label>
            <div class="input-group">
                <input type="text" class="form-control" name="${name}" placeholder="${placeholder}" required>
                <button type="button" class="btn btn-icon btn-link-danger btn-remove title="hapus" ><i
                                                class="ti ti-trash"></i></button>
            </div>
        `;

                div.querySelector('.btn-remove').addEventListener('click', function() {
                    div.remove();
                    addedPlatforms.delete(selected);
                });

                container.appendChild(div);
                select.value = '';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const selectKategori = document.getElementById('kategoriSelect');
            const inputLainnya = document.getElementById('kategoriLainnya');

            selectKategori.addEventListener('change', function() {
                if (this.value === 'Lainnya') {
                    inputLainnya.classList.remove('d-none');
                    inputLainnya.required = true;
                } else {
                    inputLainnya.classList.add('d-none');
                    inputLainnya.required = false;
                    inputLainnya.value = '';
                }
            });
        });

        document.querySelectorAll('.kategoriSelect').forEach(select => {
            const container = select.closest('.mb-3');
            const inputLainnya = container.querySelector('.inputKategoriLainnya');
            select.addEventListener('change', function() {
                if (this.value === 'Lainnya') {
                    inputLainnya.style.display = 'block';
                } else {
                    inputLainnya.style.display = 'none';
                    inputLainnya.querySelector('input').value = '';
                }
            });
        });
    </script>

    <!-- Tambahkan ini di layout kamu jika belum ada -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection
