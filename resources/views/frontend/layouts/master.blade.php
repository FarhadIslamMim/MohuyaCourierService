<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') - {{ $setting->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="One Point Courier Mangement System" name="description" />
    <meta content="One Point IT Soultions" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset($setting->logo) }}" type="image/x-icon">

    @include('frontend.layouts.styles')
    @yield('custom-styles')
</head>

<body>
    <div id="smooth-wrapper">
        <div id="smooth-content">
            <!-- Begin page -->
            <div class="layout-wrapper landing">
                @include('frontend.layouts.navbar')
                <!-- end navbar -->

                @yield('main-content')
                <!-- Start footer -->
                @include('frontend.layouts.footer')
                <!--end back-to-top-->

            </div>
            <!-- end layout wrapper -->

            @yield('custom-modal')
        </div>
    </div>
    <!-- JAVASCRIPT -->
    @include('frontend.layouts.scripts')

    <!--Swiper slider js-->
    <script src="{{ asset('assets/backend/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/landing.init.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/swiper.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js"></script>
    {{-- <script src="{{ asset('assets/backend/js/ScrollSmoother.min.js') }}"></script> --}}
    @yield('custom-scripts')
</body>

</html>
