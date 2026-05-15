@extends('admin-temp.layout_pokja_2')
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
                            <li class="breadcrumb-item"><a href="ketua_rw/dashboard">Home</a></li>
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
                        <h2 class="text-white">{{ number_format($totalSeluruhPenduduk ?? 0) }}</h2>
                        <p class="text-white mb-0">Population Total</p>
                        <i class="ti ti-users d-block f-46 text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-primary text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ number_format($totalFacilities ?? 0) }}</h2>
                        <p class="text-white mb-0">Facilities Total</p>
                        <i class="ti ti-building-carousel d-block f-46 text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-danger text-white widget-visitor-card">
                    <div class="card-body text-center">
                        <h2 class="text-white">{{ number_format($totalServices ?? 0) }}</h2>
                        <p class="text-white mb-0">Total Services</p>
                        <i class="ti ti-file-analytics d-block f-46 text-white"></i>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-12 col-xl-8">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Unique Visitor</h5>
                    <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill"
                                data-bs-target="#chart-tab-home" type="button" role="tab"
                                aria-controls="chart-tab-home" aria-selected="true">Month</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#chart-tab-profile" type="button" role="tab"
                                aria-controls="chart-tab-profile" aria-selected="false">Week</button>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="chart-tab-tabContent">
                            <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                                tabindex="0">
                                <div id="visitor-chart-1"></div>
                            </div>
                            <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                                aria-labelledby="chart-tab-profile-tab" tabindex="0">
                                <div id="visitor-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-md-12 col-xl-4">
                <h5 class="mb-3">Income Overview</h5>
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                        <h3 class="mb-3">$7,650</h3>
                        <div id="income-overview-chart"></div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-md-12 col-xl-8">
                <h5 class="mb-3">Recent Orders</h5>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>TRACKING NO.</th>
                                        <th>PRODUCT NAME</th>
                                        <th>TOTAL ORDER</th>
                                        <th>STATUS</th>
                                        <th class="text-end">TOTAL AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Camera Lens</td>
                                        <td>40</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                                        </td>
                                        <td class="text-end">$40,570</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Laptop</td>
                                        <td>300</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                                        </td>
                                        <td class="text-end">$180,139</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Mobile</td>
                                        <td>355</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span>
                                        </td>
                                        <td class="text-end">$180,139</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Camera Lens</td>
                                        <td>40</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                                        </td>
                                        <td class="text-end">$40,570</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Laptop</td>
                                        <td>300</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                                        </td>
                                        <td class="text-end">$180,139</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Mobile</td>
                                        <td>355</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span>
                                        </td>
                                        <td class="text-end">$180,139</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Camera Lens</td>
                                        <td>40</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-danger f-10 m-r-5"></i>Rejected</span>
                                        </td>
                                        <td class="text-end">$40,570</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Laptop</td>
                                        <td>300</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-warning f-10 m-r-5"></i>Pending</span>
                                        </td>
                                        <td class="text-end">$180,139</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Mobile</td>
                                        <td>355</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span>
                                        </td>
                                        <td class="text-end">$180,139</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" class="text-muted">84564564</a></td>
                                        <td>Mobile</td>
                                        <td>355</td>
                                        <td><span class="d-flex align-items-center gap-2"><i
                                                    class="fas fa-circle text-success f-10 m-r-5"></i>Approved</span>
                                        </td>
                                        <td class="text-end">$180,139</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <h5 class="mb-3">Analytics Report</h5>
                <div class="card">
                    <div class="list-group list-group-flush">
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                            Finance Growth<span class="h5 mb-0">+45.14%</span></a>
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                            Expenses Ratio<span class="h5 mb-0">0.58%</span></a>
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Business
                            Risk Cases<span class="h5 mb-0">Low</span></a>
                    </div>
                    <div class="card-body px-2">
                        <div id="analytics-report-chart"></div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-md-12 col-xl-8 mx-auto">
                <h5 class="mb-3">Population Report</h5>
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-00 text-muted">This Year Statistics</h6>
                        <h3 class="mb-0">$7,650</h3>
                        <div id="sales-report-chart"></div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-xl-6 col-md-12">
                    <h5 class="mb-3">Statistik Penduduk (KTP RW 12)</h5>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-00 text-muted">Total Penduduk</h6>
                            <h3 class="mb-0">{{ number_format($jumlahTotalKtp ?? 0) }}</h3>
                            <div id="chart-ktp-rw12"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12">
                    <h5 class="mb-3">Statistik Penduduk (Non KTP RW 12)</h5>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-2 f-w-00 text-muted">Total Penduduk</h6>
                            <h3 class="mb-0">{{ number_format($jumlahTotalNonKtp ?? 0) }}</h3>
                            <div id="chart-non-ktp-rw12"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-12 col-xl-4">
                <h5 class="mb-3">Transaction History</h5>
                <div class="card">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                                        <i class="ti ti-gift f-18"></i>
                                    </div>
                                </div>
                                <div class="grow ms-3">
                                    <h6 class="mb-1">Order #002434</h6>
                                    <p class="mb-0 text-muted">Today, 2:00 AM</P>
                                </div>
                                <div class="shrink-0 text-end">
                                    <h6 class="mb-1">+ $1,430</h6>
                                    <p class="mb-0 text-muted">78%</P>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s rounded-circle text-primary bg-light-primary">
                                        <i class="ti ti-message-circle f-18"></i>
                                    </div>
                                </div>
                                <div class="grow ms-3">
                                    <h6 class="mb-1">Order #984947</h6>
                                    <p class="mb-0 text-muted">5 August, 1:45 PM</P>
                                </div>
                                <div class="shrink-0 text-end">
                                    <h6 class="mb-1">- $302</h6>
                                    <p class="mb-0 text-muted">8%</P>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s rounded-circle text-danger bg-light-danger">
                                        <i class="ti ti-settings f-18"></i>
                                    </div>
                                </div>
                                <div class="grow ms-3">
                                    <h6 class="mb-1">Order #988784</h6>
                                    <p class="mb-0 text-muted">7 hours ago</P>
                                </div>
                                <div class="shrink-0 text-end">
                                    <h6 class="mb-1">- $682</h6>
                                    <p class="mb-0 text-muted">16%</P>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection

