@extends('backend.layouts.master')
@section('title', 'Pickupman Report')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Pickupman Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Parcel Manage</a></li>
                        <li class="breadcrumb-item active">Pickupman Report</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Pickupman Report content start -->

    <div class="card">
        <div class="card-body">
            <form action="">
                <div class="row gy-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Select Merchant</label>
                            <select name="pickupman_id" id="pickupman_id" class="form-control select2">
                                 <option value="" selected disabled> Select PickupMan </option>
                                @foreach ($pickupmans as $pickupman)
                                    <option value="{{ $pickupman->id }}"
                                        @if (old('pickupman_id', $pickupman_info->id ?? '') == $pickupman->id) selected @endif>
                                        {{ $pickupman->name }} - {{ $pickupman->phone }}
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

    <div class="row">
        @if ($pickupman_info)
            <div class="content-fluid">
                <div class="print_area">
                    <div class="card">
                        <div class="card-body">
                            <div class="print_area">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="details" style="line-height: 8px;">
                                                    <h3 class="text-center"> {{ $site_settings->name }} </h3>
                                                    <p class="text-center">{{ $site_settings->address }}</p>
                                                    <p class="text-center">Email : {{ $site_settings->email }} - Phone :
                                                        {{ $site_settings->mobile_no }}</p>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 25%">
                                                                <span class="deliveryman_info flex">
                                                                    <b>Pickup Person:</b>
                                                                    {{ $pickupman_info->name ?? '' }}
                                                                    <br>
                                                                    Phone : {{ $pickupman_info->phone ?? '' }}
                                                                    <br>
                                                                    <b>Date :</b> {{ date('d M Y') }}
                                                                </span>
                                                            </th>
                                                            <th style="width: 30%">
                                                                <span class="flex">
                                                                    Total Parcel {{ number_format(count($parcels)) }}
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
                                                            <th class="text-center">SL</th>
                                                            <th class="text-center"> Invoice No.</th>
                                                            <th class="text-center">Tracking ID</th>
                                                            <th  class="text-center">Created Date</th>
                                                            <th  class="text-center">Picked Date</th>
                                                            <th  class="text-center"> Merchant Details </th>
                                                            <th  class="text-center"> Customer Details </th>
                                                            {{-- <th> @lang('common.pickup_date') </th>
                                                            <th> @lang('common.delivery_date') </th> --}}
                                                            <th  class="text-center">Status</th>
                                                            <th  class="text-center">Parcel Amount</th>
                                                            <!--<th width="100" class="text-center">Partial Return</th>-->
                                                            {{-- <th class="text-right"> @lang('common.delivery_charge') </th>
                                                            <th class="text-right"> @lang('common.cod_charge') </th> --}}
                                                            {{-- <th  width="25"  class="text-right"> @lang('common.payable_amount') </th> --}}
                                                            <th  class="text-center"> Note</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($parcels as $key => $parcel)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td class="text-center">
                                                                    @if ($parcel->invoiceNo)
                                                                        {{ $parcel->invoiceNo }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">{{ $parcel->trackingCode }}</td>

                                                                <td class="text-center">
                                                                    {{ date('d M Y g:i A', strtotime( $parcel->created_at ?? '')) }}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{ date('d M Y g:i A', strtotime( $parcel->pickup_date ?? '')) }}
                                                                </td>
                                                                <td>
                                                                    {{ $parcel->merchant->companyName ?? ''}} <br>
                                                                    0{{ $parcel->merchant->phoneNumber ?? '' }} <br>

                                                                </td>
                                                                <td>
                                                                    {{ $parcel->recipientName ?? '' }}-
                                                                    {{ $parcel->recipientPhone ?? ''}}
                                                                    <br>
                                                                    {{ $parcel->delivery_address ?? ''}},{{$parcel->area->name ?? ''}},{{$parcel->thana->name ??''}},{{$parcel->district->name??''}}
                                                                    @if ($parcel->alternative_mobile_no)
                                                                        ,
                                                                        {{ $parcel->alternative_mobile_no }}
                                                                    @endif
                                                                </td>


                                                                {{-- <td>
                                                                    @if ($parcel->pickup_date)
                                                                        {{ date('d M Y', strtotime($parcel->pickup_date)) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($parcel->delivery_date)
                                                                        {{ date('d M Y', strtotime($parcel->delivery_date)) }}
                                                                    @endif
                                                                </td> --}}
                                                                <td class="text-center">
                                                                    {{ $parcel->parcelStatus->title ?? '' }}
                                                                </td>


                                                                {{-- <td class="text-right">{{ number_format($parcel->cod, 2) }}</td> --}}
                                                                {{-- <td class="text-right">
                                                                    {{ number_format($parcel->deliveryCharge, 2) }}</td> --}}
                                                                <td class="text-right">{{ number_format($parcel->cod, 2) }}
                                                                </td>

                                                                {{-- <td class="text-right">
                                                                    {{ number_format($parcel->productPrice, 2) }}</td> --}}
                                                                <td class="text-center">
                                                                    {{-- <span
                                                                        style="border:1px solid #282828; padding:2px 3px; font-size:13px">
                                                                        {{ $parcel->weight->name }}</span>
                                                                    <br> --}}


                                                                    @if ($parcel->note)
                                                                        {{ $parcel->note }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="8">Total Collection</th>
                                                            <th class="text-right">
                                                                {{ number_format($parcels->sum('cod'), 2) }}
                                                            </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="col-md-12">
                                                Print Time: {{ date('d M Y g:i a') }}
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
            $('.custom').hide();
            $('.dataTables_paginate').hide();
            $('body').html($('.print_area').html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
