@extends('frontend.layouts.master')
@section('title', 'Edit Percel')
@section('custom-styles')
@endsection
@section('main-content')
    <section class="section bg-light">
        <div class="container mt-5">
            <!-- percel create content start -->
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Percel Edit</h4>
                            <br>
                            @include('backend.layouts.notifications')
                            <form role="form" action="{{ route('agent.percel.update') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="hidden_id" value="{{ $edit_data->id }}">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="row gy-4">
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="merchantId">Merchant <span class="text-danger">
                                                                *</span></label>
                                                        <select class="form-control select2" value="{{ old('merchantId') }}"
                                                            name="merchantId" id="merchantId">
                                                            <option value="">Select Merchant</option>
                                                            @foreach ($merchants as $value)
                                                                <option value="{{ $value->id }}"
                                                                    @if (old('merchantId', $edit_data->merchantId) == $value->id) selected @endif>
                                                                    {{ $value->companyName }}
                                                                    ({{ $value->phoneNumber }})
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
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="weight_id">Weight<span
                                                                class="text-danger">*</span></label>
                                                        <select
                                                            class="form-control select2 weight_id {{ $errors->has('weight_id') ? ' is-invalid' : '' }}"
                                                            name="weight_id" id="weight_id">
                                                            {{-- <option value="">@lang('common.select')</option> --}}

                                                            @foreach ($weights as $weight)
                                                                <option value="{{ $weight->id }}"
                                                                    @if (old('weight_id', $edit_data->weight->id ?? '') == $weight->id) selected @endif>
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
                                                {{-- <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group">
                                                        <div>
                                                            <label for="">Delivery Charge <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" step="any" class="form-control "
                                                                id="total_charge_input" name="deliveryCharge"
                                                                value="{{ old('deliveryCharge', $edit_data->deliveryCharge) }}"
                                                                placeholder="Enter delivery Charge Collection">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group">
                                                        <div>
                                                            <label for="invoiceNo">Invoice no<span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" step="any"
                                                                class="form-control invoiceNo" id="invoiceNo"
                                                                name="invoiceNo"
                                                                value="{{ old('invoiceNo', $edit_data->invoiceNo) }}"
                                                                placeholder="000">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="form-group">
                                                        <div>
                                                            <label for="productPrice">Cash Collection <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" step="any"
                                                                class="form-control productPrice" id="productPrice"
                                                                name="cod"
                                                                value="{{ old('productPrice', $edit_data->cod) }}"
                                                                placeholder="Enter delivery Charge Collection">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- form group -->
                                                <div class="col-xxl-6 col-md-6">
                                                    <label for="name"> Customer Name <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                        value="{{ old('name', $edit_data->recipientName) }}" name="name"
                                                        id="name" placeholder="Recipient Name" required>
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="col-xxl-6 col-md-6">
                                                    <label for="phonenumber">Mobile No. <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                                        value="{{ old('phonenumber', $edit_data->recipientPhone) }}"
                                                        name="phonenumber" id="phonenumber" placeholder="Phone Number"
                                                        required>
                                                    @if ($errors->has('phonenumber'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phonenumber') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <label for="alternative_mobile_no">Alternavtive Mobile No.</label>
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('alternative_mobile_no') ? ' is-invalid' : '' }}"
                                                        value="{{ old('alternative_mobile_no', $edit_data->alternative_mobile_no) }}"
                                                        name="alternative_mobile_no" id="alternative_mobile_no"
                                                        placeholder="Alternative mobile no">
                                                    @if ($errors->has('alternative_mobile_no'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('alternative_mobile_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="col-sm-6">
                                                    <div>
                                                        <label for="division_id">Divison <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select name="division_id" id="division_id"
                                                            class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}"
                                                            value="{{ old('division_id') }}" required>
                                                            <option value="">Select Division</option>
                                                            @foreach ($divisions as $division)
                                                                <option value="{{ $division->id }}"
                                                                    @if (old('division_id', $edit_data->division_id) == $division->id) selected @endif>
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
                                                    <div>
                                                        <label for="district_id">District<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select name="district_id" id="district_id"
                                                            class="form-control select2" required>
                                                            <option value="">Select District</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div>
                                                        <label for="thana_id">Thana (Upazila)<span class="text-danger">*</span>
                                                        </label>
                                                        <select name="thana_id" id="thana_id"
                                                            class="form-control select2" required>
                                                            <option value="">Thana (Upazila)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div>
                                                        <label for="area_id">Area</label>
                                                        <select name="area_id" id="area_id"
                                                            class="form-control select2">
                                                            <option value="">Select</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <label for="delivery_address">Delivery Address (maximum 500
                                                        characters) <span class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control {{ $errors->has('delivery_address') ? ' is-invalid' : '' }}"
                                                        name="delivery_address" placeholder="Delivery Address">{{ old('delivery_address', $edit_data->delivery_address) }}</textarea>


                                                    @if ($errors->has('delivery_address'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('delivery_address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!-- form group -->
                                                <div class="col-xxl-6 col-md-6">
                                                    <label for="note">Note (maximum 300
                                                        characters)</label>
                                                    <textarea type="text" class="form-control {{ $errors->has('note') ? ' is-invalid' : '' }}"
                                                        value="{{ old('note', $edit_data->note) }}" name="note" placeholder="Note Optional">{{ old('note') }}</textarea>
                                                    @if ($errors->has('note'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('note') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Percel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <!-- Rounded Ribbon -->
                    <div class="card ribbon-box border shadow-none mb-lg-0">
                        <div class="card-body">
                            <div class="ribbon ribbon-primary round-shape">Cost Summary</div>
                            <h5 class="fs-14 text-end">Total Cost for the percel</h5>
                            <div class="ribbon-content mt-4 text-muted">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Delivery Charge</th>
                                        <td class="text-right">
                                            <span class="delivery_charge"> {{ $edit_data->deliveryCharge }} </span> tk.
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>COD Charge</th>
                                        <td class="text-right">
                                            <span class="cod_charge"> 0.00 </span> tk.
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Charge</th>
                                        <th class="text-right">
                                            <span class="total_charge"> {{ $edit_data->deliveryCharge }} </span> tk.
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Pay to merchant</th>
                                        <th class="text-right">
                                            <span class="total_cash_collection">
                                                {{ $edit_data->cod - ($edit_data->deliveryCharge + $edit_data->codCharge) }}
                                            </span>
                                            tk.
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- percel create content end -->

        </div>
    </section>

@endsection
@section('custom-scripts')
    <script>
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
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                var selected = '{{ old('district_id', $edit_data->district_id) }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (item.id == selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#district_id').html(options);
                    $('#district_id').trigger('change');
                });
            })
            $('#division_id').trigger('change');
            // Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value=""> Select thana </option>';
                var selected = '{{ old('thana_id', $edit_data->thana_id) }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#thana_id').html(options);
                    $('#thana_id').trigger('change');
                });
            })
            // Get Area
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                var selected = '{{ old('area_id', $edit_data->area_id) }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_areas_final') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#area_id').html(options);
                });
            })
            $('#thana_id').trigger('change');

        })
    </script>

    <script>
        $(function() {
            $('body').on('change paste keyup',
                '.productPrice, #total_charge_input, .weight_id, #thana_id, #merchantId',
                function() {
                    getparcelCharge();
                    console.log('loading from 2');
                })

            $('body').on('change paste keyup', '#total_charge_input', function() {

                var charge = $(this).val();
                $('.delivery_charge').html(charge);
                $('.cod_charge').html();
                $('.total_charge').html(charge);
            })

            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val() || 0;
                var division_id = $('#division_id').val();
                var district_id = $('#district_id').val();
                var thana_id = $('#thana_id').val();
                var merchantId = $('#merchantId').val();
                var deliveryCharge = $('#total_charge_input').val();

                // console.log(weight_id);
                if (weight_id && productPrice && thana_id && merchantId) {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('cost.calculator') }}",
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'division_id': division_id,
                            'district_id': district_id,
                            'thana_id': thana_id,
                            'merchantId': merchantId,
                            'deliveryCharge': deliveryCharge,
                        },
                    }).done(function(response) {
                        console.log(response);
                        if (response.success) {
                            $('.delivery_charge').html(response.pdeliverycharge)
                            $('.cod_charge').html(response.pcodecharge)
                            $('.total_charge').html(response.total_charge)
                            $('.total_charge_input').html(response.pdeliverycharge)
                            $('.total_cash_collection').html(response.pay_to_merchant)
                        } else {
                            // alert(response.message);
                            $('.delivery_charge').html(0.00)
                            $('.cod_charge').html(0.00)
                            $('.total_charge').html(0.00)
                            $('.total_charge_input').html(0.00)
                        }

                    });
                }

            }
        });
    </script>
@endsection
