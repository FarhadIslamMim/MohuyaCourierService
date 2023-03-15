@extends('backend.layouts.master')
@section('title', 'Summary Report')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Summary Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Percel Manage</a></li>
                        <li class="breadcrumb-item active">Summary Report</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Summary Report content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date"> Start Date </label>
                                    <input type="date" name="start_date" value="{{ $start_date }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date"> End Date </label>
                                    <input type="date" name="end_date" value="{{ $end_date }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for=""> <br> </label>
                                    <input type="submit" value="Search" class="btn btn-success form-control">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success text-right" onclick="startPrint()">
                            Print </button>
                    </div>
                </div>
            </div>
            <div class="print_area">
                <div class="card">
                    <div class="card-header">
                        <h3>Summary Report</h3>
                        <p>
                            <b>{{ date('d F-Y', strtotime($start_date)) }} To
                                {{ date('d F-Y', strtotime($end_date)) }}</b>
                        </p>
                    </div>

                    <div class="card-body">
                        @include('backend.layouts.notifications')
                        <div class="table-responsive ">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    @php
                                        $totalOrder = 0;
                                        $toady_quantity = 0;
                                        $toady_collection = 0;
                                        $toady_delivery_charge = 0;
                                        $toady_codCharge = 0;
                                        $toady_merchant_payable = 0;
                                    @endphp
                                    <tr>
                                        <th class="text-center">SL</th>
                                        <th>Percel Type</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Total Collection</th>
                                        <th class="text-right">Delivery Charge</th>
                                        <th class="text-right">COD Charge</th>
                                        <th class="text-right">Merchant Payable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parcel_types as $parcel_type)
                                        <tr>
                                            <th class="text-center">
                                                {{ $loop->iteration }}
                                            </th>
                                            <th width="15%">
                                                {{ $parcel_type->title }}
                                            </th>
                                            <td class="text-right">
                                                {{ $parcel['today_' . $parcel_type->slug . '_quantity'] }}
                                                @php
                                                    $totalOrder += $parcel['today_' . $parcel_type->slug . '_quantity'];
                                                    $toady_quantity += $parcel['today_' . $parcel_type->slug . '_quantity'];
                                                @endphp
                                            </td>
                                            <td class="text-right">
                                                {{ $parcel['today_' . $parcel_type->slug . '_collection'] }}
                                                @php
                                                    $toady_collection += $parcel['today_' . $parcel_type->slug . '_collection'];
                                                @endphp
                                            </td>
                                            <td class="text-right">
                                                {{ $parcel['today_' . $parcel_type->slug . '_delivery_charge'] }}
                                                @php
                                                    $toady_delivery_charge += $parcel['today_' . $parcel_type->slug . '_delivery_charge'];
                                                @endphp
                                            </td>
                                            <td class="text-right">
                                                {{ $parcel['today_' . $parcel_type->slug . '_codCharge'] }}
                                                @php
                                                    $toady_codCharge += $parcel['today_' . $parcel_type->slug . '_codCharge'];
                                                @endphp
                                            </td>
                                            <td class="text-right">
                                                {{ $parcel['today_' . $parcel_type->slug . '_merchant_payable'] }}
                                                @php
                                                    $toady_merchant_payable += $parcel['today_' . $parcel_type->slug . '_merchant_payable'];
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <th class="text-right" colspan="2">
                                            Total
                                        </th>
                                        <th class="text-right">
                                            {{ $toady_quantity }}
                                        </th>
                                        <th class="text-right">
                                            {{ $toady_collection }}
                                        </th>
                                        <th class="text-right">
                                            {{ $toady_delivery_charge }}
                                        </th>
                                        <th class="text-right">
                                            {{ $toady_codCharge }}
                                        </th>
                                        <th class="text-right">
                                            {{ $toady_merchant_payable }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
                        <div class="card ">
                            <div class="col-sm-12">
                                <h3 class="text-center">
                                    <b> Total Summary</b>
                                </h3>
                            </div>
                            <div class="table-responsive ">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        @php
                                            $totalOrder = 0;
                                            $total_quantity = 0;
                                            $total_collection = 0;
                                            $total_delivery_charge = 0;
                                            $total_codCharge = 0;
                                            $total_merchant_payable = 0;
                                        @endphp
                                        <tr>
                                            <th class="text-center">SL</th>
                                            <th>Percel Type</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Total Collection</th>
                                            <th class="text-right">Delivery Charge</th>
                                            <th class="text-right">Cod Charge</th>
                                            <th class="text-right">Merchant Payable </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($parcel_types as $parcel_type)
                                            <tr>
                                                <th class="text-center">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <th width="15%">
                                                    {{ $parcel_type->title }}
                                                </th>
                                                <td class="text-right">
                                                    {{ $parcel['total_' . $parcel_type->slug . '_quantity'] }}
                                                    @php
                                                        $totalOrder += $parcel['total_' . $parcel_type->slug . '_quantity'];
                                                        $total_quantity += $parcel['total_' . $parcel_type->slug . '_quantity'];
                                                    @endphp
                                                </td>
                                                <td class="text-right">
                                                    {{ $parcel['total_' . $parcel_type->slug . '_collection'] }}
                                                    @php
                                                        $total_collection += $parcel['total_' . $parcel_type->slug . '_collection'];
                                                    @endphp
                                                </td>
                                                <td class="text-right">
                                                    {{ $parcel['total_' . $parcel_type->slug . '_delivery_charge'] }}
                                                    @php
                                                        $total_delivery_charge += $parcel['total_' . $parcel_type->slug . '_delivery_charge'];
                                                    @endphp
                                                </td>
                                                <td class="text-right">
                                                    {{ $parcel['total_' . $parcel_type->slug . '_codCharge'] }}
                                                    @php
                                                        $total_codCharge += $parcel['total_' . $parcel_type->slug . '_codCharge'];
                                                    @endphp
                                                </td>
                                                <td class="text-right">
                                                    {{ $parcel['total_' . $parcel_type->slug . '_merchant_payable'] }}
                                                    @php
                                                        $total_merchant_payable += $parcel['total_' . $parcel_type->slug . '_merchant_payable'];
                                                    @endphp
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th class="text-right" colspan="2">
                                                Total
                                            </th>
                                            <th class="text-right">
                                                {{ $total_quantity }}
                                            </th>
                                            <th class="text-right">
                                                {{ $total_collection }}
                                            </th>
                                            <th class="text-right">
                                                {{ $total_delivery_charge }}
                                            </th>
                                            <th class="text-right">
                                                {{ $total_codCharge }}
                                            </th>
                                            <th class="text-right">
                                                {{ $total_merchant_payable }}
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Summary Report content end -->

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        function startPrint() {
            $('.dt-buttons').hide();
            $('.dataTables_paginate').hide();
            $('body').html($('.print_area').html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
