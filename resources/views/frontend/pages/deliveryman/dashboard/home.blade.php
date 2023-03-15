@extends('frontend.layouts.master')
@section('title', 'Home')
@section('custom-styles')

@endsection
@section('main-content')
    <div class="section bg-light mt-5">
        <div class="container">
            <div class="row">
                {{-- @include('frontend.pages.deliveryman.layouts.sidebar') --}}
                <div class="container">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Welcome, {{ $deliveryman_info->name }}</h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4>Today Parcel Details</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="stats-reportList-inner">
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6">
                                            <a href="{{ route('deliveryman.today.percel') }}">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Parcel</p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $dailyparcel }}">{{ $dailyparcel }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.today.percel') }}?parcel_type=pending">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Pending
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $dailypending }}">{{ $dailypending }}
                                                                    </span>
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.today.percel') }}?parcel_type=picked">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Picked
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $dailypicked }}">{{ $dailypicked }}
                                                                    </span>
{{--                                                                    @if ($today_picked_amount)--}}
{{--                                                                        / {{ $today_picked_amount }}৳--}}
{{--                                                                    @endif--}}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.today.percel') }}?parcel_type=in-transit">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today In Transit
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $dailyintransit }}">{{ $dailyintransit }}
                                                                    </span>
{{--                                                                    @if ($today_transit_amount)--}}
{{--                                                                        / {{ $today_transit_amount }}৳--}}
{{--                                                                    @endif--}}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.today.percel') }}?parcel_type=hold">
                                                <div class="card card-animate bg-warning">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Hold</p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $dailyhold }}">{{ $dailyhold }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.today.percel') }}?parcel_type=deliverd">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Delivered
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $dailydelivered }}">{{ $dailydelivered }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.today.percel') }}?parcel_type=return-pending">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Return to
                                                                    Pending
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $dailyreturnpending }}">{{ $dailyreturnpending }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.today.percel') }}?parcel_type=return-to-hub">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Return to Hub
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $dailyreturntohub }}">{{ $dailyreturntohub }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Collected
                                                                    Amount
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $today_collected_amount }}">{{ $today_collected_amount }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Partial
                                                                    Return
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $daily_partial_return }}">{{ $daily_partial_return }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="#" title="">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Income
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $today_amount }}">{{ $today_amount }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
{{--                                            <a href="javascript:void()">--}}
                                            <a href="#">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Paid/Unpaid
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    {{ $today_paid }} / {{ $today_unpaid }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                <!-- dashboard payment -->
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4>Total Parcel Details</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="stats-reportList-inner">
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6">
                                            <a href="{{ route('deliveryman.percels') }}">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Parcel</p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $totalparcel }}">{{ $totalparcel }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.percels') }}?parcel_type=pending">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Pending</p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $totalpending }}">{{ $totalpending }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.percels') }}?parcel_type=picked">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Picked
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $totalpicked }}">{{ $totalpicked }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.percels') }}?parcel_type=in-transit">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total In Transit
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $totaltransit }}">{{ $totaltransit }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.percels') }}?parcel_type=hold">
                                                <div class="card card-animate bg-warning">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Hold</p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $totalhold }}">{{ $totalhold }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.percels') }}?parcel_type=deliverd">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Delivered
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $totaldelivery }}">{{ $totaldelivery }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.percels') }}?parcel_type=return-pending">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Return to
                                                                    Pending
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $returnpendin }}">{{ $returnpendin }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                            <a href="{{ route('deliveryman.percels') }}?parcel_type=return-to-hub">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Return to Hub
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $returnhub }}">{{ $returnhub }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Collected
                                                                    Amount
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $collected_amount }}">{{ $collected_amount }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Partial
                                                                    Return
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span>
                                                                    {{ number_format( $total_partial_return_amount,2) }}
                                                                    </span>
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                                                <p class="fw-medium text-white-50 mb-0">Total Income
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span class="counter-value"
                                                                        data-target="{{ $total_amount }}">{{ $total_amount }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                                                <p class="fw-medium text-white-50 mb-0">Paid/Unpaid
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    {{ $total_paid }} / {{ $total_due }}
                                                                </h2>
                                                            </div>
                                                            <div>
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-clock text-white">
                                                                            <circle cx="12" cy="12"
                                                                                r="10">
                                                                            </circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
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
                                <!-- dashboard payment -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-scripts')


    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Your browser doesn't support location");
            }
        }

        function showPosition(position) {
            $.ajax({
                type: "GET",
                url: "{{ route('location.update') }}",
                data: {
                    'latitude': position.coords.latitude,
                    'longitude': position.coords.longitude,
                },
                success: function(response) {
                    console.log(response);
                }
            });
        }

        getLocation();
    </script>
@endsection
