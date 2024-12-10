<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | @yield('title')</title>
    @include('admin.includes.head')

</head>

<body>

    <!-- ======= Header ======= -->
    @include('admin.includes.topbar')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin.includes.sidebar')
    <!-- End Sidebar-->

    <main id="main" class="main">

        @yield('content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('admin.includes.footer')
    <!-- End Footer -->

    @include('admin.includes.foot')
    @yield('script-area')
    @include('sweetalert::alert')

</body>

</html>
