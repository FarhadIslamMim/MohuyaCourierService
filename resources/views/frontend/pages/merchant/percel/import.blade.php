@extends('frontend.layouts.master')
@section('title', 'Percel Import')
@section('custom-styles')

@endsection
@section('main-content')
    <section class="section bg-light  mt-5">
        <div class="row">
            {{-- @include('frontend.pages.merchant.layouts.sidebar') --}}
            <div class="container">
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Bulk Import</h4>
                        </div>
                        <div class="card-body">
                            @include('frontend.layouts.notifications')
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="{{ route('merchant.percel.import.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row gy-4">
                                            <div class="col-lg-12">
                                                <label for="csv_file">Select CSV File</label>
                                                <input type="file" name="importFile" class="form-control">
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="submit" value="Import" class="btn btn-info">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-lg-6">
                                    <h5>Instructions</h5>
                                    <p>Please follow the instructions</p>
                                    <ul>
                                        <ol>* <a class="text-green" href="{{ asset('sample.xlsx') }}">Download
                                                the sample file(.xlsx)</a>
                                        </ol>
                                        <ol>* Fillup the form with details</ol>
                                        <ol>* Product Price and Weight is double (0.00)</ol>
                                        <ol>* Save and Import</ol>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (count($temp_files) > 0)
                        <div class="card">
                            <div class="card-body">
                                <h5>Edit your parcel details</h5>
                                <form action="{{ route('merchant.percel.import.store.data') }}" method="POST">
                                    @csrf
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

                                                                        <select
                                                                            onchange="getDistrict({{ $temp->id }})"
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
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-scripts')
    {{-- @include('backend.layouts.datatable_scripts') --}}

    <script>
        $(document).ready(function() {
            $("#example").DataTable();
        });
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
    </script>
@endsection
