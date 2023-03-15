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
                        <div class="preview"></div>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Exculded Weight <span class="badge badge-outline-success">(Select
                                            the weight you don't want to add amount)</span></label>
                                    <select name="excluded_weights[]" class="form-control select2" multiple>
                                        <option value="">Select Weight</option>
                                        @foreach ($weights as $weight)
                                            <option value="{{ $weight->id }}">
                                                {{ $weight->name }}
                                            </option>
                                        @endforeach
                                    </select>
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


    <template id="template_education">
        <tr class="expense_item">
            <td class="text-left"><button type="button" class="btn btn-sm btn-danger remove_education"><i
                        class="la la-trash"></i></button></td>
            <td class="text-left">
                <select name="division_id" class="form-control select2" required onchange="getDistrict(this.value,this)">
                    <option value=""> Select Division </option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}"> {{ $division->name }} </option>
                    @endforeach
                </select>
            </td>
            <td width="20px" class="text-left">
                <select name="district_id" id="district_id" onchange="getThana(this.value,this)"
                    class="form-control select2 district_id" required>
                    <option value="">Select District </option>
                </select>
            </td>
            <td class="text-left">
                <select name="thana_id[]" multiple id="thana_id_extarnal" class="form-control select2 thana_id_extarnal"
                    required>

                </select>
            </td>

        </tr>
    </template>
@endsection
@section('custom-scripts')
    <script>
        function addRowExpense() {
            var rowCount = $('#add-row-expense tr:last-child').attr('class');
            var html = $('#template_education').html();
            $('.select2').select2();
            $('#thana_id_extarnal').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#thana_id_extarnal > option").prop("selected",
                        "selected");
                    $("#thana_id").trigger("change");
                }
            });

            $('#add-row-expense').append(html);

        }

        $('body').on('click', '.remove_education', function() {
            $(this).closest('.expense_item').remove();
        });

        $(function() {
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

                if (id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('dcp.location.setup') }}",
                        data: {
                            id: id,
                        },
                        dataType: "html",
                        success: function(response) {
                            $(".preview").html(response);
                            $('.select2').select2();
                            $('#thana_id').on("select2:select", function(e) {
                                var data = e.params.data.text;
                                if (data == 'All') {
                                    $("#thana_id > option").prop("selected",
                                        "selected");
                                    $("#thana_id").trigger("change");
                                }
                            });
                        }
                    });
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $("body").on('change', '.district_id_all', function() {
                $('.district_id_all').on("select2:select", function(e) {
                    var data = e.params.data.text;
                    if (data == 'All') {
                        $(".district_id_all > option").prop("selected",
                            "selected");
                        $(".district_id_all").trigger("change");
                    }
                });
            });

        });
    </script>
    <script>
        async function getDistrict(divisionId, ref) {
            //let id = divisionId.value;
            var closestDistrict = $(ref).closest('div').find('.district_id');
            var options = '<option value=""> Select district </option>';
            $.ajax({
                method: "GET",
                url: "{{ route('get_division_districts') }}",
                data: {
                    'division_id': divisionId
                },
            }).done(function(response) {
                response.forEach(function(item, i) {
                    options += '<option value="' + item.id + '"> ' + item.name +
                        ' </option>';
                });

                closestDistrict.append(options);
            });

            $('.select2').select2();
            $('#thana_id_extarnal').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#thana_id_extarnal > option").prop("selected",
                        "selected");
                    $("#thana_id").trigger("change");
                }
            });

        }

        async function getThana(districtId, ref) {
            var closestDistrict = $(ref).closest('div').find('.thana_id_extarnal');

            var options = '<option value="">All</option>';
            $.ajax({
                method: "GET",
                url: "{{ route('get_district_thanas') }}",
                data: {
                    'district_id': districtId
                },
            }).done(function(response) {
                response.forEach(function(item, i) {
                    options += '<option value="' + item.id + '"> ' + item.name +
                        ' </option>';
                });
                $('.select2').select2();
                $('#thana_id_extarnal').on("select2:select", function(e) {
                    var data = e.params.data.text;
                    console.log(data);
                    if (data == 'All') {
                        $("#thana_id_extarnal > option").prop("selected",
                            "selected");
                        $("#thana_id").trigger("change");
                    }
                });
                closestDistrict.append(options);

            });
        }
    </script>
@endsection
