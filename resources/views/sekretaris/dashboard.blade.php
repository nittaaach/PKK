@extends('admin-temp.layout_sekretaris')
@section('content_admin')
    <!-- [ Main Content ] start -->
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Home</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="sekretaris/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-4">
                <div class="card bg-success text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ number_format($countSuratMasuk ?? 0) }}</h2>
                        <p class="text-white mb-0">Total Surat Masuk</p>
                        <i class="ti ti-mail-opened d-block f-46 text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-primary text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ number_format($countSuratKeluar ?? 0) }}</h2>
                        <p class="text-white mb-0">Total Surat Keluar</p>
                        <i class="ti ti-mail-forward d-block f-46 text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-danger text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ number_format($countKegiatan ?? 0) }}</h2>
                        <p class="text-white mb-0">Total Kegiatan</p>
                        <i class="ti ti-clipboard-list d-block f-46 text-white"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <h5 class="mb-3">Grafik Papan Data Sekretaris</h5>
                    <div class="card">
                        <div class="card-body">
                            <div id="chart-papan-data"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12">
                    <h5 class="mb-3">Grafik Data Umum</h5>
                    <div class="card">
                        <div class="card-body">
                            <div id="chart-data-umum"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12">
                    <h5 class="mb-3">Grafik Potensi Wilayah</h5>
                    <div class="card">
                        <div class="card-body">
                            <div id="chart-potensi-wilayah"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        let papanDataLabels = @json($papanDataLabels ?? []);
        let papanDataSeries = @json($papanDataSeries ?? []);

        let dataUmumLabels = @json($dataUmumLabels ?? []);
        let dataUmumSeries = @json($dataUmumSeries ?? []);

        let potensiLabels = @json($potensiLabels ?? []);
        let potensiSeries = @json($potensiSeries ?? []);

        // --- CHART 1: PAPAN DATA ---
        (function() {
            var options = {
                chart: { type: 'bar', height: 430, toolbar: { show: false } },
                plotOptions: { bar: { columnWidth: '45%', borderRadius: 4 } },
                stroke: { show: true, width: 2, colors: ['transparent'] },
                dataLabels: { enabled: false },
                legend: { position: 'top', horizontalAlign: 'right', show: true },
                colors: ['#1890ff'],
                series: [{ name: 'Jumlah', data: papanDataSeries }],
                xaxis: { categories: papanDataLabels },
            };
            if (typeof ApexCharts !== 'undefined') {
                new ApexCharts(document.querySelector('#chart-papan-data'), options).render();
            }
        })();

        // --- CHART 2: DATA UMUM ---
        (function() {
            var options = {
                chart: { type: 'bar', height: 430, toolbar: { show: false } },
                plotOptions: { bar: { columnWidth: '45%', borderRadius: 4, distributed: true } },
                stroke: { show: true, width: 2, colors: ['transparent'] },
                dataLabels: { enabled: false },
                legend: { show: false },
                colors: ['#00E396', '#FEB019', '#FF4560'],
                series: [{ name: 'Jumlah', data: dataUmumSeries }],
                xaxis: { categories: dataUmumLabels },
            };
            if (typeof ApexCharts !== 'undefined') {
                new ApexCharts(document.querySelector('#chart-data-umum'), options).render();
            }
        })();

        // --- CHART 3: POTENSI WILAYAH ---
        (function() {
            var options = {
                chart: { type: 'pie', height: 430, toolbar: { show: false } },
                dataLabels: { enabled: true },
                legend: { position: 'bottom', horizontalAlign: 'center', show: true },
                colors: ['#775DD0', '#008FFB', '#00E396', '#FEB019'],
                series: potensiSeries,
                labels: potensiLabels,
            };
            if (typeof ApexCharts !== 'undefined') {
                new ApexCharts(document.querySelector('#chart-potensi-wilayah'), options).render();
            }
        })();

    });
</script>
