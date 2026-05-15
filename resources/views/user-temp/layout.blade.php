<!DOCTYPE html>
<html lang="en">

<head>
    @include('user-temp.head')
</head>

<body class="index-page">
    
    @include('user-temp.header')

    <!-- ======= Main Content ======= -->
    <main class="main">
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    @include('user-temp.footer')
</body>

</html>
