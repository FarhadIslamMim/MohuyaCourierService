@extends('frontend.layouts.master')
@section('title', 'Percels')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <section class="section mt-5">
        <div class="container">
            <!-- Deliveryman Report content start -->
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select Deliveryman</label>
                                    <select name="deliveryman_id" id="deliveryman_id" class="form-control select2">
                                        {{-- <option value=""> Select deliveryman </option> --}}
                                        @foreach ($deliverymans as $deliveryman)
                                            @foreach ($deliveryman->getDeliveryMan as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (old('deliveryman_id', $deliveryman_info->id ?? '') == $item->id) selected @endif>
                                                    {{ $item->name }} - {{ $item->phone }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Start Date">Start Date</label>
                                    <input type="date" name="start_date"
                                        value="{{ request()->get('start_date') ? date('Y-m-d', strtotime(request()->get('start_date'))) : '' }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="endDate">End Date</label>
                                    <input type="date" name="end_date"
                                        value="{{ request()->get('end_date') ? date('Y-m-d', strtotime(request()->get('end_date'))) : '' }}"
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
                @if (count($parcels) > 0)
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
                                                            <p class="text-center">Email : {{ $site_settings->email }} -
                                                                Phone :
                                                                {{ $site_settings->mobile_no }}</p>
                                                        </div>
                                                        <img class="logo" src="{{ url($setting->logo) }}" alt="Logo"
                                                            width="80" height="80">
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
                                                                            <b>Date :</b> {{ date('d-m-Y') }}
                                                                        </span>
                                                                    </th>
                                                                    <th style="width: 30%">
                                                                        <span class="flex">
                                                                            Total Percel {{ count($parcels) }}
                                                                        </span>
                                                                    </th>
                                                                    <th style="width: 45%; line-height: 8px;">
                                                                        <span class="total_info flex">
                                                                            <p>Total Cash :
                                                                                ............................................................
                                                                            </p>
                                                                            <p>bkash : ..............,,........ Other :
                                                                                ....................</p>
                                                                            {{-- <p>NC : .............. EC : ........ Pick : .........</p> --}}
                                                                            <p>Partials : ............ Hold : ...........
                                                                                Return
                                                                                :
                                                                                ...........</p>
                                                                        </span>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-bordered table-sm"
                                                            style="margin-top: 15px">
                                                            <thead>
                                                                <tr>
                                                                    <th width="15" class="text-center">SL</th>
                                                                    <th width="80" class="text-center"> Invoice No.</th>
                                                                    <th width="40" class="text-center">Tracking ID</th>
                                                                    <th width="100" class="text-center"> Merchant Deatils
                                                                    </th>
                                                                    <th width="250" class="text-center"> Customer Details
                                                                    </th>
                                                                    {{-- <th> @lang('common.pickup_date') </th>
                                                            <th> @lang('common.delivery_date') </th> --}}
                                                                    <th width="20" class="text-center">Status</th>
                                                                    <th width="20" class="text-center">Amount(COD)</th>
                                                                    <th width="100" class="text-center">Partial Return
                                                                    </th>
                                                                    {{-- <th class="text-right"> @lang('common.delivery_charge') </th>
                                                            <th class="text-right"> @lang('common.cod_charge') </th> --}}
                                                                    {{-- <th  width="25"  class="text-right"> @lang('common.payable_amount') </th> --}}
                                                                    <th width="150" class="text-center"> Note</th>
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
                                                                        <td class="text-center">{{ $parcel->trackingCode }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $parcel->merchant->companyName }} <br>
                                                                            0{{ $parcel->merchant->phoneNumber }} <br>

                                                                        </td>
                                                                        <td>
                                                                            {{ $parcel->recipientName }}-
                                                                            {{ $parcel->recipientPhone }}
                                                                            <br>
                                                                            {{ $parcel->delivery_address }}
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
                                                                        <td class="text-right">
                                                                            {{ number_format($parcel->cod, 2) }}
                                                                        </td>
                                                                        <td class="text-right">
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

                                                                {{-- <tr>
                                                            <th colspan="10"> @lang('common.total_amount') </th>
                                                            <th class="text-right">
                                                                {{ number_format($dailyparcels->sum('pickupman_amount'), 2) }}</th>
                                                        </tr> --}}
                                                                <tr>
                                                                    <th colspan="8">Total Collection</th>
                                                                    <th class="text-right">
                                                                        {{ number_format($parcels->sum('cod'), 2) }}
                                                                    </th>
                                                                </tr>
                                                                <tr class="custom">
                                                                    <th colspan="8">Delivery Charge</th>
                                                                    <th class="text-right">
                                                                        {{ number_format($parcels->sum('deliveryCharge'), 2) }}
                                                                    </th>
                                                                </tr>
                                                                <tr class="custom">
                                                                    <th colspan="8">COD Charge</th>
                                                                    <th class="text-right">
                                                                        {{ number_format($parcels->sum('codCharge'), 2) }}
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
                @endif
                @if (count($dailyparcels) > 0)
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
                                                                    <b>Delivery Person:</b>

                                                                    {{ $deliveryman_info->name ?? '' }}
                                                                    <br>

                                                                    Phone : {{ $deliveryman_info->phone ?? '' }}
                                                                    <br>
                                                                    <b>Date :</b> {{ date('d-m-Y') }}
                                                                </span>
                                                            </th>
                                                            <th style="width: 30%">
                                                                <span class="flex">
                                                                    Total Percel # {{ count($dailyparcels) }}
                                                                </span>
                                                            </th>
                                                            <th style="width: 45%; line-height: 8px;">
                                                                <span class="total_info flex">
                                                                    <p>Total Cash :
                                                                        ............................................................
                                                                    </p>
                                                                    <p>bkash : ..............,,........ Other :
                                                                        ....................
                                                                    </p>
                                                                    {{-- <p>NC : .............. EC : ........ Pick : .........</p> --}}
                                                                    <p>Partials : ............ Hold : ........... Return :
                                                                        ...........</p>
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
                                                            <th width="80" class="text-center"> Invoice No.</th>
                                                            <th width="40" class="text-center">Tracking ID</th>
                                                            <th width="100" class="text-center"> Merchant Deatils </th>
                                                            <th width="250" class="text-center"> Customer Details </th>
                                                            {{-- <th> @lang('common.pickup_date') </th>
                                                    <th> @lang('common.delivery_date') </th> --}}
                                                            <th width="20" class="text-center">Status</th>
                                                            <th width="20" class="text-center">Amount(COD)</th>
                                                            <th width="100" class="text-center">Partial Return</th>
                                                            {{-- <th class="text-right"> @lang('common.delivery_charge') </th>
                                                    <th class="text-right"> @lang('common.cod_charge') </th> --}}
                                                            {{-- <th  width="25"  class="text-right"> @lang('common.payable_amount') </th> --}}
                                                            <th width="150" class="text-center"> Note</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dailyparcels as $key => $parcel)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td class="text-center">
                                                                    @if ($parcel->invoiceNo)
                                                                        {{ $parcel->invoiceNo }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">{{ $parcel->trackingCode }}</td>
                                                                <td>
                                                                    {{ $parcel->merchant->companyName }} <br>
                                                                    0{{ $parcel->merchant->phoneNumber }} <br>

                                                                </td>
                                                                <td>
                                                                    {{ $parcel->recipientName }}-
                                                                    {{ $parcel->recipientPhone }}
                                                                    <br>
                                                                    {{ $parcel->delivery_address }}
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
                                                                <td class="text-right">
                                                                    {{ number_format($parcel->cod, 2) }}
                                                                </td>
                                                                <td class="text-right">
                                                                    {{number_format($parcel->partial_return_amount, 2)}}
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

                                                        {{-- <tr>
                                                    <th colspan="10"> @lang('common.total_amount') </th>
                                                    <th class="text-right">
                                                        {{ number_format($dailyparcels->sum('pickupman_amount'), 2) }}</th>
                                                </tr> --}}
                                                        <tr>
                                                            <th colspan="8">Total Collection</th>
                                                            <th class="text-right">
                                                                {{ number_format($dailyparcels->sum('cod'), 2) }}
                                                            </th>
                                                        </tr>
                                                        <tr class="custom">
                                                            <th colspan="8">Delivery Charge</th>
                                                            <th class="text-right">
                                                                {{ number_format($dailyparcels->sum('deliveryCharge'), 2) }}
                                                            </th>
                                                        </tr>
                                                        <tr class="custom">
                                                            <th colspan="8">COD Charge</th>
                                                            <th class="text-right">
                                                                {{ number_format($dailyparcels->sum('codCharge'), 2) }}
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
                @else
                    <div class="card">
                        <div class="card-body">
                            <i class="bx bx-error-alt"></i> Sorry, No record found!
                        </div>
                    </div>
                @endif

            </div>
            <!-- Merchant Report content end -->

        </div>
    </section>
@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        function startPrint() {
            $('.dt-buttons').hide();
            $('.dataTables_paginate').hide();
            $('.custom').hide();
            $('body').html($('.print_area').html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
