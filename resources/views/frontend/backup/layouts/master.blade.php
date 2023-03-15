<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')- {{ $setting->name }} </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset($setting->image) }}"type="image/x-icon">
    <!-- styles -->
    @include('frontend.layouts.styles')
    <!-- styles end -->
    @yield('custom-styles')
</head>

<body id="app">
    <!-- Preloader -->
    <!-- Main Wrapper -->
    <main class="wrapper">

        <!-- Header -->
        @include('frontend.layouts.header')
        <!-- /.Header -->

        <!-- Content Wrapper -->
        @yield('content')
        <!-- /.Content Wrapper -->

        <!-- Footer -->
        @include('frontend.layouts.footer')
        <!-- /.Footer -->


    </main>
    <!-- / Main Wrapper -->

    <!-- Top -->
    <div class="to-top theme-clr-bg transition"> <i class="fa fa-angle-up"></i> </div>



    <!--  scripts -->
    @include('frontend.layouts.scripts')
    @yield('custom-scripts')
</body>

</html>
