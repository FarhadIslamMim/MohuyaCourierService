@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')
    <article>
        <!-- slider -->
        @include('frontend.layouts.slider')
        <!-- /.slider -->

        <!-- Track Product -->
        <section>
            <div class="d-flex justify-content-lg-center">
                <div class="row">
                    <div class="col-md-8 track-prod clrbg-before wow slideInUp " data-wow-offset="50" data-wow-delay=".20s"
                        style="position: relative;z-index: 4;">
                        <h2 class="title-1"> track your parcel </h2> <span class="font2-light fs-12">Now you can track your
                            parcel easily</span>
                        <br>
                        <br>
                        <form method="get" action="{{ route('home.parcel.tracking') }}">
                            <div class="row">
                                <div class="col-md-7 col-sm-7">
                                    <div class="form-group">
                                        <input type="text" name="tracking_id" placeholder="Enter your tracking ID"
                                            required="" class="form-control box-shadow">
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <div class="form-group">
                                        <button class="btn-1">Track Your Parcel</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.Track Product -->

        <!-- About Us -->
        <section class="pad-80 about-wrap clrbg-before">
            <span class="bg-text wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> About </span>
            <div class="theme-container container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-us">

                            <h2 class="section-title pb-10 wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> About
                                Us </h2>
                            @foreach ($abouts as $about)
                                <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s">
                                    {{ $about->text }}
                                </p>
                            @endforeach
                            <ul class="feature">
                                <li>
                                    <img alt="" src="{{ asset('assets/frontend/img/icons/icon-2.png') }}"
                                        class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                    <div class="feature-content wow rotateInDownRight" data-wow-offset="50"
                                        data-wow-delay=".30s">
                                        <h2 class="title-1">Fast delivery</h2>
                                    </div>
                                </li>
                                <li>
                                    <img alt="" src="{{ asset('assets/frontend/img/icons/icon-3.png') }}"
                                        class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                    <div class="feature-content wow rotateInDownRight" data-wow-offset="50"
                                        data-wow-delay=".30s">
                                        <h2 class="title-1">secured service</h2>
                                    </div>
                                </li>
                                <li>
                                    <img alt="" src="{{ asset('assets/frontend/img/icons/icon-4.png') }}"
                                        class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                    <div class="feature-content wow rotateInDownRight" data-wow-offset="50"
                                        data-wow-delay=".30s">
                                        <h2 class="title-1">Countrywide shipping</h2>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="pb-80 visible-lg"></div>
                        <img alt="" src="{{ asset('assets/frontend/img/block/about-img.png') }}"
                            class="wow slideInRight" data-wow-offset="50" data-wow-delay=".20s" />
                    </div>
                </div>
            </div>
        </section>
        <!-- /.About Us -->


        <!-- Steps -->
        <section class="steps-wrap mask-overlay pad-80">
            <div class="theme-container container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="font-2 fs-50 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".20s"> 1. </div>
                        <div class="steps-content wow fadeInLeft" data-wow-offset="50" data-wow-delay=".25s">
                            <h2 class="title-3">Order</h2>
                            <p class="gray-clr">Duis autem vel eum iriur <br> hendrerit in vulputate</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="font-2 fs-50 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".20s"> 2. </div>
                        <div class="steps-content wow fadeInLeft" data-wow-offset="50" data-wow-delay=".25s">
                            <h2 class="title-3">Wait</h2>
                            <p class="gray-clr">Duis autem vel eum iriur <br> hendrerit in vulputate</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="font-2 fs-50 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".20s"> 3. </div>
                        <div class="steps-content wow fadeInLeft" data-wow-offset="50" data-wow-delay=".25s">
                            <h2 class="title-3">Deliver</h2>
                            <p class="gray-clr">Duis autem vel eum iriur <br> hendrerit in vulputate</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="step-img wow slideInRight" data-wow-offset="50" data-wow-delay=".20s"> <img
                    src="assets/img/block/step-img.png" alt="" /> </div>
        </section>
        <!-- /.Steps -->

        <!-- Product Delivery -->
        <section class="prod-delivery pad-120">
            <div class="theme-container container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="pt-120 rel-div">
                            <div class="pb-50 hidden-xs"></div>
                            <h2 class="section-title wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> Get the
                                <span class="theme-clr"> fastest </span> product delivery
                            </h2>
                            @foreach ($abouts as $about)
                                <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s">
                                    {{ $about->text }}</p>
                            @endforeach
                            <div class="pb-120 hidden-xs"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="delivery-img pt-10">
                            <img alt="" src="{{ asset('assets/frontend/img/block/delivery.png') }}"
                                class="wow slideInLeft" data-wow-offset="50" data-wow-delay=".20s" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.Product Delivery -->

        {{-- <!-- Testimonial -->
        <section class="testimonial mask-overlay">
            <div class="theme-container container">
                <div class="testimonial-slider no-pagination pad-120">
                    <div class="item">
                        <div class="testimonial-img darkclr-border theme-clr font-2 wow fadeInUp" data-wow-offset="50"
                            data-wow-delay=".20s">
                            <img alt="" src="assets/img/block/testimonial-1.png" />
                            <span>,,</span>
                        </div>
                        <div class="testimonial-content">
                            <p class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s"> <i
                                    class="gray-clr fs-16">
                                    Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,
                                    vel illum dolore eu feugiat nulla
                                    <br> facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                    luptatum zzril delenit
                                    <br> augue duis dolore te feugait nulla facilisi.
                                </i> </p>
                            <h2 class="title-2 pt-10 wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> <a
                                    href="#" class="white-clr fw-900"> Bushra Ahsani </a> </h2>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-img darkclr-border theme-clr font-2">
                            <img alt="" src="assets/img/block/testimonial-1.png" />
                            <span>,,</span>
                        </div>
                        <div class="testimonial-content">
                            <p> <i class="gray-clr fs-16">
                                    Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,
                                    vel illum dolore eu feugiat nulla
                                    <br> facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                    luptatum zzril delenit
                                    <br> augue duis dolore te feugait nulla facilisi.
                                </i> </p>
                            <h2 class="title-2 pt-10"> <a href="#" class="white-clr fw-900"> Bushra Ahsani </a>
                            </h2>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-img darkclr-border theme-clr font-2">
                            <img alt="" src="assets/img/block/testimonial-1.png" />
                            <span>,,</span>
                        </div>
                        <div class="testimonial-content">
                            <p> <i class="gray-clr fs-16">
                                    Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,
                                    vel illum dolore eu feugiat nulla
                                    <br> facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                    luptatum zzril delenit
                                    <br> augue duis dolore te feugait nulla facilisi.
                                </i> </p>
                            <h2 class="title-2 pt-10"> <a href="#" class="white-clr fw-900"> Bushra Ahsani </a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.Testimonial --> --}}

        {{-- <!-- Pricing & Plans -->
        <section class="pricing-wrap pt-120">
            <div class="theme-container container">
                <span class="bg-text center wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> Pricing </span>
                <div class="title-wrap text-center  pb-50">
                    <h2 class="section-title wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">Pricing & plans
                    </h2>
                    <p class="wow fadeInLeft" data-wow-offset="50" data-wow-delay=".25s">See our pricing & plans to get
                        best service</p>
                </div>
                <div class="row">
                    <div class="col-md-4 wow slideInUp" data-wow-offset="50" data-wow-delay=".20s">
                        <div class="pricing-box clrbg-before clrbg-after transition">
                            <div class="title-wrap text-center">
                                <h2 class="section-title fs-36">$50</h2>
                                <p>for single product</p>
                                <div class="btn-1">basic</div>
                            </div>
                            <div class="price-content">
                                <ul class="title-2">
                                    <li> Product Weight: <span class="gray-clr"> &LT; 3kg</span> </li>
                                    <li> Country: <span class="gray-clr"> all</span> </li>
                                    <li> duration: <span class="gray-clr">7-14 days</span> </li>
                                    <li> support: <span class="gray-clr">yes</span> </li>
                                </ul>
                            </div>
                            <div class="order">
                                <a href="#" class="title-1 theme-clr"> <span class="transition"> order now </span>
                                    <i class="arrow_right fs-26"></i> </a>
                            </div>
                            <div class="pricing-hover clrbg-before clrbg-after transition"></div>
                        </div>
                    </div>
                    <div class="col-md-4 active white-clr wow slideInUp" data-wow-offset="50" data-wow-delay=".25s">
                        <div class="pricing-box theme-clr-bg">
                            <div class="title-wrap text-center">
                                <h2 class="section-title fs-36">$250</h2>
                                <p>for package product</p>
                                <div class="btn-1 dark">Premium</div>
                            </div>
                            <div class="price-content">
                                <ul class="title-2">
                                    <li> Product Weight: <span class="white-clr">&LT; 3kg</span> </li>
                                    <li> Country: <span class="white-clr"> all</span> </li>
                                    <li> duration: <span class="white-clr">7-14 days</span> </li>
                                    <li> support: <span class="white-clr">yes</span> </li>
                                </ul>
                            </div>
                            <div class="order">
                                <a href="#" class="title-1 white-clr"> <span class="transition"> order now </span>
                                    <i class="arrow_right fs-26"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow slideInUp" data-wow-offset="50" data-wow-delay=".30s">
                        <div class="pricing-box clrbg-before clrbg-after transition">
                            <div class="title-wrap text-center">
                                <h2 class="section-title fs-36">$150</h2>
                                <p>for multiple product</p>
                                <div class="btn-1">standard</div>
                            </div>
                            <div class="price-content">
                                <ul class="title-2">
                                    <li> Product Weight: <span class="gray-clr">&LT; 3kg</span> </li>
                                    <li> Country: <span class="gray-clr"> all</span> </li>
                                    <li> duration: <span class="gray-clr">7-14 days</span> </li>
                                    <li> support: <span class="gray-clr">yes</span> </li>
                                </ul>
                            </div>
                            <div class="order">
                                <a href="#" class="title-1 theme-clr"> <span class="transition"> order now </span>
                                    <i class="arrow_right fs-26"></i> </a>
                            </div>
                            <div class="pricing-hover clrbg-before clrbg-after transition"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.Pricing & Plans --> --}}

        <!-- Contact us -->
        <section class="contact-wrap pad-120">
            <div class="theme-container container">
                <div class="row">
                    <div class="col-md-6 col-sm-8">
                        <h2>Contact</h2>
                        <p>{{$setting->address}}</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.Contact us -->
    </article>
@endsection
@section('custom-scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            center: true,
            margin: 10,
            nav: false,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    </script>
@endsection
