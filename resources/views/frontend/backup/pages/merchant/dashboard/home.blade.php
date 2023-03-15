@extends('frontend.layouts.master')
@section('title', 'Home')
@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/styles.css') }}">

@endsection
@section('content')
    <div class="dashboard">
        <article>
            <div class="container">
                <div class="main-content">
                    <div class="row">
                        {{-- @include('frontend.pages.merchant.layouts.sidebar') --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Welcome, {{ $merchant_info->firstName }}</h3>
                                </div>
                                <div class="card-body">
                                    <h4>Today <i class="badge badge-primary">{{ date('d-m-Y') }}</i> Percel Status</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="stats-reportList-inner">
                                                <div class="row">
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/today/parcels') }}">
                                                            <div class="stats-reportList jelly">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Percel</h5>
                                                                    <h3>{{ $today_placepercel }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->

                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/today/parcels?parcel_type=pending') }}">
                                                            <div class="stats-reportList pink">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Pending</h5>
                                                                    <h3>{{ $today_pendingparcel }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/today/parcels?parcel_type=cancelled') }}">
                                                            <div class="stats-reportList blue">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Canceld</h5>
                                                                    <h3>{{ $today_cancelparcel }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/today/parcels?parcel_type=deliverd') }}">
                                                            <div class="stats-reportList poppy">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Delivered</h5>
                                                                    <h3>{{ $today_deliverd }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a
                                                            href="{{ url('merchant/today/parcels?parcel_type=return-to-merchant') }}">
                                                            <div class="stats-reportList fade_green">
                                                                <div class="stats-per-item">
                                                                    <h5>Today retrun to merchant</h5>
                                                                    <h3>{{ $today_parcelreturn }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/today/parcels?parcel_type=hold') }}">
                                                            <div class="stats-reportList bg-info">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Hold</h5>
                                                                    <h3>{{ $today_totalhold }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->

                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList bg-white">
                                                            <div class="stats-per-item">
                                                                <h5>Today Amount</h5>
                                                                <h3>{{ $today_totalamount }} ৳</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList bg-success">
                                                            <div class="stats-per-item">
                                                                <h5>Today Paid Amount</h5>
                                                                <h3>{{ $today_merchantPaid }} ৳</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList bg-danger">
                                                            <div class="stats-per-item">
                                                                <h5>Today Unpaid amount</h5>
                                                                <h3>{{ $today_merchantUnPaid }} ৳</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->

                                                </div>
                                            </div>
                                            <br>
                                            <!-- dashboard parcel -->
                                            <div class="dashboard-payment-info">
                                                <h3>Total</h3>
                                                <div class="row">
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/parcels') }}">
                                                            <div class="stats-reportList blue">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Parcel</h5>
                                                                    <h3>{{ $placepercel }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <!-- col end -->

                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/parcels?parcel_type=pending') }}">
                                                            <div class="stats-reportList bg-secondary">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Pending</h5>
                                                                    <h3>{{ $pendingparcel }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/parcels?parcel_type=deliverd') }}">
                                                            <div class="stats-reportList poppy">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Delivered</h5>
                                                                    <h3>{{ $deliverd }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/parcels?parcel_type=cancelled') }}">
                                                            <div class="stats-reportList bg-danger">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Cancled</h5>
                                                                    <h3>{{ $cancelparcel }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a
                                                            href="{{ url('merchant/parcels?parcel_type=return-to-merchant') }}">
                                                            <div class="stats-reportList bg-warning">
                                                                <div class="stats-per-item">
                                                                    <h5>Returned to merchant</h5>
                                                                    <h3>{{ $parcelreturn }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('merchant/parcels?parcel_type=hold') }}">
                                                            <div class="stats-reportList bg-info">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Hold</h5>
                                                                    <h3>{{ $totalhold }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList pink">
                                                            <div class="stats-per-item">
                                                                <h5>Total Amount</h5>
                                                                <h3>{{ $totalamount }} ৳</h3>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList fade_green">
                                                            <div class="stats-per-item">
                                                                <h5>Total Paid Amount</h5>
                                                                <h3>{{ $merchantPaid }} ৳</h3>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList bg-danger">
                                                            <div class="stats-per-item">
                                                                <h5>Total Unpaid Amount</h5>
                                                                <h3>{{ $merchantUnPaid }} ৳</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                </div>
                                                {{-- <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3>@lang('common.parcel_statistics')</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <canvas id="myChart"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <!-- dashboard payment -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
@section('custom-scripts')

@endsection
