<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Sign In | PKK Cipinang Melayu RW 12</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets_admin/images/favicon.svg') }}" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets_admin/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets_admin/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets_admin/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets_admin/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets_admin/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets_admin/css/style-preset.css') }}">

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <a href="#"><img src="{{ asset('assets_admin/images/logo_pkk.png') }}" alt="img"
                            style="width:80px; height:auto;"></a>
                </div>
                <div class="card my-5">
                    <div class="card-body">
                        <form action="{{ route('login.process') }}" class="form-horizontal" method="POST">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <h3 class="mb-0"><b>Sign In</b></h3>
                                <a href="#" class="link-primary">Welcome to PKK Cipinang Melayu</a>
                            </div>
                            <div class="form-group mb-3">
                                <label for="role" class="form-label">What's Your Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="" selected disabled>Pilih Role</option>
                                    <option value="Ketua">Ketua</option>
                                    <option value="Wakil">Wakil</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Bendahara">Bendahara</option>
                                    <option value="Pokja_1">Pokja 1</option>
                                    <option value="Pokja_2">Pokja 2</option>
                                    <option value="Pokja_3">Pokja 3</option>
                                    <option value="Pokja_4">Pokja 4</option>
                                    <option value="Admin">Admin</option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                @csrf
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    placeholder="Email Address">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required aria-describedby="password">
                                @error('record')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Hitung: {{ $a }} + {{ $b }} = ?
                                </label>
                                <input type="text" name="captcha_answer" class="form-control" placeholder="Jawaban"
                                    required>
                                @error('captcha_answer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex mt-1 justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" id="customCheckc1"
                                        checked="">
                                    <label class="form-check-label text-muted" for="customCheckc1">Keep me sign
                                        in</label>
                                </div>
                                {{-- <h5 class="text-secondary f-w-400">Forgot Password?</h5> --}}
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            {{-- <div class="saprator mt-3">
                                <span>Login with</span>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                            <img src="{{ asset('assets_admin/images/authentication/google.svg') }}"
                                                alt="img"> <span class="d-none d-sm-inline-block"> Google</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                            <img src="{{ asset('assets_admin/images/authentication/twitter.svg') }}"
                                                alt="img"> <span class="d-none d-sm-inline-block"> Twitter</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                            <img src="{{ asset('assets_admin/images/authentication/facebook.svg') }}"
                                                alt="img"> <span class="d-none d-sm-inline-block">
                                                Facebook</span>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>
                <div class="auth-footer row">
                    <!-- <div class=""> -->
                    <div class="col my-1">
                        <p class="m-0">Copyright © <a href="#">PKK Cipinang Melayu</a></p>
                    </div>
                    <div class="col-auto my-1">
                        <ul class="list-inline footer-link mb-0">
                            <li class="list-inline-item"><a href="#">Home</a></li>
                            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="#">Contact us</a></li>
                        </ul>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="{{ asset('assets_admin/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets_admin/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugins/feather.min.js') }}"></script>





    <script>
        layout_change('light');
    </script>




    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Public-Sans");
    </script>



</body>
<!-- [Body] end -->

</html>
