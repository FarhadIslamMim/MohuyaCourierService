@extends('frontend.layouts.master')
@section('title', 'Home')
@section('custom-styles')
@endsection
@section('main-content')
    <div class="section mt-5">
        <div class="container">
            <article>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Welcome, {{ $merchant_info->firstName }}</h3>
                            </div>
                            <div class="card-body">
                                <h5>Today Parcel Details</h5>
                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/today/parcels') }}"  target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Parcel</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>{{ $today_placepercel }} / {{number_format($today_parcel_total,2)}}</span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/today/parcels?parcel_type=pending') }}"  target="_blank">
                                            <div class="card card-animate bg-success">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Pending</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>{{ $today_pendingparcel }}
                                                                    @if ($today_pendingparcel_amount)
                                                                      / {{number_format($today_pendingparcel_amount,2)}}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/today/parcels?parcel_type=picked') }}">
                                            <div class="card card-animate bg-green">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Picked</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>{{ $today_picked }}
                                                                    @if ($today_picked_amount)
                                                                        / {{ number_format($today_picked_amount,2) }}
                                                                    @endif
                                                                </span>


                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/today/parcels?parcel_type=in-transit') }}"  target="_blank">
                                            <div class="card card-animate bg-info">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Transit</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    {{ $today_transit }}
                                                                    @if ($today_transit_amount)
                                                                        / {{ number_format($today_transit_amount,2) }}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/today/parcels?parcel_type=hold') }}">
                                            <div class="card card-animate bg-warning">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Hold</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                {{ $today_totalhold }}
                                                                  @if ($today_hold_amount)
                                                                        / {{ number_format($today_hold_amount,2) }}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/today/parcels?parcel_type=deliverd') }}"  target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Delivered</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    {{ $today_deliverd }}
                                                                    @if ($today_delivered_amount)
                                                                        / {{ number_format($today_delivered_amount,2) }}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/today/parcels?parcel_type=hold') }}"  target="_blank">
                                            <div class="card card-animate bg-danger">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Cancel</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    {{ $today_cancelparcel }}
                                                                   @if($today_cancel_amount)
                                                                        / {{ number_format($today_cancel_amount,2)}}
                                                                   @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-5">
                                        <a href="{{ url('merchant/today/parcels?parcel_type=return-pending')}}" target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-small text-white-50 mb-0"> Return to Pending</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>
                                                                    {{$today_return_to_pending}}
                                                                    @if($today_return_to_pending_amount)
                                                                       /{{number_format($today_return_to_pending_amount,2)}}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                                r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-5">
                                        <a href="{{ url('merchant/today/parcels?parcel_type=return-to-hub')}}"  target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-small text-white-50 mb-0"> Return to Hub</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    {{$today_return_to_hub}}
                                                                    @if($today_return_to_hub_amount)
                                                                       / {{number_format($today_return_to_hub_amount,2)}}
                                                                    @endif

                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                                r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-5">
                                        <a href="{{ url('merchant/today/parcels?parcel_type=return-to-merchant') }}"  target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-small text-white-50 mb-0"> Return to
                                                                Merchant</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    {{ $today_parcelreturn }}
                                                                    @if($today_parcelreturn_amount)
                                                                        / {{number_format($today_parcelreturn_amount,2)}}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Partial Return
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    {{ number_format($today_partial_return,2) }}
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="#">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    {{ number_format($todayamount,2) }}
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="#">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Paid Amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    {{ number_format($today_paid,2) }}
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="#">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Unpaid amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    {{ number_format($today_unpaid,2) }}
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5>All Parcel Information</h5>
                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels') }}">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Parcel</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>
                                                                    {{ $placepercel }}
                                                                    @if($placepercel_amount)
                                                                      / {{ number_format($placepercel_amount,2) }}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels?parcel_type=pending') }}">
                                            <div class="card card-animate bg-success">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Pending</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                {{ $pendingparcel }}
                                                                @if($pendingparcel_amount)
                                                                    / {{ number_format($pendingparcel_amount,2) }}
                                                                @endif
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels?parcel_type=picked') }}">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total picked</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                {{ $parcle_picked }}
                                                                @if($parcel_picked_total_amount)
                                                                    / {{number_format($parcel_picked_total_amount,2)}}
                                                                @endif
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels?parcel_type=transit') }}">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Transit</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                {{ $parcle_transit }}
                                                                    @if($parcel_transit_total_amount)
                                                                        / {{number_format($parcel_transit_total_amount,2)}}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels?parcel_type=deliverd') }}">
                                            <div class="card card-animate bg-info">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Delivered</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                {{ $deliverd }}
                                                                @if($total_delivered_amount)
                                                                    / {{number_format($total_delivered_amount,2)}}
                                                                @endif
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels?parcel_type=return-pending') }}">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Returned to Pending
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>
                                                                {{ $return_pending }}
                                                                    @if($return_pending_amount)
                                                                        / {{number_format($return_pending_amount,2)}}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels?parcel_type=return-to-hub') }}">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Returned to Hub
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                {{ $return_hub }}
                                                                    @if($return_hub_amount)
                                                                        / {{number_format($return_hub_amount,2)}}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels?parcel_type=return-to-merchant') }}">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Returned to Merchant
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>
                                                                {{ $parcelreturn }}
                                                                @if($parcelreturn_amount)
                                                                   / {{number_format($parcelreturn_amount,2)}}
                                                                @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels?parcel_type=cancelled') }}">
                                            <div class="card card-animate bg-danger">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Canceled</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                {{ $cancelparcel }}
                                                                    @if($cancelparcel_amount)
                                                                        / {{number_format($cancelparcel_amount,2)}}
                                                                    @endif
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="{{ url('merchant/parcels?parcel_type=hold') }}">
                                            <div class="card card-animate bg-success">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Hold</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                {{ $totalhold }}
                                                                @if($total_hold_count_amount)
                                                                    / {{number_format($total_hold_count_amount,2)}}
                                                                @endif
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Partial Return
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span
                                                                    class="counter-value"
                                                                    data-target="{{ $total_partial_return }}">{{ $total_partial_return }}
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span
                                                                    class="counter-value"
                                                                    data-target="{{ $totalamount }}">
                                                                    {{ $totalamount }}
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Paid Amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span
                                                                    class="counter-value"
                                                                    data-target="{{ $total_paid }}">{{ $total_paid }}
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Unpaid amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span
                                                                    class="counter-value"
                                                                    data-target="{{ $total_unpaid }}">{{ $total_unpaid }}
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
@endsection
@section('custom-scripts')

@endsection
