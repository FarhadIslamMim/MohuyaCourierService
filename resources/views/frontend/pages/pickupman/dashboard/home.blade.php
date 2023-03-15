@extends('frontend.layouts.master')
@section('title', 'Home')
@section('custom-styles')

@endsection
@section('main-content')
    <div class="section bg-light mt-5">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Welcome, {{ $pickupman_info->name }}</h3>
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
                                          {{-- <a href="{{ route('pickupman.percels') }}">--}}
                                            <a href="{{ route('pickupman.today.percel') }}">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Parcel</p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span>
                                                                        {{ $dailyparcel }}
{{--                                                                        @if($dailyparcel_amount)--}}
{{--                                                                            / {{number_format($dailyparcel_amount,2)}}--}}
{{--                                                                        @endif--}}
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
                                            <a href="{{ route('pickupman.today.parcel.pending') }}?parcel_type=pending">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Pending
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span>
                                                                        {{ $dailypending }}

{{--                                                                        @if($dailypending_amount)--}}
{{--                                                                            / {{number_format($dailypending_amount,2)}}--}}
{{--                                                                        @endif--}}

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
                                            <a href="{{ route('pickupman.today.parcel.picked') }}?parcel_type=picked">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Picked
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span>
                                                                        {{ $dailypicked }}

{{--                                                                        @if($dailypicked_amount)--}}
{{--                                                                            / {{number_format($dailypicked_amount,2)}}--}}
{{--                                                                        @endif--}}
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
                                            <a href="">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Today Amount
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span>
                                                                         {{number_format($today_amount,2)}}

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
                                            <a href="">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Paid / Unpaid
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    {{number_format($today_paid,2)}}  /   {{number_format($today_unpaid,2)}}
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
                                            <a href="{{ route('pickupman.percels') }}">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Parcel</p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span>

                                                                        {{ $totalparcel }}
{{--                                                                        @if($totalparcel_amount)--}}
{{--                                                                            /  {{number_format($totalparcel_amount,2)}}--}}
{{--                                                                        @endif--}}

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
                                            <a href="{{ route('pickupman.percels') }}?parcel_type=pending">
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Pending
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span>{{ $totalpending }}
{{--                                                                        @if($totalpending_amount)--}}
{{--                                                                            /  {{number_format($totalpending_amount,2)}}--}}
{{--                                                                        @endif--}}

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
                                            <a href="{{ route('total.parcel.without_pending')}}">
{{--                                            <a href="{{ route('pickupman.percels') }}">--}}
                                                <div class="card card-animate bg-success">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Picked
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span>
                                                                        {{ $totals_picked }}

{{--                                                                        @if($totalpicked_amount)--}}
{{--                                                                            /  {{number_format($totalpicked_amount,2)}}--}}
{{--                                                                        @endif--}}
                                                                    </span>
{{--                                                                    {{ $totalparcel }}--}}
{{--                                                                    @if($totalparcel_amount)--}}
{{--                                                                        /  {{number_format($totalparcel_amount,2)}}--}}
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
                                            <a href="">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Total Amount
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    <span>

                                                                    {{number_format($total_amount,2)}}

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
                                            <a href="">
                                                <div class="card card-animate bg-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="fw-medium text-white-50 mb-0">Paid/Unpaid
                                                                </p>
                                                                <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                    {{number_format($total_paid,2)}} / {{number_format($total_due,2)}}
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

@endsection
