@extends('backend.layouts.master')
@section('title', 'Agent Create')
@section('custom-styles')
    <style>

    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Agent Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Agent</a></li>
                        <li class="breadcrumb-item active">Agent Create</li>
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
                    <h4>Agent Create</h4>
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
                    <form role="form" action="{{ route('agent.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @include('backend.layouts.notifications')
                        @csrf
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Agent Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" id="name"
                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            value="{{ old('name') }}" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                                <!-- column end -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email address </label>
                                        <input type="email" name="email" id="email"
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Mobile No. <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="phone" id="phone"
                                            class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            value="{{ old('phone') }}" required>
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alternative_phone"> Alternative Mobile No.</label>
                                        <input type="text" name="alternative_phone" id="alternative_phone"
                                            class="form-control {{ $errors->has('alternative_phone') ? ' is-invalid' : '' }}"
                                            value="{{ old('alternative_phone') }}">
                                        @if ($errors->has('alternative_phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('alternative_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nid_no"> NID Number </label>
                                        <input type="text" name="nid_no" id="nid_no"
                                            class="form-control {{ $errors->has('nid_no') ? ' is-invalid' : '' }}"
                                            value="{{ old('nid_no') }}">
                                        @if ($errors->has('nid_no'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" name="designation" id="designation"
                                            class="form-control {{ $errors->has('designation') ? ' is-invalid' : '' }}"
                                            value="{{ old('designation') }}">
                                        @if ($errors->has('designation'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('designation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="designation">Per Parcel Amount</label>
                                        <input type="text" name="per_percel_amount" id="per_percel_amount"
                                            class="form-control {{ $errors->has('per_percel_amount') ? ' is-invalid' : '' }}"
                                            value="{{ old('per_percel_amount') }}">
                                        @if ($errors->has('per_percel_amount'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('per_percel_amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="image"> Image <span class="text-danger">*</span>
                                        </label>
                                        <input type="file" name="image" id="image"
                                            class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"
                                            value="{{ old('image') }}">
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="division_id"> Division<span class="text-danger">*</span>
                                        </label>
                                        <select name="division_id" id="division_id"
                                            class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}"
                                            value="{{ old('division_id') }}" required>
                                            <option value=""> Select Division </option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">
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
                                    <div class="form-group">
                                        <label for="district_id">District <span class="text-danger">*</span>
                                        </label>
                                        <select name="district_id" id="district_id" class="form-control select2"
                                            required>
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="thana_id">Thana <span class="text-danger">*</span></label>
                                        <select name="thana_id[]" id="thana_id" class="form-control multi_select2"
                                            multiple required>
                                            <option value="">Select Thana </option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="area_id">Area </label>
                                        <select name="area_id" id="area_id" class="form-control select2">
                                            <option value="">Select area </option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="address"> Address </label>
                                        <input type="text" name="address" id="address"
                                            class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                            value="{{ old('address') }}" autocomplete="new-address">
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
                                            value="{{ old('password') }}" autocomplete="new-password" required>
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
                                            value="{{ old('confirm') }}" autocomplete="new-password" required>
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
                            <button type="submit" class="btn btn-primary">Create Agent</button>
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
@endsection