{{-- ... (di luar @endsection) ... --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {

        let ktpLabels = @json($ktpLabels ?? []);
        let ktpLakiData = @json($ktpLaki ?? []);
        let ktpPerempuanData = @json($ktpPerempuan ?? []);

        let nonKtpLabels = @json($nonKtpLabels ?? []);
        let nonKtpLakiData = @json($nonKtpLaki ?? []);
        let nonKtpPerempuanData = @json($nonKtpPerempuan ?? []);

        // --- CHART 1: DATA KTP RW 12 (DINAMIS) ---
        (function() {
            var options_ktp_rw12 = {
                chart: {
                    type: 'bar',
                    height: 430,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '45%', // <-- 1. Dibuat sedikit lebih lebar
                        borderRadius: 4
                    }
                },
                // 2. STROKE DIHILANGKAN AGAR JADI BAR, BUKAN GARIS
                stroke: {
                    show: true,
                    width: 2, // <-- Dikecilkan dari 8 jadi 2
                    colors: ['transparent']
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    show: true
                },
                // 3. WARNA PEREMPUAN DIUBAH JADI MERAH (#F44336)
                colors: ['#1890ff', '#F44336'],
                series: [{
                    name: 'Laki-Laki',
                    data: ktpLakiData
                }, {
                    name: 'Perempuan',
                    data: ktpPerempuanData
                }],
                xaxis: {
                    categories: ktpLabels
                },
            };

            if (typeof ApexCharts !== 'undefined') {
                var chart = new ApexCharts(document.querySelector('#chart-ktp-rw12'), options_ktp_rw12);
                chart.render();
            } else {
                console.error("Error: ApexCharts library is not loaded.");
            }
        })();


        // --- CHART 2: DATA NON KTP RW 12 (DINAMIS) ---
        (function() {
            var options_non_ktp_rw12 = {
                chart: {
                    type: 'bar',
                    height: 430,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '45%', // <-- 1. Dibuat sedikit lebih lebar
                        borderRadius: 4
                    }
                },
                // 2. STROKE DIHILANGKAN
                stroke: {
                    show: true,
                    width: 2, // <-- Dikecilkan dari 8 jadi 2
                    colors: ['transparent']
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    show: true
                },
                // 3. WARNA PEREMPUAN DIUBAH JADI MERAH (#F44336)
                colors: ['#1890ff', '#F44336'],
                series: [{
                    name: 'Laki-Laki',
                    data: nonKtpLakiData
                }, {
                    name: 'Perempuan',
                    data: nonKtpPerempuanData
                }],
                xaxis: {
                    categories: nonKtpLabels
                },
            };

            if (typeof ApexCharts !== 'undefined') {
                var chart = new ApexCharts(document.querySelector('#chart-non-ktp-rw12'),
                    options_non_ktp_rw12);
                chart.render();
            } else {
                console.error("Error: ApexCharts library is not loaded.");
            }
        })();

    });
</script>
