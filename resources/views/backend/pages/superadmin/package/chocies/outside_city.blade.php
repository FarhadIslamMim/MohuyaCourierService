@extends('backend.layouts.master')
@section('title', 'Add Package')
@section('custom-styles')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000000 !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000000 !important;
        }

        .select2-results__option:before {
            content: "";
            display: inline-block;
            position: relative;
            height: 20px;
            width: 20px;
            border: 2px solid #e9e9e9;
            border-radius: 4px;
            background-color: #fff;
            margin-right: 20px;
            vertical-align: middle;
        }

        .select2-results__option[aria-selected=true]:before {
            font-family: fontAwesome;
            content: "✓";
            color: #fff;
            background-color: #5897FB;
            border: 0;
            display: inline-block;
            padding-left: 3px;
        }

        .select2-container .select2-selection--multiple {
            height: 150px !important;
            margin: 0;
            padding: 0;
            line-height: inherit;
            border-radius: 0;
            overflow: scroll;
        }
    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Delivery Package</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Percel</a></li>
                        <li class="breadcrumb-item active">New Package</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Delivery Package Create</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dcp.store') }}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="row gy-4">
                            <div class="form-group col-md-6">
                                <label for="delivery_charge_head_id">Package Name*</span>
                                </label>
                                <input type="text" placeholder="Package Name" class="form-control" name="package_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="delivery_charge_head_id">Charge Category<span class="text-danger">*</span>
                                </label>
                                <select name="delivery_charge_head_id" id="delivery_charge_head_id"
                                    class="form-control select2" required>
                                    <option value=""> Select Charge Head </option>
                                    @foreach ($dlivery_charge_heads as $dch)
                                        <option value="{{ $dch->id }}"> {{ $dch->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <h5>Location Management <span id="location_name"> (Inside City)</span></h5>
                        <div id="inside_city">
                            <div class="row gy-4">
                                <div class="form-group col-md-6">
                                    <label for="division_id">Division<span class="text-danger">*</span> </label>
                                    <select name="division_id" id="division_id" class="form-control select2" required>
                                        <option value=""> Select Division </option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"> {{ $division->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="district_id">District<span class="text-danger">*</span> </label>
                                    <select name="district_id" id="district_id" class="form-control select2" required>
                                        <option value="">Select District </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="thana_id">Thana<span class="text-danger">*</span> </label>
                                    <select name="thana_id[]" multiple id="thana_id" class="form-control select2" required>
                                        <option value="">Select Thana </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="sub_city">
                            <div class="row gy-4">
                                <div class="form-group col-md-6">
                                    <label for="division_id">Division<span class="text-danger">*</span> </label>
                                    <select name="division_id" id="division_id" class="form-control select2" required>
                                        <option value=""> Select Division </option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"> {{ $division->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="district_id">District<span class="text-danger">*</span> </label>
                                    <select name="district_id" id="district_id" class="form-control select2" required>
                                        <option value="">Select District </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="thana_id">Thana<span class="text-danger">*</span> </label>
                                    <select name="thana_id[]" multiple id="thana_id" class="form-control select2" required>
                                        <option value="">Select Thana </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h5>Rates</h5>
                        <div class="row gy-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="delivery_charge">Delivery Charge </label>
                                    <input type="number" name="delivery_charge" id="delivery_charge"
                                        class="form-control {{ $errors->has('delivery_charge') ? ' is-invalid' : '' }}"
                                        value="">
                                    @if ($errors->has('delivery_charge'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('delivery_charge') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="extradeliverycharge">Extra Delivery Charge
                                    </label>
                                    <input type="number" name="extra_delivery_charge" id="extra_delivery_charge"
                                        class="form-control {{ $errors->has('extra_delivery_charge') ? ' is-invalid' : '' }}"
                                        value="">
                                    @if ($errors->has('extra_delivery_charge'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('extra_delivery_charge') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cod_charge">COD Charge (%) </label>
                                    <input type="number" step="any" name="cod_charge" id="cod_charge"
                                        class="form-control" value="">
                                    @if ($errors->has('cod_charge'))
                                        <span class="invalid-feedback">
                                            <strong></strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="return_charge">Return Charge (%)</label>
                                    <input type="number" step="any" name="return_charge" id="return_charge"
                                        class="form-control" value="">
                                    @if ($errors->has('return_charge'))
                                        <span class="invalid-feedback">
                                            <strong></strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Add Package" class="btn btn-success">
                </div>
                </form>

            </div>

        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(function() {
            // Get District
            $("#sub_city").remove();
            // $("#outside_city").hide();

            $('#thana_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#thana_id > option").prop("selected", "selected");
                    $("#thana_id").trigger("change");
                }
            });


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
            //Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value="">All</option>';
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



            // city sub selection
            $('body').on('change', '#delivery_charge_head_id', function() {
                let id = $(this).val();
            });
        })
    </script>
@endsection
@extends('backend.layouts.master')
@section('title', 'Add Package')
@section('custom-styles')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000000 !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000000 !important;
        }

        .select2-results__option:before {
            content: "";
            display: inline-block;
            position: relative;
            height: 20px;
            width: 20px;
            border: 2px solid #e9e9e9;
            border-radius: 4px;
            background-color: #fff;
            margin-right: 20px;
            vertical-align: middle;
        }

        .select2-results__option[aria-selected=true]:before {
            font-family: fontAwesome;
            content: "✓";
            color: #fff;
            background-color: #5897FB;
            border: 0;
            display: inline-block;
            padding-left: 3px;
        }

        .select2-container .select2-selection--multiple {
            height: 150px !important;
            margin: 0;
            padding: 0;
            line-height: inherit;
            border-radius: 0;
            overflow: scroll;
        }
    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Delivery Package</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Percel</a></li>
                        <li class="breadcrumb-item active">New Package</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Delivery Package Create</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dcp.store') }}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="row gy-4">
                            <div class="form-group col-md-6">
                                <label for="delivery_charge_head_id">Package Name*</span>
                                </label>
                                <input type="text" placeholder="Package Name" class="form-control" name="package_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="delivery_charge_head_id">Charge Category<span class="text-danger">*</span>
                                </label>
                                <select name="delivery_charge_head_id" id="delivery_charge_head_id"
                                    class="form-control select2" required>
                                    <option value=""> Select Charge Head </option>
                                    @foreach ($dlivery_charge_heads as $dch)
                                        <option value="{{ $dch->id }}"> {{ $dch->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <h5>Location Management <span id="location_name"> (Inside City)</span></h5>
                        <div id="inside_city">
                            <div class="row gy-4">
                                <div class="form-group col-md-6">
                                    <label for="division_id">Division<span class="text-danger">*</span> </label>
                                    <select name="division_id" id="division_id" class="form-control select2" required>
                                        <option value=""> Select Division </option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"> {{ $division->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="district_id">District<span class="text-danger">*</span> </label>
                                    <select name="district_id" id="district_id" class="form-control select2" required>
                                        <option value="">Select District </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="thana_id">Thana<span class="text-danger">*</span> </label>
                                    <select name="thana_id[]" multiple id="thana_id" class="form-control select2" required>
                                        <option value="">Select Thana </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="sub_city">
                            <div class="row gy-4">
                                <div class="form-group col-md-6">
                                    <label for="division_id">Division<span class="text-danger">*</span> </label>
                                    <select name="division_id" id="division_id" class="form-control select2" required>
                                        <option value=""> Select Division </option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"> {{ $division->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="district_id">District<span class="text-danger">*</span> </label>
                                    <select name="district_id" id="district_id" class="form-control select2" required>
                                        <option value="">Select District </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="thana_id">Thana<span class="text-danger">*</span> </label>
                                    <select name="thana_id[]" multiple id="thana_id" class="form-control select2" required>
                                        <option value="">Select Thana </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h5>Rates</h5>
                        <div class="row gy-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="delivery_charge">Delivery Charge </label>
                                    <input type="number" name="delivery_charge" id="delivery_charge"
                                        class="form-control {{ $errors->has('delivery_charge') ? ' is-invalid' : '' }}"
                                        value="">
                                    @if ($errors->has('delivery_charge'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('delivery_charge') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="extradeliverycharge">Extra Delivery Charge
                                    </label>
                                    <input type="number" name="extra_delivery_charge" id="extra_delivery_charge"
                                        class="form-control {{ $errors->has('extra_delivery_charge') ? ' is-invalid' : '' }}"
                                        value="">
                                    @if ($errors->has('extra_delivery_charge'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('extra_delivery_charge') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cod_charge">COD Charge (%) </label>
                                    <input type="number" step="any" name="cod_charge" id="cod_charge"
                                        class="form-control" value="">
                                    @if ($errors->has('cod_charge'))
                                        <span class="invalid-feedback">
                                            <strong></strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="return_charge">Return Charge (%)</label>
                                    <input type="number" step="any" name="return_charge" id="return_charge"
                                        class="form-control" value="">
                                    @if ($errors->has('return_charge'))
                                        <span class="invalid-feedback">
                                            <strong></strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Add Package" class="btn btn-success">
                </div>
                </form>

            </div>

        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(function() {
            // Get District
            $("#sub_city").remove();
            // $("#outside_city").hide();

            $('#thana_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#thana_id > option").prop("selected", "selected");
                    $("#thana_id").trigger("change");
                }
            });


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
            //Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value="">All</option>';
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



            // city sub selection
            $('body').on('change', '#delivery_charge_head_id', function() {
                let id = $(this).val();
            });
        })
    </script>
@endsection
