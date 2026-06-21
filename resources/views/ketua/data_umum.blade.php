@extends('admin-temp.layout_ketua')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Ketua.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Data Umum</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Umum <span class="badge bg-info">Lihat Saja</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-sm-12">
        <div class="card"><div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="basic-btn" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>NO</th>
                            @foreach (array_keys($data_umum->first() ? $data_umum->first()->getAttributes() : []) as $col)
                                @if (!in_array($col, ['id','created_at','updated_at']))
                                    <th>{{ strtoupper(str_replace('_',' ',$col)) }}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_umum as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @foreach ((array)$item->getAttributes() as $key => $val)
                                    @if (!in_array($key, ['id','created_at','updated_at']))
                                        <td>{{ $val ?? '-' }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold bg-light">
                            <th colspan="2" class="text-center align-middle">JUMLAH</th>
                            @foreach (array_keys($data_umum->first() ? $data_umum->first()->getAttributes() : []) as $col)
                                @if (!in_array($col, ['id','created_at','updated_at', 'nama_wilayah']))
                                    @if ($col === 'keterangan')
                                        <th class="text-center"></th>
                                    @else
                                        <th class="text-center">{{ $data_umum->sum($col) ?: '-' }}</th>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                    </tfoot>
            </div>
        </div></div>
    </div></div>
@endsection
