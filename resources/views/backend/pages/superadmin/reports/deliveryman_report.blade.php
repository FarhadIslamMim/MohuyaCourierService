@extends('backend.layouts.master')
@section('title', 'Deliveryman Report')
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
                <h4 class="mb-sm-0">Deliveryman Report</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Parcel Manage</a></li>
                        <li class="breadcrumb-item active">Deliveryman Report</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="">
                <div class="row gy-4">
                    <input type="hidden" value="1" name="target_value">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Select Deliveryman</label>
                            <select name="deliveryman_id" id="deliveryman_id" class="form-control select2">
                                 <option value="" selected disabled>--Select Deliveryman--</option>
                                @foreach ($deliverymans as $deliveryman)
                                    <option value="{{ $deliveryman->id }}"
                                            @if (old('deliveryman_id', $deliveryman_info->id ?? '') == $deliveryman->id) selected @endif>
                                        {{ $deliveryman->name }} - {{ $deliveryman->phone }}
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
                    <div class="col-md-2">
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


    <!-- end page title -->
    <div class="row">
        @if ($deliveryman_info)
            <div class="content-fluid">
                <div class="print_area">
                    <div class="">
                        <div class="">
                            <div class="print_area">
                                <div class="">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="details" style="line-height: 8px;">
                                                    <h3 class="text-center"> {{ $site_settings->name }} </h3>
                                                    <p class="text-center">{{ $site_settings->address }}</p>
                                                    <p class="text-center">Email : {{ $site_settings->email }} - Phone :
                                                        {{ $site_settings->mobile_no }}</p>
                                                </div>

                                                <br>
                                            </div>
                                            <div class="col-sm-12">
                                                <table class="table table-sm">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 25%">
                                                                <span class="deliveryman_info flex">
                                                                    <b>Delivery Person:</b>

                                                                    {{ $deliveryman_info->name ?? '' }}
                                                                    <br>

                                                                    Phone : {{ $deliveryman_info->phone ?? '' }}
                                                                    <br>
                                                                    <b>Date :</b> {{ date('d M Y') }}
                                                                </span>
                                                        </th>
                                                        <th style="width: 30%">
                                                                <span class="flex">
                                                                    Total Parcel {{ count($parcels) }}
                                                                </span>
                                                        </th>
                                                        <th style="width: 45%; line-height: 8px;">
                                                                <span class="total_info flex">
                                                                    <p>Total Cash :
                                                                        .....................................................................
                                                                    </p>
                                                                    <p>bkash : .............................. Other :
                                                                        .................................</p>
                                                                     <p>NC : ................... EC : .................... Picked : .................</p>
                                                                    <p>Partials : ................ Hold : .............. Return :
                                                                        ...............</p>
                                                                </span>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered table-sm" style="margin-top: 15px">
                                                    <thead>
                                                    <tr>
                                                        <th width="15" class="text-center">SL</th>
                                                        <th width="80" class="text-center"> Invoice <br> No.</th>
                                                        <th width="40" class="text-center">Tracking ID</th>
                                                        <th width="100" class="text-center"> Merchant Details </th>
                                                        <th width="250" class="text-center"> Customer Details </th>
                                                        <th  class="text-center">Created Date</th>
                                                        <th  class="text-center">Pickup Date</th>
                                                        <th class="text-center">Delivery Date </th>
                                                        <th width="20" class="text-center">Status</th>
                                                        <th width="20" class="text-center">Parcel Amount</th>
                                                        <th width="20" class="text-center">Collected Amount</th>
                                                        <th width="100" class="text-center">Partial Return</th>
                                                         <th class="text-right d_charge" >Delivery Charge </th>
                                                        <th class="text-right cod_charge">COD Charge</th>
                                                         <th  width="25"  class="text-right m_pay">Merchant Pay</th>
                                                        <th width="150" class="text-center"> Note</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="reqtablenew">
                                                    @foreach ($parcels as $key => $parcel)
                                                        <tr>
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">
                                                                @if ($parcel->invoiceNo)
                                                                    {{ $parcel->invoiceNo }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{ $parcel->trackingCode }}</td>
                                                            <td>
                                                                {{ $parcel->merchant->companyName ?? ''}} <br>
                                                                0{{ $parcel->merchant->phoneNumber ?? ' ' }} <br>

                                                            </td>
                                                            <td>
                                                                {{ $parcel->recipientName }}-
                                                                {{ $parcel->recipientPhone }}
                                                                <br>
                                                                {{ $parcel->delivery_address ?? '' }},{{ $parcel->area->name ?? '' }},{{ $parcel->thana->name ?? '' }},{{ $parcel->district->name ?? '' }}
                                                                @if ($parcel->alternative_mobile_no)
                                                                    ,
                                                                    {{ $parcel->alternative_mobile_no }}
                                                                @endif
                                                            </td>

                                                            <td class="">
                                                               {{ date('d M Y g:i A', strtotime($parcel->created_at)) }}
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
                                                            <td class="text-center">
                                                                {{ $parcel->parcelStatus->title ?? '' }}
                                                            </td>

                                                             <td class="text-right">{{ number_format($parcel->cod, 2) }}</td>
                                                             <td class="text-right">
                                                                 {{ number_format($parcel->collected_amount, 2) }}
{{--                                                                {{ number_format($parcel->deliveryCharge, 2) }}--}}
                                                             </td>

                                                            <td class="text-right">
                                                                {{ number_format($parcel->partial_return_amount, 2) }}
                                                            </td>
                                                            <td class="text-right d_charge">
                                                                {{ number_format($parcel->deliveryCharge, 2) }}
                                                            </td>
                                                            <td class="text-right cod_charge">
                                                                {{number_format($parcel->codCharge,2)}}
                                                            </td>
                                                             <td class="text-right m_pay">
                                                                {{ number_format($parcel->merchantAmount, 2) }}
                                                             </td>
                                                            <td class="text-center">
                                                                @if ($parcel->deliveryman_note)
                                                                    {{ $parcel->deliveryman_note }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>

                                                     <tr>
                                                        <th colspan="9">Total Amount </th>
                                                        <th class="text-right">
                                                            {{ number_format($parcels->sum('cod'), 2) }}
                                                        </th>
                                                         <th class="text-right">
                                                             {{ number_format($parcels->sum('collected_amount'), 2) }}
                                                         </th>
                                                         <th class="text-right">
                                                             {{ number_format($parcels->sum('partial_return_amount'), 2) }}
                                                         </th>
                                                         <th class="text-right d_charge">
                                                             {{ number_format($parcels->sum('deliveryCharge'), 2) }}
                                                         </th>
                                                         <th class="text-right cod_charge">
                                                             {{ number_format($parcels->sum('codCharge'), 2) }}
                                                         </th>
                                                         <th class="text-right m_pay">
                                                             {{ number_format($parcels->sum('merchantAmount'), 2) }}
                                                         </th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="col-md-12">
                                                Print Time: {{ date('d M Y H:i a') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @else
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
            $('.d_charge').hide();
            $('.m_pay').hide();
            $('.cod_charge').hide();
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
