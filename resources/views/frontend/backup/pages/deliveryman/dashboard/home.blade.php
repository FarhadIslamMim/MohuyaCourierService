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
                        {{-- @include('frontend.pages.deliveryman.layouts.sidebar') --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Welcome, {{ $deliveryman_info->name }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="stats-reportList-inner">
                                                <div class="row">
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ route('deliveryman.percels') }}">
                                                            <div class="stats-reportList poppy">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Parcel</h5>
                                                                    <h3>{{ $dailyparcel }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ route('deliveryman.percels') }}?parcel_type=hold">
                                                            <div class="stats-reportList blue">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Hold</h5>
                                                                    <h3>{{ $dailyhold }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ route('deliveryman.percels') }}?parcel_type=deliverd">
                                                            <div class="stats-reportList pink">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Delivered</h5>
                                                                    <h3>{{ $dailydelivered }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ route('deliveryman.percels') }}?parcel_type=cancelled') }}">
                                                            <div class="stats-reportList bg-warning">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Cancled</h5>
                                                                    <h3>{{ $dailycancled }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a
                                                            href="{{ route('deliveryman.percels') }}?parcel_type=return-pending">
                                                            <div class="stats-reportList bg-info">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Return</h5>
                                                                    <h3>{{ $dailyreturnpending }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a
                                                            href="{{ route('deliveryman.percels') }}?parcel_type=return-to-merchant">
                                                            <div class="stats-reportList bg-danger">
                                                                <div class="stats-per-item">
                                                                    <h5>Today Return to merchant</h5>
                                                                    <h3>{{ $dailyreturntomarchant }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                </div>
                                            </div>
                                            <!-- dashboard payment -->
                                            <div class="dashboard-payment-info">
                                                <div class="row">
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList poppy">
                                                            <div class="stats-per-item">
                                                                <h5>Total Amount</h5>
                                                                <h3>{{ $total_amount }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList pink">
                                                            <div class="stats-per-item">
                                                                <h5>Paid Amount</h5>
                                                                <h3>{{ $total_paid }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList bg-danger">
                                                            <div class="stats-per-item">
                                                                <h5>Unpaid Amount</h5>
                                                                <h3>{{ $total_due }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="stats-reportList-inner">
                                                <div class="row">
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('deliveryman/parcels') }}">
                                                            <div class="stats-reportList poppy">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Parcel</h5>
                                                                    <h3>{{ $totalparcel }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('deliveryman/parcels?parcel_type=deliverd') }}">
                                                            <div class="stats-reportList pink">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Delivery</h5>
                                                                    <h3>{{ $totaldelivery }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('deliveryman/parcels?parcel_type=hold') }}">
                                                            <div class="stats-reportList pink">
                                                                <div class="stats-per-item">
                                                                    <h5>@lang('common.total_hold')</h5>
                                                                    <h3>{{ $totalhold }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a href="{{ url('deliveryman/parcels?parcel_type=cancelled') }}">
                                                            <div class="stats-reportList bg-warning">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Cancled</h5>
                                                                    <h3>{{ $totalcancel }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a
                                                            href="{{ url('deliveryman/parcels?parcel_type=return-pending') }}">
                                                            <div class="stats-reportList bg-info">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Pending</h5>
                                                                    <h3>{{ $returnpendin }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <a
                                                            href="{{ url('deliveryman/parcels?parcel_type=return-to-merchant') }}">
                                                            <div class="stats-reportList bg-danger">
                                                                <div class="stats-per-item">
                                                                    <h5>Total Return to Merchant</h5>
                                                                    <h3>{{ $returnmerchant }}</h3>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <!-- col end -->
                                                </div>
                                            </div>
                                            <!-- dashboard payment -->
                                            <div class="dashboard-payment-info">
                                                <div class="row">
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList poppy">
                                                            <div class="stats-per-item">
                                                                <h5>@lang('common.total_amount')</h5>
                                                                <h3>{{ $total_amount }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList pink">
                                                            <div class="stats-per-item">
                                                                <h5>Paid Amount</h5>
                                                                <h3>{{ $total_paid }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                    <div class="col-lg-2 colo-md-2 col-sm-2 col-6">
                                                        <div class="stats-reportList bg-danger">
                                                            <div class="stats-per-item">
                                                                <h5>Unpaid Amount</h5>
                                                                <h3>{{ $total_due }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                </div>
                                            </div>
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
