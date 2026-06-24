@extends('user-temp.layout')
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Profil</h1>
                        <p class="mb-0">Letak geografis serta visi dan misi</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/landing">Home</a></li>
                    <li class="current">Profil</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Letak Geografis Section -->
    <section id="geografis" class="features section bg-light">

        <div class="container" data-aos="fade-up">

            <div class="row align-items-center gy-4">

                <!-- Teks di Kiri -->
                <div class="col-xl-6 col-lg-6">
                    <h2 class="fw-bold mb-4">Letak Geografis</h2>
                    <p>
                        Kawasan Kelurahan Cipinang Melayu terletak di wilayah Kecamatan Makasar, Kota Administrasi Jakarta
                        Timur. Terbentang di lahan seluas kurang lebih 254 hektar, wilayah ini mencakup lingkungan pemukiman
                        padat dan strategis yang berbatasan langsung dengan jalur transportasi utama serta aliran sungai.
                        Kawasan ini ditentukan oleh batas-batas geografis tertentu.
                    </p>
                    <p>
                        Di sisi Utara dibatasi oleh Saluran Inspeksi Tarum Barat (Kalimalang) dan wilayah Kelurahan Cipinang
                        Muara. Di sisi Timur dibatasi oleh wilayah Kelurahan Halim Perdanakusuma dan Bandara Halim
                        Perdanakusuma. Di sisi Selatan dibatasi oleh Jalan Tol Jakarta-Cikampek. Di sisi Barat dibatasi oleh
                        wilayah Kelurahan Kebon Pala dan Kelurahan Cipinang Muara.
                    </p>
                    <p>
                        Kawasan Kelurahan Cipinang Melayu merupakan wilayah administrasi yang dinamis dengan cakupan wilayah
                        pembinaan PKK yang luas, terdiri dari 13 RW (Rukun Warga) dan puluhan RT (Rukun Tetangga).
                    </p>
                </div>

                <!-- Gambar di Kanan -->
                <div class="col-xl-6 col-lg-6 text-center" data-aos="zoom-out" data-aos-delay="100">
                    <iframe style="border:0; width: 100%; height: 400px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.144427794066!2d106.8960106739902!3d-6.2446899937436475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f37d3a86183b%3A0x18ce438310cb437d!2sKantor%20Kelurahan%20Cipinang%20Melayu!5e0!3m2!1sid!2sid!4v1779433448132!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>

        </div>

    </section><!-- /Letak Geografis Section -->

    <!-- Visi Misi Section -->
    <section id="visi-misi" class="visi-misi section" style="margin-top: 50px">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <p>Visi & Misi</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">

                <div class="col-lg-6">
                    <div class="content-box p-4 shadow-sm rounded">
                        <h3>Visi</h3>
                        <p>
                            Terwujudnya keluarga yang beriman dan bertaqwa kepada Tuhan Yang Maha
                            Esa, berakhlak mulia dan berbudi luhur, sehat sejahtera lahir dan batin.
                        </p>
                    </div>
                </div><!-- End Visi -->

                <div class="col-lg-6">
                    <div class="content-box p-4 shadow-sm rounded">
                        <h3>Misi</h3>
                        <ul>
                            <li>Membentuk karakter keluarga melalui pola asuh yang sesuai dengan nilai dasar Pancasila dan
                                meningkatkan pendidikan serta ekonomi pancasila.</li>
                            <li>Membangun keluarga yang harmonis dan berkecukupan.</li>
                            <li>Meningkatkan kualitas hidup keluarga melalui pendidikan, kesehatan dan ekonomi.</li>
                        </ul>
                    </div>
                </div><!-- End Misi -->

            </div>

        </div>

    </section><!-- /Visi Misi Section -->
@endsection
