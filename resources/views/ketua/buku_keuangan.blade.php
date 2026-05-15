@extends('admin-temp.layout_ketua')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Ketua.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Buku Keuangan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Buku Keuangan <span class="badge bg-info">Lihat Saja</span></h2>
                        <p class="text-muted mt-1">TP PKK Kelurahan Cipinang Melayu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="basic-btn-keuangan" class="table table-striped table-bordered" style="width:100%;">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>NO</th><th>Tanggal</th><th>Sumber Dana</th><th>Uraian</th><th>Bukti kas</th><th>Penerimaan (Rp)</th>
                                    <th>NO</th><th>Tanggal</th><th>Sumber Dana</th><th>Uraian</th><th>Bukti kas</th><th>Pengeluaran (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $tp = 0; $tpg = 0; @endphp
                                @foreach ($buku_keuangan as $i => $item)
                                    @php $tp += $item->penerimaan ?? 0; $tpg += $item->pengeluaran ?? 0; @endphp
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $item->tanggal_penerimaan ? \Carbon\Carbon::parse($item->tanggal_penerimaan)->translatedFormat('d M Y') : '' }}</td>
                                        <td>{{ $item->sumber_dana_penerimaan }}</td><td>{{ $item->uraian_penerimaan }}</td><td>{{ $item->bukti_kas_penerimaan }}</td>
                                        <td class="text-end">{{ $item->penerimaan ? number_format($item->penerimaan, 0, ',', '.') : '' }}</td>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $item->tanggal_pengeluaran ? \Carbon\Carbon::parse($item->tanggal_pengeluaran)->translatedFormat('d M Y') : '' }}</td>
                                        <td>{{ $item->sumber_dana_pengeluaran }}</td><td>{{ $item->uraian_pengeluaran }}</td><td>{{ $item->bukti_kas_pengeluaran }}</td>
                                        <td class="text-end">{{ $item->pengeluaran ? number_format($item->pengeluaran, 0, ',', '.') : '' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold bg-light">
                                        <td colspan="5" class="text-end pe-3">JUMLAH</td>
                                        <td class="text-end">Rp {{ number_format($tp, 0, ',', '.') }}</td>
                                        <td colspan="5" class="text-end pe-3">JUMLAH</td>
                                        <td class="text-end">Rp {{ number_format($tpg, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
