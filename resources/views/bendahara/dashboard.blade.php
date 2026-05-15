@extends('admin-temp.layout_bendahara')
@section('content_admin')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Home</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Bendahara.dashboard') }}">Home</a></li>
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
                    <i class="ti ti-report-money d-block f-46 text-primary mb-3"></i>
                    <h3>Selamat Datang, Bendahara</h3>
                    <p class="text-muted">Kelola data keuangan PKK Cipinang Melayu RW 12</p>
                </div>
            </div>
        </div>
    </div>
@endsection
