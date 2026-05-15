@extends('admin-temp.layout_ketua')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title"><h5 class="m-b-10">Home</h5></div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Ketua.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="ti ti-crown d-block f-46 text-warning mb-3"></i>
                    <h3>Selamat Datang, Ketua</h3>
                    <p class="text-muted">Pantau seluruh data PKK Cipinang Melayu RW 12</p>
                </div>
            </div>
        </div>
    </div>
@endsection
