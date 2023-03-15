@extends('frontend.layouts.master')
@section('title', 'Privacy & Policy')
@section('custom-styles')

@endsection
@section('main-content')
    <section class="section">
        <article>
            <!-- Breadcrumb -->
            <section class="theme-breadcrumb bg-info py-4">
                <div class="container ">
                    <div class="row">
                        <div class="col-sm-8 pull-left">
                            <div class="title-wrap py-4">
                                <h2 class="section-title_2 no-margin"> Privacy & Policies </h2>
                                <p class="fs-16 no-margin"> Know our privacy & Policy </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.Breadcrumb -->
        </article>
    </section>

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="bg-soft-primary position-relative">
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <h3>Privacy Policy</h3>
                                </div>
                            </div>
                            <div class="shape">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                    width="1440" height="60" preserveAspectRatio="none" viewBox="0 0 1440 60">
                                    <g mask="url(&quot;#SvgjsMask1001&quot;)" fill="none">
                                        <path d="M 0,4 C 144,13 432,48 720,49 C 1008,50 1296,17 1440,9L1440 60L0 60z"
                                            style="fill: var(--vz-card-bg-custom);"></path>
                                    </g>
                                    <defs>
                                        <mask id="SvgjsMask1001">
                                            <rect width="1440" height="60" fill="#ffffff"></rect>
                                        </mask>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-check-circle text-success icon-dual-success icon-xs">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>Privacy Policy for {{ $setting->name }}</h5>
                                    <p>What information do we collect? We may collect, store and use the following kinds of
                                        personal data:
                                    </p>
                                    <ul>
                                        <li>Information about your visits to and use of this website.</li>
                                        <li>Information about any
                                            interactions carried out between you and us on or in relation to this website.
                                        </li>
                                        <li>Information that
                                            you provide to us for the purpose of registering with us and/or subscribing to
                                            our website
                                            services and/or email notifications.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                All rights for <b>{{ $setting->name }}</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('custom-scripts')

@endsection
