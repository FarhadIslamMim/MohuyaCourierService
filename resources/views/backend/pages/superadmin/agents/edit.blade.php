@extends('backend.layouts.master')
@section('title', 'Agent Create')
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
                <h4 class="mb-sm-0">Data Entry Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Entry</a></li>
                        <li class="breadcrumb-item active">Data Entry Create</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- percel create content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Entry Update</h4>
                    <br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" action="{{ route('agent.update') }}" method="POST" enctype="multipart/form-data">
                        @include('backend.layouts.notifications')
                        @csrf
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-sm-6">
                                    <input type="hidden" value="{{ $edit_data->id }}" name="hidden_id">

                                    <div class="form-group">
                                        <label for="name">Data Entry Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" id="name"
                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            value="{{ old('name', $edit_data->name) }}" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                                <!-- column end -->
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email address </label>
                                        <input type="email" name="email" id="email"
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            value="{{ old('email', $edit_data->email) }}">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                <!-- column end -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Mobile No. <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="phone" id="phone"
                                            class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            value="{{ old('phone', $edit_data->phone) }}" required>
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alternative_phone"> Alternative Mobile No.</label>
                                        <input type="text" name="alternative_phone" id="alternative_phone"
                                            class="form-control {{ $errors->has('alternative_phone') ? ' is-invalid' : '' }}"
                                            value="{{ old('alternative_phone', $edit_data->alternative_phone) }}">
                                        @if ($errors->has('alternative_phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('alternative_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nid_no"> NID Number </label>
                                        <input type="text" name="nid_no" id="nid_no"
                                            class="form-control {{ $errors->has('nid_no') ? ' is-invalid' : '' }}"
                                            value="{{ old('nid_no', $edit_data->nid_no) }}">
                                        @if ($errors->has('nid_no'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}

                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" name="designation" id="designation"
                                            class="form-control {{ $errors->has('designation') ? ' is-invalid' : '' }}"
                                            value="{{ $edit_data->designation }}">
                                        @if ($errors->has('designation'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('designation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="designation">Per Parcel Amount</label>
                                        <input type="text" name="per_percel_amount" id="per_percel_amount"
                                            class="form-control {{ $errors->has('per_percel_amount') ? ' is-invalid' : '' }}"
                                            value="{{ $edit_data->per_percel_amount }}">
                                        @if ($errors->has('per_percel_amount'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('per_percel_amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="image"> Image <span class="text-danger">*</span>
                                        </label>
                                        <input type="file" name="image" id="image"
                                            class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"
                                            value="{{ old('image') }}">
                                        <img src="{{ asset($edit_data->image) }}" class="img-fluid" width="60px">
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="division_id"> Division<span class="text-danger">*</span>
                                        </label>
                                        <select name="division_id" id="division_id"
                                            class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}"
                                            value="{{ old('division_id') }}" required>
                                            <option value=""> Select Division </option>
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
                                </div> --}}

                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="district_id">District <span class="text-danger">*</span>
                                        </label>
                                        <select name="district_id" id="district_id" class="form-control select2"
                                            required>
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="thana_id">Thana <span class="text-danger">*</span></label>
                                        <select name="thana_id[]" id="thana_id" class="form-control multi_select2"
                                            multiple required>
                                            <option value="">Select Thana </option>
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="area_id">Area </label>
                                        <select name="area_id" id="area_id" class="form-control select2">
                                            <option value="">Select area </option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="address"> Address </label>
                                        <input type="text" name="address" id="address"
                                            class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                            value="{{ old('address', $edit_data->address) }}" autocomplete="new-address">
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            value="{{ old('password') }}" autocomplete="new-password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="confirm"> Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="confirm" id="confirm"
                                            class="form-control {{ $errors->has('confirm') ? ' is-invalid' : '' }}"
                                            value="{{ old('confirm') }}" autocomplete="new-password">
                                        @if ($errors->has('confirm'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('confirm') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="custom-label">
                                            <label> Status </label>
                                        </div>
                                        <div class="box-body pub-stat display-inline">
                                            <input class="" type="radio" id="active" name="status"
                                                value="1" @if (old('status', 1) == 1) checked @endif>
                                            <label for="active">Active</label>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="box-body pub-stat display-inline">
                                            <input class="" type="radio" name="status" value="0"
                                                @if (old('status', 1) == 0) checked @endif>
                                            <label for="inactive">Inactive</label>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Data Entry</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
    <!-- percel create content end -->

@endsection
@section('custom-scripts')
    <script>
        $(function() {
            $('.multi_select2').select2({
                closeOnSelect: false,
            });
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
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#thana_id').html(options);
                    $('#thana_id').trigger('change');
                });
            })
            // Get Area
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                var selected = <?php echo json_encode($thana_ids); ?>;

                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_areas') }}",
                    data: {
                        'district_id': district_id,
                    },
                }).done(function(response) {
                    console.log("response " + response);
                    response.forEach(function(item, i) {

                        if (jQuery.inArray(item.id, selected) != '-1') {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#thana_id').html(options);
                });
            })
            $('#thana_id').trigger('change');
        })
    </script>
@endsection
