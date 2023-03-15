@extends('backend.layouts.master')
@section('title', 'Add new area')
@section('custom-styles')

@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Areas</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Areas</a></li>
                        <li class="breadcrumb-item active">New Area</li>
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
                    <h4>Area Create</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('area.store') }}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
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
                            <div class="form-group col-md-6">
                                <label for="thana_id">Thana<span class="text-danger">*</span> </label>
                                <select name="thana_id" id="thana_id" class="form-control select2" required>
                                    <option value="">Select Thana </option>
                                </select>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label for="coverage"> Common Coverage <span class="text-danger">*</span> </label>
                                <select name="coverage" id="coverage" class="form-control select2" required>
                                    <option value="1" @if (old('coverage') == 1) selected @endif>
                                        Yes </option>
                                    <option value="0" @if (old('coverage') == 0) selected @endif>
                                        No </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="delivery_type"> Delivery Type <span class="text-danger">*</span> </label>
                                <select name="delivery_type" id="delivery_type" class="form-control select2" required>
                                    <option value="1" @if (old('delivery_type') == 1) selected @endif>
                                        Home Delivery </option>
                                    <option value="2" @if (old('delivery_type') == 2) selected @endif>
                                        Point Delivery </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pickup"> @lang('common.pickup') <span class="text-danger">*</span> </label>
                                <select name="pickup" id="pickup" class="form-control select2" required>
                                    <option value="1" @if (old('pickup') == 1) selected @endif>
                                        Yes </option>
                                    <option value="0" @if (old('pickup') == 0) selected @endif>
                                        No </option>
                                </select>
                            </div> --}}
                            {{-- <div class="form-group col-md-12">
                                <label for="thana_id">Thana  <span class="text-danger">*</span> </label>
                                <select name="thana_id" id="thana_id" class="form-control" required>
                                    <option value="">Select Thana </option>
                                    @foreach ($thanas as $thana)
                                        <option value="{{ $thana->id }}"> {{ $thana->name }} </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="form-group col-md-6">
                                <label for="pickupman_id"> Pickupman </label>
                                <select name="pickupman_id" id="pickupman_id" class="form-control">
                                    <option value="">Select Pickupman </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="deliverymen_id"> Deliveryman </label>
                                <select name="deliverymen_id" id="deliverymen_id" class="form-control">
                                    <option value="">Select Deliverymen </option>
                                </select>
                            </div> --}}
                            <div class="form-group col-md-12">
                                <label for="name"> Area Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    value="{{ old('name') }}" name="name" id="name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <div class="custom-label">
                                    <label>Status <span class="text-danger"> * </span> </label>
                                </div>
                                <div class="box-body pub-stat display-inline">
                                    <input class="" type="radio" id="active" name="status" value="1"
                                        @if (old('status', 1) == 1) checked @endif>
                                    <label for="active">Active</label>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="box-body pub-stat display-inline">
                                    <input class="" type="radio" name="status" value="0"
                                        id="inactive @if (old('status') == 0) checked @endif">
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
                <div class="card-footer">
                    <input type="submit" value="Add area" class="btn btn-success">
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
                var options = '<option value=""> Select Thana </option>';
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
            // Get Deliveryman & Pickupman
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var deliverymans = '<option value=""> Select Deliveryman </option>';
                var pickupmans = '<option value=""> Select Pickupman </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_deliverymen_pickupman') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response.deliverymens);
                    var deliveryman_data = response.deliverymens;
                    var pickupman_data = response.pickupmens;
                    if (deliveryman_data) {
                        deliveryman_data.forEach(function(item, i) {
                            deliverymans += '<option value="' + item.id + '"> ' + item
                                .name + ' - ' + item.phone + ' </option>';
                        });
                    }
                    if (pickupman_data) {
                        pickupman_data.forEach(function(item, i) {
                            pickupmans += '<option value="' + item.id + '"> ' + item.name +
                                ' - ' + item.phone + ' </option>';
                        });
                    }
                    $('#deliverymen_id').html(deliverymans);
                    $('#pickupman_id').html(pickupmans);
                });
            })
        })
    </script>
@endsection
