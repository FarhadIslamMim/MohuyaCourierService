@extends('backend.layouts.master')
@section('title', 'Merchant Report')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .row_active{
            background-color: #908d8d;
        }
    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Merchant Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Parcel Manage</a></li>
                        <li class="breadcrumb-item active">Merchant Report</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Merchant Report content start -->

    <div class="card">
        <div class="card-body">
            <form action="">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Select Merchant</label>
                            <select name="merchant_id" id="merchant_id" class="form-control select2">
                                 <option value="" selected disabled> Select Merchant </option>
                                @foreach ($merchants as $merchant)
                                    <option value="{{ $merchant->id }}" @if (old('merchant_id', $merchant_info->id ?? '') == $merchant->id) selected @endif>
                                        {{ $merchant->companyName }} ({{ $merchant->firstName }} -
                                        {{ $merchant->phoneNumber }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Start Date">Start Date</label>
                            <input type="date" name="start_date"
                                   value="{{ request()->get('start_date')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" name="end_date"
                                   value="{{ request()->get('end_date')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="trackingCode">Tracking Code</label>
                            <input type="text" name="trackingCode"
                                value="{{ old('trackingCode', request()->get('trackingCode')) }}" class="form-control"
                                placeholder="Enter tracking no.">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="parcel_type">Parcel Type</label>
                            <select name="status" id="status" class="form-control select2">
                                <option value="" selected disabled>  All Parcel Type </option>
                                @foreach ($parcel_types as $parcel_type)
                                    <option value="{{ $parcel_type->id }}"
                                        @if (old('status', request()->get('status')) == $parcel_type->id) selected @endif>
                                        {{ $parcel_type->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Search</label>
                            <br>
                            <button type="submit" class="btn btn-md btn-info"><i class=" bx bx-search-alt-2"></i>
                                Search</button>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="form-group">
                            <button type="button" class="btn btn-sm btn-primary text-right" onclick="startPrint()">
                            Print </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @if (count($parcels) > 0)
            <div class="content-fluid">
                <div class="print_area">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 class="text-center"> Merchant Parcel Report</h3>
                                    @if (request()->get('start_date') && request()->get('end_date'))
                                        <h6 class="text-center">
                                            Date : {{ date('d M Y', strtotime(request()->get('start_date'))) }}
                                            to
                                            {{ date('d M Y', strtotime(request()->get('end_date'))) }}
                                        </h6>
                                    @else
                                        <h6 class="text-center">
                                            Date : Full time
                                        </h6>
                                    @endif
                                    <br>
                                </div>
{{--                                <div class="col-sm-8">--}}
{{--                                    <img class="logo" src=@foreach ($whitelogo as $logo)--}}
{{--                                      {{ asset('public/' . $logo->image) }} @endforeach--}}
{{--                                        alt="Logo" width="100" height="100">--}}
{{--                                </div>--}}
                                <div class="col-sm-4">
                                    <span class="merchant_info text-right">
                                        <b> Merchant Name : </b> {{ $merchant_info->companyName ?? '' }} <br>
                                        ({{ $merchant_info->firstName ?? '' }} -
                                        0{{ $merchant_info->phoneNumber ?? '' }})
                                    </span>
                                    <br>
                                    <span class="total_info">
                                        Total Parcel : {{ count($parcels) }}
                                    </span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <br>
                                    <br>
                                    <div class="table-reponsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th width="15">SL</th>
                                                    <th width="15">Invoice No.</th>
                                                    <th width="90">Tracking <br> ID</th>
                                                    <th>Customer <br> Details </th>
                                                    <th>Created <br> Date</th>
                                                    <th>Pickup <br> Date</th>
                                                    <th>Delivery <br> Date</th>
                                                    <th>Delivery <br> Address</th>
                                                    <th>Status</th>
                                                    <th class="text-right">Collect Amount</th>
                                                    <th class="text-right">Delivery Charge</th>
                                                    <th class="text-right">COD Charge</th>
                                                    <th class="text-right">Payable Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="reqtablenew">

                                                @foreach ($parcels as $key => $parcel)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $parcel->invoiceNo }}</td>
                                                        <td>{{ $parcel->trackingCode }}</td>
                                                        <td>
                                                            {{ $parcel->recipientName }} <br>
                                                            {{ $parcel->recipientPhone }}
                                                            @if ($parcel->alternative_mobile_no)
                                                                ,
                                                                {{ $parcel->alternative_mobile_no }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($parcel->created_at)
                                                                {{ date('d M Y g:i A', strtotime($parcel->created_at)) }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($parcel->pickup_date)
                                                                {{ date('d M Y g:i A', strtotime($parcel->pickup_date)) }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($parcel->delivery_date)
                                                                {{ date('d M Y g:i A', strtotime($parcel->delivery_date)) }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($parcel->delivery_address)
                                                                {{ $parcel->delivery_address }},
                                                            @endif
                                                            {{-- @if ($parcel->area)
                                                                {{ $parcel->area->name }},
                                                            @endif
                                                            @if ($parcel->thana)
                                                                {{ $parcel->thana->name }},
                                                            @endif
                                                            @if ($parcel->district)
                                                                {{ $parcel->district->name }},
                                                            @endif
                                                            @if ($parcel->division)
                                                                {{ $parcel->division->name }},
                                                            @endif --}}
                                                        </td>
                                                        <td>{{ $parcel->parcelStatus->title ?? '' }}</td>
                                                        <td class="text-right">
                                                            {{ number_format($parcel->cod, 2) }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ number_format($parcel->deliveryCharge, 2) }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ number_format($parcel->codCharge, 2) }}
                                                        </td>
                                                        <td class="text-right">
                                                            @if (in_array($parcel->status, [4, 6, 7, 8]))
                                                                {{ number_format($parcel->merchantDue, 2) }}
                                                            @else
                                                                0.00
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="9">Total</th>
                                                    <th class="text-right">{{ number_format($total['cod'], 2) }}</th>
                                                    <th class="text-right">{{ number_format($total['delivery_charge'], 2) }}</th>
                                                    <th class="text-right">{{ number_format($total['cod_charge'], 2) }}</th>
                                                    <th class="text-right">{{ number_format($total['merchant_pay'], 2) }}</th>
                                                </tr>

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    Print Time: {{ date('d M Y g:i a') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @elseif($parcels)
            <div class="card">
                <div class="card-body">
                    <i class="bx bx-error-alt"></i> Sorry, No record found!
                </div>
            </div>
        @endif
    </div>
    <!-- Merchant Report content end -->

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
    <script>
        $(document).ready(function () {
            $('#reqtablenew tr').click(function () {
                $('#reqtablenew tr').removeClass("row_active");
                $(this).addClass("row_active");
            });
        });
    </script>
@endsection
