@extends('backend.layouts.master')
@section('title', 'Edit Package')
@section('custom-styles')

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
                        <li class="breadcrumb-item active">Edit Package</li>
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
                    <h4>Delivery Package Edit</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dcp.update') }}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
                        <input type="text" value="{{ $delivery_packages->id }}" name="id" hidden>
                        <div class="row gy-4">
                            <div class="form-group col-md-12">
                                <label for="delivery_charge_head_id">Package Name*</span>
                                </label>
                                <input type="text" placeholder="Package Name"
                                    value="{{ $delivery_packages->package_name }}" class="form-control" name="package_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="delivery_charge_head">Charge Category<span class="text-danger">*</span>
                                </label>
                                <select name="delivery_charge_head" id="delivery_charge_head"
                                    class="form-control select2" required>
                                    <option value=""> Select Charge Head </option>
                                    @foreach ($dlivery_charge_heads as $dch)
                                        <option value="{{ $dch->id }}"
                                            {{ $dch->id == $delivery_packages->delivery_charge_head ? 'selected' : '' }}>
                                            {{ $dch->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="division_id">Division<span class="text-danger">*</span> </label>
                                <select name="division_id" id="division_id" class="form-control select2" required>
                                    <option value=""> Select Division </option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}"
                                            {{ $division->id == $delivery_packages->division_id ? 'selected' : '' }}>
                                            {{ $division->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="district_id">District<span class="text-danger">*</span> </label>
                                <select name="district_id" id="district_id" class="form-control select2" required>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ $district->id == $delivery_packages->district_id ? 'selected' : '' }}>
                                            {{ $district->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="thana_id">Thana<span class="text-danger">*</span> </label>
                                <select name="thana_id[]" multiple id="thana_id" class="form-control select2" required>
                                    @foreach ($delivery_packages->getDeliveryAreas as $thana)
                                        <option value="{{ $thana->getThanas->id }}" selected>{{ $thana->getThanas->name }}
                                        </option>
                                    @endforeach
                                </select>
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
                                        value="{{ $delivery_packages->delivery_charge }}">
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
                                        value="{{ $delivery_packages->extra_delivery_charge }}">
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
                                        class="form-control" value="{{ $delivery_packages->cod_charge }}">
                                    @if ($errors->has('cod_charge'))
                                        <span class="invalid-feedback">
                                            <strong></strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="return_charge">Return Charge</label>
                                    <input type="number" step="any" name="return_charge" id="return_charge"
                                        class="form-control" value="{{ $delivery_packages->return_charge }}">
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

        })
    </script>
@endsection
