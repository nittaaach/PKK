@extends('admin-temp.layout_pkk')
@section('content_admin')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Pages</a></li>
                        <li class="breadcrumb-item" aria-current="page">Dokumentasi PKK Anyelir</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Dokumentasi PKK Anyelir.</h2>
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
                                        data-bs-target="#AdddokumModal">
                                        Tambah Dokumentasi
                                    </button>
                                </div>
                                <table id="basic-btn-rw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Caption</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokumentasi as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item->fotopkk)
                                                        <img src="{{ asset('storage/' . $item->fotopkk) }}" width="150"
                                                            class="img-thumbnail" style="cursor: pointer;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#PreviewFotoModal-{{ $item->id }}">
                                                    @endif
                                                </td>
                                                <td
                                                    style="max-width: 200px; white-space: normal; overflow-wrap: break-word;">
                                                    {{ $item->caption }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatedokumModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeletedokumModal-{{ $item->id }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Caption</th>
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
    @foreach ($dokumentasi as $item)
        <!-- Modal Preview Foto -->
        <div class="modal fade" id="PreviewFotoModal-{{ $item->id }}" tabindex="-1"
            aria-labelledby="PreviewFotoLabel-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="PreviewFotoLabel-{{ $item->id }}">Preview Foto Dokumentasi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $item->fotopkk) }}" class="img-fluid rounded"
                            alt="Foto Dokumentasi">
                        <p class="mt-3 text-muted">{{ $item->caption }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Tambah dokumentasi -->
    <div id="AdddokumModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AdddokumModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah dokumentasi RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form action="{{ route('dokumentasipkk.store_pkk') }}" method="POST" enctype="multipart/form-data"
                            class="modal-content">
                            @csrf
                            <div class="card-body">

                                <div class="form-group mb-4">
                                    <label class="form-label">Foto Kegiatan</label>
                                    <input type="file" name="fotopkk" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Caption</label>
                                    <input type="text" class="form-control" name="caption"
                                        placeholder="Masukan Caption">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update dokumentasi -->
    @foreach ($dokumentasi as $item)
        <div id="UpdatedokumModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatedokumModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Update dokumentasi RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form action="{{ route('dokumentasipkk.update_pkk', $item->id) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">

                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="form-label">Foto Kegiatan (biarkan kosong jika tidak diganti)</label>
                                        <input type="file" name="fotopkk" class="form-control" accept="image/*">
                                        <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                        @if ($item->fotopkk)
                                            <div class="mt-2 text-center">
                                                <img src="{{ asset('storage/' . $item->fotopkk) }}" alt="Foto Lama"
                                                    width="150" class="img-thumbnail">
                                                <p class="text-muted mt-1">Foto Saat Ini</p>
                                            </div>
                                        @endif
                                        @error('fotopkk')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Caption</label>
                                        <input type="text" class="form-control" placeholder="Masukan Caption"
                                            name="caption" value="{{ $item->caption }}">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete dokumentasi -->
    @foreach ($dokumentasi as $item)
        <div id="DeletedokumModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletedokumModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletelayananModalTitle-{{ $item->id }}">Hapus Foto Kegiatan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dokumentasipkk.destroy_pkk', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3">
                                <div class="form-group">
                                    <label class="form-label">Foto Kegiatan</label>
                                    @if ($item->fotopkk)
                                        <div class="mt-2 text-center">
                                            <img src="{{ asset('storage/' . $item->fotopkk) }}" alt="Foto Lama"
                                                width="150" class="img-thumbnail">
                                            <p class="text-muted mt-1">Foto Saat Ini</p>
                                        </div>
                                    @endif

                                    @error('fotopkk')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <h5>Yakin ingin menghapus dokumentasi
                                    <strong>{{ $item->caption }}</strong>?
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
@endsection
