@extends('admin-temp.layout_admin')
@section('content_admin')
    @php
        use Illuminate\Support\Str;

        $kategori_dipilih = $current_categories ?? [];
        $harga_dipilih = $current_price_range ?? null;

        $kategori_items = $all_categories ?? collect();
        $harga_items = $price_ranges ?? [];

        $kategori_midpoint = ceil($kategori_items->count() / 2);
        $kategori_kolom1 = $kategori_items->take($kategori_midpoint);
        $kategori_kolom2 = $kategori_items->skip($kategori_midpoint);

        $harga_midpoint = ceil(count($harga_items) / 2);
        $harga_kolom1 = array_slice($harga_items, 0, $harga_midpoint);
        $harga_kolom2 = array_slice($harga_items, $harga_midpoint);
    @endphp

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">E-commerce</a></li>
                        <li class="breadcrumb-item" aria-current="page">Products</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="ecom-wrapper">
                <div class="offcanvas offcanvas-start ecom-offcanvas" tabindex="-1" id="offcanvas_mail_filter">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            data-bs-target="#offcanvas_mail_filter" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-0 sticky-xxl-top">
                        <div id="ecom-filter" class="show collapse collapse-horizontal">
                            <div class="ecom-filter">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Filter</h5>
                                    </div>
                                    <div class="scroll-block">
                                        <div class="card-body">
                                            <form action="{{ url()->current() }}" method="GET">
                                                @if (request('sort'))
                                                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                                                @endif

                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 py-2">
                                                        <a class="btn border-0 px-0 text-start w-100"
                                                            data-bs-toggle="collapse" href="#filtercollapse2">
                                                            <div class="float-end"><i class="ti ti-chevron-down"></i></div>
                                                            Categories
                                                        </a>
                                                        <div class="collapse show" id="filtercollapse2">
                                                            <div class="row py-3">
                                                                <div class="col-6">
                                                                    <div class="form-check my-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="kategori[]" value=""
                                                                            id="categoryfilter-all"
                                                                            {{ empty($kategori_dipilih) || (count($kategori_dipilih) == 1 && $kategori_dipilih[0] == '') ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="categoryfilter-all">All</label>
                                                                    </div>

                                                                    @foreach ($kategori_kolom1 as $kategori)
                                                                        @php
                                                                            $kategori_id =
                                                                                'kategori-' . Str::slug($kategori);
                                                                        @endphp
                                                                        <div class="form-check my-2">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="kategori[]"
                                                                                value="{{ $kategori }}"
                                                                                id="{{ $kategori_id }}"
                                                                                {{ in_array($kategori, $kategori_dipilih) ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="{{ $kategori_id }}">{{ $kategori }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <div class="col-6">
                                                                    @foreach ($kategori_kolom2 as $kategori)
                                                                        @php
                                                                            $kategori_id =
                                                                                'kategori-' . Str::slug($kategori);
                                                                        @endphp
                                                                        <div class="form-check my-2">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="kategori[]"
                                                                                value="{{ $kategori }}"
                                                                                id="{{ $kategori_id }}"
                                                                                {{ in_array($kategori, $kategori_dipilih) ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="{{ $kategori_id }}">{{ $kategori }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="list-group-item px-0 py-2">
                                                        <a class="btn border-0 px-0 text-start w-100"
                                                            data-bs-toggle="collapse" href="#filtercollapse4">
                                                            <div class="float-end"><i class="ti ti-chevron-down"></i></div>
                                                            Price
                                                        </a>
                                                        <div class="collapse show" id="filtercollapse4">
                                                            <div class="row py-3">
                                                                <div class="col-6">
                                                                    @foreach ($harga_kolom1 as $index => $range)
                                                                        @php
                                                                            $price_id = 'pricefilter-' . $index;
                                                                        @endphp
                                                                        <div class="form-check my-2">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="price_range" id="{{ $price_id }}"
                                                                                value="{{ $range['value'] }}"
                                                                                {{ $harga_dipilih == $range['value'] ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="{{ $price_id }}">{{ $range['label'] }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <div class="col-6">
                                                                    @foreach ($harga_kolom2 as $index_offset => $range)
                                                                        @php
                                                                            $price_id =
                                                                                'pricefilter-' .
                                                                                ($index_offset + count($harga_kolom1));
                                                                        @endphp
                                                                        <div class="form-check my-2">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="price_range" id="{{ $price_id }}"
                                                                                value="{{ $range['value'] }}"
                                                                                {{ $harga_dipilih == $range['value'] ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="{{ $price_id }}">{{ $range['label'] }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="list-group-item px-0 py-2">
                                                        <button type="submit" class="btn btn-primary w-100">Apply
                                                            Filter</button>
                                                    </li>
                                                    <li class="list-group-item px-0 py-2">
                                                        <a href="{{ url('admin/dashboard') }}"
                                                            class="btn btn-light-danger w-100">Clear All</a>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ecom-content">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-sm-flex align-items-center">

                                <form action="{{ url()->current() }}" method="GET"
                                    class="d-sm-flex w-100 align-items-center">

                                    <ul class="list-inline me-auto my-1">
                                        <li class="list-inline-item align-bottom">
                                            <a href="#" class="btn btn-link-secondary" data-bs-toggle="offcanvas"
                                                data-bs-target="#offcanvas_mail_filter">
                                                <i class="ti ti-filter f-16"></i> Filter
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="form-search">
                                                <i class="ti ti-search"></i>
                                                <input type="search" class="form-control" placeholder="Search Products"
                                                    name="search" value="{{ request('search') }}">
                                            </div>
                                        </li>
                                    </ul>

                                    <ul class="list-inline ms-auto my-1">
                                        <li class="list-inline-item">
                                            <select class="form-select" name="sort" onchange="this.form.submit()">
                                                <option value="created_at_desc"
                                                    @if (($current_sort ?? 'created_at_desc') == 'created_at_desc') selected @endif>
                                                    Fresh Arrivals (Default)
                                                </option>
                                                <option value="price_desc"
                                                    @if (($current_sort ?? '') == 'price_desc') selected @endif>
                                                    Price: High To Low
                                                </option>
                                                <option value="price_asc"
                                                    @if (($current_sort ?? '') == 'price_asc') selected @endif>
                                                    Price: Low To High
                                                </option>
                                            </select>

                                            @if (request('kategori'))
                                                @foreach (request('kategori') as $k)
                                                    <input type="hidden" name="kategori[]" value="{{ $k }}">
                                                @endforeach
                                            @endif

                                            @if (request('price_range'))
                                                <input type="hidden" name="price_range"
                                                    value="{{ request('price_range') }}">
                                            @endif
                                        </li>
                                    </ul>

                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($produks as $produk)
                            <div class="col-sm-6 col-xl-4">
                                <div class="card product-card">
                                    <div class="card-img-top">
                                        <img src="{{ $produk->fotoProduk->first() ? asset('storage/' . $produk->fotoProduk->first()->path_foto) : '' }}"
                                            alt="{{ $produk->nama_produk }}" class="img-prod"
                                            style="width: 100%; height: 200px; object-fit: contain;"
                                            onerror="this.src='https://placehold.co/600x400/E5E7EB/9CA3AF?text=Foto+Produk';">
                                        <div class="card-body position-absolute end-0 top-0">
                                            <div class="form-check prod-likes">
                                                <input type="checkbox" class="form-check-input">
                                                <i data-feather="heart" class="prod-likes-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="#">
                                            <h5 class="mb-1 text-truncate">{{ $produk->nama_produk }}</h5>
                                        </a>
                                        <p class="prod-content mb-3 text-muted">
                                            {{ $produk->nama_penjual ?? 'Nama Penjual' }}</p>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <div class="me-2">
                                                <h6 class="mb-1">
                                                    <b>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</b>
                                                </h6>
                                            </div>
                                            <span
                                                class="badge bg-light-success">{{ $produk->status_stock ?? 'Tersedia' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var clearButton = document.getElementById("btn-clear-filter");
        var filterContainer = document.getElementById("ecom-filter");
        if (clearButton && filterContainer) {

            clearButton.addEventListener("click", function() {
                var checkboxes = filterContainer.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
                var radios = filterContainer.querySelectorAll('input[type="radio"]');
                radios.forEach(function(radio) {
                    radio.checked = false;
                });

                console.log("Semua filter telah dibersihkan!");
            });
        }
    });
</script>

<!-- [Page Specific JS] start -->
<script>
    // scroll-block
    var tc = document.querySelectorAll('.scroll-block');
    for (var t = 0; t < tc.length; t++) {
        new SimpleBar(tc[t]);
    }
</script>
