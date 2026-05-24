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
                        Kawasan RW 12 terletak di Kelurahan Pegangsaan Dua, Kecamatan Kelapa Gading.
                        Terbentang di lahan seluas 50 hektar, mulai dari blok NB hingga blok NI.
                        Kawasan ini ditentukan oleh batas-batas geografis tertentu.
                    </p>
                    <p>
                        Di sisi Utara dibatasi oleh Jl. Nias Raya. Di sisi Timur dibatasi oleh
                        Jl. Kelapa Lilin Timur dan Kali Betik. Di sisi Barat dibatasi oleh
                        Jl. Raya Gading Indah.
                    </p>
                    <p>
                        Kawasan RW 12 merupakan kawasan hunian dengan jumlah RT (Rukun Tetangga)
                        terbesar yaitu 31 RT.
                    </p>
                </div>

                <!-- Gambar di Kanan -->
                <div class="col-xl-6 col-lg-6 text-center" data-aos="zoom-out" data-aos-delay="100">
                    <img src="assets-user/img/features.png" class="img-fluid rounded-4 shadow-sm" alt="Peta RW 12">
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
                            Menjadi organisasi yang unggul dalam pengembangan ilmu pengetahuan, teknologi,
                            dan karakter, serta mampu memberikan kontribusi nyata bagi masyarakat.
                        </p>
                    </div>
                </div><!-- End Visi -->

                <div class="col-lg-6">
                    <div class="content-box p-4 shadow-sm rounded">
                        <h3>Misi</h3>
                        <ul>
                            <li>Mengembangkan potensi mahasiswa melalui kegiatan akademik maupun non-akademik.</li>
                            <li>Menciptakan lingkungan yang inklusif, kreatif, dan kolaboratif.</li>
                            <li>Mendorong inovasi dalam bidang sains, teknologi, dan sosial.</li>
                            <li>Memberikan manfaat nyata bagi masyarakat melalui program kerja yang berkelanjutan.</li>
                        </ul>
                    </div>
                </div><!-- End Misi -->

            </div>

        </div>

    </section><!-- /Visi Misi Section -->
@endsection
