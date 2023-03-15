@extends('frontend.layouts.master')
@section('title', 'Percel Import')
@section('custom-styles')

@endsection
@section('main-content')
    <section class="section bg-light">
        <!-- percel create content start -->
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    @if (count($temp_files) > 0)
                        <div class="card">
                            <div class="card-header">
                                <h5>Edit your parcel details</h5>
                                <form action="{{ route('agent.import.parcel.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="col-xxl-6 col-md-6">
                                            <div class="form-group">
                                                <label for="merchantId">{{ __('lang.merchant') }} <span class="text-danger">
                                                        *</span></label>
                                                <select required class="form-control select2"
                                                    value="{{ old('merchantId') }}" name="merchantId" id="merchantId">
                                                    <option value="">{{ __('lang.select_merchant') }}</option>
                                                    @foreach ($merchants as $value)
                                                        <option value="{{ $value->id }}"
                                                            @if (old('merchantId') == $value->id) selected @endif>
                                                            {{ $value->companyName }}
                                                            (0{{ $value->phoneNumber }})
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('merchantId'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('merchantId') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @foreach ($temp_files as $temp)
                                        <input type="text" value="{{ $temp->temp_no }}" name="temp" hidden>
                                        <div class="card" id="deleteCustomer_{{ $temp->id }}">
                                            <div class="card-body">
                                                <div class="text-end">
                                                    <a href="javascript:void(0)" class="btn btn-danger"
                                                        onclick="deleteCustomer({{ $temp->id }})"> <i
                                                            class="las la-trash"></i></a>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <b>Customer Informaiton # {{ $temp->receipt_name }}</b>

                                                        <div class="row">
                                                            <div class="row gy-2">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="">Invoice No</label>
                                                                        <input type="text"
                                                                            class="form-control invoiceNo {{ $errors->has('invoiceNo') ? ' is-invalid' : '' }}"
                                                                            value="{{ $temp->invoice_no }}"
                                                                            name="invoiceNo[]" placeholder="Invoice No.">
                                                                        @if ($errors->has('invoiceNo'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('invoiceNo') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="">Customer Name</label>
                                                                        <input type="text"
                                                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                            value="{{ $temp->receipt_name }}"
                                                                            name="recipientName[]"
                                                                            placeholder="Customer Name *">
                                                                        @if ($errors->has('name'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('name') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="">Phone Number</label>

                                                                        <input type="number"
                                                                            class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                                                            value="0{{ $temp->customer_phone }}"
                                                                            name="phonenumber[]" placeholder="Mobile No. *">
                                                                        @if ($errors->has('phonenumber'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('phonenumber') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="">Alternative Phone No.</label>

                                                                        <input type="number"
                                                                            class="form-control{{ $errors->has('alternative_mobile_no') ? ' is-invalid' : '' }}"
                                                                            value="0{{ $temp->alternative_phone_no }}"
                                                                            name="alternative_mobile_no[]"
                                                                            placeholder="Alternative mobile no.">
                                                                        @if ($errors->has('alternative_mobile_no'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('alternative_mobile_no') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <div>
                                                                            <label
                                                                                for="productPrice">{{ __('lang.cash_collection') }}<span
                                                                                    class="text-danger">*</span>
                                                                            </label>
                                                                            <input type="number"
                                                                                class="form-control productPrice"
                                                                                id="productPrice" name="productPrice[]"
                                                                                placeholder="Enter Cash Collection"
                                                                                value="{{ $temp->product_price }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="weight_id">{{ __('lang.weight') }}<span
                                                                                class="text-danger">*</span></label>
                                                                        <select
                                                                            class="form-control select2 weight_id {{ $errors->has('weight_id') ? ' is-invalid' : '' }}"
                                                                            value="{{ old('weight_id') }}"
                                                                            name="weight_id[]" id="weight_id">
                                                                            {{-- <option value="">@lang('lang.select')</option> --}}

                                                                            @foreach ($weights as $weight)
                                                                            <option value="{{ $weight->value }}"
                                                                                @if ($temp->product_weight == $weight->value) selected @endif>
                                                                                {{ $weight->name }}
                                                                            </option>
                                                                        @endforeach
                                                                        </select>

                                                                        @if ($errors->has('merchantId'))
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('merchantId') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="row">
                                                            <div class="row gy-2">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="">Division</label>

                                                                        <select onchange="getDistrict({{ $temp->id }})"
                                                                            name="division_id[]"
                                                                            class="form-control select2 division_id"
                                                                            id="division_id_{{ $temp->id }}" required>
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
                                                                    <label for="">District</label>

                                                                    <div onchange="getThana({{ $temp->id }})"
                                                                        class="form-group">
                                                                        <select name="district_id[]"
                                                                            class="form-control select2 district_id"
                                                                            id="district_id_{{ $temp->id }}" required>
                                                                            <option value="">District *</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="">Thana</label>

                                                                    <div class="form-group">
                                                                        <select name="thana_id[]"
                                                                            class="form-control select2 thana_id"
                                                                            id="thana_id_{{ $temp->id }}" required>
                                                                            <option value="">Thana *</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="">Delivery Address</label>

                                                                        <input type="text" name="delivery_address[]"
                                                                            id="delivery_address" list="address_list"
                                                                            class="form-control"
                                                                            placeholder="Delivery Address *"
                                                                            autocomplete="new-password"
                                                                            value="{{ $temp->delivery_address }}"
                                                                            required />

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Save Bulk Upload">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h4>Percel Create</h4>
                                <br>
                                @include('backend.layouts.notifications')
                                <form role="form" action="{{ route('agent.import.parcel.read') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row gy-4">
                                            <div class="col-lg-12">
                                                <a href="{{ asset('sample.xlsx') }}">Download Sample</a>
                                                <br>
                                                <label for="">Select Parcel</label>
                                                <input type="file" class="form-control" name="importFile">
                                                <br>
                                                <button class="btn btn-success " type="submit">Import</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- percel create content end -->
    </section>
@endsection
@section('custom-scripts')
    <script>
        $(function() {
            $('body').on('change paste keyup',
                '.productPrice, .weight_id, #thana_id, #division_id, #district_id, #merchantId',
                function() {
                    getparcelCharge();
                })





            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val() || 0;
                var thana_id = $('#thana_id').val();
                var division_id = $('#division_id').val();
                var district_id = $('#district_id').val();
                var merchantId = $('#merchantId').val();

                if (weight_id && productPrice && thana_id && merchantId) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('cost.calculator') }}',
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'thana_id': thana_id,
                            'merchantId': merchantId,
                            'division_id': division_id,
                            'district_id': district_id,

                        },
                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            $('.delivery_charge').html(response.pdeliverycharge)
                            $('.cod_charge').html(response.pcodecharge)
                            $('.total_charge').html(response.total_charge)
                            $('.pay_to_merchant').html(response.pay_to_merchant)
                        } else {
                            alert(response.message);
                            $('.delivery_charge').html(0.00)
                            $('.cod_charge').html(0.00)
                            $('.total_charge').html(0.00)
                        }

                    });
                }

            }
        })
    </script>
    <script>
        // delete customer
        function deleteCustomer(id) {
            // var customer_id = $('#deleteCustomer_'+id);
            $("#deleteCustomer_" + id).remove();
        }


        function getDistrict(id) {
            var division_id = $('#division_id_' + id).val();
            console.log(division_id);
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
                $('#district_id_' + id).html(options);
            });
        }

        function getThana(id) {
            var district_id = $('#district_id_' + id).val();
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
                $('#thana_id_' + id).html(options);
            });
        }

        $(function() {
            // Get Merchant details
            $('body').on('change', '#merchantId', function() {
                var merchantId = $('#merchantId').val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_merchant_details') }}",
                    data: {
                        'merchantId': merchantId
                    },
                }).done(function(response) {
                    // console.log(response.pickLocation);
                    if (response.pickLocation) {
                        $('#pickLocation').val(response.pickLocation);
                    }
                })
            })
            // Get District
            // $('body').on('change', '#division_id', function() {

            // })

            // Get Thana
            $('body').on('change', '#district_id', function() {

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

                // Get Thana Agent
                var agents = '';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_agents') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        agents +=
                            '<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="agents[]" value="' +
                            item.id + '">' + item.name + ' - ' + item.phone +
                            '</label></div>';
                    });
                    $('#agent_list').html(agents);
                });
            })
        })
    </script>
@endsection
