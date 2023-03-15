@extends('frontend.layouts.master')
@section('title', 'Percel Create')
@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/styles.css') }}">
@endsection
@section('content')
    <div class="dashboard">
        <aside>
            <div class="container">
                <div class="main-content">
                    <div class="row">
                        {{-- @include('frontend.pages.merchant.layouts.sidebar') --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Percel Create</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row addpercel-inner">
                                                <div class="col-lg-7 col-md-12 col-sm-12">
                                                    <div class="fraud-search">
                                                        @include('frontend.layouts.notifications')
                                                        <form action="{{ route('merchant.percel.store') }}" method="POST">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h6> Percel Information </h6>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-3">
                                                                        <input type="text"
                                                                            class="form-control invoiceNo {{ $errors->has('invoiceNo') ? ' is-invalid' : '' }}"
                                                                            value="{{ old('invoiceNo') }}" name="invoiceNo"
                                                                            placeholder="Invoice No.">
                                                                        @if ($errors->has('invoiceNo'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('invoiceNo') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-3">
                                                                        <select name="weight_id"
                                                                            class="form-control select2 weight_id {{ $errors->has('weight_id') ? ' is-invalid' : '' }}"
                                                                            id="weight_id" required>
                                                                            @foreach ($weights as $weight)
                                                                                <option value="{{ $weight->id }}">
                                                                                    {{ $weight->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('weight_id'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('weight_id') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-3">
                                                                        <input type="number" step="any"
                                                                            class="form-control productPrice {{ $errors->has('productPrice') ? ' is-invalid' : '' }}"
                                                                            value="{{ old('productPrice') }}"
                                                                            name="productPrice"
                                                                            placeholder="Total Cash Collection" required>
                                                                        @if ($errors->has('productPrice'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('productPrice') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h6> Customer Information </h6>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group mb-3">
                                                                        <input type="text"
                                                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                            value="{{ old('name') }}" name="name"
                                                                            placeholder="Customer Name *">
                                                                        @if ($errors->has('name'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('name') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-3">
                                                                        <input type="number"
                                                                            class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                                                            value="{{ old('phonenumber') }}"
                                                                            name="phonenumber" placeholder="Mobile No. *">
                                                                        @if ($errors->has('phonenumber'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('phonenumber') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-3">
                                                                        <input type="number"
                                                                            class="form-control{{ $errors->has('alternative_mobile_no') ? ' is-invalid' : '' }}"
                                                                            value="{{ old('alternative_mobile_no') }}"
                                                                            name="alternative_mobile_no"
                                                                            placeholder="Alternative mobile no.">
                                                                        @if ($errors->has('alternative_mobile_no'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('alternative_mobile_no') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h6>Delivery Address </h6>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-3">
                                                                        <select name="division_id"
                                                                            class="form-control select2 division_id"
                                                                            id="division_id" required>
                                                                            <option value="">Division *</option>
                                                                            @foreach ($divisions as $division)
                                                                                <option value="{{ $division->id }}"
                                                                                    @if (old('division_id') == $division->id) selected @endif>
                                                                                    {{ $division->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('division_id'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('division_id') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-3">
                                                                        <select name="district_id"
                                                                            class="form-control select2 district_id"
                                                                            id="district_id" required>
                                                                            <option value="">District *</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-3">
                                                                        <select name="thana_id"
                                                                            class="form-control select2 thana_id"
                                                                            id="thana_id" required>
                                                                            <option value="">Thana *</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-3">
                                                                        <select name="area_id"
                                                                            class="form-control select2 area_id"
                                                                            id="area_id">
                                                                            <option value="">Area </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group mb-3">
                                                                        <input type="text" name="delivery_address"
                                                                            id="delivery_address" list="address_list"
                                                                            class="form-control"
                                                                            placeholder="Delivery Address *"
                                                                            autocomplete="new-password" required />
                                                                        <datalist id="address_list">
                                                                        </datalist>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <textarea type="text" name="note" value="{{ old('note') }}" class="form-control" placeholder="Note"
                                                                    rows="1"></textarea>
                                                            </div>


                                                            <div class="row">

                                                                <div class="col-sm-12">
                                                                    <div
                                                                        class="form-group mb-3 d-flex flex-row justify-content-center align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-success w-50">Create
                                                                            Percel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- col end -->
                                                <div class="col-lg-1 col-md-1 col-sm-0"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="parcel-details-instance">
                                                        <h4>Delivery Charge Details</h4>
                                                        <div class="content calculate_result">
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    Delivery Charge
                                                                </div>
                                                                <div class="col-sm-5 text-right">
                                                                    <span id="pdeliverycharge">0.00</span> Tk
                                                                </div>
                                                            </div>
                                                            <!-- row end -->
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    COD Charge
                                                                </div>
                                                                <div class="col-sm-5 text-right">
                                                                    <span id="pcodecharge">0.00</span> Tk
                                                                </div>
                                                            </div>
                                                            <!-- row end -->
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <b>Total Charge</b>
                                                                </div>
                                                                <div class="col-sm-5 text-right">
                                                                    <b><span id="total_charge">0.00</span> Tk</b>
                                                                </div>
                                                            </div>
                                                            <!-- row end -->
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    Merchant Pay
                                                                </div>
                                                                <div class="col-sm-5 text-right">
                                                                    <span id="merchant_pay">0.00</span> Tk
                                                                </div>
                                                            </div>
                                                            <!-- row end -->
                                                            <div class="row total-bar">
                                                                <div class="col-sm-12">
                                                                    <p class="text-center">Note : <span
                                                                            class="">Order
                                                                            Message</span></p>
                                                                </div>
                                                            </div>
                                                            <!-- row end -->
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
                </div>
            </div>
        </aside>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(function() {
            $('body').on('change paste keyup', '.productPrice, .weight_id, #thana_id', function() {
                getparcelCharge();
            })

            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val() || 0;
                var thana_id = $('#thana_id').val();
                // console.log(weight_id);

                if (weight_id && productPrice && thana_id) {
                    console.log(weight_id);
                    $.ajax({
                        method: "GET",
                        url: "{{ route('cost.calculator') }}",
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'thana_id': thana_id
                        },
                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            $('#pdeliverycharge').html(response.pdeliverycharge)
                            $('#pcodecharge').html(response.pcodecharge)
                            $('#total_charge').html(response.total_charge)
                        } else {
                            alert(response.message);
                            $('#pdeliverycharge').html(0.00)
                            $('#pcodecharge').html(0.00)
                            $('#total_charge').html(0.00)
                        }

                    });
                }

            }
        })
    </script>
    <script>
        $(function() {
            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#district_id').html(options);
                });
            })
            // Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value=""> Select thana </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#thana_id').html(options);
                });
            })
            // Get Area
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_areas') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#area_id').html(options);
                });
            })
        })
    </script>

    <script>
        function getAddress() {
            var area_id = $('#area_id').val();
            var options = '';
            if (area_id) {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_area_address') }}",
                    data: {
                        'area_id': area_id
                    },
                    cache: false,
                    dataType: "json",
                }).done(function(response) {
                    response.forEach(function(item) {
                        options += "<option>" + item.recipientAddress + "</option>"
                    })
                    $('#address_list').html(options);
                });
            }

        }
    </script>
@endsection
