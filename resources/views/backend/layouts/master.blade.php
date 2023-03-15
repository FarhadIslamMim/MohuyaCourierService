<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') - {{ $setting->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Onepoint IT Soultions" name="description" />
    <meta content="Onepoint IT Soultions" name="author" />
    <link rel="shortcut icon" href="{{ asset($setting->logo) }}" type="image/x-icon">

    {{-- laod style sheet --}}
    @include('backend.layouts.styles')
    @yield('custom-styles')
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        {{-- header --}}
        @include('backend.layouts.header')
        {{-- header --}}
        <!-- ========== App Menu ========== -->
        @include('backend.layouts.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @yield('main-content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('backend.layouts.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-primary btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>
    @yield('custom-modal')
    <!-- Theme Settings -->
    @include('backend.layouts.theme_settings')
    {{-- scripts --}}
    @include('backend.layouts.scripts')
    @yield('custom-scripts')
</body>

</html>
